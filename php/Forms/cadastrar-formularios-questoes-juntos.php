<?php session_start(); ?>
<div class="col-md-12 py-4" id="form-body" style="background-color: white;">
    <div class="container-fluid">
        <form class="row g-3">
            <h4>Cadastro Novo Formulário</h4>
            <div class="col-md-12">
                <label for="cod_formulario" class="form-label">Cód. do Formulário</label>
                <input type="text" class="form-control" id="cod_formulario" name="cod_formulario" disabled>
            </div>
            <div class="col-md-12">
                <label for="sigla_formulario" class="form-label">Sigla do Formulário</label>
                <input type="text" class="form-control" id="sigla_formulario" name="sigla_formulario">
                <div id="sigla-invalida" class="invalid-feedback">
                    Sigla já está em uso!
                </div>
            </div>
            <div class="col-md-12">
                <h2 class="text-center mt-1 my-2 pt-4 pb-4" id="title-form">
                    <input type="text" class="form-control text-center" id="nome_formulario" name="nome_formulario" placeholder="Título do Formulário" autocomplete="off">
                </h2>
                <div id="insira-nome" class="invalid-feedback">
                    Insira um nome ao formulário!
                </div>
            </div>
        </form>
        <div class="col-md-12">
            <div class="container-fluid">
                <form class="row g-3" id="form-questoes">

                </form>
            </div>
        </div>
        <div class="col-md-12 my-2">
            <button type="button" class="btn btn-success" id="add-questao" onclick="MaximizarCadQuestoes()">+ Questão</button>
        </div>
        <div class="col-md-12">
            <div class="alert alert-success" id="form-salvo" role="alert">
                Formulário gerado com sucesso!
            </div>
        </div>
        <div class="col-md-7 mx-auto pt-4 " id="questao" style="border: 1px solid black; border-radius: 10px;">
            <div class="container-fluid">
                <form class="row g-3" id="cad-questao">
                    <div class="col-md-12 mb-3">
                        <div class="position-relative">
                            <div class="position-absolute top-0 start-0">
                                <h4>Questão</h4>
                            </div>
                            <div class="position-absolute top-0 end-0">
                                <button type="button" class="btn" onclick="MinimizarCadQuestoes()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-none">
                        <label for="cod_questao" class="form-label">Cód. da Questão</label>
                        <input type="text" class="form-control" id="cod_questao" name="cod_questao" disabled>
                    </div>
                    <div class="col-md-12">
                        <label for="desc_questao" class="form-label">Descrição da Questão</label>
                        <input type="text" class="form-control" id="desc_questao" name="desc_questao">
                    </div>
                    <div class="col-md-12">
                        <label for="tipo_questao" class="form-label">Tipo de Questão</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radios-tipo-questao" id="tipo_texto" value="Text" checked>
                            <label class="form-check-label" for="tipo_texto">
                                Texto
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radios-tipo-questao" id="tipo_opcoes" value="Option">
                            <label class="form-check-label" for="tipo_opcoes">
                                Opções
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radios-tipo-questao" id="tipo_checkbox" value="Checkbox">
                            <label class="form-check-label" for="tipo_checkbox">
                                Checkbox
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12" id="secao-opcoes">
                        <label for="valor_opcao" class="form-label">Valor Opção</label>
                        <div class="row">
                            <div class="col-md-11">
                                <input type="text" class="form-control" id="valor_opcao" name="valor_opcao">
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-info" id="button-add-opcao">➕</button>
                            </div>
                        </div>
                        <div class="row mt-2 ">
                            <div class="col-md-6 mx-auto">
                                <ul class="list-group" id="valores_opcao"></ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-none">
                        <label for="sigla_questao " class="form-label">Sigla da Questão</label>
                        <input type="text" class="form-control" id="sigla_questao" name="sigla_questao" disabled>
                    </div>
                    <div class="col-md-12">
                        <label for="html_questao " class="form-label">HTML da Questão</label>
                        <button type="button" class="btn btn-info btn-sm my-1" onclick="HtmlVisualizar()">Prefixo</button>
                        <textarea class="form-control" id="html_questao" name="html_questao" rows="10"></textarea>
                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-warning text-center" role="alert" id="noti-descricao">Insira a descrição da questão!</div>
                        <div class="alert alert-danger text-center" role="alert" id="noti-sigla">Insira a sigla do formulário!</div>
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary mx-auto" onclick="VisuQuestao()">➕ Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12 my-2">
            <button type="button" class="btn btn-primary mt-3" style="width: 100%;" onclick="SalvarFormularioQuestao()">Salvar Formulário</button>
        </div>
    </div>
