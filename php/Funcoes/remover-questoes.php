<?php
include_once '../conexao/conexao.php';

$cod_formulario = $_POST['cod_formulario'];
$sigla_questao = $_POST['sigla_questao'];


$sql_select = "SELECT `ques_codigo` FROM `fm_questoes` WHERE `ques_sigla` = '$sigla_questao' ORDER BY `ques_codigo` DESC LIMIT 1";
$pdo = Conectar();
$stm = $pdo->prepare($sql_select);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
foreach ($retorno as $valor) {
    $cod_questao_remover = $valor['ques_codigo'];
    //Primeiro ele deleta o vinculo da questao com o formulario
    $sql_delete_vinculo = "DELETE FROM `fm_formularios_questoes` 
    WHERE `fm_formularios_questoes`.`fq_ques_codigo` = $cod_questao_remover 
    AND `fm_formularios_questoes`.`fq_form_codigo` = $cod_formulario";
    $stm = $pdo->prepare($sql_delete_vinculo);
    if ($stm->execute()) {
        //Depois ele deleta a pergunta da tabela de questao
        $sql_delete_questao = "DELETE FROM `fm_questoes` WHERE `fm_questoes`.`ques_codigo` = $cod_questao_remover";
        $stm = $pdo->prepare($sql_delete_questao);
        if ($stm->execute()) {
            echo "<p>Deletada com sucesso!</p>";
        } else {
            echo "<p>Erro ao deletar vinculo!</p>" . $sql_delete_questao;
        }
    } else {
        echo "<p>Erro ao deletar vinculo!</p>" . $sql_delete_vinculo;
    }
}
