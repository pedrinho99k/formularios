<?php
include_once '../conexao/conexao.php';

$cod_formulario = 2;
$cod_questao = 2;

$sql_select = "SELECT*FROM fm_formulario_questao WHERE fq_codigo_formulario = $cod_formulario AND fq_codigo_questao = $cod_questao";
$conecta = Conectar();
$stm = $conecta->prepare($sql_select);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
if(count($retorno) > 0){
    
}else{
    echo 'test';
}
