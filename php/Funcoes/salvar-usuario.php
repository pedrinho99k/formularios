<?php
include_once '../conexao/conexao.php';

$cod_usuario = $_POST['cod_usuario'];
$login_usuario = $_POST['login_usuario'];
$nome_usuario = $_POST['nome_usuario'];
$email_usuario = $_POST['email_usuario'];
$cod_perfil_usuario = $_POST['cod_perfil_usuario'];
$usuario_ativo = $_POST['usuario_ativo'];

$sql_insert = "INSERT INTO fm_usuarios(usu_login,usu_nome,usu_email,usu_codigo_perfil,usu_ativo)VALUES('$login_usuario','$nome_usuario','$email_usuario',$cod_perfil_usuario,'$usuario_ativo')";
$sql_update = "UPDATE fm_usuarios SET usu_login = '$login_usuario', usu_nome = '$nome_usuario', usu_email = '$email_usuario', usu_codigo_perfil = $cod_perfil_usuario, usu_ativo = '$usuario_ativo' WHERE usu_codigo = $cod_usuario";
if ($cod_usuario > null) {
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
