<?php
$cod_questao = $_POST['cod_questao'];

$sql = "SELECT * FROM fm_questoes WHERE ques_codigo = $cod_questao";

include_once("../conexao/conexao.php");
$conecta = Conectar();
$stm = $conecta->prepare($sql);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
$retornoJson = json_encode($retorno);
echo $retornoJson;