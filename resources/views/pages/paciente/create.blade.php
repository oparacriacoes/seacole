@extends('admin_template')
@section('sample')
<div class="container-fluid">
  <div class="row">
    <div class="col-12 text-center">
      <h1>Cadastrar Paciente</h1>
    </div>
  </div>

  <hr>

  <div class="row pb-4">
    <div class="col">
      <form id="createPacienteForm" method="POST" action="{{ route('paciente') }}">
        @csrf
        <div class="row">
          <div class="col">
            <label for="agente">Agente Responsável</label>
            <select name="agente" class="form-control">
              <option value="null">Selecione</option>
              @foreach($agentes as $agente)
              <option value="{{ $agente->id }}" <?php if( \Auth::user()->role === 'agente' && \Auth::user()->agente->id === $agente->id ){ echo 'selected=selected'; } ?> >{{ $agente->user->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="medico">Médico Responsável</label>
              <select name="medico" class="form-control">
                <option value="null">Selecione</option>
                @foreach($medicos as $medico)
                <option value="{{ $medico->id }}" <?php if( \Auth::user()->role === 'medico' && \Auth::user()->medico->id === $medico->id ){ echo 'selected=selected'; } ?> >{{ $medico->user->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="medico">Psicólogo Responsável</label>
              <select name="psicologo_id" class="form-control">
                <option value="null">Selecione</option>
                @foreach($psicologos as $psicologo)
                <option value="{{ $psicologo->id }}" <?php if( \Auth::user()->role === 'psicologo' && \Auth::user()->psicologo->id === $psicologo->id ){ echo 'selected=selected'; } ?> >{{ $psicologo->user->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-12 col-md-8">
            <div class="form-group">
              <label for="name">Nome Completo (obrigatório)</label>
              <input name="name" type="text" class="required form-control" id="name" aria-describedby="nameHelp">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="name">Situação</label>
              <select name="situacao" class="required form-control" id="situacao" aria-describedby="situacaoHelp">
                <option value="" selected>Selecione</option>
                <option value="ATIVO - Alto Risco">ATIVO - Alto Risco</option>
                <option value="ATIVO - Baixo Risco">ATIVO - Baixo Risco</option>
                <option value="FINALIZADO">Finalizado</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="email">Email</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <a href="#">
                    <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-envelope" style="font-size: 1.5rem; color:#007bff;"></i></div>
                  </a>
                </div>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="name">Data Nascimento (obrigatório)</label>
              <input name="data_nascimento" type="text" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="cor_raca">Raça / Cor</label>
              <select name="cor_raca" class="form-control">
                <option value="" selected>Selecione</option>
                <option value="negra">Negra</option>
                <option value="branca">Branca</option>
                <option value="parda">Parda</option>
                <option value="amarela">Amarela</option>
                <option value="indigena">Indígena</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6 col-md-4">
            <div class="form-group">
              <label for="name">CEP</label>
              <input name="endereco_cep" type="text" class="form-control cep" id="endereco_cep" aria-describedby="endereco_cepHelp">
            </div>
          </div>
          <div class="col-6 col-md-4">
            <div class="form-group">
              <label for="endereco_rua">Logradouro</label>
              <input name="endereco_rua" type="text" class="form-control" id="endereco_rua" aria-describedby="endereco_ruaHelp">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="endereco_numero">Número</label>
              <input name="endereco_numero" type="text" class="form-control" id="endereco_numero" aria-describedby="endereco_numeroHelp">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6 col-md-3">
            <div class="form-group">
              <label for="endereco_bairro">Bairro</label>
              <input name="endereco_bairro" type="text" class="form-control" id="endereco_bairro" aria-describedby="endereco_bairroHelp">
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="form-group">
              <label for="endereco_cidade">Cidade</label>
              <input name="endereco_cidade" type="text" class="form-control" id="endereco_cidade" aria-describedby="endereco_cidadeHelp">
            </div>
          </div>
          <div class="col-12 col-md-3">
            <div class="form-group">
              <label for="endereco_uf">UF</label>
              <input name="endereco_uf" type="text" class="form-control" id="endereco_uf" aria-describedby="endereco_ufHelp">
            </div>
          </div>
          <div class="col-12 col-md-3">
            <div class="form-group">
              <label for="ponto_referencia">Ponto de referência</label>
              <input name="ponto_referencia" type="text" class="form-control" id="ponto_referencia" aria-describedby="ponto_referenciaHelp">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="endereco_complemento">Complemento</label>
              <input name="endereco_complemento" type="text" class="form-control" id="endereco_complemento" aria-describedby="endereco_complementoHelp">
            </div>
          </div>
          <div class="col-6 col-md-4">
            <div class="form-group">
              <label for="fone_fixo">Telefone fixo</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <a href="#">
                    <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-phone-square-alt" style="font-size: 1.5rem; color:#007bff;"></i></div>
                  </a>
                </div>
                <input name="fone_fixo" type="text" class="form-control phone_with_ddd" id="fone_fixo" aria-describedby="fone_fixoHelp">
              </div>
            </div>
          </div>
          <div class="col-6 col-md-4">
            <div class="form-group">
              <label for="fone_celular">Telefone celular</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <a href="#">
                    <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-mobile-alt" style="font-size: 1.5rem; color:#007bff;"></i></div>
                  </a>
                </div>
                <input name="fone_celular" type="text" class="form-control mobile_with_ddd" id="fone_celular" aria-describedby="fone_celularHelp">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="numero_pessoas_residencia">Nº Pessoas na Residência</label>
              <input name="numero_pessoas_residencia" type="number" class="form-control" id="numero_pessoas_residencia" aria-describedby="numero_pessoas_residenciaHelp">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="responsavel_residencia">Responsável</label>
              <input name="responsavel_residencia" type="text" class="form-control" id="responsavel_residencia" aria-describedby="responsavel_residenciaHelp">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="renda_residencia">Renda da casa (somente números)</label>
              <input name="renda_residencia" type="text" class="form-control money" id="renda_residencia" aria-describedby="renda_residenciaHelp">
            </div>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col">
            <label>Doenças crônicas?</label>
            <div class="form-check form-check-inline">
              <input name="doenca_cronica[]" class="form-check-input" type="checkbox" value="cardiovasculares">
              <label class="form-check-label" for="inlineCheckbox1">Cardiovasculares</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="doenca_cronica[]" class="form-check-input" type="checkbox" value="respiratorias">
              <label class="form-check-label" for="inlineCheckbox2">Respiratórias</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="doenca_cronica[]" class="form-check-input" type="checkbox" value="hipertensao">
              <label class="form-check-label" for="inlineCheckbox3">Hipertensão</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="doenca_cronica[]" class="form-check-input" type="checkbox" value="cancer">
              <label class="form-check-label" for="inlineCheckbox3">Câncer</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="doenca_cronica[]" class="form-check-input" type="checkbox" value="diabetes">
              <label class="form-check-label" for="inlineCheckbox3">Diabetes</label>
            </div>
            <div class="form-check form-check-inline">
              <!--<label class="form-check-label" for="inlineCheckbox3">Outras </label>-->
              <input name="doenca_cronica[]" class="form-control" type="text" placeholder="Outra (digite)">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="outras_doencas">Tem outras doenças?</label>
              <input name="outras_doencas" type="text" class="form-control" id="outras_doencas" aria-describedby="outras_doencasHelp">
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="remedios_consumidos">Toma outros remédios?</label>
              <input name="remedios_consumidos" type="text" class="form-control" id="remedios_consumidos" aria-describedby="remedios_consumidosHelp">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <label>Sintomas manifestados:</label>
            <div class="form-check form-check-inline">
              <input name="sintomas[]" class="form-check-input" id="tosse" type="checkbox" value="tosse">
              <label class="form-check-label" for="tosse">Tosse</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="sintomas[]" class="form-check-input" id="febre" type="checkbox" value="febre">
              <label class="form-check-label" for="febre">Febre</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="sintomas[]" class="form-check-input" id="sonolencia" type="checkbox" value="sonolência">
              <label class="form-check-label" for="sonolencia">Sonolência</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="sintomas[]" class="form-check-input" id="pressao_baixa" type="checkbox" value="pressão baixa">
              <label class="form-check-label" for="pressao_baixa">Pressão baixa</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="sintomas[]" class="form-check-input" id="falta_de_ar" type="checkbox" value="falta de ar">
              <label class="form-check-label" for="falta_de_ar">Falta de ar</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="sintomas[]" class="form-check-input" type="checkbox" value="perda de olfato">
              <label class="form-check-label" for="inlineCheckbox3">Perda do olfato</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="sintomas[]" class="form-check-input" type="checkbox" value="perda do paladar">
              <label class="form-check-label" for="inlineCheckbox3">Perda do paladar</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="sintomas[]" class="form-check-input" type="checkbox" value="enjoo">
              <label class="form-check-label" for="inlineCheckbox3">Enjoo</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="sintomas[]" class="form-check-input" type="checkbox" value="dor de cabeça">
              <label class="form-check-label" for="inlineCheckbox3">Dor de Cabeça</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="sintomas[]" class="form-control" type="text" placeholder="Outros (digite)">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="febre_temperatura_maxima">Temperatura máxima (em graus)</label>
              <input name="febre_temperatura_maxima" type="number" class="form-control" id="febre_temperatura_maxima" aria-describedby="febre_temperatura_maximaHelp">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="data_medicao_temperatura">Data temperatura máxima</label>
              <input name="data_medicao_temperatura" type="text" class="form-control date" id="data_medicao_temperatura" aria-describedby="data_medicao_temperaturaHelp">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="temperatura_atual">Temperatura atual (em graus)</label>
              <input name="temperatura_atual" type="number" class="form-control" id="temperatura_atual" aria-describedby="temperatura_atualHelp">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="cansaco_saturacao">Saturação</label>
              <input name="cansaco_saturacao" type="number" class="form-control" id="cansaco_saturacao" aria-describedby="cansaco_saturacaoHelp">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="cansaco_frequencia_respiratoria">Frequência respiratória</label>
              <input name="cansaco_frequencia_respiratoria" type="number" class="form-control" id="cansaco_frequencia_respiratoria" aria-describedby="cansaco_frequencia_respiratoriaHelp">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="cansaco_pressao_arterial">Pressão Arterial Atual (mmHg)</label>
              <input name="cansaco_pressao_arterial" type="number" class="form-control" id="cansaco_pressao_arterial" aria-describedby="cansaco_pressao_arterial">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="data_inicio_sintoma">Data início sintomas</label>
              <input name="data_inicio_sintoma" type="text" class="form-control date" id="data_inicio_sintoma" aria-describedby="data_inicio_sintomaHelp">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              <label for="horario_sintoma">Horário</label>
              <input name="horario_sintoma" type="text" class="form-control time" id="horario_sintoma" aria-describedby="horario_sintomaHelp">
            </div>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-12">
            <label class="form-check-label">Tem acompanhamento médico?</label>
            <div class="form-check form-check-inline">
              <input name="acompanhamento_medico" class="form-check-input" type="radio" value="sim">
              <label class="form-check-label" for="acompanhamento_medico">Sim</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="acompanhamento_medico" class="form-check-input" type="radio" value="não">
              <label class="form-check-label" for="acompanhamento_medico">Não</label>
            </div>
          </div>

          <hr>

          <div class="col-12">
            <label class="form-check-label">Há condição de ficar isolada, sozinha, em um cômodo da casa?</label>
            <div class="form-check form-check-inline">
              <input name="isolamento_residencial" class="form-check-input" type="radio" value="sim">
              <label class="form-check-label" for="isolamento_residencial">Sim</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="isolamento_residencial" class="form-check-input" type="radio" value="não">
              <label class="form-check-label" for="isolamento_residencial">Não</label>
            </div>
          </div>

          <hr>

          <div class="col-12">
            <label class="form-check-label">Tem comida disponível, sem precisar sair?</label>
            <div class="form-check form-check-inline">
              <input name="alimentacao_disponivel" class="form-check-input" type="radio" value="sim">
              <label class="form-check-label" for="alimentacao_disponivel">Sim</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="alimentacao_disponivel" class="form-check-input" type="radio" value="não">
              <label class="form-check-label" for="alimentacao_disponivel">Não</label>
            </div>
          </div>

          <hr>

          <div class="col-12">
            <label class="form-check-label">Tem alguém para auxiliá-lo(a)?</label>
            <div class="form-check form-check-inline">
              <input name="auxilio_terceiros" class="form-check-input" type="radio" value="sim">
              <label class="form-check-label" for="auxilio_terceiros">Sim</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="auxilio_terceiros" class="form-check-input" type="radio" value="não">
              <label class="form-check-label" for="auxilio_terceiros">Não</label>
            </div>
          </div>

          <hr>

          <div class="col-12">
            <label class="form-check-label">Consegue realizar tarefas de autocuidado? (como tomar banho, cozinhar,  lavar a própria roupa)</label>
            <div class="form-check form-check-inline">
              <input name="tarefas_autocuidado" class="form-check-input" type="radio"  value="sim">
              <label class="form-check-label" for="tarefas_autocuidado">Sim</label>
            </div>
            <div class="form-check form-check-inline">
              <input name="tarefas_autocuidado" class="form-check-input" type="radio" value="não">
              <label class="form-check-label" for="tarefas_autocuidado">Não</label>
            </div>
          </div>

          <hr>

        </div>

        <div class="row">
          <div class="col-12">
            <label class="form-check-label">Precisa de algum tipo de ajuda?</label>
          </div>
          <div class="col-12">
            <div class="form-check form-check-inline">
              <input name="ajuda_tipo[]" class="form-check-input" type="checkbox" id="remedios" value="compra de remédios" >
              <label class="form-check-label" for="inlineCheckbox1">Comprar remédios de uso contínuo</label>
            </div>
          </div>
          <div class="col-12">
            <div class="form-check form-check-inline">
              <input name="ajuda_tipo[]" class="form-check-input" type="checkbox" id="alimento_ou_necessidade_basica" value="compra de alimentos" >
              <label class="form-check-label" for="inlineCheckbox2">Comprar alimento ou outro produtos de necessidade básica</label>
            </div>
          </div>
          <div class="col">
            <div class="form-check form-check-inline">
              <input name="ajuda_tipo[]" class="form-control" type="text" id="outros" placeholder="Outro tipo de ajuda (digite)" >
            </div>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-12 col-md-6">
            <!--<label>Qual o estado emocional?</label>
            <div class="form-check form-check-inline">
              <input name="estado_emocional" class="form-check-input" type="checkbox" value="tranquilo">
              <label class="form-check-label" for="estado_emocional">Se sente tranquilo(a)?</label>
            </div>-->
            <div class="form-group">
              <label for="estado_emocional">Qual o estado emocional?</label>
              <input name="estado_emocional" type="text" class="form-control" aria-describedby="estado_emocionalHelp" placeholder="Digite">
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="medo">Tem medos?</label>
              <input name="medo" type="text" class="form-control" aria-describedby="medoHelp" placeholder="Digite">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="cansaco_frequencia_respiratoria">Algo mais que queira dizer?</label>
              <textarea name="observacoes" class="form-control" aria-describedby="observacoesHelp" placeholder="Digite"></textarea>
            </div>
          </div>
        </div>
        <button class="btn btn-primary" name="createPaciente" id="createPaciente">Cadastrar</button>
      </form>
    </div>
  </div>
  <!-- /.row -->
</div><!-- /.container-fluid -->
@stop
