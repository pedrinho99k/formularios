<?php
function Conectar()
{
    require_once("../../config/config.php");
    $dsn = 'mysql:host=' . HOST . ';dbname=' . DB . ';charset=utf8';
    $user = USER;
    $pass = PASS;
    try {
        $pdo = new PDO($dsn, $user, $pass);
        //echo 'Conectado com sucesso!';
        return $pdo;
    } catch (PDOException $ex) {
        echo 'Erro: ' . $ex->getMessage();
    }
}