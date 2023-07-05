<?php
$cod_formulario = $_POST['cod_formulario'];

$sql = "SELECT * FROM fm_formularios WHERE form_codigo = $cod_formulario";

include_once("../conexao/conexao.php");
$conecta = Conectar();
$stm = $conecta->prepare($sql);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
$retornoJson = json_encode($retorno);
echo $retornoJson;