<?php

//$sql = "SELECT * FROM fm_formulario_questao JOIN fm_formularios ON form_codigo.fm_formularios = fq_codigo_formulario.fm_formularios_questoes";
$sql = "SELECT * FROM fm_formularios_questoes AS fq
JOIN fm_formularios AS form ON form.form_codigo = fq.fq_form_codigo
JOIN fm_questoes AS ques ON ques.ques_codigo = fq.fq_ques_codigo
ORDER BY fq.fq_codigo DESC";

include_once("../conexao/conexao.php");
$conecta = Conectar();
$stm = $conecta->prepare($sql);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
$retornoJson = json_encode($retorno);
echo $retornoJson;