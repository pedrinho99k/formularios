<?php
include_once '../conexao/conexao.php';
//Primeiro Busca a sigla d formulario que recebera a alteração
$cod_formulario = $_POST['cod_form'];
$tipo = $_POST['tipo'];
if($tipo == "Visualizar") {
    $cod_dados = $_POST['cod_dados'];
};

$sql_select_form = "SELECT form_sigla FROM fm_formularios WHERE form_codigo = $cod_formulario";
$conecta = Conectar();
$stm = $conecta->prepare($sql_select_form);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
foreach ($retorno as $valor) {
    $sigla_form = $valor['form_sigla'];
}
//Agora ele busca os dados que serão inseridos
// $sql_select_dados = "SELECT * FROM `" . $sigla_form . "` WHERE codigo = " . $cod_dados;

// $sql_select_dados = "SELECT * FROM `{$sigla_form}` LIMIT {$cod_dados}";

if($tipo == "Visualizar") {
    $sql_select_dados = "SELECT * FROM `" . $sigla_form . "` WHERE codigo = " . $cod_dados;
} else {
    $sql_select_dados = "
        SELECT *
        FROM `{$sigla_form}` AS sf
        LEFT JOIN fm_registros AS fr ON sf.codigo = fr.reg_codigo_registro
        WHERE fr.reg_codigo_formulario = $cod_formulario AND fr.reg_ativo = 'SIM'";
}



// if($tipo == "Visualizar") {
//     $sql_select_dados = "SELECT * FROM `" . $sigla_form . "` WHERE codigo = " . $cod_dados;
// } else {
//     $sql_select_dados = "SELECT * FROM `{$sigla_form}` LIMIT {$cod_dados}";
// }

$stm = $conecta->prepare($sql_select_dados);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
$retornoJson = json_encode($retorno);
echo $retornoJson;












// include_once '../conexao/conexao.php';

// // Primeiro, busca a sigla do formulário que receberá a alteração
// $cod_formulario = $_POST['cod_form'];
// $cod_dados = $_POST['cod_dados'];

// // Conexão com o banco de dados
// $conecta = Conectar();

// try {
//     // Busca a sigla do formulário
//     $sql_select_form = "SELECT form_sigla FROM fm_formularios WHERE form_codigo = :cod_formulario";
//     $stm = $conecta->prepare($sql_select_form);
//     $stm->bindParam(':cod_formulario', $cod_formulario, PDO::PARAM_INT);
//     $stm->execute();
//     $retorno = $stm->fetchAll(PDO::FETCH_ASSOC);

//     if (empty($retorno)) {
//         throw new Exception('Formulário não encontrado.');
//     }

//     $sigla_form = $retorno[0]['form_sigla'];

//     // Busca os dados que serão inseridos
//     $sql_select_dados = "SELECT * FROM `{$sigla_form}` WHERE `codigo` = :cod_dados LIMIT 10";
//     $stm = $conecta->prepare($sql_select_dados);
//     $stm->bindParam(':cod_dados', $cod_dados, PDO::PARAM_INT);
//     $stm->execute();
//     $retorno = $stm->fetchAll(PDO::FETCH_ASSOC);

//     // Converte os dados para JSON e envia a resposta
//     $retornoJson = json_encode($retorno);
//     echo $retornoJson;

// } catch (Exception $e) {
//     // Em caso de erro, envia uma resposta com o erro
//     echo json_encode(['error' => $e->getMessage()]);
// }

// // Fecha a conexão
// $conecta = null;
?>