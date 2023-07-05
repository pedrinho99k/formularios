<?php

if (empty($_POST['campo'])) {
    $campo = 'ques_codigo';
}
if (empty($_POST['ordenacao'])) {
    $ordenacao = 'DESC';
} else {
    $ordenacao = $_POST['ordenacao'];
    $campo = $_POST['campo'];
}

$sql = "SELECT * FROM fm_questoes ORDER BY $campo $ordenacao";

include_once("../conexao/conexao.php");
$conecta = Conectar();
$stm = $conecta->prepare($sql);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
$retornoJson = json_encode($retorno);
echo $retornoJson;
