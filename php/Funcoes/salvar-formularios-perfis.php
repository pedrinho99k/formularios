<?php
include_once '../conexao/conexao.php';

$cod_formulario = $_POST['cod_formulario'];
$cod_perfil = $_POST['cod_perfil'];
$vinculo_ativo = $_POST['vinculo_ativo'];

$sql_select = "SELECT*FROM fm_formulario_perfil WHERE fp_codigo_formulario = $cod_formulario AND fp_codigo_perfil = $cod_perfil";
$conecta = Conectar();
$stm = $conecta->prepare($sql_select);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
if (count($retorno) > 0) {
    echo 'Vinculo já existe!';
} else {
    $sql_insert = "INSERT INTO fm_formulario_perfil(fp_codigo_formulario,fp_codigo_perfil,fp_ativo)VALUES('$cod_formulario','$cod_perfil','$vinculo_ativo')";
    $pdo = Conectar();
    $stmt = $pdo->prepare($sql_insert);
    if ($stmt->execute()) {
        echo 'Salvo com sucesso!';
    } else {
        echo 'Erro ao salvar! ' . $sql_insert;
    }
}
