<!DOCTYPE html>
<html>

<head>
    <script src="http://hr.org/intra/DadosAHPACEG/js/jQuery-2.1.4.min.js"></script>
    <link href="http://hr.org/intra/DadosAHPACEG/bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div id="tabela-registros">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" id="cod_registro">Cód. Registro</th>
                        <th scope="col">Formulário</th>
                        <th scope="col">Cód. dos Dados</th>
                        <th scope="col">Tipo do Registro</th>
                        <th scope="col">Data/Hora</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody id="corpo-tabela">

                </tbody>
            </table>


            <div class="paginacao text-center" id="paginacao">
            </div>
        </div>
    </div>
</body>
<script src="http://hr.org/intra/DadosAHPACEG/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
<script>
    function ConverteDataHoraFormtBR(data) {
        ano = data.substring(0, 4);
        mes = data.substring(5, 7);
        dia = data.substring(8, 10);
        hora = data.substring(11);
        let DataBR = dia + '/' + mes + '/' + ano + ' ' + hora;
        return DataBR;
    }
    var url = '/intra/DadosAHPACEG/';
    const list_element = document.getElementById('corpo-tabela');
    const pagination_element = document.getElementById('paginacao');
    let current_page = 1;
    let rows = 5;

    $.ajax({
        url: url + "php/Funcoes/buscar-registros-json.php",
        method: "POST",
        data: {
            cod_usuario: 1
        },
        dataType: "JSON",
        success: function(result) {

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
        error: function() {
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
                <td>` + item['reg_codigo'] + `</td>
                <td>` + item['form_nome'] + `</td>
                <td>` + item['reg_codigo_registro'] + `</td>
                <td>` + item['reg_tipo'] + `</td>
                <td>` + dataHora + `</td>
                <td><button type="button" class="btn btn-primary btn-sm my-1" style="width: 100%;" onclick="SelecionarRegistroAlterar(` + item['form_codigo'] + `,` + item['reg_codigo_registro'] + `,` + item['reg_codigo'] + `)">Alterar</button>
                    <button type="button" class="btn btn-danger btn-sm my-1" style="width: 100%;" onclick="SelecionarRegistroExcluir(` + item['reg_codigo'] + `)">Excluir</button>
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
        button.classList.add('btn');
        button.classList.add('btn-primary');
        button.classList.add('m-1');
        button.innerText = page;

        if (current_page == page) button.classList.add('active');

        button.addEventListener('click', function() {

            current_page = page;
            LinhasTabela(items, list_element, rows, current_page);

            let current_btn = document.querySelector('.paginacao button.active');
            current_btn.classList.remove('active');

            button.classList.add('active');
        });
        return button;
    }
</script>

</html>