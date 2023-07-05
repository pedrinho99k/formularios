<?php
include_once '../conexao/conexao.php';

$cod_perfil = $_POST['cod_perfil'];
$perfil_ativo = $_POST['perfil_ativo'];

$sql_update = "UPDATE fm_perfil SET per_ativo = '$perfil_ativo' WHERE per_codigo = $cod_perfil";

$pdo = Conectar();
$stmt = $pdo->prepare($sql_update);
if ($stmt->execute()) {
    echo '<p>Salvo com sucesso!</p>' . $sql_update;
} else {
    echo '<p>Erro ao salvar!</p>' . $sql_update;
}
