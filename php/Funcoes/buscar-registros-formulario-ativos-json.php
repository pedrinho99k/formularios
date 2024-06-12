<?php
$cod_form = $_POST['cod_formulario'];

// if (empty($_POST['cod_usuario'])) {
//     $sql = "SELECT *
// FROM fm_registros AS reg 
// JOIN fm_formularios as form ON reg.reg_codigo_formulario = form.form_codigo
// JOIN fm_usuarios as usu ON reg.reg_codigo_usuario = usu.usu_codigo
// WHERE form.form_codigo = $cod_form
// AND form.form_ativo = 'SIM'
// AND reg.reg_ativo = 'SIM' 
// ORDER BY reg.reg_codigo DESC";
// } else {
//     $cod_usuario = $_POST['cod_usuario'];
//     $sql = "SELECT *
// FROM fm_registros AS reg 
// JOIN fm_formularios as form ON reg.reg_codigo_formulario = form.form_codigo
// JOIN fm_usuarios as usu ON reg.reg_codigo_usuario = usu.usu_codigo
// WHERE reg.reg_codigo_usuario = $cod_usuario 
// AND form.form_codigo = $cod_form
// AND form.form_ativo = 'SIM'
// AND reg.reg_ativo = 'SIM' 
// ORDER BY reg.reg_codigo DESC";
// }

$sql = "SELECT *
FROM fm_registros AS reg 
JOIN fm_formularios as form ON reg.reg_codigo_formulario = form.form_codigo
JOIN fm_usuarios as usu ON reg.reg_codigo_usuario = usu.usu_codigo
WHERE form.form_codigo = $cod_form
AND form.form_ativo = 'SIM'
AND reg.reg_ativo = 'SIM' 
ORDER BY reg.reg_codigo DESC";

include_once("../conexao/conexao.php");
$conecta = Conectar();
$stm = $conecta->prepare($sql);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
$retornoJson = json_encode($retorno);
echo $retornoJson;