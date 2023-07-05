<?php
$sigla_formulario = $_POST['sigla_formulario'];


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
            if (count($retorno) == $i + 1) {
                $sql_create .= " `" . $retorno[$i]['ques_sigla'] . "` INT AUTO_INCREMENT, PRIMARY KEY(`codigo`));";
            } else {
                $sql_create .= " `" . $retorno[$i]['ques_sigla'] . "` INT AUTO_INCREMENT,";
            }
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

//echo $sql_create;
$pdo = Conectar();
$stmt = $pdo->prepare($sql_create);
if ($stmt->execute()) {
    echo '<p>Tabela Criada com sucesso!</p>';
} else {
    echo '<p>Erro ao criar tabela!</p>' . $sql_create;
}
