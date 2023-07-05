<?php
include_once '../conexao/conexao.php';

$cod_vinculo = $_POST['cod_vinculo'];
$vinculo_ativo = $_POST['vinculo_ativo'];

$sql_update = "UPDATE fm_formularios_questoes SET fq_vinculo_ativo = '$vinculo_ativo' WHERE fq_codigo = $cod_vinculo";

$pdo = Conectar();
$stmt = $pdo->prepare($sql_update);
if ($stmt->execute()) {
    echo '<p>Salvo com sucesso!</p>' . $sql_update;
} else {
    echo '<p>Erro ao salvar!</p>' . $sql_update;
}
