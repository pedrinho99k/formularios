<?php session_start(); ?>
<form>
    <div class="col-md-12 py-4" id="form-body" style="background-color: white;">
        <div class="container-fluid">
            <h4>Cadastro Formulário apartir de um formulário já criado</h4>
            <form class="row g-3">
                <div class="col-md-12">
                    <h2 class="text-center mt-1 my-2 pt-4 pb-4" id="title-form" >
                        <input type="text" class="form-control text-center" id="nome_formulario" name="nome_formulario" placeholder="Título do Formulário" autocomplete="off">
                    </h2>
                    <div id="insira-nome" class="invalid-feedback">
                        Insira um nome ao formulário!
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="cod_formulario" class="form-label">Formulário</label>
                    <select class="form-select" name="cod_formulario" id="cod_formulario">
                        <option value="" selected>Selecione um Formulário</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label for="sigla_formulario" class="form-label">Sigla do Formulário</label>
                    <input type="text" class="form-control" id="sigla_formulario" name="sigla_formulario" disabled>
                </div>
                <div class="col-md-12 my-2">
                    <button type="button" class="btn btn-primary" onclick="SalvarFormularioApartirFormularioCriado()">Salvar</button>
                    <button type="button" class="btn btn-secondary" onclick="LimparCampos()">Limpar Campos</button>
                </div>
                <div class="col-md-12">
                    <div class="alert alert-success" id="form-salvo" role="alert">
                        Formulário gerado com sucesso!
                    </div>
                </div>
            </form>
            <div id="tabela">
                <table class="table table-hover" style="cursor: pointer;">
                    <thead>
                        <tr>
                            <th scope="col">Selecione</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Sigla</th>
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
    //Lista formularios ativos no select para seleção de questões
    $(document).ready(function() {
        $("#insira-nome").hide();
        $("#form-salvo").hide();
        $.ajax({
            url: url + "php/Funcoes/buscar-formulario-json.php",
            datatype: "POST",
            dataType: "JSON",
            success: function(result) {
                result.forEach(element => {
                    switch (element['form_ativo']) {
                        case 'SIM':
                            $("#cod_formulario").append(`
                                <option value="` + element['form_codigo'] + `">` + element['form_nome'] + `</option>
                            `);
                            break;
                        default:
                            break;
                    }
                });
            },
            error: function() {
                console.log('Erro ao listar formulários pelo Ajax!');
            }
        });
    });

    //Eventos ao selecionar o formulário
    $("#cod_formulario").change(function() {

        //Busca e insere o campo sigla do fomrulario do formulario inserido
        let cod_formulario = $("#cod_formulario").val();
        $.ajax({
            url: url + "php/Funcoes/buscar-formulario-codigo-json.php",
            data: {
                cod_formulario: cod_formulario
            },
            method: "POST",
            dataType: "JSON",
            success: function(result) {
                result.forEach(element => {
                    $("#sigla_formulario").val(element['form_sigla']);
                });
            },
            error: function() {
                console.log('Erro ao listar formulários pelo Ajax!');
            }
        });

        //Lista questoes para selecao e formação do formulario
        $.ajax({
            url: url + "php/Funcoes/montar-formulario.php",
            data: {
                cod_formulario: cod_formulario
            },
            method: "POST",
            dataType: "JSON",
            success: function(result) {
                $("#corpo-tabela").html('');
                result.forEach(element => {
                    switch (element['ques_descricao']) {
                        case 'codigo':
                            break;
                        default:
                            $("#corpo-tabela").append(`
                        <tr>
                            <td class="text-center">
                                <input class="form-check-input" type="checkbox" value="` + element['ques_codigo'] + `" id="check-` + element['ques_codigo'] + `" name="selecao_questoes">
                            </td>
                            <td onclick="CheckSelecionado(` + element['ques_codigo'] + `)">` + element['ques_descricao'] + `</td>
                            <td>` + element['ques_sigla'] + `</td>
                        </tr>    
                    `);
                            break;

                    }
                });
            },
            error: function() {
                console.log('Erro ao listar formulários pelo Ajax!');
            }
        });
    });

    function CheckSelecionado(cod_check) {
        let status_check = $("#check-" + cod_check).attr("checked");
        switch (status_check) {
            case 'checked':
                $("#check-" + cod_check).attr("checked", false);
                break;
            default:
                $("#check-" + cod_check).trigger("click");
                break;
        }
    }
    //Eventos do campo nome_formulario
    $("#nome_formulario").keyup(function() {
        $("#insira-nome").slideUp();
        var texto = $("#nome_formulario").val();
        $("#nome_formulario").val(texto.toUpperCase()); // joga o resultado no campo do nome formulario maiuscula
    });

    //Evento de seleção das questões
    var check;
    $("#corpo-tabela").change(function() {
        check = [];
        $('input[type="checkbox"][name="selecao_questoes"]:checked').each(function() {
            check.push($(this).val());
            
        });
        if (check.length > 0) {
            $("#cod_formulario").attr("disabled", true);
        } else {
            $("#cod_formulario").attr("disabled", false);
        }
    });


    //Salvar formulário e vincular questoes selecionadas
    function SalvarFormularioApartirFormularioCriado() {
        var nome_formulario = $("#nome_formulario").val();
        var sigla_formulario = $("#sigla_formulario").val();
        var formulario_ativo = 'SIM';
        if (nome_formulario == '') { //Verifica se o formulário possui um nome
            $("#insira-nome").slideDown();
        } else {
            $.ajax({
                method: "POST",
                url: url + "php/Funcoes/salvar-formulario.php",
                data: {
                    nome_formulario: nome_formulario,
                    sigla_formulario: sigla_formulario,
                    formulario_ativo: formulario_ativo
                },
                success: function(result) {
                    var cod_form = result;
                    var check = [];
                    $('input[type="checkbox"][name="selecao_questoes"]:checked').each(function() {
                        check.push($(this).val());
                    });
                    for (var i = 0; i < check.length; i++) {
                        console.log(check[i] + '-' + cod_form);
                        SalvarVinculoFormularioQuestao(check[i], cod_form);
                    }
                    $("#form-salvo").slideDown().delay(3000).slideUp();
                    setTimeout(() => {
                        LimparCampos();
                    }, 3000);
                    
                },
                error: function() {
                    console.log('Erro ao salvar o formulário no ajax!')
                }
            });
        }
    }

    //Função para Salvar Vinculos de questões com formulário
    function SalvarVinculoFormularioQuestao(cod_questao, cod_formulario) {
        let vinculo_ativo = "SIM";
        $.ajax({
            url: url + "php/Funcoes/salvar-formularios-questoes.php",
            data: {
                cod_questao: cod_questao,
                cod_formulario: cod_formulario,
                vinculo_ativo: vinculo_ativo
            },
            method: "POST",
            success: function(result) {
                console.log("Vinculo salvo com sucesso:" + result);
            },
            error: function() {
                console.log("Erro ao salvar usuario pelo Ajax!");
            }
        });
    }

    //Função Limpar os Campos
    function LimparCampos(){
        $("#corpo-tabela").html('');
        $("#cod_formulario").attr("disabled", false);
        $("#cod_formulario").val('');
        $("#nome_formulario").val('');
        $("#sigla_formulario").val('');
    }
</script>