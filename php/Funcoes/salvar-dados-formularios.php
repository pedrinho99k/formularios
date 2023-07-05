<?php
include_once '../conexao/conexao.php';
date_default_timezone_set('America/Sao_Paulo');
$data_hora_registro = date('Y-m-d H:i:s');

$codigo_dados = $_POST['codigo'];

if (empty($codigo_dados)) {
    $dados = $_POST['dados'];
    $cod_formulario = $_POST['cod_form'];
    $cod_usuario = $_POST['cod_usuario'];
    for ($i = 0; $i < count($dados); $i++) { //Remove o index codigo pois não precisamos dele
        switch ($dados[$i]['name']) {
            case "codigo":
                unset($dados[$i]);
                break;
        }
    }

    $sql_insert = "INSERT INTO `" . $_POST['sigla_form'] . "`(";
    for ($i = 1; $i <= count($dados); $i++) {
        if (count($dados) == $i ) {
            $sql_insert .= " `" . $dados[$i]['name'] . "`)VALUES(";
        } else {
            $sql_insert .= " `" . $dados[$i]['name'] . "`,";
        }
    }
    for ($i = 1; $i <= count($dados); $i++) {
        if (count($dados) == $i ) {
            $sql_insert .= " '" . $dados[$i]['value'] . "')";
        } else {
            $sql_insert .= " '" . $dados[$i]['value'] . "',";
        }
    }
    //echo $sql_insert;
    $pdo = Conectar();
    $stmt = $pdo->prepare($sql_insert);
    if ($stmt->execute()) {
        echo 'Salvo com sucesso!';
        //Busca o codigo do ultimo registro para salvar na tabela de registros
        $sql_select = "SELECT `codigo` FROM `" . $_POST['sigla_form'] . "` ORDER BY codigo DESC LIMIT 1";
        $stm = $pdo->prepare($sql_select);
        $stm->execute();
        $retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($retorno as $valor) {
            $cod_registro_inserido = $valor['codigo'];
        }

        //Salva o codigo do registro de dados na tabela de registros para questões de auditoria e alteração de dados
        $sql_insert_registro = "INSERT INTO fm_registros(
        reg_codigo_formulario,
        reg_codigo_usuario,
        reg_codigo_registro,
        reg_tipo,
        reg_data_hora,
        reg_ativo)VALUES(
            $cod_formulario,
            $cod_usuario,
            $cod_registro_inserido,
            'Inserido',
            '$data_hora_registro',
            'SIM')";
        $stmt = $pdo->prepare($sql_insert_registro);
        if ($stmt->execute()) {
            // echo '<p>Registro Salvo com sucesso!</p>';
        } else {
            echo '<p>Erro ao salvar registro!</p>' . $sql_insert_registro;
        }
    } else {
        echo '<p>Erro ao salvar dados do form!</p>' . $sql_insert;
    }
} else {
    $dados = $_POST['dados'];
    $cod_formulario = $_POST['cod_form'];
    $cod_usuario = $_POST['cod_usuario'];
    $cod_registro = $_POST['cod_registro'];
    for ($i = 0; $i < count($dados); $i++) { //Remove o index codigo pois não precisamos dele
        switch ($dados[$i]['name']) {
            case "codigo":
                unset($dados[$i]);
                break;
        }
    }
    $sql_update = "UPDATE `" . $_POST['sigla_form'] . "` SET";
    for ($i = 1; $i <= count($dados); $i++) {
        if (count($dados) == $i ) {
            $sql_update .= " `" . $dados[$i]['name'] . "` = '" . $dados[$i]['value'] . "' WHERE codigo = " . $codigo_dados;
        } else {
            $sql_update .= " `" . $dados[$i]['name'] . "` = '" . $dados[$i]['value'] . "',";
        }
    }
    //echo $sql_update;
    $pdo = Conectar();
    $stmt = $pdo->prepare($sql_update);
    if ($stmt->execute()) {
        echo 'Salvo com sucesso!';

        //Salva o codigo do registro de dados na tabela de registros para questões de auditoria e alteração de dados
        $sql_insert_registro = "INSERT INTO fm_registros(
        reg_codigo_formulario,
        reg_codigo_usuario,
        reg_codigo_registro,
        reg_tipo,
        reg_data_hora,
        reg_ativo)VALUES(
            $cod_formulario,
            $cod_usuario,
            $codigo_dados,
            'Alterado',
            '$data_hora_registro',
            'SIM')";
        $stmt = $pdo->prepare($sql_insert_registro);
        if ($stmt->execute()) {
            // echo '<p>Registro Salvo com sucesso!</p>';
            //Coloca o compo ativo como 'não' para não aparecer o registro alterado ser alterado novamente 
            $sql_update_registro = "UPDATE fm_registros SET reg_ativo = 'NÃO' WHERE reg_codigo = $cod_registro";
            $stmt = $pdo->prepare($sql_update_registro);
            if ($stmt->execute()) {
                // echo '<p>Registro Alterado com sucesso!</p>';
            } else {
                echo '<p>Erro ao salvar registro!</p>' . $sql_update_registro;
            }
        } else {
            echo '<p>Erro ao salvar registro!</p>' . $sql_insert_registro;
        }
    } else {
        echo '<p>Erro ao salvar dados do form!</p>' . $sql_update;
    }
}


