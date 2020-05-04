$(document).ready(function() {
  //ViaCEP
  function limpa_formulário_cep() {
                  // Limpa valores do formulário de cep.
                  $("#endereco_rua").val("");
                  $("#endereco_bairro").val("");
                  $("#endereco_cidade").val("");
                  $("#endereco_uf").val("");
                  //$("#ibge").val("");
              }

              //Quando o campo cep perde o foco.
              $("#endereco_cep").blur(function() {

                  //Nova variável "cep" somente com dígitos.
                  var cep = $(this).val().replace(/\D/g, '');

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

  //JQUERY MASKS
  //$('.date').mask('00/00/0000');
  //$('.time').mask('00:00:00');
  //$('.date_time').mask('00/00/0000 00:00:00');
  $('.cep').mask('00000-000');
  //$('.phone').mask('0000-0000');
  $('.phone_with_ddd').mask('(00) 0000-0000');
  $('.mobile_with_ddd').mask('(00) 0 0000-0000');
  //$('.mixed').mask('AAA 000-S0S');
  //$('.cpf').mask('000.000.000-00', {reverse: true});
  //$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
  //$('.money').mask('000.000.000.000.000,00', {reverse: true});
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

function editForm() {
  $('#btn-save').attr('disabled', false);
  $('.form-control').attr('readonly', false);
  $('.form-check-input').attr('disabled', false);
  $('#btn-edit').removeClass("btn-danger");
  $('#btn-edit').addClass("btn-secondary");
  $('#btn-edit').text('Cancelar');
  $("#btn-edit").attr("onclick","cancelEdit()");
}

function cancelEdit() {
  $('.form-control').attr('readonly', true);
  $('#btn-save').attr('disabled', true);
  $('.form-check-input').attr('disabled', true);
  $('#btn-edit').removeClass("btn-secondary");
  $('#btn-edit').addClass("btn-danger");
  $('#btn-edit').text('Editar');
  $("#btn-edit").attr("onclick","editForm()");
}
