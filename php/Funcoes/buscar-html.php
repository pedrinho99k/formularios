<?php

// if (empty($_POST['campo'])) {
//     $campo = 'ques_codigo';
// }
// if (empty($_POST['ordenacao'])) {
//     $ordenacao = 'DESC';
// } else {
//     $ordenacao = $_POST['ordenacao'];
//     $campo = $_POST['campo'];
// }

// $sql = "SELECT ques_html FROM fm_questoes ORDER BY $campo $ordenacao";

$sql = "SELECT ques_html FROM fm_questoes";

// include_once("../conexao/conexao.php");
// $conecta = Conectar();
// $stm = $conecta->prepare($sql);
// $stm->execute();
// $retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
// $retornoJson = json_encode($retorno);
// echo $retornoJson;

include_once("../conexao/conexao.php");
$conecta = Conectar();
$stm = $conecta->prepare($sql);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);

$htmlQuestoes = array_column($retorno, 'ques_html');

foreach ($htmlQuestoes as $html) {
  echo $html;
}