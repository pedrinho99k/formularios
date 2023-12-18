<?php

$sql = "SELECT * FROM fm_usuarios JOIN fm_perfil ON fm_perfil.per_codigo = fm_usuarios.usu_codigo_perfil ORDER BY usu_nome";

include_once("../conexao/conexao.php");
$conecta = Conectar();
$stm = $conecta->prepare($sql);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
$retornoJson = json_encode($retorno);
echo $retornoJson;
