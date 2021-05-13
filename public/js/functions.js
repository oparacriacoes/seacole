$(document).ready(function () {

    $(window).on("resize", function () {
        $(this).width() < 1250 ? $(".app-container").addClass("closed-sidebar-mobile closed-sidebar") : $(".app-container").removeClass("closed-sidebar-mobile closed-sidebar")
    })

    $(".mobile-toggle-header-nav").click(function () { $(this).toggleClass("active"), $(".app-header__content").toggleClass("header-mobile-open") })

    $(".mobile-toggle-nav").click(function () { $(this).toggleClass("is-active"), $(".app-container").toggleClass("sidebar-mobile-open") }),

        $('.hamburger').click(e => {
            e.currentTarget.classList.toggle('is-active')

            $('#app-container').toggleClass('closed-sidebar')
        });

    //ViaCEP
    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#endereco_rua").val("");
        $("#endereco_bairro").val("");
        $("#endereco_bairro").val("");
        $("#endereco_cidade").val("");
        $("#endereco_uf").val("");
        //$("#ibge").val("");
    }

    //Quando o campo cep perde o foco.
    $("#endereco_cep").blur(function () {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        console.log(cep);

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#endereco_rua").val("...");
                $("#endereco_bairro").val("...");
                $("#endereco_cidade").val("...");
                $("#endereco_uf").val("...");
                //$("#ibge").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#endereco_rua").val(dados.logradouro);
                        $("#endereco_bairro").val(dados.bairro);
                        $("#endereco_cidade").val(dados.localidade);
                        $("#endereco_uf").val(dados.uf);
                        //$("#ibge").val(dados.ibge);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });

    //DATATABLES
    const langOptions = {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
        },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        },
        "select": {
            "rows": {
                "_": "Selecionado %d linhas",
                "0": "Nenhuma linha selecionada",
                "1": "Selecionado 1 linha"
            }
        }
    };

    $('#pacientes').DataTable({
        //"pageLength": 25,
        "language": langOptions,
    });

    $('#medicos').DataTable({
        //"pageLength": 25,
        "language": langOptions
    });

    $('#psicologos').DataTable({
        //"pageLength": 25,
        "language": langOptions
    });

    $('#agentes').DataTable({
        //"pageLength": 25,
        "language": langOptions
    });

    $('.time').mask('00:00');
    $('.cep').mask('00000-000');
    $('.phone_with_ddd').mask('(00) 0000-0000');
    $('.mobile_with_ddd').mask('(00) 0 0000-0000');
    $('.money').mask('000.000.000.000.000,00', {
        reverse: true
    });
});


const PEOPLE_COLORS = {
    PRETA: 'rgb(17, 24, 39)',
    PARDA: 'rgb(120, 53, 15)',
    INDIGENA: 'rgb(220, 38, 38)',
    BRANCA: 'rgb(240, 240, 240)',
    AMARELA: 'rgb(251, 191, 36)',
    SEM_INFORMACAO: 'rgb(75, 192, 192)',
}

function peopleColor(color = '') {
    switch (color) {
        case 'Preta':
            return PEOPLE_COLORS.PRETA;
        case 'Parda':
            return PEOPLE_COLORS.PARDA;
        case 'Indígena':
            return PEOPLE_COLORS.info;
        case 'Branca':
            return PEOPLE_COLORS.BRANCA;
        case 'Amarela':
            return PEOPLE_COLORS.AMARELA;
        default:
            return PEOPLE_COLORS.SEM_INFORMACAO;
    }
}

function requiredField() {
    //CAMPOS DE PREENCHIMENTO OBRIGATÓRIO
    el = $('.required');
    for (e = 0; e < el.length; e++) {
        //el[e].value === '' ? [Swal.fire({title:'Atenção!',text:'Informação de preenchimento obrigatório.',icon:'warning'}), el[e].style.border = '2px solid #dc3545', abort()] : '';
        el[e].value === '' ? [el[e].style.border = '2px solid #dc3545', abort('Informação com preenchimento obrigatório')] : '';
    }
}

