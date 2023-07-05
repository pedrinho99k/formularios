<?php
include_once '../conexao/conexao.php';
//Primeiro Busca a sigla d formulario que recebera a alteração
$cod_formulario = $_POST['cod_form'];
$cod_dados = $_POST['cod_dados'];
$sql_select_form = "SELECT form_sigla FROM fm_formularios WHERE form_codigo = $cod_formulario";
$conecta = Conectar();
$stm = $conecta->prepare($sql_select_form);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
foreach ($retorno as $valor) {
    $sigla_form = $valor['form_sigla'];
}
//Agora ele busca os dados que serão inseridos
$sql_select_dados = "SELECT * FROM `" . $sigla_form . "` WHERE codigo = " . $cod_dados;

$stm = $conecta->prepare($sql_select_dados);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
$retornoJson = json_encode($retorno);
echo $retornoJson;