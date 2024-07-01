var url = '/Formularios/';


function PegarDataAtual() {
    const d = new Date();
    const meses = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
    const dias = ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"];
    mes = meses[d.getMonth()];
    dia = dias[d.getDate()];
    let Data = d.getFullYear() + '-' + mes + '-' + dia;
    return Data;
}


function PegarDataDiaAnterior() {
    const d = new Date();
    const meses = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
    mes = meses[d.getMonth()];
    let Data = d.getFullYear() + '-' + mes + '-' + d.getDate() - 1;
    return Data;
}


function PegarDataAtualFormtBR() {
    const d = new Date();
    const meses = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
    const dias = ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"];
    mes = meses[d.getMonth()];
    dia = dias[d.getDate()];
    let Data = dia + '/' + mes + '/' + d.getFullYear();
    return Data;
}


function ConverteDataFormtBR(data) {
    ano = data.substring(0, 4);
    mes = data.substring(5, 7);
    dia = data.substring(8, 10);
    let DataBR = dia + '/' + mes + '/' + ano;
    return DataBR;
}


function ConverteDataHoraFormtBR(data) {
    ano = data.substring(0, 4);
    mes = data.substring(5, 7);
    dia = data.substring(8, 10);
    hora = data.substring(11);
    let DataBR = dia + '/' + mes + '/' + ano + ' ' + hora;
    return DataBR;
}

//Verificação de perfil
let cod_perfil = $("#cod_perfil_login").text();

let nivel_perfil_element = document.querySelector('span#nivelPerfil');
let nivel_perfil;

if (nivel_perfil_element != null) {
    nivel_perfil = nivel_perfil_element.dataset.nivel;
}




// Obtém o nível do perfil
var nivelPerfil = document.getElementById('nivelPerfil').textContent;

// Função para esconder elementos
function esconderElemento(id) {
    document.getElementById(id).style.display = 'none';
}

// Esconde todos os elementos desabilitados
function esconderElementosDesabilitados() {
    esconderElemento('usuarios');  // Sempre é escondido

    // Alterar o nivel Intermediario
    var nivelIntermediario = function() {
        esconderElemento('vinculos');
    };

    // Alterar o nivel Básico
    var nivelBasico = function() {
        nivelIntermediario();
        esconderElemento('formularios');
    }

    // Verifica o nível de perfil
    if (nivelPerfil === 'Intermediário') { // Esconde outros elementos para perfil intermediário
        nivelIntermediario();
    } else if (nivelPerfil === 'Básico') { // Esconde todos os elementos para perfil básico
        nivelBasico();
    }
}

if (nivelPerfil !== 'Avançado') {
    esconderElementosDesabilitados();
}

//Inicio
$(document).ready(function () {
    //Esconde linha de vizualição de registros
    $("#vizualizacao").hide();
    $("#nome-form-pesquisa").hide();

    $("#btn-conta").mouseenter(function () {
        $("#drop-conta").addClass('show');
        $("#btn-conta").attr('aria-expanded', true);
        $("#drop-conta").attr('data-bs-popper', 'none');

    }).mouseleave(function () {
        $("#drop-conta").removeClass('show');
        $("#btn-conta").attr('aria-expanded', false);
        $("#drop-conta").removeAttr('data-bs-popper');
    });

    // Icone SVG do Excel
    var iconExcel = '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18" viewBox="0 0 48 48">' +
        '<path fill="#169154" d="M29,6H15.744C14.781,6,14,6.781,14,7.744v7.259h15V6z"></path>' +
        '<path fill="#18482a" d="M14,33.054v7.202C14,41.219,14.781,42,15.743,42H29v-8.946H14z"></path>' +
        '<path fill="#0c8045" d="M14 15.003H29V24.005000000000003H14z"></path>' +
        '<path fill="#17472a" d="M14 24.005H29V33.055H14z"></path>' +
        '<g>' +
        '<path fill="#29c27f" d="M42.256,6H29v9.003h15V7.744C44,6.781,43.219,6,42.256,6z"></path>' +
        '<path fill="#27663f" d="M29,33.054V42h13.257C43.219,42,44,41.219,44,40.257v-7.202H29z"></path>' +
        '<path fill="#19ac65" d="M29 15.003H44V24.005000000000003H29z"></path>' +
        '<path fill="#129652" d="M29 24.005H44V33.055H29z"></path>' +
        '</g>' +
        '<path fill="#0c7238" d="M22.319,34H5.681C4.753,34,4,33.247,4,32.319V15.681C4,14.753,4.753,14,5.681,14h16.638 C23.247,14,24,14.753,24,15.681v16.638C24,33.247,23.247,34,22.319,34z"></path>' +
        '<path fill="#fff" d="M9.807 19L12.193 19 14.129 22.754 16.175 19 18.404 19 15.333 24 18.474 29 16.123 29 14.013 25.07 11.912 29 9.526 29 12.719 23.982z"></path>' +
        '</svg>'
    ;

    // Array com códigos de formulários que terão botão Excel
    var formularios_excel = [1, 22, 28, 29, 34, 37, 44, 57];

    var global_codigo_form = 0;
    var globalcodigo_nome = 0;

    // Função para alternar entre os modos de visualização
    function toggleViewMode() {
        var contentContainer = document.getElementById('contentContainer');
        var radios = document.getElementsByName('viewMode');
        var selectedValue = '';

        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                selectedValue = radios[i].value;
                break;
            }
        }

        // Limpa o conteúdo atual
        contentContainer.innerHTML = '';


        // Requisição Ajax para obter formulários no modo Lista
        $.ajax({
            url: url + "php/Funcoes/buscar-formulario-codigo-perfil-json.php",
            method: "POST",
            data: {
                cod_perfil: cod_perfil
            },
            dataType: "JSON",
            success: function (result) {
                if (result.length > 0) {
                    result.forEach(function (elemento) {
                        var codigo_form = elemento['form_codigo'];
                        var codigo_nome = elemento['form_nome'];
                        var rows = $("#num_linhas").val(); //LINHAS POR PAGINA

                        // Verifica se o formulário tem botão Excel
                        var showExcelButton = formularios_excel.includes(codigo_form);

                        if (selectedValue === 'List') {
                            // Remove classes específicas antes de adicionar novas
                            contentContainer.classList.remove('d-flex', 'align-content-stretch', 'flex-wrap', 'w-100');

                            // Monta o HTML para o modo de lista
                            var listHtml = `
                                <div class="p-1 d-flex align-items-center">
                                    <h5 class="text-left flex-fill" id="nome-form">${codigo_nome}</h5>
                                    <button type="button" class="mx-2 btn btn-primary button-prin btn-sm ml-2" onclick="MontarFormulario(${codigo_form})">Novo Registro</button>
                                    <input type="radio" class="btn-check mx-2" name="btnradio" id="btnradio${codigo_form}" autocomplete="off">
                                    <label class="btn btn-outline-secondary button-prin btn-sm ml-2 my-1" for="btnradio${codigo_form}" onclick="VizualizarRegistroPorFormulario(${codigo_form}, '${codigo_nome}', ${rows})">Buscar Registros</label>
                                    ${showExcelButton ? `
                                    <form class="m-0 mx-2" action="php/excel/testeExcel.php" method="post">
                                        <input type="hidden" name="codigo_form" value="${codigo_form}">
                                        <input type="hidden" name="codigo_nome" value="${codigo_nome}">
                                        <button class="btn btn-outline-success button-prin btn-sm" type="submit">${iconExcel} Exportar em Excel</button>
                                    </form>` : ''}
                                </div>
                                <hr style="margin: 0px;">
                            `;

                            // Adiciona o bloco HTML ao elemento #contentContainer
                            $("#contentContainer").append(listHtml);
                        } else if (selectedValue === 'Card') {
                            // Adiciona classes específicas para o modo Card
                            contentContainer.classList.add('d-flex', 'align-content-stretch', 'flex-wrap', 'w-100');

                            // Monta o HTML para o modo Card
                            var cardHtml = `
                                <div class="card col-md-2 m-3">
                                    <div class="card-body d-flex flex-column p-2">
                                        <h5 class="card-title text-center flex-fill" id="nome-form">${elemento['form_nome']}</h5>
                                        <button type="button" class="btn btn-primary button-prin btn-sm" w-100 onclick="MontarFormulario(${codigo_form})">Novo Registro</button>
                                        <input type="radio" class="btn-check"  name="btnradio" id="btnradio${codigo_form}" autocomplete="off">
                                        <label class="btn btn-outline-secondary button-prin btn-sm card-text w-100 my-1" for="btnradio${codigo_form}" onclick="VizualizarRegistroPorFormulario(${codigo_form}, '${codigo_nome}', ${rows})">Buscar Registros</label>
                                        ${showExcelButton ? `
                                        <form class="m-0" action="php/excel/testeExcel.php" method="post">
                                            <input type="hidden" name="codigo_form" value="${codigo_form}">
                                            <input type="hidden" name="codigo_nome" value="${codigo_nome}">
                                            <button class="btn btn-outline-success button-prin btn-sm w-100" type="submit">${iconExcel} Exportar em Excel</button>
                                        </form>` : ''}
                                    </div>
                                </div>
                            `;

                            // Adiciona o bloco HTML ao elemento #contentContainer
                            $("#contentContainer").append(cardHtml);
                        }
                    });
                } else {
                    // Caso não haja formulários disponíveis
                    contentContainer.innerHTML = `<p>Nenhum Formulário habilitado ao seu perfil!</p>`;
                }
            },
            error: function () {
                console.log("Erro ao listar perfis pelo Ajax!");
            }
        });
    }

    // Chama a função para configurar o conteúdo inicial
    toggleViewMode();

    // Adiciona evento de mudança nos botões de rádio
    var radios = document.getElementsByName('viewMode');
    for (var i = 0; i < radios.length; i++) {
        radios[i].addEventListener('change', toggleViewMode);
    }


    //Busca Registros de fomrulários do usuário
    let cod_usuario = $("#cod_usuario_login").text();
    const list_element = document.getElementById('corpo-tabela');
    const pagination_element = document.getElementById('paginacao');
    let current_page = 1;
    let rows = $("#num_linhas").val();

    $.ajax({
        url: url + "php/Funcoes/buscar-registros-ativos-json.php",
        method: "POST",
        data: {
            cod_usuario: cod_usuario
        },
        dataType: "JSON",
        success: function (result) {
            if (result.length > 0) {
                LinhasTabela(result, list_element, rows, current_page);
                SetupPagination(result, pagination_element, rows);
            } else {
                $("#corpo-tabela").append(`
                    <tr>
                        <td colspan="6">Nenhum registro encontrado!</td>
                    </tr>
                `);
            }
        },
        error: function () {
            console.log("Erro ao listar perfis pelo Ajax!");
        }
    });

    function LinhasTabela(items, wrapper, rows_per_page, page) {
        wrapper.innerHTML = "";
        page--;

        let inicio = rows_per_page * page;
        let fim = inicio + rows_per_page;
        let paginatedItems = items.slice(inicio, fim);

        for (let i = 0; i < paginatedItems.length; i++) {
            let item = paginatedItems[i];
            let dataHora = ConverteDataHoraFormtBR(item['reg_data_hora']);
            let tr_element = document.createElement('tr');

            tr_element.innerHTML = `
                    <td id="cod_registro">` + item['reg_codigo'] + `</td>
                    <td>` + item['form_nome'] + `</td>
                    <td>` + item['reg_codigo_registro'] + `</td>
                    <td>` + item['reg_tipo'] + `</td>
                    <td>` + dataHora + `</td>
                    <td>
                        <div id="button-desktop" class="btn-group w-100" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary btn-sm"  onclick="VizualizarRegistro(` + item['form_codigo'] + `,` + item['reg_codigo_registro'] + `,` + item['reg_codigo'] + `)">Ver</button>
                            <button type="button" class="btn btn-secondary button-admin btn-sm"  onclick="SelecionarRegistroAlterar(` + item['form_codigo'] + `,` + item['reg_codigo_registro'] + `,` + item['reg_codigo'] + `)">Alterar</button>
                            <button type="button" class="btn btn-danger button-admin btn-sm"  onclick="SelecionarRegistroExcluir(` + item['reg_codigo'] + `)">Excluir</button>
                        </div>
                        <div id="button-mobile" class="d-flex w-100">
                            <button type="button" class="btn btn-primary btn-sm flex-grow-1 mx-1"  onclick="VizualizarRegistro(` + item['form_codigo'] + `,` + item['reg_codigo_registro'] + `,` + item['reg_codigo'] + `)">Ver</button>
                            <button type="button" class="btn btn-secondary button-admin btn-sm flex-grow-1 mx-1"  onclick="SelecionarRegistroAlterar(` + item['form_codigo'] + `,` + item['reg_codigo_registro'] + `,` + item['reg_codigo'] + `)">Alterar</button>
                            <button type="button" class="btn btn-danger button-admin btn-sm flex-grow-1 mx-1"  onclick="SelecionarRegistroExcluir(` + item['reg_codigo'] + `)">Excluir</button>
                        </div>
                    </td>`;

            wrapper.appendChild(tr_element); //Insere no html
        }
    }

    function SetupPagination(items, wrapper, rows_per_page) {
        wrapper.innerHTML = "";

        let page_count = Math.ceil(items.length / rows_per_page);
        for (let i = 1; i < page_count + 1; i++) {
            let btn = PaginationButton(i, items);
            wrapper.appendChild(btn);
        }
    }

    function PaginationButton(page, items) {
        let button = document.createElement('button');
        button.setAttribute('type', 'button');
        button.classList.add('btn');
        button.classList.add('btn-primary');
        button.classList.add('m-1');
        button.innerText = page;

        if (current_page == page) button.classList.add('active');

        button.addEventListener('click', function () {

            current_page = page;
            LinhasTabela(items, list_element, rows, current_page);

            let current_btn = document.querySelector('.paginacao button.active');
            current_btn.classList.remove('active');

            button.classList.add('active');
        });
        return button;
    }

    setInterval(() => {
        
        if (nivel_perfil == 2) {
            $("#usuarios").attr("disabled", true);
            $("#usuarios").addClass("d-none");
        }

        if (nivel_perfil == 3) {
            $(".button-admin").attr("disabled", true);
            $(".button-admin").addClass("d-none");
        }

    }, 10);

});

