<?php
include_once '../conexao/conexao.php';
$conecta = Conectar();
$sql_select = "SELECT `codigo` FROM `dados_ahpaceg` ORDER BY codigo DESC LIMIT 1";
$stm = $conecta->prepare($sql_select);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
//var_dump($retorno);
foreach ($retorno as $value) {
    echo $value['codigo'];
}
