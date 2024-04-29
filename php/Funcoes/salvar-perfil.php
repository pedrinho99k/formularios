<?php
include_once '../conexao/conexao.php';

$cod_perfil = $_POST['cod_perfil'];
$desc_perfil = $_POST['desc_perfil'];
$perfil_ativo = $_POST['perfil_ativo'];
$cod_nivel = $_POST['cod_nivel'];

$sql_insert = "INSERT INTO fm_perfil(per_descricao,per_ativo,per_nivel)VALUES('$desc_perfil','$perfil_ativo','$cod_nivel')";
$sql_update = "UPDATE fm_perfil SET per_descricao = '$desc_perfil',per_ativo = '$perfil_ativo',per_nivel = '$cod_nivel' WHERE per_codigo = $cod_perfil";
if ($cod_perfil > null) {
    $pdo = Conectar();
    $stmt = $pdo->prepare($sql_update);
    if ($stmt->execute()) {
        echo '<p>Salvo com sucesso!</p>'. $sql_update;
    } else {
        echo '<p>Erro ao salvar!</p>' . $sql_update;
    }
} else {
    $pdo = Conectar();
    $stmt = $pdo->prepare($sql_insert);
    if ($stmt->execute()) {
        echo '<p>Salvo com sucesso!</p>'. $sql_insert;
    } else {
        echo '<p>Erro ao salvar!</p>' . $sql_insert;
    }
}
