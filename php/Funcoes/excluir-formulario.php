<?php
session_start();

$nome_tabela = $_POST['form_sigla'];
$cod_form = $_POST['cod_formulario'];

// Função para conectar ao banco de dados
include_once("../conexao/conexao.php");
$conecta = Conectar();

// Verifique se o nome da tabela é válido (somente letras, números, underscore e letras especiais)
if (preg_match('/^[a-zA-Z0-9_\p{L}]+$/u', $nome_tabela)) {
    // Escapa adequadamente o nome da tabela
    $nome_tabela_escapado = $conecta->quote($nome_tabela);
    // Remove aspas simples adicionadas pela função quote
    $nome_tabela_escapado = trim($nome_tabela_escapado, "'");

    $sql_verificacao = "SELECT COUNT(*) AS total FROM `$nome_tabela_escapado`";
    $stmt_verificar = $conecta->prepare($sql_verificacao);

    try {
        $stmt_verificar->execute();
        $resultado = $stmt_verificar->fetch(PDO::FETCH_ASSOC);

        if ($resultado['total'] == 0) {
            // Se a tabela estiver vazia, exclua-a
            $sql_drop = "DROP TABLE `$nome_tabela_escapado`";
            $stmt_drop = $conecta->prepare($sql_drop);
            $stmt_drop->execute();

            // Verifique se a tabela foi realmente excluída
            $sql_check = "SHOW TABLES LIKE '$nome_tabela_escapado'";
            $stmt_check = $conecta->prepare($sql_check);
            $stmt_check->execute();
            $table_exists = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if (!$table_exists) {
                // Atualize a tabela `fm_formularios`
                $sql_delete = "DELETE FROM fm_formularios WHERE form_codigo = :cod_form";
                $stmt_delete = $conecta->prepare($sql_delete);
                $stmt_delete->bindParam(':cod_form', $cod_form, PDO::PARAM_INT);
                $stmt_delete->execute();

                $sql_delete_question = "
                  DELETE fq
                  FROM fm_formularios_questoes AS fq
                  JOIN fm_formularios AS form ON fq.fq_form_codigo = form.form_codigo
                  JOIN fm_questoes AS ques ON fq.fq_ques_codigo = ques.ques_codigo
                  WHERE form.form_codigo = :cod_formulario
                ";

                $stmt_delete_question = $conecta->prepare($sql_delete_question);
                $stmt_delete_question->bindParam(':cod_formulario', $cod_form, PDO::PARAM_INT);
                $stmt_delete_question->execute();

                echo json_encode(['status' => 'success', 'message' => 'Tabela excluída e formulário atualizado com sucesso.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'A tabela não pôde ser excluída.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'A tabela não está vazia e não pode ser excluída.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Erro: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Nome da tabela inválido']);
}

?>