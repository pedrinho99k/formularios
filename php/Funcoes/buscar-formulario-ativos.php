<?php 

  $sql = "SELECT * FROM fm_formularios WHERE form_ativo = 'SIM' ORDER BY form_nome";
  
  include_once("../conexao/conexao.php");
  $conecta = Conectar();
  $stm = $conecta->prepare($sql);
  $stm->execute();
  $retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
  $retornoJson = json_encode($retorno);
  echo $retornoJson;

?>
