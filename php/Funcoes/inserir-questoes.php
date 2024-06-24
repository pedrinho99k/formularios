<?php
include_once '../conexao/conexao.php';
$pdo = Conectar();

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Recebe os dados JSON do POST
  $input = file_get_contents('php://input');
  $data = json_decode($input, true);

  // Verifica se houve erro ao decodificar o JSON
  if (json_last_error() !== JSON_ERROR_NONE) {
      echo json_encode(["success" => false, "message" => "Erro ao decodificar JSON"]);
      exit;
  }

  // Acessa os dados das questões e do código do formulário
  $questoes = $data['questoes'];
  $cod_form = $data['cod_form'];

  // Array para armazenar as questões encontradas
  $resultCheck = [];

  // Itera sobre cada questão e executa a consulta
  foreach ($questoes as $questao) {
      $descricao = $questao['descricao'];

      // Prepara e executa a consulta
      $sqlCheck = "SELECT * FROM fm_questoes JOIN fm_formularios_questoes ON fq_ques_codigo = ques_codigo WHERE fq_form_codigo = :cod_form AND ques_descricao = :descricao";
      $stmtCheck = $pdo->prepare($sqlCheck);
      $stmtCheck->bindParam(":cod_form", $cod_form);
      $stmtCheck->bindParam(":descricao", $descricao);

      if ($stmtCheck->execute()) {
          $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);
          if ($result) {
              $resultCheck[] = $result;
          }
      } else {
          echo json_encode(["success" => false, "message" => "Erro ao executar o Select"]);
          exit;
      }
  }

  // Verifica se alguma questão foi encontrada
  if (!empty($resultCheck)) {
      echo json_encode(["success" => true, "message" => "Select funcionou", "data" => $resultCheck]);
  } else {
      echo json_encode(["success" => false, "message" => "Nenhuma questão encontrada com essa descrição para o formulário informado"]);
  }
} else {
  echo json_encode(["success" => false, "message" => "Método de requisição inválido"]);
}