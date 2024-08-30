<?php

// Autoload do Composer
require __DIR__ . '/../../vendor/autoload.php';

// Arquivo de Conexão
require __DIR__ . '/../conexao/conexao.php';

// QUERY SQL
require __DIR__ . '/query_sql.php';

// Conectar ao banco de dados
$conexao = Conectar();


// Qualquer erro na query sql deixa o arquivo xlsx corrompido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo_form'])) {
    $codigo_form = $_POST['codigo_form'];
    $codigo_nome = $_POST['codigo_nome'];
    $nomeDoArquivo = '';

    $isDefault = false;

    // Adicionar a query ao switch
    switch ($codigo_form) {
        case 1:
            $query = $query_1;
            $nomeDoArquivo = $codigo_nome;
            break;
        case 22:
            $query = $query_22;
            $nomeDoArquivo = $codigo_nome;
            break;
        case 28:
            $query = $query_28;
            $nomeDoArquivo = $codigo_nome;
            break;
        case 29:
            $query = $query_29;
            $nomeDoArquivo = $codigo_nome;
            break;
        case 34:
            $query = $query_34;
            $nomeDoArquivo = $codigo_nome;
            break;
        case 37:
            $query = $query_37;
            $nomeDoArquivo = $codigo_nome;
            break;
        case 44:
            $query = $query_44;
            $nomeDoArquivo = $codigo_nome;
            break;
        case 57:
            $query = $query_57;
            $nomeDoArquivo = $codigo_nome;
            break;
        default:
            // QUERY SQL
            $select_form = "SELECT *
                FROM fm_formularios
                WHERE form_codigo = :codigo_form
            ";

            $isDefault = true;

            $stmt = $conexao->prepare($select_form);
            $stmt->bindParam(':codigo_form', $codigo_form, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Exibe as linhas
            foreach ($result as $row) {
                $sigla = $row['form_sigla'];
            }

            $select_colunas = "SELECT ques_descricao
                FROM fm_formularios_questoes AS fq
                JOIN fm_formularios AS form ON fq.fq_form_codigo = form.form_codigo
                JOIN fm_questoes AS ques ON fq.fq_ques_codigo = ques.ques_codigo
                WHERE form.form_codigo = :codigo_form
                AND fq.fq_vinculo_ativo = 'SIM'
                AND form.form_ativo = 'SIM'
                AND ques.ques_ativo = 'SIM'
                ORDER BY ques.ques_posicao ASC
            ";

            $resultado_colunas = $conexao->prepare($select_colunas);
            $resultado_colunas->bindParam(':codigo_form', $codigo_form, PDO::PARAM_INT);
            $resultado_colunas->execute();

            // Obter os nomes das colunas
            $colunas = $resultado_colunas->fetchAll(PDO::FETCH_COLUMN);

            // Remove o primeiro resultado
            array_shift($colunas);

            $query = "SELECT
                    cdp.codigo AS REGISTRO,
                    DATE_FORMAT(fr.reg_data_hora, '%d/%m/%Y %H:%i:%s') AS INSERIDO,
                    usu.usu_nome AS USUÁRIO,
                    usu.usu_login AS 'LOGIN',
                    cdp.*
                FROM
                    $sigla cdp
                    JOIN fm_registros fr ON fr.reg_codigo_registro = cdp.codigo
                    JOIN fm_usuarios usu ON usu.usu_codigo = fr.reg_codigo_usuario
                WHERE 
                    fr.reg_codigo_formulario = :codigo_form
                    AND fr.reg_ativo <> 'EXCLUIDO'
                ORDER BY 
                    fr.reg_data_hora
            ";

            $nomeDoArquivo = $codigo_nome;

        break;
    }

    try {
        if (!empty($query)) {
            $resultado = $conexao->prepare($query);
            if ($isDefault) {
                $resultado->bindParam(':codigo_form', $codigo_form, PDO::PARAM_INT);
            }
            $resultado->execute();
        
            
            // Criar uma instância do PhpSpreadsheet
            $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            if ($isDefault) {
                // Adicionar cabeçalhos
                $coluna = 'A'; // Inicia com a coluna A

                $sheet->setCellValue($coluna . '1', 'CODIGO');
                $coluna++;

                $sheet->setCellValue($coluna . '1', 'DATA INSERIDO');
                $coluna++;

                $sheet->setCellValue($coluna . '1', 'USUÁRIO');
                $coluna++;

                $sheet->setCellValue($coluna . '1', 'LOGIN');
                $coluna++;

                foreach ($colunas as $nome_coluna) {
                    $sheet->setCellValue($coluna . '1', $nome_coluna); // Define o valor da célula
                    $coluna++; // Move para a próxima coluna
                }
            } else {
                $coluna = 'A';
                foreach ($resultado->fetch(PDO::FETCH_ASSOC) as $campo => $valor) {
                    $sheet->setCellValue($coluna . '1', $campo);
                    $coluna++;
                }
            }

            // Reiniciar a execução da consulta
            $resultado->execute();

            // Adicionar dados
            $linha = 2;
            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $coluna = 'A';
                unset($row['codigo'], $row['registro_ativo']);
                foreach ($row as $valor) {
                    $sheet->setCellValue($coluna . $linha, $valor);
                    $coluna++;
                }
                $linha++;
            }

            // Data atual quando o arquivo foi gerado
            $data = date('d-m-Y');
        
            // Nome que vai ficar salvo no arquivo
            $nomeDownload = $nomeDoArquivo . "_" . $data . ".xlsx";
        
            // Definir cabeçalhos HTTP para download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment;filename=$nomeDownload");
            header('Cache-Control: max-age=0');
        
            // Nome do arquivo que fica salvo no sistema
            //$nomeArquivo = $nomeDoArquivo . "_" . $data . ".xlsx";
        
            // Salvar o arquivo Excel
            $writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');  // Para baixar
            //$writer->save("planilhas/" . $nomeArquivo);  // Para salvar no pc local
            
        }

    } catch (PDOException $e) {
        echo "<h3>Erro ao gerar planilha</h3>" . $e->getMessage();
    }

}

// Pasta que fica as exportações
$directory = __DIR__ . "/planilhas";

// Verificar se existe o diretorio
if (!file_exists($directory)) {
    // Criar o diretorio se ele não existir
    if (!mkdir($directory, 0777, true)) {
        die('Erro ao criar a pasta de exportação!');
    }
}

?>