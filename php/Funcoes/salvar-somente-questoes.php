<?php
include_once '../conexao/conexao.php';
$cod_questao = $_POST['cod_questao'];
$desc_questao = $_POST['desc_questao'];
$sigla_questao = $_POST['sigla_questao'];
$html_questao = $_POST['html_questao'];
$questao_ativo = $_POST['questao_ativo'];
$posicao = $_POST['posicao_questao'];

$sql_insert = "INSERT INTO fm_questoes(ques_descricao,ques_sigla,ques_html,ques_posicao,ques_ativo)VALUES('$desc_questao','$sigla_questao','$html_questao',$posicao,'$questao_ativo')";

$sql_update = "UPDATE fm_questoes SET
    ques_descricao = '$desc_questao',
    ques_sigla = '$sigla_questao',
    ques_html = '$html_questao',
    ques_posicao = $posicao,
    ques_ativo = '$questao_ativo'
    WHERE ques_codigo = $cod_questao;
";

if (empty($_POST['cod_questao'])) {
    $pdo = Conectar();
    $stmt = $pdo->prepare($sql_insert);
    if ($stmt->execute()) {
        echo '<p>Salvo com sucesso!</p>';
    } else {
        echo '<p>Erro ao salvar!</p>' . $sql_insert;
    }
} else {
    $pdo = Conectar();
    $stmt = $pdo->prepare($sql_update);
    if ($stmt->execute()) {
        echo '<p>Salvo com sucesso!</p>';
    } else {
        echo '<p>Erro ao salvar!</p>' . $sql_update;
    }
}
