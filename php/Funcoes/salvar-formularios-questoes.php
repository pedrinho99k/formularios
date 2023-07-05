<?php
include_once '../conexao/conexao.php';

$cod_formulario = $_POST['cod_formulario'];
$cod_questao = $_POST['cod_questao'];
$vinculo_ativo = $_POST['vinculo_ativo'];

$sql_select = "SELECT*FROM fm_formularios_questoes WHERE fq_form_codigo = $cod_formulario AND fq_ques_codigo = $cod_questao";
$conecta = Conectar();
$stm = $conecta->prepare($sql_select);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
if (count($retorno) > 0) {
    echo 'Vinculo já existe!';
} else {
    $sql_insert = "INSERT INTO fm_formularios_questoes(fq_form_codigo,fq_ques_codigo,fq_vinculo_ativo)VALUES($cod_formulario,$cod_questao,'$vinculo_ativo')";
    $pdo = Conectar();
    $stmt = $pdo->prepare($sql_insert);
    if ($stmt->execute()) {
        echo 'Salvo com sucesso!';
    } else {
        echo 'Erro ao salvar!' . $sql_insert;
    }
}