$("#num_linhas").change(function (e) {
    e.preventDefault(); // Previne o comportamento padrão do evento

    VizualizarRegistroPorFormulario(cod_form, nome_form);

    //Busca Registros de fomrulários do usuário
    let cod_usuario = $("#cod_usuario_login").text();
    const list_element = document.getElementById('corpo-tabela');
    const pagination_element = document.getElementById('paginacao');
    let current_page = 1;
    let rows = $("#num_linhas").val();

    $.ajax({
        url: url + "php/Funcoes/buscar-registros-ativos-json.php",
        method: "POST",
        data: {
            cod_usuario: cod_usuario
        },
        dataType: "JSON",
        success: function (result) {
            // Limpa a tabela e a paginação antes de adicionar novos dados
            list_element.innerHTML = "";
            pagination_element.innerHTML = "";

            if (result.length > 0) {
                LinhasTabela(result, list_element, rows, current_page);
                SetupPagination(result, pagination_element, rows);
            } else {
                $("#corpo-tabela").append(`
                    <tr>
                        <td colspan="6">Nenhum registro encontrado!</td>
                    </tr>
                `);
            }
        },
        error: function () {
            console.log("Erro ao listar perfis pelo Ajax!");
        }
    });

    function LinhasTabela(items, wrapper, rows_per_page, page) {
        wrapper.innerHTML = ""; // Limpa o conteúdo anterior
        page--;

        let inicio = rows_per_page * page;
        let fim = inicio + rows_per_page;
        let paginatedItems = items.slice(inicio, fim);

        for (let i = 0; i < paginatedItems.length; i++) {
            let item = paginatedItems[i];
            let dataHora = ConverteDataHoraFormtBR(item['reg_data_hora']);
            let tr_element = document.createElement('tr');

            tr_element.innerHTML = `
                    <td id="cod_registro">` + item['reg_codigo'] + `</td>
                    <td>` + item['form_nome'] + `</td>
                    <td>` + item['reg_codigo_registro'] + `</td>
                    <td>` + item['reg_tipo'] + `</td>
                    <td>` + dataHora + `</td>
                    <td>
                        <div id="button-desktop" class="btn-group w-100" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary btn-sm"  onclick="VizualizarRegistro(` + item['form_codigo'] + `,` + item['reg_codigo_registro'] + `,` + item['reg_codigo'] + `)">Ver</button>
                            <button type="button" class="btn btn-secondary button-admin btn-sm"  onclick="SelecionarRegistroAlterar(` + item['form_codigo'] + `,` + item['reg_codigo_registro'] + `,` + item['reg_codigo'] + `)">Alterar</button>
                            <button type="button" class="btn btn-danger btn-sm"  onclick="SelecionarRegistroExcluir(` + item['reg_codigo'] + `)">Excluir</button>
                        </div>
                        <div id="button-mobile" class="d-flex w-100">
                            <button type="button" class="btn btn-primary btn-sm flex-grow-1 mx-1"  onclick="VizualizarRegistro(` + item['form_codigo'] + `,` + item['reg_codigo_registro'] + `,` + item['reg_codigo'] + `)">Ver</button>
                            <button type="button" class="btn btn-secondary button-admin btn-sm flex-grow-1 mx-1"  onclick="SelecionarRegistroAlterar(` + item['form_codigo'] + `,` + item['reg_codigo_registro'] + `,` + item['reg_codigo'] + `)">Alterar</button>
                            <button type="button" class="btn btn-danger btn-sm flex-grow-1 mx-1"  onclick="SelecionarRegistroExcluir(` + item['reg_codigo'] + `)">Excluir</button>
                        </div>
                    </td>
            `;

            wrapper.appendChild(tr_element); //Insere no html
        }
    }

    function SetupPagination(items, wrapper, rows_per_page) {
        wrapper.innerHTML = ""; // Limpa o conteúdo anterior

        let page_count = Math.ceil(items.length / rows_per_page);
        for (let i = 1; i < page_count + 1; i++) {
            let btn = PaginationButton(i, items);
            wrapper.appendChild(btn);
        }
    }

    function PaginationButton(page, items) {
        let button = document.createElement('button');
        button.setAttribute('type', 'button');
        button.classList.add('btn', 'btn-primary', 'm-1');
        button.innerText = page;

        if (current_page == page) button.classList.add('active');

        button.addEventListener('click', function () {

            current_page = page;
            LinhasTabela(items, list_element, rows, current_page);

            let current_btn = document.querySelector('.paginacao button.active');
            current_btn.classList.remove('active');

            button.classList.add('active');
        });
        return button;
    }
});



//Mostrar registros por fomulário
function VizualizarRegistroPorFormulario(cod_form, nome_form) {
    //INICIO DE FUNÇÕES DE PAGINAÇÃO
    let current_page = 1;//MOSTRA A PAGINA SETADA NO INICIO
    var rows = $("#num_linhas").val(); //LINHAS POR PAGINA

    console.log(rows);

    function LinhasTabela(items, wrapper, rows_per_page, page, nome_form) {
        if (items.length <= 0) {
            $("#nome-form-pesquisa").show().text('Formulário: ' + nome_form);
            $(wrapper).html(`
                <tr>
                    <td colspan="6">Nenhum registro encontrado!</td>
                </tr>`);
        } else {
            $("#nome-form-pesquisa").show().text('Formulário: ' + nome_form);
            wrapper.innerHTML = "";
            page--;

            let inicio = rows_per_page * page;
            let fim = inicio + rows_per_page;
            let paginatedItems = items.slice(inicio, fim);

            for (let i = 0; i < paginatedItems.length; i++) {
                let item = paginatedItems[i];
                let dataHora = ConverteDataHoraFormtBR(item['reg_data_hora']);
                let tr_element = document.createElement('tr');

                tr_element.innerHTML = `
                <td id="cod_registro">` + item['reg_codigo'] + `</td>
                <td>` + item['form_nome'] + `</td>
                <td>` + item['usu_nome'] + `</td>
                <td>` + item['reg_tipo'] + `</td>
                <td>` + dataHora + `</td>
                <td>
                    <div id="button-desktop" class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary btn-sm"  onclick="VizualizarRegistro(` + item['form_codigo'] + `,` + item['reg_codigo_registro'] + `,` + item['reg_codigo'] + `)">Ver</button>
                        <button type="button" class="btn btn-secondary button-admin btn-sm"  onclick="SelecionarRegistroAlterar(` + item['form_codigo'] + `,` + item['reg_codigo_registro'] + `,` + item['reg_codigo'] + `)">Alterar</button>
                        <button type="button" class="btn btn-danger btn-sm"  onclick="SelecionarRegistroExcluir(` + item['reg_codigo'] + `)">Excluir</button>
                    </div>
                    <div id="button-mobile" class="d-flex w-100">
                        <button type="button" class="btn btn-primary btn-sm flex-grow-1 mx-1"  onclick="VizualizarRegistro(` + item['form_codigo'] + `,` + item['reg_codigo_registro'] + `,` + item['reg_codigo'] + `)">Ver</button>
                        <button type="button" class="btn btn-secondary button-admin btn-sm flex-grow-1 mx-1"  onclick="SelecionarRegistroAlterar(` + item['form_codigo'] + `,` + item['reg_codigo_registro'] + `,` + item['reg_codigo'] + `)">Alterar</button>
                        <button type="button" class="btn btn-danger btn-sm flex-grow-1 mx-1"  onclick="SelecionarRegistroExcluir(` + item['reg_codigo'] + `)">Excluir</button>
                    </div>
                </td>`;

                wrapper.appendChild(tr_element); //Insere no html

                window.location='#fim';
            }
        }
    }

    function SetupPagination(items, wrapper, rows_per_page) {
        wrapper.innerHTML = "";

        let page_count = Math.ceil(items.length / rows_per_page);
        for (let i = 1; i < page_count + 1; i++) {
            let btn = PaginationButton(i, items);
            wrapper.appendChild(btn);
        }
    }

    function PaginationButton(page, items) {
        let button = document.createElement('button');
        button.setAttribute('type', 'button');
        button.classList.add('btn');
        button.classList.add('btn-primary');
        button.classList.add('m-1');
        button.innerText = page;

        if (current_page == page) button.classList.add('active');

        button.addEventListener('click', function () {

            current_page = page;
            LinhasTabela(items, list_element, rows, current_page);

            let current_btn = document.querySelector('.paginacao button.active');
            current_btn.classList.remove('active');

            button.classList.add('active');
        });
        return button;
    }
    //FIM FUNÇÕES DE PAGINAÇÃO
    let cod_usuario = $("#cod_usuario_login").text();
    const list_element = document.getElementById('corpo-tabela');
    const pagination_element = document.getElementById('paginacao');
    switch (cod_perfil) {
        case '1':
            $.ajax({
                url: url + "php/Funcoes/buscar-registros-formulario-ativos-json.php",
                method: "POST",
                data: {
                    cod_formulario: cod_form,
                },
                dataType: "JSON",
                success: function (result) {
                    $("#usuario").text("Usuário");
                    LinhasTabela(result, list_element, rows, current_page, nome_form);
                    SetupPagination(result, pagination_element, rows);
                },
                error: function () {
                    console.log("Erro ao listar todos pelo Ajax!");
                }
            });
            break;
        default:
            $.ajax({
                url: url + "php/Funcoes/buscar-registros-formulario-ativos-json.php",
                method: "POST",
                data: {
                    cod_formulario: cod_form,
                    cod_usuario: cod_usuario
                },
                dataType: "JSON",
                success: function (result) {
                    $("#usuario").text("Usuário");
                    LinhasTabela(result, list_element, rows, current_page, nome_form);
                    SetupPagination(result, pagination_element, rows);
                },
                error: function () {
                    console.log("Erro ao listar perfis pelo Ajax!");
                }
            });
            break;
    }
}


