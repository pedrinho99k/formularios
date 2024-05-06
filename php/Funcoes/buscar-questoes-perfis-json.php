<?php
session_start();

$cod_perfil = $_SESSION['codPerfil'];

if (empty($_POST['campo'])) {
  $campo = 'ques_codigo';
}
if (empty($_POST['ordenacao'])) {
  $ordenacao = 'DESC';
} else {
  $ordenacao = $_POST['ordenacao'];
  $campo = $_POST['campo'];
}

// SQL para as questoes do perfil
$sql = "SELECT * FROM fm_formularios_questoes
JOIN fm_formularios ON fm_formularios.form_codigo = fm_formularios_questoes.fq_form_codigo
JOIN fm_questoes ON fm_questoes.ques_codigo = fm_formularios_questoes.fq_ques_codigo
WHERE fm_formularios_questoes.fq_form_codigo IN
(SELECT fp_codigo_formulario FROM fm_formulario_perfil WHERE fp_codigo_perfil = :cod_perfil AND ques_descricao <> 'codigo')";

include_once("../conexao/conexao.php");
$conecta = Conectar();
$stm = $conecta->prepare($sql);
$stm->bindParam(':cod_perfil', $cod_perfil, PDO::PARAM_INT);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
$retornoJson = json_encode($retorno);
echo $retornoJson;