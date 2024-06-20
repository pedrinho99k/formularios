<?php
session_start();

include_once '../conexao/conexao.php';
$pdo = Conectar();

// $cod_form = $_POST['cod_form'];

// $sql = "SELECT * FROM fm_questoes
//   JOIN fm_formularios_questoes ON fq_ques_codigo = ques_codigo
//   WHERE fq_form_codigo = $cod_form";

// $cod_form_json = json_encode($cod_form);
// echo $cod_form_json;


$cod_form = $_POST['cod_form'];

$sql = "SELECT * FROM fm_questoes
  JOIN fm_formularios_questoes ON fq_ques_codigo = ques_codigo
  WHERE fq_form_codigo = :cod_form";


$stmt = $pdo->prepare($sql);
$stmt->bindParam(':cod_form', $cod_form, PDO::PARAM_INT);
$stmt->execute();
$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($retorno);