//Seção Registros
function SelecionarRegistroExcluir(cod_registro) {
    $.ajax({
        url: url + "php/Funcoes/excluir-registro-formulario.php",
        data: {
            cod_registro: cod_registro
        },
        method: "POST",
        success: function (result) {
            console.log(result);
            PreencherTabelaRegistros();
        }
        , error: function () {
            console.log("Erro ao excluir registro pelo Ajax!");
        }
    });
}


function PreencherTabelaRegistros() {
    $("#corpo-tabela").html("");
    let cod_usuario = $("#cod_usuario_login").text();
    const list_element = document.getElementById('corpo-tabela');
    const pagination_element = document.getElementById('paginacao');
    let current_page = 1;
    let rows = $("#num_linhas").val();

    $.ajax({
        url: url + "php/Funcoes/buscar-registros-ativos-json.php",
        method: "POST",
        data: {
            cod_usuario: cod_usuario
        },
        dataType: "JSON",
        success: function (result) {

            if (result.length > 0) {
                LinhasTabela(result, list_element, rows, current_page);
                SetupPagination(result, pagination_element, rows);
            } else {
                $("#corpo-tabela").append(`
                   <tr>
                       <td colspan="6">Nenhum registro encontrado!</td>
                   </tr>
               `);
            }
        },
        error: function () {
            console.log("Erro ao listar perfis pelo Ajax!");
        }
    });

    function LinhasTabela(items, wrapper, rows_per_page, page) {
        wrapper.innerHTML = "";
        page--;

        let inicio = rows_per_page * page;
        let fim = inicio + rows_per_page;
        let paginatedItems = items.slice(inicio, fim);

        for (let i = 0; i < paginatedItems.length; i++) {
            let item = paginatedItems[i];
            let dataHora = ConverteDataHoraFormtBR(item['reg_data_hora']);

            let tr_element = document.createElement('tr');
            tr_element.innerHTML = `
               <td id="cod_registro">` + item['reg_codigo'] + `</td>
               <td>` + item['form_nome'] + `</td>
               <td>` + item['reg_codigo_registro'] + `</td>
               <td>` + item['reg_tipo'] + `</td>
               <td>` + dataHora + `</td>
               <td>
                    <button type="button" class="btn btn-primary btn-sm my-1 w-100"  onclick="SelecionarRegistroAlterar(` + item['form_codigo'] + `,` + item['reg_codigo_registro'] + `,` + item['reg_codigo'] + `)">Alterar</button>
                    <button type="button" class="btn btn-danger btn-sm my-1 w-100"  onclick="SelecionarRegistroExcluir(` + item['reg_codigo'] + `)">Excluir</button>
               </td>`;

            wrapper.appendChild(tr_element); //Insere no html
        }
    }

    function SetupPagination(items, wrapper, rows_per_page) {
        wrapper.innerHTML = "";

        let page_count = Math.ceil(items.length / rows_per_page);
        for (let i = 1; i < page_count + 1; i++) {
            let btn = PaginationButton(i, items);
            wrapper.appendChild(btn);
        }
    }

    function PaginationButton(page, items) {
        let button = document.createElement('button');
        button.setAttribute('type', 'button');
        button.classList.add('btn');
        button.classList.add('btn-primary');
        button.classList.add('m-1');
        button.innerText = page;

        if (current_page == page) button.classList.add('active');

        button.addEventListener('click', function () {

            current_page = page;
            LinhasTabela(items, list_element, rows, current_page);

            let current_btn = document.querySelector('.paginacao button.active');
            current_btn.classList.remove('active');

            button.classList.add('active');
        });
        return button;
    }
}


function SelecionarRegistroAlterar(cod_form, cod_dados, cod_registro) {
    var siglaArray = [];
    $.ajax({
        url: url + "php/Funcoes/montar-formulario.php",
        data: {
            cod_formulario: cod_form
        },
        method: "POST",
        dataType: "JSON",
        success: function (result) {
            result.forEach(function (elemento) {

                siglaArray.push(elemento['ques_sigla']);

            });
        }
        , error: function () {
            console.log("Erro ao montar formulario pelo Ajax!");
        }
    });
    MontarFormulario(cod_form);
    $("#fim").append(`<input class="d-none" id="cod_registro"></input>`);
    let foi = null;
    setTimeout(function () {
        $("#form").addClass("placeholder-glow");
        $(".form-label, .form-select, .form-control").addClass("placeholder");

        $.ajax({
            method: "POST",
            url: url + "php/Funcoes/buscar-dados-formulario.php",
            data: {
                cod_form: cod_form,
                cod_dados: cod_dados
            },
            dataType: "JSON",
            success: function (result) {
                for (var i = 0; i < siglaArray.length; i++) {
                    result.forEach(function (elemento) {
                        $('#' + siglaArray[i]).val(elemento[siglaArray[i]]);
                    });
                }
                foi = true;
            }, error: function () {
                console.log("Erro ao inputar dados do formulario pelo Ajax!");
                foi = false;
            }
        });

    }, 50);
    setTimeout(function () {
        if (foi == true) {
            $("#form").removeClass("placeholder-glow");
            $(".form-label, .form-select, .form-control").removeClass("placeholder");
            $("#cod_registro").val(cod_registro);
        } else {
            console.log("Erro");
        }
    }, 1500);
}


function VizualizarRegistro(cod_form, cod_dados, cod_registro) {
    $("#btn-modal-vizualizacao").trigger('click');
    var siglaArray = [];
    $("#vizualizacao").slideDown();
    var html_tabela = `
    <table class="table">
    <thead>
      <tr>
        <th scope="col" style="width:50%">Questão</th>
        <th scope="col">Valor</th>
      </tr>
    </thead>
    <tbody id='corpo-tabel-vizualizacao'>
    </tbody>
  </table>
    `;
    $("#tabela-vizualizar-registros").html(html_tabela);
    var html_tbody;
    $.ajax({
        url: url + "php/Funcoes/montar-formulario.php",
        data: {
            cod_formulario: cod_form
        },
        method: "POST",
        dataType: "JSON",
        success: function (result) {
            result.forEach(function (elemento) {

                siglaArray.push(elemento['ques_sigla']);

            });
            //Busca os valores e insere na tabela
            $.ajax({
                method: "POST",
                url: url + "php/Funcoes/buscar-dados-formulario.php",
                data: {
                    cod_form: cod_form,
                    cod_dados: cod_dados
                },
                dataType: "JSON",
                success: function (result) {
                    for (var i = 0; i < siglaArray.length; i++) {
                        result.forEach(function (elemento) {
                            switch (siglaArray[i]) {
                                case 'codigo':
                                    break;
                                default:
                                    html_tbody += '<tr><th id="' + siglaArray[i] + '"></th><td>' + elemento[siglaArray[i]] + '</td></tr>';
                                    break;
                            }
                        });
                    }
                    $('#corpo-tabel-vizualizacao').append(html_tbody);

                }, error: function () {
                    console.log("Erro ao inputar dados do formulario pelo Ajax!");
                    foi = false;
                }
            });
            setTimeout(() => {
                //Busca a descrição das perguntas e inserem na tabela
                $.ajax({
                    method: "POST",
                    url: url + "php/Funcoes/montar-formulario.php",
                    data: {
                        cod_formulario: cod_form
                    },
                    dataType: "JSON",
                    success: function (result) {
                        result.forEach(function (elemento) {
                            switch (elemento['ques_sigla']) {
                                case 'codigo':
                                    break;
                                default:
                                    $("#" + elemento['ques_sigla']).text(elemento['ques_descricao']);
                                    break;
                            }
                        });
                    }, error: function () {
                        console.log("Erro ao inputar dados do formulario pelo Ajax!");
                        foi = false;
                    }
                });
            }, 10);


        }
        , error: function () {
            console.log("Erro ao montar formulario pelo Ajax!");
        }
    });
    var html_tbody;
}


//Seção Montar Formularios
function MontarFormulario(cod_formulario) {

    $("#form-principal").html(``);
    $("#fim").html(``);
    $("#form-principal").addClass("mb-2 mt-1");
    $("#inicio").addClass("d-none");
    $.ajax({
        url: url + "php/Funcoes/buscar-formulario-codigo-json.php",
        data: {
            cod_formulario: cod_formulario
        },
        method: "POST",
        dataType: "JSON",
        success: function (result) {
            result.forEach(function (elemento) {
                switch (elemento['form_ativo']) {
                    case "SIM":
                        $("#principal").removeClass("container-fluid").addClass('container');
                        $("#form-principal").append(`
                        <a class="btn mt-1" href="`+ url + `"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                        <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                      </svg> Menu Principal</a>
                        <h4 class="text-center d-none" id="cod_form" >` + elemento['form_codigo'] + `</h4>
                        <h4 class="text-center d-none" id="sigla_form">` + elemento['form_sigla'] + `</h4>
                        <h4 class="text-center mt-1 my-2 pt-4 pb-4" id="title-form">` + elemento['form_nome'] + `</h4>
                        `);
                        break;
                }
            });
            return true;
        }
        , error: function () {
            console.log("Erro ao montar Título formulario pelo Ajax!");
        }
    });
    setTimeout(function () {
        $.ajax({
            url: url + "php/Funcoes/montar-formulario.php",
            data: {
                cod_formulario: cod_formulario
            },
            method: "POST",
            dataType: "JSON",
            success: function (result) {
                result.forEach(function (elemento) {
                    $("#form-principal").append(`<h6 class="mb-4" id="ques">` + elemento['ques_html'] + `</h6><hr>`);
                });
            }
            , error: function () {
                console.log("Erro ao montar formulario pelo Ajax!");
            }
        });
    }, 20);
    setTimeout(function () {
        $("#form-principal").append(`<div class="col-md-12 text-center my-3 mt-3"><button type="button" class="btn btn-primary button-salvar" style="width:100%;" onclick="SalvarDadosFormulario()">Salvar</button></div>`)
    }, 300);
}