//

//
/*
if ($codigo_dados == null) {

    $pdo = Conectar();
    $stmt = $pdo->prepare($sql_insert);
    if ($stmt->execute()) {
        echo '<p>Salvo com sucesso!</p>';
        //Busca o codigo do ultimo registro para salvar na tabela de registros
        $sql_select = "SELECT `codigo` FROM `" . $_POST['sigla_form'] . "` ORDER BY codigo DESC LIMIT 1";
        $stm = $pdo->prepare($sql_select);
        $stm->execute();
        $retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($retorno as $valor) {
            $cod_registro_inserido = $valor['codigo'];
        }


        //Salva o codigo do registro de dados na tabela de registros para questões de auditoria e alteração de dados
        $sql_insert_registro = "INSERT INTO fm_registros(
        reg_codigo_formulario,
        reg_codigo_usuario,
        reg_codigo_registro,
        reg_tipo,
        reg_data_hora,
        reg_ativo)VALUES(
            $cod_formulario,
            $cod_usuario,
            $cod_registro_inserido,
            'Inserido',
            '$data_hora_registro',
            'SIM')";
        $stmt = $pdo->prepare($sql_insert_registro);
        if ($stmt->execute()) {
            // echo '<p>Registro Salvo com sucesso!</p>';
        } else {
            echo '<p>Erro ao salvar registro!</p>' . $sql_insert_registro;
        }
    } else {
        echo '<p>Erro ao salvar dados do form!</p>' . $sql_insert;
    }
} else {
    echo $sql_update;
    $pdo = Conectar();
    $stmt = $pdo->prepare($sql_update);
    if ($stmt->execute()) {
        echo '<p>Salvo com sucesso!</p>';

        //Salva o codigo do registro de dados na tabela de registros para questões de auditoria e alteração de dados
        $sql_insert_registro = "INSERT INTO fm_registros(
        reg_codigo_formulario,
        reg_codigo_usuario,
        reg_codigo_registro,
        reg_tipo,
        reg_data_hora,
        reg_ativo)VALUES(
            $cod_formulario,
            $cod_usuario,
            $codigo_dados,
            'Alterado',
            '$data_hora_registro',
            'SIM')";
        $stmt = $pdo->prepare($sql_insert_registro);
        if ($stmt->execute()) {
            // echo '<p>Registro Salvo com sucesso!</p>';
            //Coloca o compo ativo como 'não' para não aparecer o registro alterado ser alterado novamente 
            $sql_update_registro = "UPDATE fm_registros SET reg_ativo = 'NÃO' WHERE reg_codigo = $cod_registro";
            $stmt = $pdo->prepare($sql_update_registro);
            if ($stmt->execute()) {
                // echo '<p>Registro Alterado com sucesso!</p>';
            } else {
                echo '<p>Erro ao salvar registro!</p>' . $sql_update_registro;
            }
        } else {
            echo '<p>Erro ao salvar registro!</p>' . $sql_insert_registro;
        }
    } else {
        echo '<p>Erro ao salvar dados do form!</p>' . $sql_insert;
    }
}
*/