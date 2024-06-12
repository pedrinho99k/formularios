<?php
session_start();

$sigla_formulario = $_POST['sigla_formulario'];
$cod_formulario = $_POST['cod_formulario'];
$cod_perfil = $_SESSION['codPerfil'];


$sql = "SELECT ques.ques_sigla, form.form_sigla
FROM fm_formularios_questoes AS fq
JOIN fm_formularios AS form ON fq.fq_form_codigo = form.form_codigo
JOIN fm_questoes AS ques ON fq.fq_ques_codigo = ques.ques_codigo
WHERE form.form_sigla = '$sigla_formulario'";

include_once("../conexao/conexao.php");
$conecta = Conectar();
$stm = $conecta->prepare($sql);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);

$sql_create = "CREATE TABLE `" . $retorno[0]['form_sigla'] . "`(";
for ($i = 0; $i < count($retorno); $i++) {
    switch ($retorno[$i]['ques_sigla']) {
        case 'codigo':
            $sql_create .= " `" . $retorno[$i]['ques_sigla'] . "` INT AUTO_INCREMENT,";
            $sql_create .= " `registro_ativo` VARCHAR(255) NOT NULL DEFAULT 'ATIVO',";  // Adicionando a coluna registro_ativo a tabela
            break;
        default:
            if (count($retorno) == $i + 1) {
                $sql_create .= " `" . $retorno[$i]['ques_sigla'] . "` text null, PRIMARY KEY(`codigo`));";
            } else {
                $sql_create .= " `" . $retorno[$i]['ques_sigla'] . "` text null,";
            }
            break;
    }
}

$pdo = Conectar();

//echo $sql_create;
$stmt = $pdo->prepare($sql_create);
if ($stmt->execute()) {
    echo '<p>Tabela Criada com sucesso!</p>';
} else {
    echo '<p>Erro ao criar tabela!</p>' . $sql_create;
}

if ($cod_formulario != null) {

    // Verifica se já existe um registro com os mesmos valores
    $sql_check_duplicate = "SELECT COUNT(*) FROM fm_formulario_perfil WHERE fp_codigo_formulario = :cod_formulario AND fp_codigo_perfil = :cod_perfil";
    $stmt_check_duplicate = $pdo->prepare($sql_check_duplicate);
    $stmt_check_duplicate->bindParam(':cod_formulario', $cod_formulario, PDO::PARAM_INT);
    $stmt_check_duplicate->bindParam(':cod_perfil', $cod_perfil, PDO::PARAM_INT);
    $stmt_check_duplicate->execute();
    $count_duplicates = $stmt_check_duplicate->fetchColumn();

    if ($count_duplicates == 0) {

        // Faz a inserção para o usuario adm.
        $sql_adm = "INSERT INTO fm_formulario_perfil (fp_codigo_formulario, fp_codigo_perfil, fp_ativo) VALUES (:cod_formulario, '1', 'SIM')";
        $stmt2 = $pdo->prepare($sql_adm);
        $stmt2->bindParam(':cod_formulario', $cod_formulario, PDO::PARAM_INT);
        $stmt2->execute();

        // Faz a inserção para o usuario
        if ($cod_perfil != 1 && $cod_perfil != 0) {
            $sql_perfil = "INSERT INTO fm_formulario_perfil (fp_codigo_formulario, fp_codigo_perfil, fp_ativo) VALUES (:cod_formulario, '$cod_perfil', 'SIM')";
            $stmt3 = $pdo->prepare($sql_perfil);
            $stmt3->bindParam(':cod_formulario', $cod_formulario, PDO::PARAM_INT);
            $stmt3->execute();
        }
    }
}