function MontarVizualizacao(cod_formulario) {

    $("#form-principal").html(``);
    $("#fim").html(``);
    $("#form-principal").addClass("mb-2 mt-1");
    $("#inicio").addClass("d-none");

    setTimeout(function () {
        $.ajax({
            url: url + "php/Funcoes/montar-formulario.php",
            data: {
                cod_formulario: cod_formulario
            },
            method: "POST",
            dataType: "JSON",
            success: function (result) {
                result.forEach(function (elemento) {
                    $("#form-principal").append(`<h6 class="mb-4" id="ques">` + elemento['ques_html'] + `</h6><hr>`);
                });
            }
            , error: function () {
                console.log("Erro ao montar formulario pelo Ajax!");
            }
        });
    }, 20);
    setTimeout(function () {
        $("#form-principal").append(`<div class="col-md-12 text-center my-3 mt-3"><button type="button" class="btn btn-primary button-salvar" style="width:100%;" onclick="SalvarDadosFormulario()">Salvar</button></div>`)
    }, 300);
}


//Seção Avaliações
function FormCadastrarAvaliacao() {
    $.ajax({
        url: url + "php/Forms/cadastrar-avaliacao.php",
        success: function (result) {
            $("#form").html(result);
        },
        error: function () {
            console.log("Error");
        }
    });
}


//Seção Perfil_Usuarios
function FormCadastrarPerfilUsuario() {
    $.ajax({
        url: url + "php/Forms/cadastrar-usuarios.php",
        success: function (result) {
            $("#form").html(result);
            PreencherTabelaUsuario();
            $("#close-canvas").trigger("click");
        },
        error: function () {
            console.log("Error");
        }
    });
}


//Seção Vincula PERFIS-FORMULÁRIO
function FormVincularPerfisFormulario() {
    $.ajax({
        url: url + "php/Forms/cadastrar-formularios-perfil.php",
        success: function (result) {
            $("#form").html(result);
            PreencherSelectFormulariosPerfil();
            PreencherSelectPerfis();
            PreencherTabelaVinculoFormularioPerfil();
            $("#close-canvas").trigger("click");
        },
        error: function () {
            console.log("Error");
        }
    });
}


function SalvarVinculoFormularioPerfil() {
    let cod_perfil = $("#cod_perfil").val();
    let cod_formulario = $("#cod_formulario").val();
    let vinculo_ativo = "SIM";
    $.ajax({
        url: url + "php/Funcoes/salvar-formularios-perfis.php",
        data: {
            cod_perfil: cod_perfil,
            cod_formulario: cod_formulario,
            vinculo_ativo: vinculo_ativo
        },
        method: "POST",
        success: function (result) {
            switch (result) {
                case 'Salvo com sucesso!':
                    $('#retorno').html(`
                    <div class="alert alert-success text-center" role="alert" style="border:none">
                    <h5 id="icone">✅</h5>
                    <h5>`+ result + `</h5>
                    `).slideDown('slow');
                    $('#retorno').delay('3000').animate({ height: 'toggle' }).jq;
                    setTimeout(function () {
                        PreencherTabelaVinculoFormularioPerfil();
                    }, 3000);
                    break;

                case 'Vinculo já existe!':
                    $('#retorno').html(`
                    <div class="alert alert-warning text-center" role="alert" style="border:none">
                    <h5 id="icone">⚠️</h5>
                    <h5>`+ result + `</h5>
                </div>
                    `).slideDown('slow');
                    $('#retorno').delay('3000').animate({ height: 'toggle' });
                    break;

                default:
                    $('#retorno').append(`
                    <div class="alert alert-danger text-center" role="alert" style="border:none">
                        <h5 id="icone">⚠️</h5>
                        <h5>`+ result + `</h5>
                    </div>
                    `);
                    break;

            }
        }, error: function () {
            console.log("Erro ao salvar usuario pelo Ajax!");
        }
    });
}


function PreencherTabelaVinculoFormularioPerfil() {
    $("#corpo-tabela").html("");
    $.ajax({
        url: url + "php/Funcoes/buscar-formularios-perfis-json.php",
        dataType: "JSON",
        data: {
            cod_perfil: cod_perfil
        },
        success: function (result) {
            result.forEach(function (elemento) {
                switch (elemento['fp_ativo']) {
                    case 'SIM':
                        $("#corpo-tabela").append(`
                            <tr>
                                <th>`+ elemento['fp_codigo'] + `</th>
                                <td>`+ elemento['form_nome'] + `</td>
                                <td>`+ elemento['per_descricao'] + `</td>
                                <td>`+ elemento['fp_ativo'] + `</td>
                                <td>
                                    <button type="button" class="btn btn-danger my-1 w-100"  value="NÃO" onclick="InativarAtivarVinculoPerfilFormulario(`+ elemento['fp_codigo'] + `,this.value)">Inativar</button>
                                </td>
                            </tr>
                        `);
                        break;
                    case 'NÃO':
                        $("#corpo-tabela").append(`
                            <tr>
                                <th>`+ elemento['fp_codigo'] + `</th>
                                <td>`+ elemento['form_nome'] + `</td>
                                <td>`+ elemento['per_descricao'] + `</td>
                                <td>`+ elemento['fp_ativo'] + `</td>
                                <td>
                                    <button type="button" class="btn btn-success my-1 w-100"  value="SIM" onclick="InativarAtivarVinculoPerfilFormulario(`+ elemento['fp_codigo'] + `,this.value)">Ativar</button>
                                </td>
                            </tr>
                        `);

                        break;
                }

            });
        }
        , error: function () {
            console.log("Erro ao listar perfis pelo Ajax!");
        }
    });
}


function PreencherSelectPerfis() {
    $.ajax({
        url: url + "php/Funcoes/buscar-perfil-json.php",
        dataType: "JSON",
        success: function (result) {
            result.forEach(function (elemento) {
                switch (elemento['per_ativo']) {
                    case 'SIM':
                        $("#cod_perfil").append(`
                            <option value="`+ elemento['per_codigo'] + `">` + elemento['per_descricao'] + `</option>
                        `);
                        break;
                }
            });

        }, error: function () {
            console.log("Error");
        }
    });
}

function PreencherSelectNivel() {
    $.ajax({
        url: url + "php/Funcoes/buscar-nivel-json.php",
        dataType: "JSON",
        success: function (result) {
            console.log(result);
            result.forEach(function (elemento) {
                $("#perfil_nivel").append(`
                    <option value="${elemento.per_nivel}">${elemento.per_nivel}<?option>
                `);
            })
        }
    })
}


function InativarAtivarVinculoPerfilFormulario(cod_vinculo, vinculo_ativo) {
    $.ajax({
        url: url + "php/Funcoes/inativar-ativar-vinculo-formulario-perfil.php",
        data: {
            cod_vinculo: cod_vinculo,
            vinculo_ativo: vinculo_ativo
        },
        method: "POST",
        success: function (result) {
            console.log(result);
            PreencherTabelaVinculoFormularioPerfil();
        }
        , error: function () {
            console.log("Erro ao inativar formulario pelo Ajax!");
        }
    });
}


//Seção Vincula CAMPOS-FORMULÁRIO
function FormVincularQuestoesFormulario() {
    $.ajax({
        url: url + "php/Forms/cadastrar-formularios-questoes.php",
        success: function (result) {
            $("#form").html(result);
            PreencherSelectFormulariosPerfil();
            PreencherSelectQuestoes();
            PreencherTabelaVinculoFormularioQuestao();
            $("#close-canvas").trigger("click");
        },
        error: function () {
            console.log("Error");
        }
    });
}


function PreencherSelectQuestoes() {
    var ordenacao = 'DESC';
    var campo = 'ques_codigo';
    $.ajax({
        url: url + "php/Funcoes/buscar-questoes-perfis-json.php",
        dataType: "JSON",
        data:{
            ordenacao,
            campo
        },
        method:"POST",
        success: function (result) {
            result.forEach(function (elemento) {
                switch (elemento['ques_ativo']) {
                    case 'SIM':
                        $("#cod_questao").append(`
                            <option value="`+ elemento['ques_codigo'] + `">` + elemento['ques_sigla'] + ` - ` + elemento['ques_descricao'] + `</option>
                        `);
                        break;
                }
            });

        }, error: function () {
            console.log("Error");
        }
    });
}


function PreencherSelectFormularios() {
    $.ajax({
        url: url + "php/Funcoes/buscar-formulario-json.php",
        dataType: "JSON",
        success: function (result) {
            result.forEach(function (elemento) {
                switch (elemento['form_ativo']) {
                    case 'SIM':
                        $("#cod_formulario").append(`
                            <option value="${elemento['form_codigo']}">${elemento['form_nome']}</option>
                        `);
                        break;
                }
            });

        }, error: function () {
            console.log("Error");
        }
    });
}

function PreencherSelectFormulariosPerfil() {
    $.ajax({
        url: url + "php/Funcoes/buscar-formularios-perfis.php",
        dataType: "JSON",
        success: function (result) {
            result.forEach(function (elemento) {
                switch (elemento['form_ativo']) {
                    case 'SIM':
                        $("#cod_formulario").append(`
                            <option value="${elemento['form_codigo']}">${elemento['form_nome']}</option>
                        `);
                        break;
                }
            });

        }, error: function () {
            console.log("Error");
        }
    });
}

function PreencherSelectFormulariosAtivos() {
    $.ajax({
        url: url + "php/Funcoes/buscar-formulario-ativos.php",
        dataType: "JSON",
        success: function (result) {
            result.forEach(function (elemento) {
                $("#cod_formulario").append(`
                    <option value="${elemento['form_codigo']}">${elemento['form_nome']}</option>
                `)
            })
        }
    })
}


function SalvarVinculoFormularioQuestao() {
    let cod_questao = $("#cod_questao").val();
    let cod_formulario = $("#cod_formulario").val();
    let vinculo_ativo = "SIM";
    $.ajax({
        url: url + "php/Funcoes/salvar-formularios-questoes.php",
        data: {
            cod_questao: cod_questao,
            cod_formulario: cod_formulario,
            vinculo_ativo: vinculo_ativo
        },
        method: "POST",
        success: function (result) {
            switch (result) {
                case 'Salvo com sucesso!':
                    $('#retorno').html(`
                    <div class="alert alert-success text-center" role="alert" style="border:none">
                    <h5 id="icone">✅</h5>
                    <h5>`+ result + `</h5>
                    `).slideDown('slow');
                    $('#retorno').delay('3000').animate({ height: 'toggle' }).jq;
                    setTimeout(function () {
                        PreencherTabelaVinculoFormularioQuestao();

                    }, 3000);
                    break;

                case 'Vinculo já existe!':
                    $('#retorno').html(`
                    <div class="alert alert-warning text-center" role="alert" style="border:none">
                    <h5 id="icone">⚠️</h5>
                    <h5>`+ result + `</h5>
                </div>
                    `).slideDown('slow');

                    $('#retorno').delay('3000').animate({ height: 'toggle' });

                    break;
                default:
                    $('#retorno').append(`
                    <div class="alert alert-danger text-center" role="alert" style="border:none">
                        <h5 id="icone">⚠️</h5>
                        <h5>`+ result + `</h5>
                    </div>
                    `);
                    break;
            }
        }, error: function () {
            console.log("Erro ao salvar usuario pelo Ajax!");
        }
    });
}


