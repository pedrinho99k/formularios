<?php 
session_start(); 
$cod_form = json_encode($_POST['cod_form']);
$cod_nome = addslashes($_POST['cod_nome']);
?>

<!-- <form>
    <div id="form-body">
        <div class="container-fluid">
        <div id="card-body"></div>
        </div>
    </div>
    <div class="form-group">
        <label for="radios-tipo-questao"></label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="radios-tipo-questao" id="radio-option" value="Option" checked>
            <label class="form-check-label" for="radio-option">
                Opções
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="radios-tipo-questao" id="radio-text" value="Text">
            <label class="form-check-label" for="radio-text">
                Texto
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="radios-tipo-questao" id="radio-checkbox" value="Checkbox">
            <label class="form-check-label" for="radio-checkbox">
                Checkbox
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="radios-tipo-questao" id="radio-textarea" value="Textarea">
            <label class="form-check-label" for="radio-textarea">
                Campo de Texto
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
</form> -->

<!-- 
<div class="col-md-12">
  <label for="tipo_questao" class="form-label">Selecione o tipo de questão:</label>
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
  <div class="form-check">
      <input class="form-check-input" type="radio" name="radios-tipo-questao" id="tipo_textarea" value="Textarea">
      <label class="form-check-label" for="tipo_textarea">
          Campo Texto
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
</div> -->

<div id="form-body">
    <div class="container-fluid">
    <div id="card-body"></div>
    </div>
</div>

<form action="">
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
        <div class="form-check">
            <input class="form-check-input" type="radio" name="radios-tipo-questao" id="tipo_textarea" value="Textarea">
            <label class="form-check-label" for="tipo_textarea">
                Campo Texto
            </label>
        </div>
    </div>
    <div class="container-fluid">
        <div id="card-body"></div>
    </div>
</form>


<script>
$(document).on("click", ".btnExcluir", ExcluirCard);
$(document).on("click", ".btnAdicionar", AdicionarCard);


$(document).on('click', '.btnAdicionarCheckbox', function() {
    AdicionarCheckbox(this);
});

$(document).on('click', '.btnExcluirCheckbox', function() {
    ExcluirCheckbox(this);
});

$(document).on('click', '.btnAdicionarOpcao', function() {
    AdicionarOption(this);
});

$(document).on('click', '.btnExcluirOpcao', function() {
    ExcluirOption(this);
});



// $(document).on('click', '.btnVerificar', function() {
//     var card = $(this).closest('.card');

//     // Verifica se existe algum input do tipo checkbox dentro do card
//     var temCheckbox = card.find('input[type="checkbox"]').length > 0;

//     // Verifica se existe algum elemento option dentro de um select no card
//     var temOption = card.find('select option').length > 0;

//     if (!temCheckbox) {
//         card.find('#textoCheckbox').addClass('d-none');
//         card.find('.btnAdicionarCheckbox').addClass('d-none');
//         card.find('.btnExcluirCheckbox').addClass('d-none');
//     } else {
//         console.log('O card contém checkbox(es).');
//     }

//     if (!temOption) {
//         card.find('#nova-opcao').addClass('d-none');
//         card.find('.btnAdicionarOpcao').addClass('d-none');
//         card.find('.btnExcluirOpcao').addClass('d-none');
//     } else {
//         console.log('O card contém option(s).');
//     }
// });




// $(document).on('click', 'body', function(event) {
//     var target = $(event.target);

//     if (target.hasClass('btnExcluir')) {
//         ExcluirCard(target);
//     } else if (target.hasClass('btnAdicionar')) {
//         AdicionarCard(target);
//     } else if (target.hasClass('btnAdicionarCheckbox')) {
//         AdicionarCheckbox(target);
//     } else if (target.hasClass('btnExcluirCheckbox')) {
//         ExcluirCheckbox(target);
//     } else if (target.hasClass('btnAdicionarOpcao')) {
//         AdicionarOption(target);
//     } else if (target.hasClass('btnExcluirOpcao')) {
//         ExcluirOption(target);
//     }
// });




