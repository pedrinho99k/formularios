<?php
$cod_perfil = $_POST['cod_perfil'];

$sql = "SELECT * FROM fm_formularios AS form 
JOIN fm_formulario_perfil AS fp ON form.form_codigo = fp.fp_codigo_formulario 
WHERE fp.fp_codigo_perfil = $cod_perfil 
AND form.form_ativo = 'SIM' 
AND fp.fp_ativo = 'SIM'
ORDER BY form_nome";

include_once("../conexao/conexao.php");
$conecta = Conectar();
$stm = $conecta->prepare($sql);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
$retornoJson = json_encode($retorno);
echo $retornoJson;