function PreencherTabelaVinculoFormularioQuestao() {
    $("#corpo-tabela").html("");
    $.ajax({
        url: url + "php/Funcoes/buscar-questoes-perfis-json.php",
        dataType: "JSON",
        success: function (result) {
            result.forEach(function (elemento) {
                switch (elemento['fq_vinculo_ativo']) {
                    case 'SIM':
                        $("#corpo-tabela").append(`
                            <tr>
                                <th>`+ elemento['fq_codigo'] + `</th>
                                <td>`+ elemento['form_nome'] + `</td>
                                <td>`+ elemento['ques_descricao'] + `</td>
                                <td>`+ elemento['fq_vinculo_ativo'] + `</td>
                                <td>
                                    <button type="button" class="btn btn-danger my-1 w-100"  value="NÃO" onclick="InativarAtivarVinculoQuestaoFormulario(`+ elemento['fq_codigo'] + `,this.value)">Inativar</button>
                                </td>
                            </tr>
                        `);
                        break;
                    case 'NÃO':
                        $("#corpo-tabela").append(`
                            <tr>
                                <th>`+ elemento['fq_codigo'] + `</th>
                                <td>`+ elemento['form_nome'] + `</td>
                                <td>`+ elemento['ques_descricao'] + `</td>
                                <td>`+ elemento['fq_vinculo_ativo'] + `</td>
                                <td>
                                    <button type="button" class="btn btn-success my-1 w-100"  value="SIM" onclick="InativarAtivarVinculoQuestaoFormulario(`+ elemento['fq_codigo'] + `,this.value)">Ativar</button>
                                </td>
                            </tr>
                        `);

                        break;
                }

            });
        }
        , error: function () {
            console.log("Erro ao listar perfis pelo Ajax!");
        }
    });
}


function InativarAtivarVinculoQuestaoFormulario(cod_vinculo, vinculo_ativo) {
    $.ajax({
        url: url + "php/Funcoes/inativar-ativar-vinculo-formulario-questao.php",
        data: {
            cod_vinculo: cod_vinculo,
            vinculo_ativo: vinculo_ativo
        },
        method: "POST",
        success: function (result) {
            console.log(result);
            PreencherTabelaVinculoFormularioQuestao();
        }
        , error: function () {
            console.log("Erro ao inativar formulario pelo Ajax!");
        }
    });
}


//Seção Questões
function FormCadastraQuestoes() {
    $.ajax({
        url: url + "php/Forms/cadastrar-questoes.php",
        success: function (result) {
            $("#form").html(result);
            PreencherTabelaQuestoes();
            $("#close-canvas").trigger("click");
        },
        error: function () {
            console.log("Error");
        }
    });
}


function HtmlPrefixo() {
    let desc_questao = $("#desc_questao").val();
    let sigla_questao = $("#sigla_questao").val();
    $("#html_questao").val(`<div class="col-md-12">
    <label for="`+ sigla_questao + `" class="form-label">` + desc_questao + `</label>
    <input type="text" class="form-control" id="`+ sigla_questao + `" name="` + sigla_questao + `">
</div>`);
}


function PreencherTabelaQuestoes() {
    $("#corpo-tabela").html("");
    $.ajax({
        url: url + "php/Funcoes/buscar-questoes-perfis-json.php",
        method: "POST",
        data: {
            ordenacao: 'ASC',
            campo: 'ques_codigo'
        },
        dataType: "JSON",
        success: function (result) {
            result.forEach(function (elemento) {
                let buttonText, buttonClass, buttonValue;
                
                if (elemento['ques_ativo'] === 'SIM') {
                    buttonText = 'Inativar';
                    buttonClass = 'btn-danger';
                    buttonValue = 'NÃO';
                } else {
                    buttonText = 'Ativar';
                    buttonClass = 'btn-success';
                    buttonValue = 'SIM';
                }
        
                $("#corpo-tabela").append(`
                    <tr>
                        <th>${elemento['ques_codigo']}</th>
                        <td>${elemento['ques_descricao']}</td>
                        <td>${elemento['ques_sigla']}</td>
                        <td>${elemento['ques_ativo']}</td>
                        <td>
                            <button type="button" class="btn btn-primary my-1 w-100" onclick="SelecionarQuestaoAlterar(${elemento['ques_codigo']})">Alterar</button>
                            <button type="button" class="btn ${buttonClass} my-1 w-100" value="${buttonValue}" onclick="InativarAtivarQuestao(${elemento['ques_codigo']}, this.value)">${buttonText}</button>
                        </td>
                    </tr>
                `);
            });
        },
        error: function () {
            console.log("Erro ao listar perfis pelo Ajax!");
        }
    });
}


function SalvarQuestao() {
    let cod_questao = $("#cod_questao").val();
    let desc_questao = $("#desc_questao").val();
    let sigla_questao = $("#sigla_questao").val();
    let posicao_questao = $("#posicao_questao").val();
    let html_questao = $("#html_questao").val();
    let questao_ativo = "SIM";
    $.ajax({
        url: url + "php/Funcoes/salvar-somente-questoes.php",
        data: {
            cod_questao: cod_questao,
            desc_questao: desc_questao,
            sigla_questao: sigla_questao,
            posicao_questao: posicao_questao,
            html_questao: html_questao,
            questao_ativo: questao_ativo
        },
        method: "POST",
        success: function (result) {
            console.log(result);
            PreencherTabelaQuestoes();
            LimparCamposCadastroQuestoes();

        }, error: function () {
            console.log("Erro ao salvar usuario pelo Ajax!");
        }
    });
}


function SelecionarQuestaoAlterar(cod_questao) {
    $(window).scrollTop(0);
    $.ajax({
        url: url + "php/Funcoes/buscar-questao-codigo-json.php",
        data: {
            cod_questao: cod_questao
        },
        dataType: "JSON",
        method: "POST",
        success: function (result) {
            result.forEach(function (elemento) {
                $("#cod_questao").val(elemento['ques_codigo']);
                $("#desc_questao").val(elemento['ques_descricao']);
                $("#sigla_questao").val(elemento['ques_sigla']);
                $("#posicao_questao").val(elemento['ques_posicao']);
                $("#html_questao").val(elemento['ques_html']);
            });
        }
        , error: function () {
            console.log("Erro ao preencher campos do perfil pelo Ajax!");
        }
    });
}


function InativarAtivarQuestao(cod_questao, questao_ativo) {
    $.ajax({
        url: url + "php/Funcoes/inativar-ativar-questao.php",
        data: {
            cod_questao: cod_questao,
            questao_ativo: questao_ativo
        },
        method: "POST",
        success: function (result) {
            console.log(result);
            PreencherTabelaQuestoes();
        }
        , error: function () {
            console.log("Erro ao inativar formulario pelo Ajax!");
        }
    });
}



//Seção Formularios
function FormCadastraFormulario() {
    $.ajax({
        url: url + "php/Forms/cadastrar-formularios.php",
        success: function (result) {
            $("#form").html(result);
            PreencherTabelaFormularioPerfil();
            $("#close-canvas").trigger("click");
        },
        error: function () {
            console.log("Error");
        }
    });
}


function FormCadastraFormularioQuestoes() {
    $.ajax({
        url: url + "php/Forms/cadastrar-formularios-questoes-juntos.php",
        success: function (result) {
            $("#form").html(result);
            $("#close-canvas").trigger("click");
        },
        error: function () {
            console.log("Error");
        }
    });
}

// Fica em Formulários no Dropdown dos formulários
function PreencherTabelaFormulario() {
    $("#corpo-tabela").html("");
    $.ajax({
        url: url + "php/Funcoes/buscar-formulario-json.php",
        dataType: "JSON",
        success: function (result) {
            result.forEach(function (elemento) {
                let btnClass = elemento['form_ativo'] === 'SIM' ? 'btn-danger' : 'btn-success';
                let btnValue = elemento['form_ativo'] === 'SIM' ? 'NÃO' : 'SIM';
                let btnText = elemento['form_ativo'] === 'SIM' ? 'Inativar' : 'Ativar';

                $("#corpo-tabela").append(`
                    <tr>
                        <th>${elemento['form_codigo']}</th>
                        <td>${elemento['form_nome']}</td>
                        <td>${elemento['form_sigla']}</td>
                        <td>${elemento['form_ativo']}</td>
                        <td class="d-flex">
                            <button type="button" class="btn btn-primary w-50 mx-1 my-auto" onclick="SelecionarFormularioAlterar(${elemento['form_codigo']})">Alterar</button>
                            <button type="button" class="btn ${btnClass} w-50 mx-1 my-auto" value="${btnValue}" onclick="InativarAtivarFormulario(${elemento['form_codigo']}, this.value)">${btnText}</button>
                            <button type="button" class="btn btn-primary mx-1 flex-grow-1" onclick="mostrarModal(${elemento['form_codigo']}, '${elemento['form_sigla']}')">Excluir</button>
                        </td>
                    </tr>
                `);
            });
        }
        , error: function () {
            console.log("Erro ao listar perfis pelo Ajax!");
        }
    });
}

function PreencherTabelaFormularioPerfil() {
    console.log(cod_perfil);
    $("#corpo-tabela").html("");
    $.ajax({
        url: url + "php/Funcoes/buscar-formularios-perfis.php",
        dataType: "JSON",
        data: {
            cod_perfil: cod_perfil
        },
        success: function (result) {
            result.forEach(function (elemento) {
                let btnClass = elemento['form_ativo'] === 'SIM' ? 'btn-danger' : 'btn-success';
                let btnValue = elemento['form_ativo'] === 'SIM' ? 'NÃO' : 'SIM';
                let btnText = elemento['form_ativo'] === 'SIM' ? 'Inativar' : 'Ativar';

                $("#corpo-tabela").append(`
                    <tr>
                        <th>`+ elemento['form_codigo'] + `</th>
                        <td>`+ elemento['form_nome'] + `</td>
                        <td>`+ elemento['form_sigla'] + `</td>
                        <td>`+ elemento['form_ativo'] + `</td>
                        <td class="d-flex justify-content-between">
                            <button type="button" class="btn btn-primary mx-1 flex-grow-1" onclick="SelecionarFormularioAlterar(${elemento['form_codigo']})">Alterar</button>
                            <button type="button" class="btn ${btnClass} mx-1 flex-grow-1" value="${btnValue}" onclick="InativarAtivarFormulario(${elemento['form_codigo']}, this.value)">${btnText}</button>
                            <button type="button" class="btn btn-primary mx-1 flex-grow-1" onclick="mostrarModal(${elemento['form_codigo']}, '${elemento['form_sigla']}')">Excluir</button>
                        </td>
                    </tr>
                `);
            });
        }
        , error: function () {
            console.log("Erro ao listar perfis pelo Ajax!");
        }
    });
}