$("#secao-opcoes").hide();

$('input[type="radio"]').click(function() {
    // Obtém o valor do radio button selecionado
    var tipo = $('input[name="radios-tipo-questao"]:checked').val();
    
    // Verifica o tipo selecionado e mostra/oculta a seção de opções
    switch (tipo) {
        case 'Option':
        case 'Checkbox':
            $("#secao-opcoes").slideDown();
            break;
        case 'Text':
        case 'Textarea':
            $("#secao-opcoes").slideUp();
            break;
    }
});

let cod_form = <?php echo $cod_form ?>;
let cod_nome = '<?php echo $cod_nome ?>';

$(document).ready(function() {
    ExibirQuestoes(cod_form, cod_nome);
});

function ExibirQuestoes(cod_form, cod_nome) {
  var html = `<h4 class="d-flex justify-content-center mt-3">${cod_nome}</h4>`;
  $.ajax({
    url: url + "php/Funcoes/buscar-questoes-formularios.php",
    method: "POST",
    data: { cod_form: cod_form },
    dataType: 'json',
    success: function(result) {
      if (result.length > 0) {
        result.forEach(function(questao) {
          if (questao.ques_posicao !== -1) {
            html += CreateCardHTML(questao);
          }
        });
        html += `
          <div class="fixed-bottom d-flex justify-content-end m-3">
            <button type="button" class="btn btn-primary button-prin btnAdicionar">ADICIONAR CARD</button>
          </div>  
        `;
        $("#form").html(html);
        SetupDragAndDrop();
      } else {
        html = '<p>Nenhuma questão encontrada.</p>';
        $("#form").html(html);
        console.log('Nenhuma questão encontrada.');
      }
    }
  });
}

function CreateCardHTML(questao) {
  return `
        <div class="card my-3 draggable questao posicao-${questao.ques_posicao}" id="card${questao.ques_posicao}" draggable="true">
            <div class="card-body">
                <label>Codigo : <span data-codigo="${questao.ques_codigo}" class="codigo">${questao.ques_codigo}</span></label>
                <label>Descrição : <input class="descricao" type="text" value="${questao.ques_descricao}"></label>
                <label>Posição : <span class="posicao">${questao.ques_posicao}</span></label>
                <label>Sigla : <span data-sigla="${questao.ques_sigla}" class="sigla">${questao.ques_sigla}</span></label>
                <label>Ativo : <span data-ativo="${questao.ques_ativo}" class="ativo">${questao.ques_ativo}</span></label>
                <span class="html-codigo" id="codigo-html-${questao.ques_posicao}">${questao.ques_html}</span>
                <button type="button" class="btn btn-primary button-prin btn-md ml-2" data-cod-form="${cod_form}" id="teste-dados" onclick="ColetarDadosQuestoes(${cod_form})">TESTE</button>
                <button type="button" class="btn btn-primary button-prin btn-md ml-2" data-cod-form="${cod_form}" id="enviar-dados" onclick="EnviarDadosQuestoes(${cod_form})">Enviar</button>

                <input type="text" class="form-control textoCheckbox" id="textoCheckbox" placeholder="Digite o texto da Checkbox">
                <button type="button" class="btn btn-primary button-prin btnAdicionarCheckbox" data-sigla="${questao.ques_sigla}">ADICIONAR CHECKBOX</button>
                <button type="button" class="btn btn-danger button-prin btnExcluirCheckbox" data-sigla="${questao.ques_sigla}">EXCLUIR CHECKBOX</button>

                <input type="text" class="form-control nova-opcao" id="nova-opcao" placeholder="Digite a nova opção">
                <button type="button" class="btn btn-primary button-prin btnAdicionarOpcao" data-sigla="${questao.ques_sigla}">ADICIONAR OPÇÃO</button>
                <button type="button" class="btn btn-danger button-prin btnExcluirOpcao" data-sigla="${questao.ques_sigla}">EXCLUIR OPÇÃO</button>

                <button type="button" class="btn btn-primary button-prin btnVerificar">TESTE DE TIPO</button>
            </div>
        </div>
    `;
}

