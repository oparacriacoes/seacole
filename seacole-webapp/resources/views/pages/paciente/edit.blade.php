@extends('admin_template')
@section('controlSideBar')
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="row p-3">
    <div class="col-12">
      <h5><i class="fas fa-id-badge nav-icon"></i> {{ $paciente->name }}</h5>
      <p>Cheklist de entrega</p>
    </div>
    @php
    $cartilha = 0;
    $termometro = 0;
    $mascaras = 0;
    $limpeza = 0;
    $dipirona = 0;
    $paracetamol = 0;
    $oximetro = 0;
    @endphp
    @if($items)
    <?php
    if(strpos($items->nome_item, 'cartilha') !== false){
      $cartilha = 1;
    }
    if(strpos($items->nome_item, 'termometro') !== false){
      $termometro = 1;
    }
    if(strpos($items->nome_item, 'mascaras') !== false){
      $mascaras = 1;
    }
    if(strpos($items->nome_item, 'limpeza') !== false){
      $limpeza = 1;
    }
    if(strpos($items->nome_item, 'dipirona') !== false){
      $dipirona = 1;
    }
    if(strpos($items->nome_item, 'paracetamol') !== false){
      $paracetamol = 1;
    }
    if(strpos($items->nome_item, 'oximetro') !== false){
      $oximetro = 1;
    }
    ?>
    @endif
    <div class="col-12">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="cartilha" id="cartilha" <?php if($cartilha === 1){ echo 'checked=checked'; }; ?> >
        <label class="form-check-label" for="cartilha">
          Cartilha de cuidados
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="termometro" id="termometro" <?php if($termometro === 1){ echo 'checked=checked'; }; ?> >
        <label class="form-check-label" for="termometro">
          Termômetro
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="mascaras" id="mascaras" <?php if($mascaras === 1){ echo 'checked=checked'; }; ?> >
        <label class="form-check-label" for="mascaras">
          Máscaras de tecido
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="limpeza" id="limpeza" <?php if($limpeza === 1){ echo 'checked=checked'; }; ?> >
        <label class="form-check-label" for="limpeza">
          Material de limpeza
        </label>
      </div>
      <hr>
      Antitérmico (Qual?)
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="dipirona" id="dipirona" <?php if($dipirona === 1){ echo 'checked=checked'; }; ?> >
        <label class="form-check-label" for="dipirona">
          Dipirona
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="paracetamol" id="paracetamol" <?php if($paracetamol === 1){ echo 'checked=checked'; }; ?> >
        <label class="form-check-label" for="paracetamol">
          Paracetamol
        </label>
      </div>
      <hr>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="oximetro" id="oximetro" <?php if($oximetro === 1){ echo 'checked=checked'; }; ?> >
        <label class="form-check-label" for="oximetro">
          Oxímetro
        </label>
      </div>
      <small>(Apenas para pessoas com mais de 60 anos de idade ou, mais adiante, em caso de recomendação médica ou da enfermagem)</small>
    </div>
    <div class="col-12 mt-2">
      @if($items)
      <button class="btn btn-block btn-danger" type="button" name="button" onclick="updateKitItems(<?php echo $items->id ?>);">Atualizar</button>
      @else
      <button class="btn btn-block btn-primary" type="button" name="button" onclick="kitItems(<?php echo $dados->id; ?>);">Salvar</button>
      @endif
    </div>
  </div>
