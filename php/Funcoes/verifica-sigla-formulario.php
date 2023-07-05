<?php
$sigla_formulario = $_POST['sigla_formulario'];

$sql = "SELECT * FROM fm_formularios WHERE form_sigla = '$sigla_formulario'";

include_once("../conexao/conexao.php");
$conecta = Conectar();
$stm = $conecta->prepare($sql);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
$retornoJson = json_encode($retorno);
echo $retornoJson;