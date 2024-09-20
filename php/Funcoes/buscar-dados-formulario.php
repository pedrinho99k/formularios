<?php
include_once '../conexao/conexao.php';

// Função para buscar a sigla do formulário
function buscarSiglaFormulario($cod_formulario) {
    $sql_select_form = "SELECT form_sigla FROM fm_formularios WHERE form_codigo = :cod_formulario";
    $conecta = Conectar();
    $stm = $conecta->prepare($sql_select_form);
    $stm->bindParam(':cod_formulario', $cod_formulario, PDO::PARAM_INT);
    $stm->execute();
    $retorno = $stm->fetch(PDO::FETCH_ASSOC);
    return $retorno['form_sigla'];
}

// Função para buscar os dados com base no tipo de operação
function buscarDados($cod_formulario, $sigla_form, $tipo, $cod_dados = null, $termo_pesquisa = '') {
    $conecta = Conectar();
    if ($tipo == "Visualizar") {
        // Consulta para visualização específica de um registro
        $sql_select_dados = "
            SELECT *
            FROM `{$sigla_form}`
            WHERE codigo = :cod_dados";
        
        $stm = $conecta->prepare($sql_select_dados);
        $stm->bindParam(':cod_dados', $cod_dados, PDO::PARAM_INT);
    } else {
        // Consulta padrão para exibição de dados
        $sql_select_dados = "
            SELECT *
            FROM `{$sigla_form}` AS sf
            LEFT JOIN fm_registros AS fr ON sf.codigo = fr.reg_codigo_registro
            WHERE fr.reg_codigo_formulario = :cod_formulario
            AND fr.reg_ativo = 'SIM'";
        
        // Adiciona lógica de pesquisa se houver um termo
        if (!empty($termo_pesquisa)) {
            $sql_select_dados .= " AND (";

            // Busca os nomes das colunas dinamicamente
            $colunas_sql = "SELECT column_name 
                            FROM information_schema.columns 
                            WHERE table_name = :tabela";
            $stm_colunas = $conecta->prepare($colunas_sql);
            $stm_colunas->bindParam(':tabela', $sigla_form, PDO::PARAM_STR);
            $stm_colunas->execute();
            $colunas = $stm_colunas->fetchAll(PDO::FETCH_COLUMN);

            // Construa a pesquisa com LIKE para cada coluna
            $where_clauses = [];
            $parametros = [];
            foreach ($colunas as $index => $coluna) {
                $param_name = ":termo_pesquisa_{$index}";
                $where_clauses[] = "$coluna LIKE $param_name";
                $parametros[$param_name] = "%{$termo_pesquisa}%";  // Guarda o termo de pesquisa para vincular depois
            }

            // Concatena as condições no SQL
            $sql_select_dados .= implode(' OR ', $where_clauses);
            $sql_select_dados .= ")";

            // Preparação da query com o termo de pesquisa
            $stm = $conecta->prepare($sql_select_dados);
            $stm->bindParam(':cod_formulario', $cod_formulario, PDO::PARAM_INT);

            // Vincula os parâmetros de pesquisa dinamicamente
            foreach ($parametros as $param_name => $param_value) {
                $stm->bindValue($param_name, $param_value, PDO::PARAM_STR);
            }
        } else {
            // Preparação da query sem termo de pesquisa
            $stm = $conecta->prepare($sql_select_dados);
            $stm->bindParam(':cod_formulario', $cod_formulario, PDO::PARAM_INT);
        }
    }
    // Executa a query
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}

// Recebe as variáveis via POST
$cod_formulario = $_POST['cod_form'];
$tipo = $_POST['tipo'];
$cod_dados = ($_POST['cod_dados'] ?? null);
$termo_pesquisa = $_POST['pesquisa'] ?? ''; // Novo campo de pesquisa

// Obtém a sigla do formulário
$sigla_form = buscarSiglaFormulario($cod_formulario);

// Busca os dados com base no tipo de operação e retorna como JSON
$retorno = buscarDados($cod_formulario, $sigla_form, $tipo, $cod_dados, $termo_pesquisa);
$retornoJson = json_encode($retorno);
echo $retornoJson;
?>