function ColetarDadosQuestoes(cod_form) {
  const dadosQuestoes = [];
  const cardsQuestao = document.querySelectorAll('#form .card');

  cardsQuestao.forEach(function(card, index) {
      // Obtém os dados específicos de cada card
      const codigo = card.querySelector('.codigo').getAttribute('data-codigo');
      const descricao = card.querySelector('.descricao').value.trim();
      const posicao = index + 1;
      const sigla = card.querySelector('.sigla').getAttribute('data-sigla');
      const ativo = card.querySelector('.ativo').getAttribute('data-ativo');
      const htmlCodigo = card.querySelector('.html-codigo').innerHTML;

      // Cria um objeto com os dados da questão atual
      const questao = {
          codigo: codigo,
          descricao: descricao,
          sigla: sigla,
          posicao: posicao,
          ativo: ativo,
          html: htmlCodigo
      };

      // Adiciona o objeto ao array de dados das questões
      dadosQuestoes.push(questao);
  });

  console.log(dadosQuestoes);
  console.log(cod_form);
  // Retorna o array contendo todos os dados das questões
  return dadosQuestoes;
}

function EnviarDadosQuestoes(cod_form) {
    var questoes = ColetarDadosQuestoes(cod_form);

    $.ajax({
        url: url + "php/Funcoes/inserir-questoes.php",
        method: "POST",
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify({
            questoes: questoes,
            cod_form: cod_form,
        }),
        success: function(result) {
            console.log("Dados enviados com sucesso :", result);
        },
        error: function(xhr, status, error) {
            console.error("Erro ao enviar os dados :", error);
        }
    })
}

function ExcluirCard() {
    $(this).closest('.card').remove();
    AtualizarPosicoes();
}

function AtualizarPosicoes() {
    const cards = document.querySelectorAll('.draggable');
    cards.forEach((card, index) => {
        card.querySelector('label:nth-child(3)').innerText = `Posição : ${index + 1}`;
    });
}

function SetupDragAndDrop() {
    const draggables = document.querySelectorAll('.draggable');
    const cardContainer = document.getElementById('form');

    draggables.forEach(draggable => {
        draggable.addEventListener('dragstart', dragStart);
        draggable.addEventListener('dragend', dragEnd);
    });

    cardContainer.addEventListener('dragover', dragOver);
    cardContainer.addEventListener('drop', drop);

    function dragStart(event) {
        event.dataTransfer.setData('text/plain', event.target.id);
        event.target.classList.add('dragging');
    }

    function dragEnd(event) {
        event.target.classList.remove('dragging');
        AtualizarPosicoes();
    }

    function dragOver(event) {
        event.preventDefault();
        const afterElement = getDragAfterElement(cardContainer, event.clientY);
        const dragging = document.querySelector('.dragging');
        if (afterElement == null) {
            cardContainer.appendChild(dragging);
        } else {
            cardContainer.insertBefore(dragging, afterElement);
        }
    }

    function drop(event) {
        event.preventDefault();
        const id = event.dataTransfer.getData('text/plain');
        const draggableElement = document.getElementById(id);
        draggableElement.classList.remove('dragging');
    }

    function getDragAfterElement(container, y) {
        const draggableElements = [...container.querySelectorAll('.draggable:not(.dragging)')];
        return draggableElements.reduce((closest, child) => {
            const box = child.getBoundingClientRect();
            const offset = y - box.top - box.height / 2;
            if (offset < 0 && offset > closest.offset) {
                return { offset: offset, element: child };
            } else {
                return closest;
            }
        }, { offset: Number.NEGATIVE_INFINITY }).element;
    }
    AtualizarPosicoes();
}