</aside>
<!-- /.control-sidebar -->
@stop
@section('sample')
<div class="container-fluid">
  <div class="row">
    <div class="col-12 text-center">
      <h1>Dados do Paciente</h1>
    </div>
  </div>

  <hr>

  <div class="row pb-4">
    <div class="col">
      <form id="updatePacienteForm" method="POST" action="{{ route('paciente.update', $paciente->id) }}">
        <input id="id" type="hidden" value="{{ $paciente->id }}">
        @method('PUT')
        @csrf
        <div class="row">
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="name">Nome Completo</label>
              <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" required readonly value="{{ $paciente->name }}">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="email">Email</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <a href="mailto:{{ $paciente->email }}">
                    <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-envelope" style="font-size: 1.5rem; color:#007bff;"></i></div>
                  </a>
                </div>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ $paciente->email }}" readonly>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="name">Data Nascimento</label>
              <input name="data_nascimento" type="date" class="form-control" id="data_nascimento" aria-describedby="data_nascimentoHelp" required readonly value="{{ $dados->data_nascimento }}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6 col-md-4">
            <div class="form-group">
              <label for="name">CEP</label>
              <input name="endereco_cep" type="text" class="form-control cep" id="endereco_cep" aria-describedby="endereco_cepHelp" required readonly value="{{ $dados->endereco_cep }}">
            </div>
          </div>
          <div class="col-6 col-md-4">
            <div class="form-group">
              <label for="endereco_rua">Logradouro</label>
              <input name="endereco_rua" type="text" class="form-control" id="endereco_rua" aria-describedby="endereco_ruaHelp" required readonly value="{{ $dados->endereco_rua }}">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="endereco_numero">Número</label>
              <input name="endereco_numero" type="text" class="form-control" id="endereco_numero" aria-describedby="endereco_numeroHelp" required readonly value="{{ $dados->endereco_numero }}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6 col-md-4">
            <div class="form-group">
              <label for="endereco_bairro">Bairro</label>
              <input name="endereco_bairro" type="text" class="form-control" id="endereco_bairro" aria-describedby="endereco_bairroHelp" required readonly value="{{ $dados->endereco_bairro }}">
            </div>
          </div>
          <div class="col-6 col-md-4">
            <div class="form-group">
              <label for="endereco_cidade">Cidade</label>
              <input name="endereco_cidade" type="text" class="form-control" id="endereco_cidade" aria-describedby="endereco_cidadeHelp" required readonly value="{{ $dados->endereco_cidade }}">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="endereco_uf">UF</label>
              <input name="endereco_uf" type="text" class="form-control" id="endereco_uf" aria-describedby="endereco_ufHelp" required readonly value="{{ $dados->endereco_uf }}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-3">
            <div class="form-group">
              <label for="endereco_complemento">Complemento</label>
              <input name="endereco_complemento" type="text" class="form-control" id="endereco_complemento" aria-describedby="endereco_complementoHelp" readonly value="{{ $dados->endereco_complemento }}">
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="form-group">
              <label for="fone_fixo">Telefone fixo</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <a href="tel:{{ $dados->fone_fixo }}">
                    <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-phone-square-alt" style="font-size: 1.5rem; color:#007bff;"></i></div>
                  </a>
                </div>
                <input name="fone_fixo" type="text" class="form-control phone_with_ddd" id="fone_fixo" aria-describedby="fone_fixoHelp" value="{{ $dados->fone_fixo }}" readonly>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="form-group">
              <label for="fone_celular">Telefone celular</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <a href="tel:{{ $dados->fone_celular }}">
                    <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-mobile-alt" style="font-size: 1.5rem; color:#007bff;"></i></div>
                  </a>
                </div>
                <input name="fone_celular" type="text" class="form-control mobile_with_ddd" id="fone_celular" aria-describedby="fone_celularHelp" value="{{ $dados->fone_celular }}" readonly>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-3">
            <div class="form-group">
              <label for="numero_pessoas_residencia">Nº Pessoas na Residência</label>
              <input name="numero_pessoas_residencia" type="number" class="form-control" id="numero_pessoas_residencia" aria-describedby="numero_pessoas_residenciaHelp" required readonly value="{{ $dados->numero_pessoas_residencia }}">
            </div>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col">
            <label>Doenças crônicas?</label>
            <?php
            $cardiovasculares = 0;
            $respiratorias = 0;
            $hipertensao = 0;
            $cancer = 0;
            $diabetes = 0;
            for($c = 0; $c < count($cronicas); $c++){
              if(strpos($cronicas[$c]->tipo, 'cardiovasculares') !== false){
                $cardiovasculares = 1;
              }
              if(strpos($cronicas[$c]->tipo, 'respiratorias') !== false){
                $respiratorias = 1;
              }
              if(strpos($cronicas[$c]->tipo, 'hipertensao') !== false){
                $hipertensao = 1;
              }
              if(strpos($cronicas[$c]->tipo, 'cancer') !== false){
                $cancer = 1;
              }
              if(strpos($cronicas[$c]->tipo, 'diabetes') !== false){
                $diabetes = 1;
              }
            }
            ?>
            <div class="form-check form-check-inline">
              <input name="doenca_cronica[]" class="form-check-input" type="checkbox" value="cardiovasculares" <?php if($cardiovasculares === 1){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="inlineCheckbox1">Cardiovasculares</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="doenca_cronica[]" class="form-check-input" type="checkbox" value="respiratorias" <?php if($respiratorias === 1){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="inlineCheckbox2">Respiratórias</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="doenca_cronica[]" class="form-check-input" type="checkbox" value="hipertensao" <?php if($hipertensao === 1){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="inlineCheckbox3">Hipertensão</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="doenca_cronica[]" class="form-check-input" type="checkbox" value="cancer" <?php if($cancer === 1){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="inlineCheckbox3">Câncer</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="doenca_cronica[]" class="form-check-input" type="checkbox" value="diabetes" <?php if($diabetes === 1){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="inlineCheckbox3">Diabetes</label>
            </div>
            <div class="form-check form-check-inline">
              <!--<label class="form-check-label" for="inlineCheckbox3">Outras </label>-->
              <input name="doenca_cronica[]" class="form-control" type="text" placeholder="Outra (digite)" readonly>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="outras_doencas">Tem outras doenças?</label>
              <input name="outras_doencas" type="text" class="form-control" id="outras_doencas" aria-describedby="outras_doencasHelp" required readonly value="{{ $dados->outras_doencas }}">
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="remedios_consumidos">Toma outros remédios?</label>
              <input name="remedios_consumidos" type="text" class="form-control" id="remedios_consumidos" aria-describedby="remedios_consumidosHelp" required readonly value="{{ $dados->remedios_consumidos }}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <label>Sintomas manifestados:</label>
            <div class="form-check form-check-inline">
              @foreach($sintomas as $sintoma) @endforeach

              <?php
              $tosse = 0;
              $febre = 0;
              $sonolencia = 0;
              $pressao_baixa = 0;
              $falta_de_ar = 0;
              for($s = 0; $s < count(json_decode($sintoma->sintoma_manifestado)); $s++){
                if(strpos(json_decode($sintoma->sintoma_manifestado)[$s], 'tosse') !== false){
                  $tosse = 1;
                }
                if(strpos(json_decode($sintoma->sintoma_manifestado)[$s], 'febre') !== false){
                  $febre = 1;
                }
                if(strpos(json_decode($sintoma->sintoma_manifestado)[$s], 'sonolência') !== false){
                  $sonolencia = 1;
                }
                if(strpos(json_decode($sintoma->sintoma_manifestado)[$s], 'pressão baixa') !== false){
                  $pressao_baixa = 1;
                }
                if(strpos(json_decode($sintoma->sintoma_manifestado)[$s], 'falta de ar') !== false){
                  $falta_de_ar = 1;
                }
              }
              ?>

              <input name="sintomas[]" class="form-check-input" id="tosse" type="checkbox" value="tosse" <?php if($tosse === 1){ echo 'checked=checked'; } ?> disabled>
              <label class="form-check-label" for="tosse">Tosse</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="sintomas[]" class="form-check-input" id="febre" type="checkbox" value="febre" <?php if($febre === 1){ echo 'checked=checked'; } ?> disabled>
              <label class="form-check-label" for="febre">Febre</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="sintomas[]" class="form-check-input" id="sonolencia" type="checkbox" value="sonolência" <?php if($sonolencia === 1){ echo 'checked=checked'; } ?> disabled>
              <label class="form-check-label" for="sonolencia">Sonolência</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="sintomas[]" class="form-check-input" id="pressao_baixa" type="checkbox" value="pressão baixa" <?php if($pressao_baixa === 1){ echo 'checked=checked'; } ?> disabled>
              <label class="form-check-label" for="pressao_baixa">Pressão baixa</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="sintomas[]" class="form-check-input" id="falta_de_ar" type="checkbox" value="falta de ar" <?php if($falta_de_ar === 1){ echo 'checked=checked'; } ?> disabled>
              <label class="form-check-label" for="falta_de_ar">Falta de ar</label>
            </div>

          </div>
        </div>

        <div class="row">
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="febre_temperatura_maxima">Temperatura máxima (em graus)</label>
              <input name="febre_temperatura_maxima" type="number" class="form-control" id="febre_temperatura_maxima" aria-describedby="febre_temperatura_maximaHelp" readonly value="{{ $sintoma->febre_temperatura_maxima }}">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="data_medicao_temperatura">Data temperatura máxima</label>
              <input name="data_medicao_temperatura" type="date" class="form-control" id="data_medicao_temperatura" aria-describedby="data_medicao_temperaturaHelp" readonly value="{{ $sintoma->data_medicao_temperatura }}">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="temperatura_atual">Temperatura atual (em graus)</label>
              <input name="temperatura_atual" type="number" class="form-control" id="temperatura_atual" aria-describedby="temperatura_atualHelp" readonly value="{{ $sintoma->temperatura_atual }}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="cansaco_saturacao">Saturação</label>
              <input name="cansaco_saturacao" type="number" class="form-control" id="cansaco_saturacao" aria-describedby="cansaco_saturacaoHelp" readonly value="{{ $sintoma->cansaco_saturacao }}">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="cansaco_frequencia_respiratoria">Frequência respiratória</label>
              <input name="cansaco_frequencia_respiratoria" type="number" class="form-control" id="cansaco_frequencia_respiratoria" aria-describedby="cansaco_frequencia_respiratoriaHelp" readonly value="{{ $sintoma->cansaco_frequencia_respiratoria }}">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="data_inicio_sintoma">Data início sintomas</label>
              <input name="data_inicio_sintoma" type="date" class="form-control" id="data_inicio_sintoma" aria-describedby="data_inicio_sintomaHelp" readonly value="{{ $sintoma->data_inicio_sintoma }}">
            </div>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-12">
            <label class="form-check-label">Tem acompanhamento médico?</label>
            <div class="form-check form-check-inline">
              <input name="acompanhamento_medico" class="form-check-input" type="radio" value="sim" <?php if($dados->acompanhamento_medico === 'sim'){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="acompanhamento_medico">Sim</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="acompanhamento_medico" class="form-check-input" type="radio" value="não" <?php if($dados->acompanhamento_medico === 'não'){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="acompanhamento_medico">Não</label>
            </div>
          </div>

          <hr>

          <div class="col-12">
            <label class="form-check-label">Há condição de ficar isolada, sozinha, em um cômodo da casa?</label>
            <div class="form-check form-check-inline">
              <input name="isolamento_residencial" class="form-check-input" type="radio" value="sim" <?php if($dados->isolamento_residencial === 'sim'){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="isolamento_residencial">Sim</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="isolamento_residencial" class="form-check-input" type="radio" value="não" <?php if($dados->isolamento_residencial === 'não'){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="isolamento_residencial">Não</label>
            </div>
          </div>

          <hr>

          <div class="col-12">
            <label class="form-check-label">Tem comida disponível, sem precisar sair?</label>
            <div class="form-check form-check-inline">
              <input name="alimentacao_disponivel" class="form-check-input" type="radio" value="sim" <?php if($dados->alimentacao_disponivel === 'sim'){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="alimentacao_disponivel">Sim</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="alimentacao_disponivel" class="form-check-input" type="radio" value="não" <?php if($dados->alimentacao_disponivel === 'não'){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="alimentacao_disponivel">Não</label>
            </div>
          </div>

          <hr>

          <div class="col-12">
            <label class="form-check-label">Tem alguém para auxiliá-lo(a)?</label>
            <div class="form-check form-check-inline">
              <input name="auxilio_terceiros" class="form-check-input" type="radio" value="sim" <?php if($dados->auxilio_terceiros === 'sim'){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="auxilio_terceiros">Sim</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="auxilio_terceiros" class="form-check-input" type="radio" value="não" <?php if($dados->auxilio_terceiros === 'não'){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="auxilio_terceiros">Não</label>
            </div>
          </div>

          <hr>

          <div class="col-12">
            <label class="form-check-label">Consegue realizar tarefas de autocuidado? (como tomar banho, cozinhar,  lavar a própria roupa)</label>
            <div class="form-check form-check-inline">
              <input name="tarefas_autocuidado" class="form-check-input" type="radio" value="sim" <?php if($dados->tarefas_autocuidado === 'sim'){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="tarefas_autocuidado">Sim</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="tarefas_autocuidado" class="form-check-input" type="radio" value="não" <?php if($dados->tarefas_autocuidado === 'não'){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="tarefas_autocuidado">Não</label>
            </div>
          </div>

          <hr>

        </div>

        <div class="row">
          <div class="col-12">
            <label class="form-check-label">Precisa de algum tipo de ajuda?</label>
          </div>
          @foreach($ajudas as $ajuda) @endforeach
          <?php
          //echo $ajuda->tipo;
          $remedios = 0;
          $alimentos = 0;
          if(strpos($ajuda->tipo, 'compra_de_remedios') !== false){
            $remedios = 1;
          }
          if(strpos($ajuda->tipo, 'compra_de_alimentos') !== false){
            $alimentos = 1;
          }
          //echo $remedios;
          //echo $alimentos;
          ?>
          <div class="col">
            <div class="form-check form-check-inline">
              <input name="ajuda_tipo[]" class="form-check-input" type="checkbox" id="remedios" value="compra_de_remedios" <?php if($remedios === 1){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="ajuda_tipo">Comprar remédios de uso contínuo</label>
            </div>
          </div>
          <div class="col-12">
            <div class="form-check form-check-inline">
              <input name="ajuda_tipo[]" class="form-check-input" type="checkbox" id="alimento_ou_necessidade_basica" value="compra_de_alimentos" <?php if($alimentos === 1){ echo 'checked=checked'; }; ?> disabled>
              <label class="form-check-label" for="ajuda_tipo">Comprar alimento ou outro produtos de necessidade básica</label>
            </div>
          </div>
          <div class="col">
            <div class="form-check form-check-inline">
              <input name="ajuda_tipo[]" class="form-control" type="text" id="outros" placeholder="Outro tipo de ajuda (digite)" readonly>
            </div>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-12 col-md-6">
            <label>Qual o estado emocional?</label>
            <div class="form-check form-check-inline">
              <input name="estado_emocional" class="form-check-input" type="checkbox" value="tranquilo" <?php if($emocional->situacao === 'tranquilo'){ echo 'checked=checked'; } ?> disabled>
              <label class="form-check-label" for="estado_emocional">Se sente tranquilo(a)?</label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="medo">Tem medos?</label>
              <input name="medo" type="text" class="form-control" aria-describedby="medoHelp" placeholder="Digite" readonly <?php if($emocional->medo !== null){ echo 'value="'.$emocional->medo.'"'; } ?> >
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="observacoes">Algo mais que queira dizer?</label>
              @if($observacao !== null)
              <input name="observacoes" type="text" class="form-control" aria-describedby="observacoesHelp" placeholder="Digite" readonly value="{{ $observacao->comentarios }}">
              @else
              <input name="observacoes" type="text" class="form-control" aria-describedby="observacoesHelp" placeholder="Digite" readonly >
              @endif
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-danger" name="button" id="btn-edit" onclick="editForm()">Editar</button>
        <button type="submit" class="btn btn-primary btn-save" id="updatePaciente" disabled>Salvar</button>
      </form>
    </div>
  </div>
</div>
@stop
