<?php
$login = "guilherme.santos";
$usu_nome = "Guilherme Marins dos Santos";
//Salva as informações vindas do AD no BD do Boletim Médico
include_once("./php/conexao/conexao.php");
$conecta = Conectar1();
$sql_select = "SELECT*FROM bm_usuarios WHERE usu_login = '$login'";
$stm = $conecta->prepare($sql_select);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
if (count($retorno) == 0) {

    $sql_insert = "INSERT INTO bm_usuarios (usu_login,usu_nome,usu_email)VALUES('$login','$usu_nome','$usu_email')";
    $stmt = $conecta->prepare($sql_insert);

    if ($stmt->execute()) {
        //echo "Salvo com sucesso!";
        $sql_select = "SELECT*FROM bm_usuarios WHERE usu_login = '$login'";
        $stm = $conecta->prepare($sql_select);
        $stm->execute();
        $retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
        if (count($retorno) > 0) {
            for ($i = 0; $i < count($retorno); $i++) {
                $_SESSION['usuarioId'] = $retorno[$i]['usu_codigo'];
                $_SESSION['usuarioNome'] = $retorno[$i]['usu_nome'];
                $_SESSION['usuarioEmail'] = $retorno[$i]['usu_email'];
                $_SESSION['usuarioAtivo'] = $retorno[$i]['usu_ativo'];
            }
        } else {
            echo "Erro ao buscar informações";
        }
    } else {
        echo "Erro ao Salvar!" . $sql_insert;
    }
} else {
    for ($i = 0; $i < count($retorno); $i++) {
        $_SESSION['usuarioId'] = $retorno[$i]['usu_codigo'];
        $_SESSION['usuarioNome'] = $retorno[$i]['usu_nome'];
        $_SESSION['usuarioEmail'] = $retorno[$i]['usu_email'];
        $_SESSION['usuarioAtivo'] = $retorno[$i]['usu_ativo'];
        echo $retorno[$i]['usu_codigo'];
        echo $retorno[$i]['usu_ativo'];
    }
}
