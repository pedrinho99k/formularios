<?php
include_once '../conexao/conexao.php';

$cod_questao = $_POST['cod_questao'];
$questao_ativo = $_POST['questao_ativo'];

$sql_update = "UPDATE fm_questoes SET ques_ativo = '$questao_ativo' WHERE ques_codigo = $cod_questao";

$pdo = Conectar();
$stmt = $pdo->prepare($sql_update);
if ($stmt->execute()) {
    echo '<p>Salvo com sucesso!</p>' . $sql_update;
} else {
    echo '<p>Erro ao salvar!</p>' . $sql_update;
}
