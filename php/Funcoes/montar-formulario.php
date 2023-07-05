<?php
$cod_formulario = $_POST['cod_formulario'];

$sql = "SELECT * FROM fm_formularios_questoes AS fq
JOIN fm_formularios AS form ON fq.fq_form_codigo = form.form_codigo
JOIN fm_questoes AS ques ON fq.fq_ques_codigo = ques.ques_codigo
WHERE form.form_codigo = $cod_formulario
AND fq.fq_vinculo_ativo = 'SIM'
AND form.form_ativo = 'SIM'
AND ques.ques_ativo = 'SIM'
ORDER BY ques.ques_posicao ASC";

include_once("../conexao/conexao.php");
$conecta = Conectar();
$stm = $conecta->prepare($sql);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
$retornoJson = json_encode($retorno);
echo $retornoJson;