function SalvarFormulario() {
    let cod_formulario = $("#cod_formulario").val();
    let nome_formulario = $("#nome_formulario").val();
    let sigla_formulario = $("#sigla_formulario").val();
    let formulario_ativo = "SIM";
    $.ajax({
        url: url + "php/Funcoes/salvar-formulario.php",
        data: {
            cod_formulario: cod_formulario,
            nome_formulario: nome_formulario,
            sigla_formulario: sigla_formulario,
            formulario_ativo: formulario_ativo
        },
        method: "POST",
        success: function (result) {
            console.log(result);
            PreencherTabelaFormulario();
            LimparCamposCadastroFormulario();

        }, error: function () {
            console.log("Erro ao salvar usuario pelo Ajax!");
        }
    });
}


function LimparCamposCadastroQuestoes() {
    $("#cod_questao").val("");
    $("#desc_questao").val("");
    $("#sigla_questao").val("");
    $("#posicao_questao").val("");
    $("#html_questao").val("");
}


function SelecionarFormularioAlterar(cod_formulario) {
    $(window).scrollTop(0);
    $.ajax({
        url: url + "php/Funcoes/buscar-formulario-codigo-json.php",
        data: {
            cod_formulario: cod_formulario
        },
        dataType: "JSON",
        method: "POST",
        success: function (result) {
            result.forEach(function (elemento) {
                $("#cod_formulario").val(elemento['form_codigo']);
                $("#nome_formulario").val(elemento['form_nome']);
                $("#sigla_formulario").val(elemento['form_sigla']);

            });
        }
        , error: function () {
            console.log("Erro ao preencher campos do perfil pelo Ajax!");
        }
    });
}

function mostrarModal(cod_formulario, form_sigla) {
    // Atualiza os botões do modal para chamar ExcluirFormulario com os dados corretos
    $('#modal-btn-prosseguir').off('click').on('click', function() {
        ExcluirFormulario(cod_formulario, form_sigla);
    });

    // Exibe o modal
    $('#myModal').show();
}

function fecharModal() {
    $('#myModal').hide();
}

$('#modal-btn-cancelar').on('click', fecharModal);

function ExcluirFormulario(cod_formulario, form_sigla) {
    $.ajax({
        url: url + "php/funcoes/excluir-formulario.php",
        data: {
            cod_formulario: cod_formulario,
            form_sigla: form_sigla
        },
        method: "POST",
        success: function (result) {
            var response = JSON.parse(result);
            if (response.status === 'success') {
                alert(response.message);
                fecharModal();
                // FormCadastraFormulario();
                PreencherTabelaFormulario();
            } else {
                alert(response.message);
                fecharModal();
            }
        },
        error: function () {
            console.log(response);
            alert("Erro ao excluir o formulário."); // Caso falhe
            fecharModal();
        }
    });
}


function InativarAtivarFormulario(cod_formulario, formulario_ativo) {
    $.ajax({
        url: url + "php/Funcoes/inativar-ativar-formulario.php",
        data: {
            cod_formulario: cod_formulario,
            formulario_ativo: formulario_ativo
        },
        method: "POST",
        success: function (result) {
            console.log(result);
            PreencherTabelaFormulario();
        }
        , error: function () {
            console.log("Erro ao inativar formulario pelo Ajax!");
        }
    });
}


function LimparCamposCadastroFormulario() {
    $("#cod_formulario").val("");
    $("#nome_formulario").val("");
    $("#sigla_formulario").val("");
}


function SalvarDadosFormulario() {

    var valoresAgrupados = {};

    $("#ques input[type='checkbox']:checked").each(function() {
        var idDiv = $(this).closest('div').attr('id');
        var valor = $(this).val();

        if (valoresAgrupados.hasOwnProperty(idDiv)) {
            valoresAgrupados[idDiv].push(valor);
        } else {
            valoresAgrupados[idDiv] = [valor];
        }
    });


    var cod_form = $("#cod_form").text();
    var sigla_form = $("#sigla_form").text();
    var cod_usuario = $("#cod_usuario_login").text();
    var codigo = $("#codigo").val();
    var cod_registro = $("#cod_registro").val();
    var dados = $("form").serializeArray();


    // Para adicionar os valores junto com a var = dados
    $.each(valoresAgrupados, function(key, value) {
        dados.push({ name:key, value:value.join(", ") })
    });

    // console.log(cod_form, 'COD FORM');
    // console.log(sigla_form, 'SIGLA FORM');
    // console.log(cod_usuario, 'COD USUARIO');
    // console.log(codigo, 'CODIGO');
    // console.log(cod_registro, 'COD REGISTRO');
    // console.log(dados ,'DADOS');

    $.ajax({
        method: "POST",
        url: url + "php/Funcoes/salvar-dados-formularios.php",
        data: {
            cod_usuario: cod_usuario,
            cod_form: cod_form,
            sigla_form: sigla_form,
            dados: dados,
            codigo: codigo,
            cod_registro: cod_registro
        },
        success: function (result) {
            console.log(result);
            if (result == 'Salvo com sucesso!') {
                /*$("#form").addClass("placeholder-glow");
                $(".form-label, .form-select, .form-control").addClass("placeholder");
                $(".form-label, .form-select, .form-control, hr, .button-salvar").fadeOut("slow");*/
                $("#form-principal").html("");
                $("#fim").addClass("text-center");
                $("#fim").append(`
                <div class="col-md-12 mt-3 mb-4">
                <div class="card" style="width: 30%; margin-left:35%; margin-right:35%;">
                <div class="card-body text-center card- ini" style="background-color: #d1e7dd;">
                    <div class="alert alert-success text-center" role="alert" style="border:none">
                        <h5 id="icone">✅</h5>
                        <h5>Seu registro foi salvo com sucesso!</h5>
                    </div>
                </div>
                <div class="card-body text-center card-fim">
                    <h5 class="card-title">Deseja:</h5>
                    <a href="`+ url + `" class="btn btn-primary mb-2 w-100" >Voltar ao Menu Principal</a>
                    <button type="button" class="btn btn-primary button-prin mb-2" style="width:100%;" onclick="MontarFormulario(`+ cod_form + `)">Novo Registro</button>
                    <a href="logout.php" class="btn btn-primary mb-2 w-100" >Sair do Sistema</a>
                </div>
            </div>
            </div>
            `);
                $(".card-fim").hide().delay('1000').toggle("slow");
                $(".card").hide().delay('500').fadeIn("slow");
                /*setTimeout(function () {
                    $(".alert").addClass("d-none");
                    window.location.href = url;
                }, 5000);*/
            } else {
                $("#form-principal").html("");
                $("#fim").addClass("text-center");
                $("#fim").append(`
                <div class="col-md-12 mt-3 mb-4">
                <div class="card" style="width: 30%; margin-left:35%; margin-right:35%;">
                <div class="card-body text-center card- ini" style="background-color: #f8d7da;">
                    <div class="alert alert-danger text-center" role="alert" style="border:none">
                        <h5 id="icone">❌</h5>
                        <h5>Erro ao salvar!</h5>
                    </div>
                </div>
                <div class="card-body text-center card-fim">
                    <h5 class="card-title">Entre em contato com setor de Tecnologia da Informação!</h5>
                    <a href="`+ url + `" class="btn btn-primary mb-2 w-100" >Voltar ao Menu Principal</a>
                    <a href="logout.php" class="btn btn-primary mb-2 w-100" >Sair do Sistema</a>
                </div>
            </div>
            </div>
            `);
                $(".card-fim").hide().delay('900').toggle("slow");
                $(".card").hide().delay('500').fadeIn("slow");
            }
        }, error: function () {
            console.log("Erro ao salvar usuario pelo Ajax!");
        }
    });
}

//Seção Formulários apartir de um formulário criado
function FormCadastraFormularioApartirFormularioCriado() {
    $.ajax({
        url: url + "php/Forms/cadastrar-formularios-apartir-formulario-criado.php",
        success: function (result) {
            $("#form").html(result);
            $("#close-canvas").trigger("click");
        },
        error: function () {
            console.log("Error");
        }
    });
}


//Seção Usuário
function FormCadastraUsuario() {
    $.ajax({
        url: url + "php/Forms/cadastrar-usuarios.php",
        success: function (result) {
            $("#form").html(result);
            PreencherTabelaUsuario();
            PreencherComboxPerfil();
            $("#close-canvas").trigger("click");
        },
        error: function () {
            console.log("Error");
        }
    });
}


function PreencherTabelaUsuario() {
    $("#corpo-tabela").html("");
    $.ajax({
        url: url + "php/Funcoes/buscar-usuario-json.php",
        dataType: "JSON",
        success: function (result) {
            result.forEach(function (elemento) {
                var resultado_nivel = elemento['per_nivel'];
                resultado_nivel = resultado_nivel==1?"Avançado":resultado_nivel==2?"Intermédiario":"Básico";

                switch (elemento['usu_ativo']) {
                    case 'SIM':
                        $("#corpo-tabela").append(`
                            <tr>
                                <th>${elemento['usu_codigo']}</th>
                                <td>${elemento['per_nivel']}</td>
                                <td>${elemento['usu_login']}</td>
                                <td>${elemento['usu_nome']}</td>
                                <td>${elemento['usu_email']}</td>
                                <td>${elemento['per_descricao']}</td>
                                <td>${elemento['usu_ativo']}</td>
                                <td class="d-flex">
                                    <button type="button" class="btn btn-primary mx-1 w-50 flex-fill"  onclick="SelecionarUsuarioAlterar(`+ elemento['usu_codigo'] + `)">Alterar</button>
                                    <button type="button" class="btn btn-danger mx-1 w-50 flex-fill"  value="NÃO" onclick="InativarAtivarUsuario(`+ elemento['usu_codigo'] + `,this.value)">Inativar</button>
                                </td>
                            </tr>
                        `);
                        break;
                    case 'NÃO':
                        $("#corpo-tabela").append(`
                            <tr>
                                <th>${elemento['usu_codigo']}</th>
                                <td>${elemento['per_nivel']}</td>
                                <td>${elemento['usu_login']}</td>
                                <td>${elemento['usu_nome']}</td>
                                <td>${elemento['usu_email']}</td>
                                <td>${elemento['per_descricao']}</td>
                                <td>${elemento['usu_ativo']}</td>
                                <td class="d-flex">
                                    <button type="button" class="btn btn-primary mx-1 w-50 flex-fill"  onclick="SelecionarUsuarioAlterar(`+ elemento['usu_codigo'] + `)">Alterar</button>
                                    <button type="button" class="btn btn-success mx-1 w-50 flex-fill"  value="SIM" onclick="InativarAtivarUsuario(`+ elemento['usu_codigo'] + `,this.value)">Ativar</button>
                                </td>
                            </tr>
                        `);

                        break;
                }

            });
        }
        , error: function () {
            console.log("Erro ao listar perfis pelo Ajax!");
        }
    });
}


function SalvarUsuario() {
    let cod_usuario = $("#cod_usuario").val();
    let login_usuario = $("#login_usuario").val();
    let nome_usuario = $("#nome_usuario").val();
    let email_usuario = $("#email_usuario").val();
    let cod_perfil_usuario = $("#cod_perfil_usuario").val();
    let usuario_ativo = "SIM";
    $.ajax({
        url: url + "php/Funcoes/salvar-usuario.php",
        data: {
            cod_usuario: cod_usuario,
            login_usuario: login_usuario,
            nome_usuario: nome_usuario,
            email_usuario: email_usuario,
            cod_perfil_usuario: cod_perfil_usuario,
            usuario_ativo: usuario_ativo
        },
        method: "POST",
        success: function (result) {

            PreencherTabelaUsuario();
            LimparCamposCadastroUsuario();

        }, error: function () {
            console.log("Erro ao salvar usuario pelo Ajax!");
        }
    });
}


