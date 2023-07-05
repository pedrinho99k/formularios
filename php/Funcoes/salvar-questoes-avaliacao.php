<?php
include_once '../conexao/conexao.php';

$cod_avaliacao = $_POST['cod_avaliacao'];
$desc_questao_avaliacao = $_POST['desc_questao'];
$sigla_questao = $_POST['sigla_questao'];
$html_questao = $_POST['html_questao'];
$posicao = $_POST['posicao'];

if (empty($_POST['cod_questao_avaliacao'])) {
    $pdo = Conectar();
    $html = $pdo->quote($html_questao);
    $desc = $pdo->quote($desc_questao_avaliacao);
    $sql_insert = "INSERT INTO `fm_questoes_avaliacao` (`ques_ava_descricao`, `ques_ava_sigla`, `ques_ava_html`, `ques_ava_posicao`, `ava_codigo`)VALUES($desc,'$sigla_questao',$html,$posicao,$cod_avaliacao)";
    $stmt2 = $pdo->prepare($sql_insert);
    if ($stmt2->execute()) {
        echo '<p>Salvo com sucesso!</p>';
    } else {
        echo '<p>Erro ao salvar!</p>' . $sql_insert;
    }
} else {
    $cod_questao_avaliacao = $_POST['cod_questao_avaliacao'];
    $sql_update = "UPDATE fm_questoes_avaliacao SET 
    ques_ava_descricao=`$desc_questao_avaliacao`,
    ques_ava_sigla=`$sigla_questao`,
    ques_ava_html=`$html_questao`,
    ques_ava_posicao=`$posicao`,
    ava_codigo=`$cod_avaliacao` 
    WHERE ques_ava_codigo=`$cod_questao_avaliacao`";

    $pdo = Conectar();
    $stmt = $pdo->prepare($sql_update);
    if ($stmt->execute()) {
        echo '<p>Salvo com sucesso!</p>';
    } else {
        echo '<p>Erro ao salvar!</p>' . $sql_update;
    }
}

/*
CREATE TABLE fm_questoes_avaliacao(
    ques_ava_codigo INT AUTO INCREMENT,
    ques_ava_descricao TEXT,
    ques_ava_sigla VARCHAR(90),
    ques_ava_html TEXT,
    ques_ava_posicao INT,
    ava_codigo_avaliacao INT, FOREIGN KEY(ava_codigo) REFERENCES fm_avaliacao(ava_codigo),
    ques_ava_ativo VARCHAR(3) DEFAULT 'SIM',
    PRIMARY KEY(ques_ava_codigo)
)*/