function abort(info) {
    Swal.fire({
        icon: 'info',
        title: info,
        showConfirmButton: false,
        timer: 1990
    })
    throw new Error('Isto não é um erro. Apenas abortando a execução...');
}

function validaSenha() {
    let senha1 = $('#password_1').val();
    let senha2 = $('#password_2').val();
    senha1 !== senha2 ? abort('Senhas não conferem.') : '';
}

function editForm() {
    $('.btn-save').attr('disabled', false);
    $('.form-control').attr('readonly', false);
    $('textarea[name="sintomas_iniciais"]').attr('readonly', true);
    $('.form-control').attr('disabled', false);
    $('.form-check-input').attr('disabled', false);
    $('#btn-edit').removeClass("btn-danger");
    $('#btn-edit').addClass("btn-secondary");
    $('#btn-edit').text('Cancelar');
    $("#btn-edit").attr("onclick", "cancelEdit()");
}

function cancelEdit() {
    $('.form-control').attr('readonly', true);
    $('.form-control').attr('disabled', true);
    $('.btn-save').attr('disabled', true);
    $('.form-check-input').attr('disabled', true);
    $('#btn-edit').removeClass("btn-secondary");
    $('#btn-edit').addClass("btn-danger");
    $('#btn-edit').text('Editar');
    $("#btn-edit").attr("onclick", "editForm()");
}


function kitItems(id) {
    cartilha = $('#cartilha');
    termometro = $('#termometro');
    mascaras = $('#mascaras');
    limpeza = $('#limpeza');
    cesta = $('#cesta');
    dipirona = $('#dipirona');
    paracetamol = $('#paracetamol');
    oximetro = $('#oximetro');
    data = new Array();

    if (cartilha.prop('checked') === true) {
        data.push(cartilha.val());
    }
    if (termometro.prop('checked') === true) {
        data.push(termometro.val());
    }
    if (mascaras.prop('checked') === true) {
        data.push(mascaras.val());
    }
    if (limpeza.prop('checked') === true) {
        data.push(limpeza.val());
    }
    if (cesta.prop('checked') === true) {
        data.push(cesta.val());
    }
    if (dipirona.prop('checked') === true) {
        data.push(dipirona.val());
    }
    if (paracetamol.prop('checked') === true) {
        data.push(paracetamol.val());
    }
    if (oximetro.prop('checked') === true) {
        data.push(oximetro.val());
    }

    $.ajax({
        method: "POST",
        url: API_URL + "/item",
        data: {
            'paciente_id': id,
            data,
        }
    })
        .done(function (msg) {
            alert(msg.message);
            window.location.reload();
        });
}

function updateKitItems(id) {
    cartilha = $('#cartilha');
    termometro = $('#termometro');
    mascaras = $('#mascaras');
    limpeza = $('#limpeza');
    cesta = $('#cesta');
    dipirona = $('#dipirona');
    paracetamol = $('#paracetamol');
    oximetro = $('#oximetro');
    data = new Array();

    if (cartilha.prop('checked') === true) {
        data.push(cartilha.val());
    }
    if (termometro.prop('checked') === true) {
        data.push(termometro.val());
    }
    if (mascaras.prop('checked') === true) {
        data.push(mascaras.val());
    }
    if (limpeza.prop('checked') === true) {
        data.push(limpeza.val());
    }
    if (cesta.prop('checked') === true) {
        data.push(cesta.val());
    }
    if (dipirona.prop('checked') === true) {
        data.push(dipirona.val());
    }
    if (paracetamol.prop('checked') === true) {
        data.push(paracetamol.val());
    }
    if (oximetro.prop('checked') === true) {
        data.push(oximetro.val());
    }

    $.ajax({
        method: "PUT",
        url: API_URL + "/item/" + id,
        data: {
            'item_id': id,
            data,
        }
    })
        .done(function (msg) {
            //console.log(msg.message);
            alert(msg.message);
            window.location.reload();
        });
}