function SelecionarUsuarioAlterar(cod_usuario) {
    $(window).scrollTop(0);
    $.ajax({
        url: url + "php/Funcoes/buscar-usuario-codigo-json.php",
        data: {
            cod_usuario: cod_usuario
        },
        dataType: "JSON",
        method: "POST",
        success: function (result) {
            result.forEach(function (elemento) {
                $("#cod_usuario").val(elemento['usu_codigo']);
                $("#login_usuario").val(elemento['usu_login']);
                $("#nome_usuario").val(elemento['usu_nome']);
                $("#email_usuario").val(elemento['usu_email']);
                $("#cod_perfil_usuario").val(elemento['usu_codigo_perfil']);

            });
        }
        , error: function () {
            console.log("Erro ao preencher campos do perfil pelo Ajax!");
        }
    });
}


function LimparCamposCadastroUsuario() {
    $("#cod_usuario").val("");
    $("#login_usuario").val("");
    $("#nome_usuario").val("");
    $("#email_usuario").val("");
}


function InativarAtivarUsuario(cod_usuario, usuario_ativo) {
    $.ajax({
        url: url + "php/Funcoes/inativar-ativar-usuario.php",
        data: {
            cod_usuario: cod_usuario,
            usuario_ativo: usuario_ativo
        },
        method: "POST",
        success: function (result) {
            console.log(result);
            PreencherTabelaUsuario();
        }
        , error: function () {
            console.log("Erro ao inativar usuario pelo Ajax!");
        }
    });
}


function PreencherComboxPerfil() {
    $.ajax({
        url: url + "php/Funcoes/buscar-perfil-json.php",
        dataType: "JSON",
        success: function (result) {
            result.forEach(function (elemento) {
                switch (elemento['per_ativo']) {
                    case 'SIM':
                        $("#cod_perfil_usuario").append(`
                            <option value="`+ elemento['per_codigo'] + `">` + elemento['per_descricao'] + `</option>
                        `);
                        break;
                }
            });

        }, error: function () {
            console.log("Error");
        }
    });
}


//Seção Perfil
function FormCadastraPerfil() {
    $.ajax({
        url: url + "php/Forms/cadastrar-perfil.php",
        success: function (result) {
            $("#form").html(result);
            PreencherTabelaPerfil();
            $("#close-canvas").trigger("click");
        },
        error: function () {
            console.log("Error");
        }
    });
}


function LimparCamposCadastroPerfil() {
    $("#cod_perfil").val("");
    $("#desc_perfil").val("");
}


function SalvarPerfil() {
    let cod_perfil = $("#cod_perfil").val();
    let desc_perfil = $("#desc_perfil").val();
    let cod_nivel = $("#perfil_nivel").val();
    let perfil_ativo = "SIM";
    $.ajax({
        url: url + "php/Funcoes/salvar-perfil.php",
        data: {
            cod_perfil: cod_perfil,
            cod_nivel: cod_nivel,
            desc_perfil: desc_perfil,
            perfil_ativo: perfil_ativo
        },
        method: "POST",
        success: function (result) {

            PreencherTabelaPerfil();
            LimparCamposCadastroPerfil();

        }, error: function () {
            console.log("Erro ao salvar Perfil pelo Ajax!");
        }
    });
}


function PreencherTabelaPerfil() {
    $("#corpo-tabela").html("");
    $.ajax({
        url: url + "php/Funcoes/buscar-perfil-json.php",
        dataType: "JSON",
        success: function (result) {
            result.forEach(function (elemento) {
                var resultado_nivel = elemento['per_nivel'];
                resultado_nivel = resultado_nivel==1?"Avançado":resultado_nivel==2?"Intermédiario":"Básico";

                switch (elemento['per_ativo']) {                    
                    case 'SIM':
                        $("#corpo-tabela").append(`
                            <tr>
                                <td class="align-middle"><strong>${elemento['per_codigo']}</strong></td>
                                <td class="align-middle"><strong>${elemento['per_nivel']}</strong></td>
                                <td class="align-middle">${elemento['per_descricao']}</td>
                                <td class="align-middle">${elemento['per_ativo']}</td>
                                <td class="align-middle d-flex">
                                    <button type="button" class="btn btn-primary flex-fill mx-1"  onclick="SelecionarPerfilAlterar(`+ elemento['per_codigo'] + `)">Alterar</button>
                                    <button type="button" class="btn btn-danger flex-fill"  value="NÃO" onclick="InativarAtivarPerfil(`+ elemento['per_codigo'] + `,this.value)">Inativar</button>
                                </td>
                            </tr>
                        `);
                        break;
                    case 'NÃO':
                        $("#corpo-tabela").append(`
                            <tr>
                                <td class="align-middle"><strong>${elemento['per_codigo']}</strong></td>
                                <td class="align-middle"><strong>${elemento['per_nivel']}</strong></td>
                                <td class="align-middle">${elemento['per_descricao']}</td>
                                <td class="align-middle">${elemento['per_ativo']}</td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-primary flex-fill mx-1"  onclick="SelecionarPerfilAlterar(`+ elemento['per_codigo'] + `)">Alterar</button>
                                    <button type="button" class="btn btn-success flex-fill"  value="SIM" onclick="InativarAtivarPerfil(`+ elemento['per_codigo'] + `,this.value)">Ativar</button>
                                </td>
                            </tr>
                        `);

                        break;
                }

            });
        }
        , error: function () {
            console.log("Erro ao listar perfis pelo Ajax!");
        }
    });
}


function SelecionarPerfilAlterar(cod_perfil) {
    $(window).scrollTop(0);
    $.ajax({
        url: url + "php/Funcoes/buscar-perfil-codigo-json.php",
        data: {
            cod_perfil: cod_perfil
        },
        dataType: "JSON",
        method: "POST",
        success: function (result) {
            result.forEach(function (elemento) {
                $("#cod_perfil").val(elemento['per_codigo']);
                $("#desc_perfil").val(elemento['per_descricao']);
                $("#perfil_ativo").val(elemento['per_ativo']);
                $("#perfil_nivel").val(elemento['per_nivel']);
            });
        }
        , error: function () {
            console.log("Erro ao preencher campos do perfil pelo Ajax!");
        }
    });
}


function InativarAtivarPerfil(cod_perfil, perfil_ativo) {
    console.log(cod_perfil, perfil_ativo);
    $.ajax({
        url: url + "php/Funcoes/inativar-ativar-perfil.php",
        data: {
            cod_perfil: cod_perfil,
            perfil_ativo: perfil_ativo
        },
        method: "POST",
        success: function (result) {
            console.log(result);
            PreencherTabelaPerfil();
        }
        , error: function () {
            console.log("Erro ao inativar perfil pelo Ajax!");
        }
    });
}


//Seção Relatório AHPACEG
function FormListarAhpaceg() {
    $.ajax({
        url: url + "php/Forms/listar-ahpaceg.php",
        success: function (result) {
            $("#form").html(result);
            PreencherTabelaPerfil();
            $("#close-canvas").trigger("click");
        },
        error: function () {
            console.log("Error");
        }
    });
}


//-------------------------------------------------------------------------------------------

function AlterarQuestoes() {
    $.ajax({
        url: url + "php/Funcoes/buscar-formulario-codigo-perfil-json.php",
        method: 'POST',
        data: {
            cod_perfil: cod_perfil
        },
        dataType: 'json',
        success: function (result) {
            var html = '';

            result.forEach(function(elemento) {
                var codigo_form = elemento['form_codigo'];
                var codigo_nome = elemento['form_nome'];

                html += `
                    <div class="p-1 d-flex align-items-center">
                        <h5 class="text-left flex-fill" id="nome-form">${codigo_nome}</h5>
                        <button type="button" class="mx-2 btn btn-primary button-prin btn-sm ml-2" onclick="ExibirQuestoes(${codigo_form}, '${codigo_nome}')">Adicionar Questões</button>
                    </div>
                    <hr style="margin: 0px;">
                `;
            });
            $("#form").html(html);
        },
        error: function(xhr, status, error) {
            console.error('Erro na requisição:', error);
        }
    });
}

// Form de alterar-questoes.php
function ExibirQuestoes(cod_form, cod_nome) {
    $.ajax({
        url: url + "php/Forms/alterar-questoes.php",
        method: "POST",
        data: {
            cod_form: cod_form,
            cod_nome: cod_nome,
        },
        success: function(result) {
            // console.log("tudo certo");
            $("#form").html(result);
        }
    })
}

// Função para exibir questões
// function ExibirQuestoes(cod_form, cod_nome) {
//     $.ajax({
//         url: url + "php/Funcoes/buscar-questoes-formularios.php",
//         method: 'POST',
//         data: {
//             cod_form: cod_form
//         },
//         dataType: 'json',
//         success: function (result) {
//             var html = `<h4 class="d-flex justify-content-center mt-3">${cod_nome}</h4>`;

//             if (result.length > 0) {
//                 result.forEach(function(questao) {
//                     if (questao.ques_posicao !== -1) {
//                         html += `
//                             <div class="card my-3 draggable questao" id="card${questao.ques_posicao}" draggable="true">
//                                 <div class="card-body">
//                                     <label>Codigo : <span data-codigo="${questao.ques_codigo}" class="codigo">${questao.ques_codigo}</span></label>
//                                     <label>Descrição : <input class="descricao" type="text" value="${questao.ques_descricao}"></label>
//                                     <label>Posição : <span class="posicao">${questao.ques_posicao}</span></label>
//                                     <label>Sigla : <span data-sigla="${questao.ques_sigla}" class="sigla">${questao.ques_sigla}</span></label>
//                                     <label>Ativo : <span data-ativo="${questao.ques_ativo}" class="ativo">${questao.ques_ativo}</span></label>
//                                     <span class="html-codigo">${questao.ques_html}</span>
//                                     <button type="button" class="btn btn-primary button-prin">INATIVAR</button>
//                                     <button type="button" class="btn btn-danger btnExcluir">EXCLUIR</button>
//                                     <input type="text" class="form-control nova-opcao" placeholder="Digite a nova opção">
//                                     <button type="button" class="btn btn-primary button-prin btnAdicionarOpcao">ADICIONAR OPÇÃO</button>
//                                     <button type="button" class="btn btn-danger button-prin btnExcluirOpcao">EXCLUIR OPÇÃO</button>
//                                     <input type="text" class="form-control" id="textoCheckbox" placeholder="Digite o texto da Checkbox">
//                                     <button type="button" class="btn btn-primary button-prin btnAdicionarCheckbox" data-sigla="${questao.ques_sigla}">ADICIONAR CHECKBOX</button>
//                                     <button type="button" class="btn btn-danger button-prin btnExcluirCheckbox" data-sigla="${questao.ques_sigla}">EXCLUIR CHECKBOX</button>
//                                 </div>
//                             </div>
//                         `;
//                     }
//                 });
//                 $("#form").html(html);
//                 // adicionarEventoExcluirOpcao();
//                 adicionarEventos();

