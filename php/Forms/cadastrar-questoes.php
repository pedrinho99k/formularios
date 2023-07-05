<?php session_start(); ?>
<form>
    <div class="col-md-12 py-4" id="form-body" style="background-color: white;">
        <div class="container-fluid">
            <h4>Cadastro de Questões</h4>
            <form class="row g-3">
                <div class="col-md-12">
                    <label for="cod_questao" class="form-label">Cód. da Questão</label>
                    <input type="text" class="form-control" id="cod_questao" name="cod_questao" disabled>
                </div>
                <div class="col-md-12">
                    <label for="dsec_questao" class="form-label">Descrição da Questão</label>
                    <input type="text" class="form-control" id="desc_questao" name="desc_questao">
                </div>
                <div class="col-md-12">
                    <label for="sigla_questao" class="form-label">Sigla da Questão</label>
                    <input type="text" class="form-control" id="sigla_questao" name="sigla_questao" onkeyup="HtmlPrefixo()">
                </div>
                <div class="col-md-12">
                    <label for="posicao_questao" class="form-label">Posição</label>
                    <input type="text" class="form-control" id="posicao_questao" name="posicao_questao">
                </div>
                <div class="col-md-12">
                    <label for="html_questao" class="form-label">HTML da Questão</label>
                    <button type="button" class="btn btn-info btn-sm my-1" onclick="HtmlPrefixo()">Prefixo</button>
                    <textarea class="form-control" id="html_questao" name="html_questao" rows="25"></textarea>
                </div>
                <div class="col-md-12 my-2">
                    <button type="button" class="btn btn-primary" onclick="SalvarQuestao()">Salvar</button>
                    <button type="button" class="btn btn-secondary" onclick="LimparCamposCadastroQuestoes()">Limpar Campos</button>
                </div>
            </form>
            <div id="tabela">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="cursor: pointer;" onclick="Ordernar('ques_codigo')">Cód.</th>
                            <th scope="col" style="cursor: pointer;" onclick="Ordernar('ques_descricao')">Descrição</th>
                            <th scope="col" style="cursor: pointer;" onclick="Ordernar('ques_sigla')">Sigla</th>
                            <th scope="col" style="cursor: pointer;" onclick="Ordernar('ques_ativo')">Ativo</th>
                            <th scope="col">Opções</th>
                        </tr>
                    </thead>
                    <tbody id="corpo-tabela">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
<script>
    let ordenacao = 'DESC';

    function Ordernar(campo) {
        $("#corpo-tabela").html("");
        switch (ordenacao) {
            case 'DESC':
                ordenacao = 'ASC'
                break;
            case 'ASC':
                ordenacao = 'DESC'
                break;
        }
        switch (campo) {
            case '':
                campo = 'ques_codigo'
                break;
        }
        $.ajax({
            url: url + "php/Funcoes/buscar-questoes-json.php",
            method: 'POST',
            data: {
                ordenacao: ordenacao,
                campo: campo
            },
            dataType: "JSON",
            success: function(result) {
                result.forEach(function(elemento) {
                    switch (elemento['ques_ativo']) {
                        case 'SIM':
                            $("#corpo-tabela").append(`
                            <tr>
                                <th>` + elemento['ques_codigo'] + `</th>
                                <td>` + elemento['ques_descricao'] + `</td>
                                <td>` + elemento['ques_sigla'] + `</td>
                                <td>` + elemento['ques_ativo'] + `</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary my-1" style="width: 100%;" onclick="SelecionarQuestaoAlterar(` + elemento['ques_codigo'] + `)">Alterar</button>
                                        <button type="button" class="btn btn-danger my-1" style="width: 100%;" value="NÃO" onclick="InativarAtivarQuestao(` + elemento['ques_codigo'] + `,this.value)">Inativar</button>
                                    </div>
                                </td>
                            </tr>
                        `);
                            break;
                        case 'NÃO':
                            $("#corpo-tabela").append(`
                            <tr>
                                <th>` + elemento['ques_codigo'] + `</th>
                                <td>` + elemento['ques_descricao'] + `</td>
                                <td>` + elemento['ques_sigla'] + `</td>
                                <td>` + elemento['ques_ativo'] + `</td>
                                <td>
                                    <button type="button" class="btn btn-primary my-1" style="width: 100%;" onclick="SelecionarQuestaoAlterar(` + elemento['ques_codigo'] + `)">Alterar</button>
                                    <button type="button" class="btn btn-success my-1" style="width: 100%;" value="SIM" onclick="InativarAtivarQuestao(` + elemento['ques_codigo'] + `,this.value)">Ativar</button>
                                </td>
                            </tr>
                        `);

                            break;
                    }

                });
            },
            error: function() {
                console.log("Erro ao listar perfis pelo Ajax!");
            }
        });
    }
</script>