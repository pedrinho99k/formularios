<?php
include_once '../conexao/conexao.php';

$cod_formulario = $_POST['cod_formulario'];
$desc_questao = $_POST['desc_questao'];
$sigla_questao = $_POST['sigla_questao'];
$html_questao = $_POST['html_questao'];
$questao_ativo = $_POST['questao_ativo'];
$posicao = $_POST['posicao'];

$sql_insert = "INSERT INTO fm_questoes(ques_descricao,ques_sigla,ques_html,ques_posicao,ques_ativo)VALUES('$desc_questao','$sigla_questao','$html_questao',$posicao,'$questao_ativo')";
$pdo = Conectar();
$stmt = $pdo->prepare($sql_insert);
if ($stmt->execute()) {
    //echo '<p>Salvo com sucesso!</p>' . $sql_insert;
    //Busca o codigo do ultimo registro para salvar na tabela de formulario_questoes
    $sql_select = "SELECT `ques_codigo` FROM `fm_questoes` ORDER BY ques_codigo DESC LIMIT 1";
    $stm = $pdo->prepare($sql_select);
    $stm->execute();
    $retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
    foreach ($retorno as $valor) {
        $cod_questao_inserida = $valor['ques_codigo'];
        $sql_insert_vinculo = "INSERT INTO `fm_formularios_questoes`(fq_form_codigo,fq_ques_codigo,fq_vinculo_ativo)VALUES($cod_formulario,$cod_questao_inserida,'SIM')";
        $pdo = Conectar();
        $stmt = $pdo->prepare($sql_insert_vinculo);
        if ($stmt->execute()) {
            //echo '<br>Vinculo salvo com sucesso!' . $sql_insert_vinculo;
        } else {
            echo '<br>Erro ao salvar vinculo' . $sql_insert_vinculo;
        }
    }
} else {
    echo '<p>Erro ao salvar!</p>' . $sql_insert;
}
