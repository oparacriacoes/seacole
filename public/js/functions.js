// Estas const urls foram movidas para a view admin_template_blade.php, carregando dinamicamente a APP_URL da instalação.
// const API_URL = 'http://localhost:8000/api';
// const APP_URL = 'http://localhost:8000';

$(document).ready(function() {
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
              $("#endereco_cep").blur(function() {

                  //Nova variável "cep" somente com dígitos.
                  var cep = $(this).val().replace(/\D/g, '');

                  console.log(cep);

                  //Verifica se campo cep possui valor informado.
                  if (cep != "") {

                      //Expressão regular para validar o CEP.
                      var validacep = /^[0-9]{8}$/;

                      //Valida o formato do CEP.
                      if(validacep.test(cep)) {

                          //Preenche os campos com "..." enquanto consulta webservice.
                          $("#endereco_rua").val("...");
                          $("#endereco_bairro").val("...");
                          $("#endereco_cidade").val("...");
                          $("#endereco_uf").val("...");
                          //$("#ibge").val("...");

                          //Consulta o webservice viacep.com.br/
                          $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

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

  //JQUERY MASKS
  //$('.time').mask('00:00:00');
  $('.time').mask('00:00');
  //$('.date_time').mask('00/00/0000 00:00:00');
  $('.cep').mask('00000-000');
  //$('.phone').mask('0000-0000');
  $('.phone_with_ddd').mask('(00) 0000-0000');
  $('.mobile_with_ddd').mask('(00) 0 0000-0000');
  //$('.mixed').mask('AAA 000-S0S');
  //$('.cpf').mask('000.000.000-00', {reverse: true});
  //$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
  $('.money').mask('000.000.000.000.000,00', {reverse: true});
  //$('.money2').mask("#.##0,00", {reverse: true});
  /*$('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
    translation: {
      'Z': {
        pattern: /[0-9]/, optional: true
      }
    }
  });*/
  //$('.ip_address').mask('099.099.099.099');
  //$('.percent').mask('##0,00%', {reverse: true});
  //$('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
  //$('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
  /*$('.fallback').mask("00r00r0000", {
      translation: {
        'r': {
          pattern: /[\/]/,
          fallback: '/'
        },
        placeholder: "__/__/____"
      }
    });*/
  //$('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});

});

function requiredField() {
  //CAMPOS DE PREENCHIMENTO OBRIGATÓRIO
  el = $('.required');
  for(e = 0; e < el.length; e++){
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

function validaSenha(){
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
  $("#btn-edit").attr("onclick","cancelEdit()");
}

function cancelEdit() {
  $('.form-control').attr('readonly', true);
  $('.form-control').attr('disabled', true);
  $('.btn-save').attr('disabled', true);
  $('.form-check-input').attr('disabled', true);
  $('#btn-edit').removeClass("btn-secondary");
  $('#btn-edit').addClass("btn-danger");
  $('#btn-edit').text('Editar');
  $("#btn-edit").attr("onclick","editForm()");
}

//AJAX
$("#createPaciente").click(function(e) {
  e.preventDefault();
  requiredField();
  let url = API_URL + "/paciente";
  let inputs = $('input');
  let selects = $('select');
  let textareas = $('textarea');
  let datas = '...';
  let datas = {...inputs.serializeJSON(), ...selects.serializeJSON(), ...textareas.serializeJSON()};

  $("#createPaciente").addClass('disabled');

  $.ajax({
    type: "post",
    url: url,
    dataType: "json",
    data: {
      datas,
    },
    success: function(response) {
        console.log('Sucesso');
        console.log(response);

        $("#createPaciente").removeClass('disabled');

        if (response.success === true) {
            Swal.fire({
                icon: 'info',
                title: response.message,
                showConfirmButton: false,
                timer: 1990
            });
            window.setTimeout(function(){
                location.replace(APP_URL + '/admin/paciente');
            } ,2000);
        } else {
            //ERRO!
            Swal.fire({
                icon: 'error',
                title: response.message,
                showConfirmButton: false,
                timer: 5990
            });
            window.setTimeout(function(){
            } ,6000);
        }
    },
    error: function(response) {
        console.log('Erro');
        console.log(response);

        $("#createPaciente").removeClass('disabled');

        //ERRO!
        Swal.fire({
            icon: 'error',
            title: 'Erro não tratado\nVerifique os campos postados.',
            showConfirmButton: false,
            timer: 5990
        });
        window.setTimeout(function(){
        } ,6000);
    }
  })
});
$("#createPacienteQA").click(function(e) {
  e.preventDefault();
  requiredField();
  let url = API_URL + "/paciente";
  let inputs = $('input');
  let selects = $('select');
  let textareas = $('textarea');
  let datas = '...';
  let datas = {...inputs.serializeJSON(), ...selects.serializeJSON(), ...textareas.serializeJSON()};

  $("#createPacienteQA").addClass('disabled');

  $.ajax({
    type: "post",
    url: url,
    dataType: "json",
    data: {
      datas,
    },
    success: function(response) {
        console.log('Sucesso');
        console.log(response);

        $("#createPacienteQA").removeClass('disabled');

        if (response.success === true) {
            Swal.fire({
                icon: 'info',
                title: response.message,
                showConfirmButton: false,
                timer: 1990
            });
            window.setTimeout(function(){
                location.replace(APP_URL + '/admin/paciente');
            } ,2000);
        } else {
            //ERRO!
            Swal.fire({
                icon: 'error',
                title: response.message,
                showConfirmButton: false,
                timer: 5990
            });
            window.setTimeout(function(){
            } ,6000);
        }
    },
    error: function(response) {
        console.log('Erro');
        console.log(response);

        $("#createPacienteQA").removeClass('disabled');

        //ERRO!
        Swal.fire({
            icon: 'error',
            title: 'Erro não tratado\nVerifique os campos postados.',
            showConfirmButton: false,
            timer: 5990
        });
        window.setTimeout(function(){
        } ,6000);
    }
  })
});

$("#updatePaciente").click(function(e) {
    e.preventDefault();
    requiredField();
    let id = $('#id').val();
    let url = API_URL + "/paciente/"+id;
    let inputs = $('input');
    let selects = $('select');
    let textareas = $('textarea');
    let data = {...inputs.serializeJSON(), ...selects.serializeJSON(), ...textareas.serializeJSON()};

    $("#updatePaciente").addClass('disabled');

    $.ajax({
        type: "put",
        url: url,
        dataType: "json",
        data: {
            data,
        },
        success: function(response) {

            $("#updatePaciente").removeClass('disabled');

            if (response.success === true) {
                Swal.fire({
                    icon: 'info',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1990
                });
                window.setTimeout(function(){
                    // location.replace(APP_URL + '/admin/paciente');
                } ,2000);
            } else {
                //ERRO!
                Swal.fire({
                    icon: 'error',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 5990
                });
                window.setTimeout(function(){
                } ,6000);
            }
        },
        error: function(response) {
            console.log('Erro');
            console.log(response);

            $("#updatePaciente").removeClass('disabled');

            //ERRO!
            Swal.fire({
                icon: 'error',
                title: 'Erro não tratado\nVerifique os campos postados.',
                showConfirmButton: false,
                timer: 5990
            });
            window.setTimeout(function(){
            } ,6000);
        }
    });
});

function deletePaciente(id){
  let url = API_URL + "/paciente/"+id;
  console.log(id);
  console.log(url); return false;
  $.ajax({
    type: "DELETE",
    url: url
  })
    .done(function(msg) {
      //console.log(msg.message);
      Swal.fire({
        icon: 'info',
        title: msg.message,
        showConfirmButton: false,
        timer: 1990
      })
      window.setTimeout(function(){
        location.reload();
      } ,2000);
    });
}

$("#createAgente").click(function(e) {
  e.preventDefault();
  let url = API_URL + "/agente";
  let inputs = $('input');
  let data = inputs.serializeJSON();
  $.ajax({
    method: "POST",
    url: url,
    data: {
      data,
    }
  })
    .done(function(msg) {
      //console.log(msg.message);
      Swal.fire({
        icon: 'info',
        title: msg.message,
        showConfirmButton: false,
        timer: 1990
      })
      window.setTimeout(function(){
        location.replace(APP_URL + '/admin/agente');
      } ,2000);
    });
});

$("#updateAgente").click(function(e) {
  e.preventDefault();
  let id = $('#id').val();
  let url = API_URL + "/agente/"+id;
  let inputs = $('input');
  let data = inputs.serializeJSON();
  validaSenha();
  //console.log(data);
  $.ajax({
    method: "PUT",
    url: url,
    data: {
      data,
    }
  })
    .done(function(msg) {
      //console.log(msg.message);
      Swal.fire({
        icon: 'info',
        title: msg.message,
        showConfirmButton: false,
        timer: 1990
      })
      window.setTimeout(function(){
        location.reload();
      } ,2000);
    });
  });

  function deleteAgente(id){
    let url = API_URL + "/agente/"+id;
    console.log(id);
    console.log(url);
    $.ajax({
      type: "DELETE",
      url: url
    })
      .done(function(msg) {
        //console.log(msg.message);
        Swal.fire({
          icon: 'info',
          title: msg.message,
          showConfirmButton: false,
          timer: 1990
        })
        window.setTimeout(function(){
          location.reload();
        } ,2000);
      });
  }

$("#createMedico").click(function(e) {
  e.preventDefault();
  let url = API_URL + "/medico";
  let inputs = $('input');
  let selects = $('select');
  let data = {...inputs.serializeJSON(), ...selects.serializeJSON()};
  //console.log(data);
  $.ajax({
    method: "POST",
    url: url,
    data: {
      data,
    }
  })
    .done(function(msg) {
      //console.log(msg.message);
      Swal.fire({
        icon: 'info',
        title: msg.message,
        showConfirmButton: false,
        timer: 1990
      })
      window.setTimeout(function(){
        location.replace(APP_URL + '/admin/medico');
      } ,2000);
    });
});

$("#updateMedico").click(function(e) {
  e.preventDefault();
  let id = $('#id').val();
  let url = API_URL + "/medico/"+id;
  let inputs = $('input');
  let selects = $('select');
  let data = {...inputs.serializeJSON(), ...selects.serializeJSON()};
  validaSenha();

  $.ajax({
    method: "PUT",
    url: url,
    data: {
      data,
    }
  })
    .done(function(msg) {
      //console.log(msg.message);
      Swal.fire({
        icon: 'info',
        title: msg.message,
        showConfirmButton: false,
        timer: 1990
      })
      window.setTimeout(function(){
        location.reload();
      } ,2000);
    });
});

function deleteMedico(id){
  let url = API_URL + "/medico/"+id;
  console.log(id);
  console.log(url);
  $.ajax({
    type: "DELETE",
    url: url
  })
    .done(function(msg) {
      //console.log(msg.message);
      Swal.fire({
        icon: 'info',
        title: msg.message,
        showConfirmButton: false,
        timer: 1990
      })
      window.setTimeout(function(){
        location.reload();
      } ,2000);
    });
}

$("#createPsicologo").click(function(e) {
  e.preventDefault();
  let url = API_URL + "/psicologo";
  let inputs = $('input');
  let selects = $('select');
  let data = {...inputs.serializeJSON(), ...selects.serializeJSON()};
  //console.log(data);
  $.ajax({
    method: "POST",
    url: url,
    data: {
      data,
    }
  })
    .done(function(msg) {
      //console.log(msg.message);
      Swal.fire({
        icon: 'info',
        title: msg.message,
        showConfirmButton: false,
        timer: 1990
      })
      window.setTimeout(function(){
        location.replace(APP_URL + '/admin/psicologo');
      } ,2000);
    });
});

$("#updatePsicologo").click(function(e) {
  e.preventDefault();
  let id = $('#id').val();
  let url = API_URL + "/psicologo/"+id;
  let inputs = $('input');
  let selects = $('select');
  let data = {...inputs.serializeJSON(), ...selects.serializeJSON()};
  validaSenha();

  $.ajax({
    method: "PUT",
    url: url,
    data: {
      data,
    }
  })
    .done(function(msg) {
      //console.log(msg.message);
      Swal.fire({
        icon: 'info',
        title: msg.message,
        showConfirmButton: false,
        timer: 1990
      })
      window.setTimeout(function(){
        location.reload();
      } ,2000);
    });
});

function deletePsicologo(id){
  let url = API_URL + "/psicologo/"+id;
  console.log(id);
  console.log(url);
  $.ajax({
    type: "DELETE",
    url: url
  })
    .done(function(msg) {
      //console.log(msg.message);
      Swal.fire({
        icon: 'info',
        title: msg.message,
        showConfirmButton: false,
        timer: 1990
      })
      window.setTimeout(function(){
        location.reload();
      } ,2000);
    });
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

  if(cartilha.prop('checked') === true){
    data.push(cartilha.val());
  }
  if(termometro.prop('checked') === true){
    data.push(termometro.val());
  }
  if(mascaras.prop('checked') === true){
    data.push(mascaras.val());
  }
  if(limpeza.prop('checked') === true){
    data.push(limpeza.val());
  }
  if(cesta.prop('checked') === true){
    data.push(cesta.val());
  }
  if(dipirona.prop('checked') === true){
    data.push(dipirona.val());
  }
  if(paracetamol.prop('checked') === true){
    data.push(paracetamol.val());
  }
  if(oximetro.prop('checked') === true){
    data.push(oximetro.val());
  }

  $.ajax({
    method: "POST",
    url: API_URL + "/item",
    data: {
      'paciente_id':id,
      data,
    }
  })
    .done(function(msg) {
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

  if(cartilha.prop('checked') === true){
    data.push(cartilha.val());
  }
  if(termometro.prop('checked') === true){
    data.push(termometro.val());
  }
  if(mascaras.prop('checked') === true){
    data.push(mascaras.val());
  }
  if(limpeza.prop('checked') === true){
    data.push(limpeza.val());
  }
  if(cesta.prop('checked') === true){
    data.push(cesta.val());
  }
  if(dipirona.prop('checked') === true){
    data.push(dipirona.val());
  }
  if(paracetamol.prop('checked') === true){
    data.push(paracetamol.val());
  }
  if(oximetro.prop('checked') === true){
    data.push(oximetro.val());
  }

  $.ajax({
    method: "PUT",
    url: API_URL + "/item/"+id,
    data: {
      'item_id':id,
      data,
    }
  })
    .done(function(msg) {
      //console.log(msg.message);
      alert(msg.message);
      window.location.reload();
    });
}