//                 adicionarExcluirOption();

//                 var buttonAdd = `
//                     <div>
//                         <button type="button" class="mx-2 btn btn-primary button-prin btn-md ml-2" data-cod-form="${cod_form}" id="enviar-dados">Enviar</button>
//                         <button type="button" class="mx-2 btn btn-primary button-prin btn-md ml-2" data-cod-form="${cod_form}" id="teste-dados">TESTE</button>
//                     </div>
//                     <div class="fixed-bottom d-flex justify-content-end m-3">
//                         <button type="button" class="mx-2 btn btn-primary button-prin btn-md ml-2 btnAdicionar">Adicionar</button>
//                     </div>
//                 `;

//                 $("#form").append(buttonAdd);

//                 $('#enviar-dados').click(function() {
//                     var cod_form = $(this).data('cod-form');
//                     EnviarDadosQuestoes(cod_form);
//                 });
                
//                 $('#teste-dados').click(function() {
//                     var cod_form = $(this).data('cod-form');
//                     ColetarDadosQuestoes(cod_form);
//                 });

//                 setupDragAndDrop();

//             } else {
//                 html = '<p>Nenhuma questão encontrada.</p>';
//                 $("#form").html(html);
//                 console.log('Nenhuma questão encontrada.');
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error("Erro na requisição:", error);
//         }
//     });
// }

// function EnviarDadosQuestoes(cod_form) {
//     var questoes = ColetarDadosQuestoes(cod_form);

//     $.ajax({
//         url: url + "php/Funcoes/inserir-questoes.php",
//         method: "POST",
//         dataType: 'json',
//         contentType: 'application/json',
//         data: JSON.stringify({
//             questoes: questoes,
//             cod_form: cod_form,
//         }),
//         success: function(result) {
//             console.log("Dados enviados com sucesso :", result);
//         },
//         error: function(xhr, status, error) {
//             console.error("Erro ao enviar os dados :", error);
//         }
//     })
// }

// function ColetarDadosQuestoes(cod_form) {
//     const dadosQuestoes = [];
//     const cardsQuestao = document.querySelectorAll('#form .card');

//     cardsQuestao.forEach(function(card, index) {
//         // Obtém os dados específicos de cada card
//         const codigo = card.querySelector('.codigo').getAttribute('data-codigo');
//         const descricao = card.querySelector('.descricao').value.trim();
//         const posicao = index + 1;
//         const sigla = card.querySelector('.sigla').getAttribute('data-sigla');
//         const ativo = card.querySelector('.ativo').getAttribute('data-ativo');
//         const htmlCodigo = card.querySelector('.html-codigo').innerHTML;

//         // Cria um objeto com os dados da questão atual
//         const questao = {
//             codigo: codigo,
//             descricao: descricao,
//             sigla: sigla,
//             posicao: posicao,
//             ativo: ativo,
//             html: htmlCodigo
//         };

//         // Adiciona o objeto ao array de dados das questões
//         dadosQuestoes.push(questao);
//     });

//     console.log(dadosQuestoes);
//     console.log(cod_form);
//     // Retorna o array contendo todos os dados das questões
//     return dadosQuestoes;
// }

// Função para adicionar um novo card
// function AdicionarCard() {
//     var novoId = $(".card").length + 1;
//     var descricao = 'Nova questão';
//     var descricao_abreviada = abreviacao(descricao);

//     var novoCardHtml = `
//         <div class="card my-3 draggable" id="card${novoId}" draggable="true">
//             <div class="card-body">
//                 <label>Descrição : <input type="text" value="Nova Questão"></label>
//                 <label>Sigla : </label>
//                 <label>Posição : ${novoId}º</label>
//                 <button type="button" class="btn btn-danger btnExcluir">EXCLUIR</button>
//             </div>
//             <div class="col-md-12">
//                 <label for="tipo_questao" class="form-label">Tipo de Questão</label>
//                 <div class="form-check">
//                     <input class="form-check-input" type="radio" name="radios-questao-${novoId}" id="${novoId}" value="Text" checked>Texto
//                 </div>
//                 <div class="form-check">
//                     <input class="form-check-input" type="radio" name="radios-questao-${novoId}" id="${novoId}" value="Option">Opções
//                 </div>
//                 <div class="form-check">
//                     <input class="form-check-input" type="radio" name="radios-questao-${novoId}" id="${novoId}" value="Checkbox">Checkbox
//                 </div>
//                 <div class="form-check">
//                     <input class="form-check-input" type="radio" name="radios-questao-${novoId}" id="${novoId}" value="Textarea">Campo Texto
//                 </div>
//             </div>
//         </div>
//     `;

//     $("#form").append(novoCardHtml);
//     window.location = "#rodape";

//     setupDragAndDrop();
//     atualizarPosicoes();
// }

// Delegação de eventos para excluir questão
// $(document).on("click", ".btnExcluir", ExcluirQuestao);
// $(document).on("click", ".btnAdicionar", AdicionarCard);

// function ExcluirQuestao() {
//     $(this).closest('.card').remove();
//     atualizarPosicoes()
// }

// Função para configurar arrastar e soltar
// function setupDragAndDrop() {
//     const draggables = document.querySelectorAll('.draggable');
//     const cardContainer = document.getElementById('form');

//     draggables.forEach(draggable => {
//         draggable.addEventListener('dragstart', dragStart);
//         draggable.addEventListener('dragend', dragEnd);
//     });

//     cardContainer.addEventListener('dragover', dragOver);
//     cardContainer.addEventListener('drop', drop);

//     function dragStart(event) {
//         event.dataTransfer.setData('text/plain', event.target.id);
//         event.target.classList.add('dragging');
//     }

//     function dragEnd(event) {
//         event.target.classList.remove('dragging');
//         atualizarPosicoes();
//     }

//     function dragOver(event) {
//         event.preventDefault();
//         const afterElement = getDragAfterElement(cardContainer, event.clientY);
//         const dragging = document.querySelector('.dragging');
//         if (afterElement == null) {
//             cardContainer.appendChild(dragging);
//         } else {
//             cardContainer.insertBefore(dragging, afterElement);
//         }
//     }

//     function drop(event) {
//         event.preventDefault();
//         const id = event.dataTransfer.getData('text/plain');
//         const draggableElement = document.getElementById(id);
//         draggableElement.classList.remove('dragging');
//     }

//     function getDragAfterElement(container, y) {
//         const draggableElements = [...container.querySelectorAll('.draggable:not(.dragging)')];
//         return draggableElements.reduce((closest, child) => {
//             const box = child.getBoundingClientRect();
//             const offset = y - box.top - box.height / 2;
//             if (offset < 0 && offset > closest.offset) {
//                 return { offset: offset, element: child };
//             } else {
//                 return closest;
//             }
//         }, { offset: Number.NEGATIVE_INFINITY }).element;
//     }

//     atualizarPosicoes();
// }

// function atualizarPosicoes() {
//     const cards = document.querySelectorAll('.draggable');
//     cards.forEach((card, index) => {
//         card.querySelector('label:nth-child(3)').innerText = `Posição : ${index + 1}`;
//     });
// }

// function adicionarEventos() {
//     $('.btnAdicionarCheckbox').click(function() {
//         adicionarCheckbox(this);
//     });

//     $('.btnExcluirCheckbox').click(function() {
//         excluirCheckbox(this);
//     });
// }

// PARA ADICIONAR/EXCLUIR OPTION
// function adicionarExcluirOption() {
//     // Evento para adicionar opção
//     $('.btnAdicionarOpcao').click(function() {
//         var novaOpcao = $(this).siblings('.nova-opcao').val().trim();
//         if (novaOpcao !== '') {
//             var select = $(this).siblings('.html-codigo').find('select');
//             var option = new Option(novaOpcao, novaOpcao);
//             select.append(option);
//             $(this).siblings('.nova-opcao').val(''); // Limpa o campo de texto após adicionar a opção
//         } else {
//             alert('Digite uma opção.');
//         }
//     });

//     // Evento para excluir opção
//     $('.btnExcluirOpcao').click(function() {
//         var select = $(this).siblings('.html-codigo').find('select'); // Seleciona o elemento select próximo do botão
//         var selectedIndex = select.prop('selectedIndex'); // Obtém o índice da opção selecionada
//         if (selectedIndex !== -1) {
//             select.find('option').eq(selectedIndex).remove(); // Remove a opção selecionada
//         } else {
//             alert('Nenhuma opção para excluir.');
//         }
//     });
// }

// PARA ADICIONAR/EXCLUIR CHECKBOX
// function ExcluirCheckbox(button) {
//     var quesSigla = $(button).data('sigla');
//     var textoCheckboxMarcada = '';
//     var checkboxes = $(`#${quesSigla}`).find('.form-check-input');
//     var found = false;

//     checkboxes.each(function() {
//         if ($(this).is(':checked')) {
//             textoCheckboxMarcada = $(this).next('.form-check-label').text(); // Obtém o texto da label e remove espaços em branco
//             $(this).closest('.form-check').remove(); // Remove o elemento pai da checkbox marcada
//             found = true;
//         }
//     });

//     if (!found) {
//         alert('Marque um checkbox para excluir.');
//     } else {
//         // Remove o input e o label que contêm exatamente o texto marcado
//         $(`#${quesSigla}`).find(`.form-check-input`).each(function() {
//             if ($(this).val() === textoCheckboxMarcada) {
//                 $(this).remove();
//             }
//         });
//         $(`#${quesSigla}`).find(`label`).each(function() {
//             if ($(this).text() === textoCheckboxMarcada) {
//                 $(this).remove();
//             }
//         });

//         console.log('Checkbox que foi excluído:', textoCheckboxMarcada);
//     }
// }

// function adicionarCheckbox(button) {
//     var quesSigla = $(button).data('sigla');
//     var htmlContent = $('#' + quesSigla); // Seleciona a div onde deseja adicionar a checkbox
//     var textoCheckbox = $('#textoCheckbox').val(); // Obtém o texto inserido no input

//     var inputCheckbox = document.createElement('input');
//     inputCheckbox.type = 'checkbox';
//     inputCheckbox.className = 'form-check-input'; // Adiciona a classe form-check-input para checkboxes do Bootstrap
//     inputCheckbox.value = textoCheckbox;

//     var label = document.createElement('label');
//     label.className = 'form-check-label'; // Adiciona a classe form-check-label para labels de checkboxes do Bootstrap
//     label.textContent = inputCheckbox.value;

//     // Adiciona a checkbox e o label dentro da div htmlContent
//     htmlContent.append(inputCheckbox);
//     htmlContent.append(label);
// }

// function abreviacao(desc_questao) {
//     desc_questao = desc_questao.replace(/[!@#$%¨&*(),.?":{}|<>]/g, '');

//     if (desc_questao.indexOf(' ') === -1) {
//         return desc_questao; // Descricao sem abreviacao
//     }

//     var words = desc_questao.split(' ');
//     var abbWords = [];

//     for (var i = 0; i < words.length; i++) {
//         abbWords.push(words[i].substr(0, 3));
//     }

//     var abreviacao = abbWords.join('_');
//     return abreviacao;
// }