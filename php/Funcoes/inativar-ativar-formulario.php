<?php
include_once '../conexao/conexao.php';

$cod_formulario = $_POST['cod_formulario'];
$formulario_ativo = $_POST['formulario_ativo'];

$sql_update = "UPDATE fm_formularios SET form_ativo = '$formulario_ativo' WHERE form_codigo = $cod_formulario";

$pdo = Conectar();
$stmt = $pdo->prepare($sql_update);
if ($stmt->execute()) {
    echo '<p>Salvo com sucesso!</p>' . $sql_update;
} else {
    echo '<p>Erro ao salvar!</p>' . $sql_update;
}
