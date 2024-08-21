<?php

// Autoload do Composer
require __DIR__ . '/../../vendor/autoload.php';

// Arquivo de Conexão
require __DIR__ . '/../conexao/conexao.php';


// Conectar ao banco de dados
$conexao = Conectar();

// QUERY SQL
require __DIR__ . '/query_sql.php';


// Qualquer erro na query sql deixa o arquivo xlsx corrompido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo_form'])) {
    $codigo_form = $_POST['codigo_form'];
    $codigo_nome = $_POST['codigo_nome'];
    $nomeDoArquivo = '';

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
        // case 44:
        //     // $query = $query_44;
        //     $stmt = $conexao->prepare($query_44);
        //     $stmt->execute();

        //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //     foreach($result as $row) {
        //         print_r($row);
        //     }

        //     $nomeDoArquivo = $codigo_nome;
        //     break;
        default:
        $stmt = $conexao->prepare($select_teste);
        $stmt->bindParam(':codigo_form', $codigo_form, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Exibe as linhas
        foreach ($result as $row) {
            // print_r($row);
            $sigla = $row['form_sigla'];
        }

        // $sql = "SELECT codigo as 'REGISTRO',
        // sigla.*
        // FROM $sigla sigla";

        // $sql = "SELECT
        //         cdp.codigo AS REGISTRO,
        //         DATE_FORMAT(fr.reg_data_hora, '%d/%m/%Y %H:%i:%s') AS INSERIDO,
        //         usu.usu_nome AS USUÁRIO,
        //         usu.usu_login AS 'LOGIN',
        //         cdp.*
        //     FROM
        //         $sigla cdp
        //         JOIN fm_registros fr ON fr.reg_codigo_registro = cdp.codigo
        //         JOIN fm_usuarios usu ON usu.usu_codigo = fr.reg_codigo_usuario
        //     WHERE 
        //         fr.reg_codigo_formulario = :codigo_form
        //         AND fr.reg_ativo <> 'EXCLUIDO'
        //     ORDER BY 
        //         fr.reg_data_hora
        // ";

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

        // $stmt2 = $conexao->prepare($sql);
        // $stmt2->bindParam(':codigo_form', $codigo_form, PDO::PARAM_INT);
        // $stmt2->bindParam(':sigla', $sigla, PDO::PARAM_STR_CHAR);
        // $stmt2->execute();

        // $result_2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        // print_r($result_2);

        // print_r($result['form_sigla']);
        
        $nomeDoArquivo = $codigo_nome;
        break;
    }

    try {
        if (!empty($query)) {
            $resultado = $conexao->prepare($query);
            $resultado->bindParam(':codigo_form', $codigo_form, PDO::PARAM_INT);
            $resultado->execute();
        
            
            // Criar uma instância do PhpSpreadsheet
            $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Adicionar cabeçalhos
            $coluna = 'A';
            foreach ($resultado->fetch(PDO::FETCH_ASSOC) as $campo => $valor) {
                $sheet->setCellValue($coluna . '1', $campo);
                $coluna++;
            }

            // Reiniciar a execução da consulta
            $resultado->execute();

            // Adicionar dados
            $linha = 2;
            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $coluna = 'A';
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