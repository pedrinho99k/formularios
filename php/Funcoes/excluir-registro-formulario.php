<?php
include_once '../conexao/conexao.php';

$cod_registro = $_POST['cod_registro'];
$registro_ativo = "EXCLUIDO";

$sql_update = "UPDATE fm_registros SET reg_ativo = '$registro_ativo' WHERE reg_codigo = $cod_registro";

$pdo = Conectar();
$stmt = $pdo->prepare($sql_update);
if ($stmt->execute()) {
    echo '<p>Excluido com sucesso!</p>';
} else {
    echo '<p>Erro ao salvar!</p>' . $sql_update;
}
