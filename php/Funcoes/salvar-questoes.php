<?php
session_start();

$cod_formulario = $_POST['cod_formulario'];
$desc_questao = $_POST['desc_questao'];
$sigla_questao = $_POST['sigla_questao'];
$html_questao = $_POST['html_questao'];
$questao_ativo = $_POST['questao_ativo'];
$posicao = $_POST['posicao'];
$des_questao_filtrado = $_POST['des_questao_filtrado'];

include_once '../conexao/conexao.php';
$pdo = Conectar();

if (!preg_match('/^[a-zA-Z0-9_]+$/', $des_questao_filtrado)) {
    echo '<p>Erro nos caracteres especiais</p>';
    exit;
}

$sql_insert = "INSERT INTO fm_questoes(ques_descricao,ques_sigla,ques_html,ques_posicao,ques_ativo)
               VALUES(:desc_questao, :sigla_questao, :html_questao, :posicao, :questao_ativo)";

$stmt = $pdo->prepare($sql_insert);
$stmt->bindParam(':desc_questao', $desc_questao);
$stmt->bindParam(':sigla_questao', $sigla_questao);
$stmt->bindParam(':html_questao', $html_questao);
$stmt->bindParam(':posicao', $posicao);
$stmt->bindParam(':questao_ativo', $questao_ativo);

if ($stmt->execute()) {
    //Busca o codigo do ultimo registro para salvar na tabela de formulario_questoes
    $sql_select = "SELECT ques_codigo FROM fm_questoes ORDER BY ques_codigo DESC LIMIT 1";
    $stm = $pdo->prepare($sql_select);
    $stm->execute();
    $retorno = $stm->fetchAll(PDO::FETCH_ASSOC);


    foreach ($retorno as $valor) {
        $cod_questao_inserida = $valor['ques_codigo'];
        $sql_insert_vinculo = "INSERT INTO `fm_formularios_questoes`(fq_form_codigo, fq_ques_codigo, fq_vinculo_ativo)
                               VALUES(:cod_formulario, :cod_questao_inserida, 'SIM')";
        
        $stmt_vinculo = $pdo->prepare($sql_insert_vinculo);
        $stmt_vinculo->bindParam(':cod_formulario', $cod_formulario);
        $stmt_vinculo->bindParam(':cod_questao_inserida', $cod_questao_inserida);

        if ($stmt_vinculo->execute()) {
            //echo '<br>Vinculo salvo com sucesso!' . $sql_insert_vinculo;
        } else {
            echo '<br>Erro ao salvar vinculo' . $sql_insert_vinculo;
        }
    }
} else {
    echo '<p>Erro ao salvar!</p>' . $sql_insert;
}