function Abreviacao(desc_questao) {
    desc_questao = desc_questao.replace(/[!@#$%¨&*(),.?":{}|<>]/g, '');

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

function AdicionarCard() {
    var novoId = $(".card").length + 1;
    var descricao = 'Nova questão';
    var descricao_abreviada = Abreviacao(descricao);

    var novoCardHtml = `
        <div class="card my-3 draggable" id="card${novoId}" draggable="true">
            <div class="card-body">
                <label>Descrição : <input type="text" value="Nova Questão"></label>
                <label>Sigla : </label>
                <label>Posição : ${novoId}º</label>
                <button type="button" class="btn btn-danger btnExcluir">EXCLUIR</button>
            </div>
            <div class="col-md-12">
                <label for="tipo_questao" class="form-label">Tipo de Questão</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radios-questao-${novoId}" id="${novoId}" value="Text" checked>Texto
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radios-questao-${novoId}" id="${novoId}" value="Option">Opções
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radios-questao-${novoId}" id="${novoId}" value="Checkbox">Checkbox
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radios-questao-${novoId}" id="${novoId}" value="Textarea">Campo Texto
                </div>
            </div>
        </div>
    `;

    $("#form").append(novoCardHtml);
    window.location = "#rodape";

    SetupDragAndDrop();
    AtualizarPosicoes();
}

function VisualizarHtml(posicao) {
    let desc_questao = $(`.posicao-${posicao} .descricao`).val();
    let html_questao = GenerateHtmlQuestion(posicao);

    if (desc_questao === "") {
        $("#noti-descricao").slideDown();
        $("#noti-descricao").delay(3000).slideUp();
    } else {
        $(`#codigo-html-${posicao}`).text(html_questao);
        $(`#visualizacao-html-${posicao}`).show();
    }
}

function AdicionarCheckbox(button) {
    var quesSigla = $(button).data('sigla');
    var htmlContent = $('#' + quesSigla); // Seleciona a div onde deseja adicionar a checkbox

    if (htmlContent.length === 0) {
        console.error('Div nao encontrada:' + quesSigla);
        return;
    }

    var textoCheckbox = $('#textoCheckbox').val(); // Obtém o texto inserido no input

    if (!textoCheckbox) {
        alert("sem texto");
        return;
    }

    var inputCheckbox = document.createElement('input');
    inputCheckbox.type = 'checkbox';
    inputCheckbox.className = 'form-check-input'; // Adiciona a classe form-check-input para checkboxes do Bootstrap
    inputCheckbox.value = textoCheckbox;
    inputCheckbox.id = textoCheckbox;

    var label = document.createElement('label');
    label.className = 'form-check-label'; // Adiciona a classe form-check-label para labels de checkboxes do Bootstrap
    label.textContent = inputCheckbox.value;
    label.htmlFor = textoCheckbox;

    // Adiciona a checkbox e o label dentro da div htmlContent
    htmlContent.append(inputCheckbox);
    htmlContent.append(label);

    $('#textoCheckbox').val('');
}

function ExcluirCheckbox(button) {
    var quesSigla = $(button).data('sigla');
    var textoCheckboxMarcada = '';
    var checkboxes = $(`#${quesSigla}`).find('.form-check-input');
    var found = false;

    checkboxes.each(function() {
        if ($(this).is(':checked')) {
            textoCheckboxMarcada = $(this).next('.form-check-label').text(); // Obtém o texto da label e remove espaços em branco
            $(this).closest('.form-check').remove(); // Remove o elemento pai da checkbox marcada
            found = true;
        }
    });

    if (!found) {
        alert('Marque um checkbox para excluir.');
    } else {
        // Remove o input e o label que contêm exatamente o texto marcado
        $(`#${quesSigla}`).find(`.form-check-input`).each(function() {
            if ($(this).val() === textoCheckboxMarcada) {
                $(this).remove();
            }
        });
        $(`#${quesSigla}`).find(`label`).each(function() {
            if ($(this).text() === textoCheckboxMarcada) {
                $(this).remove();
            }
        });

        console.log('Checkbox que foi excluído:', textoCheckboxMarcada);
    }
}

function AdicionarOption(button) {
    var novaOpcao = $(button).siblings('.nova-opcao').val().trim();
    if (novaOpcao !== '') {
        var select = $(button).siblings('.html-codigo').find('select');

        var optionExist = false;
        select.find('option').each(function() {
            if ($(this).text() === novaOpcao) {
                optionExist = true;
                return false; // Sai do loop
            }
        });

        if (!optionExist) {
            var option = new Option(novaOpcao, novaOpcao);
            select.append(option);
            $(button).siblings('.nova-opcao').val(''); // Limpa o campo de texto após adicionar a opção
        } else {
            alert('A opção já existe.');
        }
    } else {
        alert('Digite uma opção.');
    }
}

function ExcluirOption(button) {
    var select = $(button).siblings('.html-codigo').find('select'); // Seleciona o elemento select próximo do botão
    var selectedIndex = select.prop('selectedIndex'); // Obtém o índice da opção selecionada
    if (selectedIndex !== -1) {
        select.find('option').eq(selectedIndex).remove(); // Remove a opção selecionada
    } else {
        alert('Nenhuma opção para excluir.');
    }
}



// function GenerateHtmlQuestion(posicao) {
//     let html_select = "";
//     let html_questao = "";
//     let tipo = $(`.posicao-${posicao} input[name="radios-tipo-questao"]:checked`).val();
//     let desc_questao = $(`.posicao-${posicao} .descricao`).val();
//     let sigla_questao = Abreviacao(desc_questao);

//     switch (tipo) {
//         case 'Option':
//             for (let i = 0; i < cardsOpcoes[posicao].length; i++) {
//                 html_select += `<option value="${cardsOpcoes[posicao][i]}">${cardsOpcoes[posicao][i]}</option>`;
//             }
//             break;
//         case 'Checkbox':
//             for (let i = 0; i < cardsOpcoes[posicao].length; i++) {
//                 html_select += `
//                     <input type="checkbox" class="form-check-input" value="${cardsOpcoes[posicao][i]}">
//                     <label class="form-check-label">${cardsOpcoes[posicao][i]}</label>
//                 `;
//             }
//             break;
//     }

//     switch (tipo) {
//         case 'Text':
//             html_questao = `
//                 <div class="col-md-12">
//                     <label for="${sigla_questao}" class="form-label">${desc_questao}</label>
//                     <input type="text" class="form-control" id="${sigla_questao}" name="${sigla_questao}" autocomplete="off">
//                 </div>
//             `;
//             break;
//         case 'Option':
//             html_questao = `
//                 <div class="col-md-12">
//                     <label for="${sigla_questao}" class="form-label">${desc_questao}</label>
//                     <select class="form-select" id="${sigla_questao}" name="${sigla_questao}">${html_select}</select>
//                 </div>
//             `;
//             break;
//         case 'Checkbox':
//             html_questao = `
//                 <div class="col-md-12" id="${sigla_questao}">
//                     <label for="${sigla_questao}" class="form-check-label">${desc_questao}</label><br>
//                     ${html_select}
//                 </div>
//             `;
//             break;
//         case 'Textarea':
//             html_questao = `
//                 <div class="col-md-12" id="${sigla_questao}">
//                     <label for="${sigla_questao}" class="form-check-label">${desc_questao}</label>
//                     <textarea class="form-select" id="${sigla_questao}" name="${sigla_questao}" rows="5"></textarea>
//                 </div>
//             `;
//             break;
//     }

//     // Atualiza o valor do textarea específico para a questão
//     $(`#html_questao_${posicao}`).val(html_questao);

//     return html_questao;
// }







</script>