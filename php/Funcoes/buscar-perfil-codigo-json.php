<?php
$cod_perfil = $_POST['cod_perfil'];

$sql = "SELECT * FROM fm_perfil WHERE per_codigo = $cod_perfil";

include_once("../conexao/conexao.php");
$conecta = Conectar();
$stm = $conecta->prepare($sql);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
$retornoJson = json_encode($retorno);
echo $retornoJson;