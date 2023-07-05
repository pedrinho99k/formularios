<?php
include_once '../conexao/conexao.php';

$cod_usuario = $_POST['cod_usuario'];
$usuario_ativo = $_POST['usuario_ativo'];

$sql_update = "UPDATE fm_usuarios SET usu_ativo = '$usuario_ativo' WHERE usu_codigo = $cod_usuario";

$pdo = Conectar();
$stmt = $pdo->prepare($sql_update);
if ($stmt->execute()) {
    echo '<p>Salvo com sucesso!</p>' . $sql_update;
} else {
    echo '<p>Erro ao salvar!</p>' . $sql_update;
}
