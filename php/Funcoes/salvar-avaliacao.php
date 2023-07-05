<?php
include_once '../conexao/conexao.php';

$nome_avaliacao = $_POST['nome_avaliacao'];
$desc_avaliacao = $_POST['desc_avaliacao'];
$ava_login = $_POST['ava_login'];
if (empty($_POST['cod_avaliacao'])) {
    $sql_insert = "INSERT INTO fm_avaliacoes(ava_nome,ava_descricao,ava_login)VALUES('$nome_avaliacao','$desc_avaliacao','$ava_login')";
    $pdo = Conectar();
    $stmt = $pdo->prepare($sql_insert);
    if ($stmt->execute()) {
        //echo "Salvo com sucesso";
        //Busca o codigo do ultimo registro
        $sql_select = "SELECT `ava_codigo` FROM `fm_avaliacoes` ORDER BY ava_codigo DESC LIMIT 1";
        $stm = $pdo->prepare($sql_select);
        $stm->execute();
        $retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($retorno as $valor) {
            echo $valor['ava_codigo'];
        }
    } else {
        echo 'Erro ao salvar' + $sql_insert;
    }
} else {
    $cod_avaliacao = $_POST['cod_avaliacao'];
    $sql_update = "UPDATE fm_avaliacoes SET ava_nome = `$nome_avaliacao`,ava_descricao = `$desc_avaliacao`, ava_login = `$ava_login` WHERE ava_codigo = $cod_avaliacao";
    $pdo = Conectar();
    $stmt = $pdo->prepare($sql_update);
    if ($stmt->execute()) {
        echo 'Atualizado com sucesso!';
    } else {
        echo 'Erro ao salvar' + $sql_update;
    }
}
