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
function buscarDados($cod_formulario, $sigla_form, $tipo, $cod_dados = null) {
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
        
        $stm = $conecta->prepare($sql_select_dados);
        $stm->bindParam(':cod_formulario', $cod_formulario, PDO::PARAM_INT);
    }

    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}

// Recebe as variáveis via POST
$cod_formulario = $_POST['cod_form'];
$tipo = $_POST['tipo'];
$cod_dados = ($_POST['cod_dados'] ?? null);

// Obtém a sigla do formulário
$sigla_form = buscarSiglaFormulario($cod_formulario);

// Busca os dados com base no tipo de operação e retorna como JSON
$retorno = buscarDados($cod_formulario, $sigla_form, $tipo, $cod_dados);
$retornoJson = json_encode($retorno);
echo $retornoJson;
?>