</div>
<script>
    $("#form-salvo").hide();
    $("#sigla-invalida").hide();
    $("#insira-nome").hide();
    $("#secao-opcoes").hide();
    $("#noti-descricao").hide();
    $("#noti-sigla").hide();
    $("#questao").hide();
    let opcoes = [];
    let tipo = $('input[name="radios-tipo-questao"]:checked').val();

    $('input[type="radio"]').click(function() {
        tipo = $('input[name="radios-tipo-questao"]:checked').val();
        switch (tipo) {
            case 'Option':
                $("#secao-opcoes").slideDown();
            break;
            case 'Text':
                $("#secao-opcoes").slideUp();
            break;
            case 'Checkbox':
                $("#secao-opcoes").slideDown();
            break;
        }
    });
    // let html_select = "";
    let i = 0;
    $("#button-add-opcao").click(function() {
        AddOpcao();

    });
    $("#valor_opcao").keypress(function(e) {
        if (e.keyCode == 13) {
            AddOpcao();
        }
    });
    $("#sigla_formulario").change(function() {
        $("#sigla_formulario").removeClass('is-invalid');
        $("#noti-sigla").slideUp();
    });
    $("#sigla_formulario").keypress(function() {
        $("#sigla_formulario").removeClass('is-invalid');
        $("#noti-sigla").slideUp();
    });
    $("#nome_formulario").keyup(function() {
        // verifica se já existe questão inserida no formulario 
        if (posicao > 2) { // se existe ele não altera a sigla para não alterar a sigla das questões
            var texto = $("#nome_formulario").val();
            $("#nome_formulario").val(texto.toUpperCase()); // joga o resultado no campo do nome formulario maiuscula
            VerificaSigla($("#sigla_formulario").val());
            $("#insira-nome").slideUp();
        } else { // Se não existir nenhuma questão inserida ainda consegue alterar a sigla baseada no nome do formulario
            var nome_form = $("#nome_formulario").val();
            var re = nome_form.substr(0, 20);
            var resultado = re.replace(/ |"|'/g, '_');
            $("#sigla_formulario").val(resultado.toLowerCase()); // joga o resultado no campo da sigla minuscula
            var texto = $("#nome_formulario").val();
            $("#nome_formulario").val(texto.toUpperCase()); // joga o resultado no campo do nome formulario maiuscula
            VerificaSigla($("#sigla_formulario").val());
            $("#insira-nome").slideUp();
        }
    });

    //Realiza a verificação da sigla para não ocorrer valores iguais no Banco de Dados
    function VerificaSigla(sigla_formulario) {
        $.ajax({
            url: url + "php/Funcoes/verifica-sigla-formulario.php",
            data: {
                sigla_formulario: sigla_formulario
            },
            method: "POST",
            success: function(result) {
                if (result.length <= 2) {
                    $("#sigla-invalida").slideUp();
                    $("#sigla_formulario").removeClass('is-invalid');
                } else {
                    $("#sigla-invalida").slideDown();
                    $("#sigla_formulario").addClass('is-invalid');
                }
            },
            error: function() {
                console.log("Erro ao salvar usuario pelo Ajax!");
            }
        });

    }


    function SalvarFormularioQuestao() {
        let sigla_formulario = $("#sigla_formulario").val();
        let cod_formulario = $("#cod_formulario").val();
        $.ajax({
            method: "POST",
            url: url + "php/Funcoes/criar-tabela-bd.php",
            data: {
                sigla_formulario: sigla_formulario,
                cod_formulario: cod_formulario
            },
            success: function(result) {
                $("#questao").slideUp();
                $("#form-salvo").slideDown();
            },
            error: function() {
                console.log("Erro ao gerar tabela pelo Ajax!");
            }
        });
    }

    function AddOpcao() {
        $("#valores_opcao").prepend(`<p id="noti-inserido">Valor já inserido!</p>`);
        $("#noti-inserido").hide();
        let opcao = $("#valor_opcao").val();
        var index = opcoes.indexOf(opcao);
        if (index > -1) {
            console.log('Já inserido');
            $("#noti-inserido").slideDown();
            $("#noti-inserido").delay('3000').slideUp();
        } else {
            opcoes.push(opcao);
            console.log(opcoes[i] + ' - ' + i);
            $("#valores_opcao").append(`<li class="list-group-item justify-content-between align-items-center" id="li_` + i + `"><span>` + opcoes[i] + `</span><button type="button" class="btn-close" onclick="RemoveOpcao('` + opcoes[i] + `',` + i + `)" aria-label="Close"></button></li>`);
            $("#li_" + i).hide().slideDown().addClass('d-flex');
            $("#valor_opcao").val("");
            i++;
        }
    }

    function RemoveOpcao(opcao, id) {
        var index = opcoes.indexOf(opcao);
        if (index > -1) {
            opcoes.splice(index, 1);
            i = i - 1;
            if (opcoes.length <= 0) {
                opcoes = [];
                i = 0;
            }
        }
        $("#li_" + id).slideUp().remove();
    }

    let posicao = 2; // Inicia no 2, pois a posição 1 é a questão codigo
    let html_questao;

    function abreviacao(desc_questao) {
        if (desc_questao.indexOf(' ') === -1) {
            return desc_questao; // Descricao sem abreviacao
        }

        var words = desc_questao.split(' ');
        var abbWords = [];

        for (var i = 0; i < words.length; i++) {
            abbWords.push(words[i].substr(0, 3));
        }

        var abreviacao = abbWords.join('_');
        return abreviacao;
    }


    function HtmlVisualizar() {

        let html_select = "";

        tipo = $('input[name="radios-tipo-questao"]:checked').val();

        switch (tipo) {
            case 'Option':
                for (i = 0; i < opcoes.length; i++) {
                    html_select += '<option value="' + opcoes[i] + '">' + opcoes[i] + '</option>';
                }
            break;
            case 'Checkbox':
                for (i = 0; i < opcoes.length; i++) {
                    html_select += `
                        <input type="checkbox" class="form-check-input" value="${opcoes[i]}">
                        <label class="form-check-label">${opcoes[i]}</label>
                    `;
                }
            break;
        }

        let desc_questao = $("#desc_questao").val();
        let sigla_questao = abreviacao(desc_questao);
        $("#sigla_questao").val(sigla_questao);
        console.log(sigla_questao);
        switch (tipo) {
            case 'Text':
                html_questao =
                    `<div class="col-md-12">
                        <label for="${sigla_questao}" class="form-label">${desc_questao}</label>
                        <input type="text" class="form-control" id="${sigla_questao}" name="${sigla_questao}" autocomplete="off">
                    </div>
                `;
            break;
            case 'Option':
                html_questao =
                    `<div class="col-md-12">
                        <label for="${sigla_questao}" class="form-label">${desc_questao}</label>
                        <select class="form-select" id="${sigla_questao}" name="${sigla_questao}">${html_select}</select>
                    </div>
                `;
            break;
            case 'Checkbox':
                html_questao = `
                    <div class="col-md-12" id="${sigla_questao}">

                        <label for="${sigla_questao}" class="form-check-label">${desc_questao}</label><br>
                        ${html_select}
                    </div>
                `;
            break;
        }
        $("#html_questao").val(html_questao);
        return true;
    }


    function RemoveQuestao(sigla) {
        let cod_formulario = $("#cod_formulario").val();
        $.ajax({
            url: url + "php/Funcoes/remover-questoes.php",
            data: {
                cod_formulario: cod_formulario,
                sigla_questao: sigla
            },
            method: "POST",
            success: function(result) {
                console.log(result);
                $("#pai-" + sigla).remove();
                $("#pai-" + sigla).remove();
                $("#pai-" + sigla).remove();

            },
            error: function() {
                console.log("Erro ao salvar questao pelo Ajax!");
            }
        });

    }


    function VisuQuestao() {
        if (HtmlVisualizar()) {
            let cod_formulario = $("#cod_formulario").val();
            let desc_questao = $("#desc_questao").val();
            let sigla_questao = $("#sigla_questao").val();
            let html_questao = $("#html_questao").val();
            if (desc_questao == "") {
                $("#noti-descricao").slideDown();
                $("#noti-descricao").delay('3000').slideUp();
            } else {
                if (SalvarQuestao()) {
                    $("#form-questoes").append(`
                    <div class="col-md-10" id="pai-` + sigla_questao + `">
                        ` + html_questao + `
                    </div>
                    <div class="col-md-2" id="pai-` + sigla_questao + `">
                            <button type="button" class="btn btn-primary mt-4" style="width:100%;" onclick="RemoveQuestao('` + sigla_questao + `')">Remover</button>
                    </div><hr id="pai-` + sigla_questao + `">
                `);
                    $("#desc_questao").val("");
                    $("#valores_opcao").html("");
                    html_select = "";
                    opcoes = [];
                    i = 0;
                    posicao++;
                } else {
                    console.log('Erro');
                }
            }
        } else {
            console.log('Erro 1');
        }


    }


    function MinimizarCadQuestoes() {
        $("#add-questao").removeClass("d-none").fadeIn("slow");
        $("#questao").toggle("slow");

    }

    function SalvarFormulario() {
        let cod_formulario = $("#cod_formulario").val();
        let nome_formulario = $("#nome_formulario").val();
        let sigla_formulario = $("#sigla_formulario").val();
        let formulario_ativo = "SIM";

        if ($('#sigla_formulario').is('.is-invalid')) { //Verifica se a sigla está disponivel pela a classe invalid do campo
            alert('Sigla já está em uso: Altere o nome do formulário para prosseguir com a inclusão do mesmo!');
            return false;
        } else if (nome_formulario == '') { //Verifica se o formulário possui um nome, pois a sigla da questão é baseada no nome do fomrulario
            $("#insira-nome").slideDown();
            return false;
        } else {
            $.ajax({
                url: url + "php/Funcoes/salvar-formulario.php",
                data: {
                    cod_formulario: cod_formulario,
                    nome_formulario: nome_formulario,
                    sigla_formulario: sigla_formulario,
                    formulario_ativo: formulario_ativo
                },
                method: "POST",
                success: function(result) {
                    $("#cod_formulario").val(result);
                },
                error: function() {
                    console.log("Erro ao salvar usuario pelo Ajax!");
                }
            });
            return true;
        }
    }

    function SalvarQuestao() {
        let cod_formulario = $("#cod_formulario").val();
        let desc_questao = $("#desc_questao").val();
        let sigla_questao = $("#sigla_questao").val();
        let html_questao = $("#html_questao").val();
        let questao_ativo = "SIM";
        $.ajax({
            url: url + "php/Funcoes/salvar-questoes.php",
            data: {
                cod_formulario: cod_formulario,
                desc_questao: desc_questao,
                sigla_questao: sigla_questao,
                html_questao: html_questao,
                questao_ativo: questao_ativo,
                posicao: posicao
            },
            method: "POST",
            success: function(result) {
                console.log(result);

            },
            error: function() {
                console.log("Erro ao salvar questao pelo Ajax!");
            }
        });
        return true;
    }

    function MaximizarCadQuestoes() {
        //Salva o formulário para inserir o codigo do mesmo nas questoes
        if (SalvarFormulario()) {
            //Se a pessoa alterar a sigla para uma correta o formulario é salvo e o cadastro das questões aparece na tela
            $("#questao").delay("500").toggle("slow");
            $("#add-questao").fadeOut("slow");
        }
    }

    /*
    INSERT INTO `fm_questoes` (`ques_codigo`, `ques_descricao`, `ques_sigla`, `ques_html`, `ques_posicao`, `ques_ativo`) VALUES (NULL, 'codigo', 'codigo', '<div class=\"col-md-12 d-none\">\r\n <label for=\"codigo\" class=\"form-label\">codigo</label>\r\n <input type=\"text\" class=\"form-control\" id=\"codigo\" name=\"codigo\">\r\n</div>', '1', 'SIM');
    */
</script>