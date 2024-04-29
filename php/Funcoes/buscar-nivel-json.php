<?php

// SELECT DISTINCT não repete os itens e ORDER BY organizar os itens
$sql = "SELECT DISTINCT per_nivel FROM fm_perfil ORDER BY CASE per_nivel WHEN 'Básico' THEN 1 WHEN 'Intermediário' THEN 2 WHEN 'Avançado' THEN 3 END";

include_once("../conexao/conexao.php");
$conecta = Conectar();
$stm = $conecta->prepare($sql);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
$retornoJson = json_encode($retorno);
echo $retornoJson;