@extends('layouts.app_new')
@section('content')
      <div class="app-main__inner">
          <div class="app-page-title">
              <div class="page-title-wrapper">
                  <div class="page-title-heading">
                      <div class="page-title-icon">
                          <i class="pe-7s-graph text-success">
                          </i>
                      </div>
                      <div>Pacientes
                          <div class="page-title-subheading">Todas os conteúdos são somente teste.
                          </div>
                      </div>
                  </div>
                  <div class="page-title-actions">
                      <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                          <i class="fa fa-star"></i>
                      </button>
                      <div class="d-inline-block dropdown">
                          <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                              <span class="btn-icon-wrapper pr-2 opacity-7">
                                  <i class="fa fa-business-time fa-w-20"></i>
                              </span>
                              Buttons
                          </button>
                          <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                              <ul class="nav flex-column">
                                  <li class="nav-item">
                                      <a href="javascript:void(0);" class="nav-link">
                                          <i class="nav-link-icon lnr-inbox"></i>
                                          <span>
                                              Inbox
                                          </span>
                                          <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:void(0);" class="nav-link">
                                          <i class="nav-link-icon lnr-book"></i>
                                          <span>
                                              Book
                                          </span>
                                          <div class="ml-auto badge badge-pill badge-danger">5</div>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="javascript:void(0);" class="nav-link">
                                          <i class="nav-link-icon lnr-picture"></i>
                                          <span>
                                              Picture
                                          </span>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a disabled href="javascript:void(0);" class="nav-link disabled">
                                          <i class="nav-link-icon lnr-file-empty"></i>
                                          <span>
                                              File Disabled
                                          </span>
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
                </div>
          </div>
          <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
              <li class="nav-item">
                  <a class="nav-link active" id="tab0" data-toggle="tab" href="#tab-content-0">
                      <span>Geral</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="tab2" data-toggle="tab" href="#">
                      <span>Quadro Atual</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="tab3" data-toggle="tab" href="#">
                      <span>Monitoramento</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="tab4" data-toggle="tab" href="#">
                      <span>Saúde mental</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="tab5" data-toggle="tab" href="#">
                      <span>Serviços de Referência e Internação</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="tab6" data-toggle="tab" href="#t">
                      <span>Insumos Oferecidos pelo Projeto</span>
                  </a>
              </li>

          </ul>
          <div class="tab-content">
              <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <form id="createPacienteForm" method="POST" action="{{ route('paciente') }}">
                    @csrf
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">SITUAÇÃO DO CASO</h5>
                            {{-- <form class=""> --}}
                                <div class="form-row">
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="name">Data início sintomas *</label>
                                            <input name="data_inicio_sintoma" type="text" class="date  form-control" id="data_inicio_sintoma" aria-describedby="data_nascimentoHelp">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="name">Data início monitoramento *</label>
                                            <input name="data_inicio_monitoramento" type="text" class=" form-control date" id="data_inicio_monitoramento" aria-describedby="data_nascimentoHelp">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="name">Data finalização do caso (alta) *</label>
                                            <input name="data_finalizacao_caso" type="text" class=" form-control date" id="data_finalizacao_caso" aria-describedby="data_nascimentoHelp">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="exampleCustomSelect" class="">
                                                SITUAÇÃO
                                            </label>
                                            <select type="select" id="situacao" aria-describedby="situacaoHelp" name="situacao" class="custom-select">
                                                <option value="">Selecione</option>
                                                <option value="Caso ativo GRAVE">Caso ativo GRAVE</option>
                                                <option value="Caso ativo LEVE">Caso ativo LEVE</option>
                                                <option value="Contato com caso confirmado - ativo">Contato com caso confirmado - ativo</option>
                                                <option value="Outras situações (sem relação com COVID-19) - ativos">Outras situações (sem relação com COVID-19) - ativos</option>
                                                <option value="Caso finalizado GRAVE">Caso finalizado GRAVE</option>
                                                <option value="Caso finalizado LEVE">Caso finalizado LEVE</option>
                                                <option value="Contato com caso confirmado - finalizado">Contato com caso confirmado - finalizado</option>
                                                <option value="Outras situações (sem relação com COVID-19) - finalizado">Outras situações (sem relação com COVID-19) - finalizado</option>
                                                <option value="Monitoramento encerrado - segue apenas com psicólogos">Monitoramento encerrado - segue apenas com psicólogos</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="exampleCustomSelect" class="">
                                                Agente Responsável
                                            </label>
                                            <select type="select" name="agente" class="custom-select">
                                                <option value="">Selecione</option>
                                                @foreach($agentes as $agente)
                                                <option value="{{ $agente->id }}" <?php if (\Auth::user()->role === 'agente' && \Auth::user()->agente->id === $agente->id) {
    echo 'selected=selected';
} ?> >{{ $agente->user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="exampleCustomSelect" class="">
                                                Médica Responsável
                                            </label>
                                            <select type="select" name="medico" class="custom-select">
                                                <option value="">Selecione</option>
                                                @foreach($medicos as $medico)
                                                <option value="{{ $medico->id }}" <?php if (\Auth::user()->role === 'medico' && \Auth::user()->medico->id === $medico->id) {
    echo 'selected=selected';
} ?> >{{ $medico->user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="exampleCustomSelect" class="">
                                                Psicóloga Responsável
                                            </label>
                                            <select type="select" name="psicologo_id" class="custom-select">
                                                <option value="">Selecione</option>
                                                @foreach($psicologos as $psicologo)
                                                <option value="{{ $psicologo->id }}" <?php if (\Auth::user()->role === 'psicologo' && \Auth::user()->psicologo->id === $psicologo->id) {
    echo 'selected=selected';
} ?> >{{ $psicologo->user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="exampleCustomSelect" class="">
                                                Articuladora Responsável
                                            </label>
                                            <select type="select" name="articuladora_responsavel" class="custom-select">
                                                <option value="">Selecione</option>
                                                @foreach($articuladoras as $articuladora)
                                                <option value="{{ $articuladora->id }}">{{ $articuladora->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            {{-- </form> --}}
                        </div>
                    </div>

                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">DADOS DE IDENTIFICAÇÃO</h5>
                            {{-- <form class=""> --}}

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">
                                            Nome Completo (obrigatório)
                                            </label>
                                            <input name="name" iid="name" aria-describedby="nameHelp" placeholder="Nome Completo" type="text" class="required form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">
                                            Nome Social
                                            </label>
                                            <input name="name_social" id="name_social" placeholder="Nome Social" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">
                                                Telefone fixo
                                            </label>
                                            <input name="fone_fixo" id="fone_fixo" placeholder="Somente número e com DDDD" type="text" class="form-control phone_with_ddd">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">
                                                Telefone celular
                                            </label>
                                            <input name="fone_celular" id="fone_celular" placeholder="Somente número e com DDDD" type="text" class="form-control mobile_with_ddd">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="examplePassword11" class="">
                                                Data de Nascimento
                                            </label>
                                            <input name="data_nascimento" type="text" placeholder="Data de Nascimento" class=" form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Responsável</label>
                                            <input name="responsavel_residencia" type="text" class=" form-control ddate" id="responsavel_residencia" aria-describedby="responsavel_residenciaHelp">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Email</label>
                                            <input name="email" type="email" class=" form-control ddate" id="email" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">CEP</label>
                                            <input name="endereco_cep" placeholder="Somente números" type="text" class=" form-control cep" id="endereco_cep" aria-describedby="endereco_cepHelp">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Logradouro</label>
                                            <input name="endereco_rua" type="text" class=" form-control ddate" id="endereco_rua" aria-describedby="endereco_ruaHelp">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="name">Número</label>
                                            <input name="endereco_numero" type="text" class=" form-control ddate" id="endereco_numero" aria-describedby="endereco_numeroHelp">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Complemento</label>
                                            <input name="endereco_complemento" type="text" class=" form-control ddate" id="endereco_complemento" aria-describedby="endereco_complementoHelp">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="name">Bairro</label>
                                            <input name="endereco_bairro" type="text" class=" form-control ddate" id="endereco_bairro" aria-describedby="endereco_bairroHelp">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="name">Cidade</label>
                                            <input name="endereco_cidade" type="text" class=" form-control ddate" id="endereco_cidade" aria-describedby="endereco_cidadeHelp">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="name">UF</label>
                                            <input name="endereco_uf" type="text" class=" form-control ddate" id="endereco_uf" aria-describedby="endereco_ufHelp">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Ponto de referência</label>
                                            <input name="ponto_referencia" type="text" class=" form-control ddate" id="ponto_referencia" aria-describedby="ponto_referenciaHelp">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleCustomSelect" class="">
                                                Identidade de genero
                                            </label>
                                            <select type="select" id="identidade_genero" name="identidade_genero" class="custom-select">
                                                <option value="">Selecione</option>
                                                <option>mulher cis</option>
                                                <option>mulher trans</option>
                                                <option>homem cis</option>
                                                <option>homem trans</option>
                                                <option>não-binário</option>
                                                <option>outro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleCustomSelect" class="">
                                                Orientação sexual
                                            </label>
                                            <select type="select" id="orientacao_sexual" name="orientacao_sexual" class="custom-select">
                                                <option value="">Selecione</option>
                                                <option>heterossexual</option>
                                                <option>homossexual</option>
                                                <option>bissexual</option>
                                                <option>outro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleCustomSelect" class="">
                                                Raça / Cor
                                            </label>
                                            <select type="select" id="cor_raca" name="cor_raca" class="custom-select">
                                                <option value="">Selecione</option>
                                                <option>Preta</option>
                                                <option>Parda</option>
                                                <option>Branca</option>
                                                <option>Amarela</option>
                                                <option>Indígena</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Nº Pessoas na Residência</label>
                                                <input name="numero_pessoas_residencia" type="number" class=" form-control date" id="numero_pessoas_residencia" aria-describedby="numero_pessoas_residenciaHelp">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Recebe auxílio emergencial</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="auxilio_emergencial" type="radio" class="form-check-input" value="sim"> Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="auxilio_emergencial" type="radio" class="form-check-input" value="não"> Não</label></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Valor exato da renda familiar</label>
                                                <input name="renda_residencia" type="text" placeholder="0.000,00" class=" form-control money" id="renda_residencia" aria-describedby="data_nascimentoHelp">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- </form> --}}
                        </div>
                    </div>

                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">
                                (Sentinela-Vigilancia) DIAGNÓSTICO DE COVID-19
                            </h5>
                            <div class="form-row">
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="exampleCustomSelect" class="">
                                            DIAGNÓSTICO DE COVID-19
                                        </label>
                                        <select type="select" id="sintomas_iniciais" name="sintomas_iniciais" class="custom-select">
                                            <option value="">Selecione</option>
                                            <option>suspeito</option>
                                            <option>confirmado</option>
                                            <option>descartado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">
                                            Data do teste confirmatório
                                        </label>
                                        <input name="data_teste_confirmatorio" placeholder="Data do teste confirmatório" type="text" class=" form-control date" id="data_teste_confirmatorio" aria-describedby="data_teste_confirmatorioHelp">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <div class="position-relative form-group"><label for="exampleCustomMutlipleSelect" class="">
                                    Testes realizados?

                                </label>
                                <select multiple="" type="select" id="teste_utilizado" name="teste_utilizado[]" class="custom-select">
                                    <option value="">Selecione</option>
                                    <option>PCR</option>
                                    <option>sorologias (IgM/IgG)</option>
                                    <option>teste rápido</option>
                                    <option>não informado</option>
                                </select>
                                <small class="form-text text-muted">Segure o shift para marcar mais de uma opção.</small>
                                </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="exampleCustomSelect" class="">
                                            Resultados encontrados
                                        </label>
                                        <select type="select" id="resultado_teste" name="resultado_teste" class="custom-select">
                                            <option value="">Selecione</option>
                                            <option>PCR positivo</option>
                                            <option>PCR negativo</option>
                                            <option>IgM positivo</option>
                                            <option>IgM negativo</option>
                                            <option>IgG positivo</option>
                                            <option>IgG negativo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Outras informações sobre teste</label>
                                        <textarea name="outras_informacao" placeholder="ex: repetiu teste, novas datas de testes, etc" id="outras_informacao" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">CONDIÇÕES DE SAÚDE</h5>
                            <div class="position-relative form-group">
                                <label for="exampleCustomSelect" class="">
                                    Condições gerais de saúde
                                </label>

                                <div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="hipertensao_arterial_sistemica" class="custom-control-input" value="1">
                                        <label class="custom-control-label" for="hipertensao_arterial_sistemica">
                                            Hipertensão arterial sistêmica (HAS)
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="diabetes_mellitus" class="custom-control-input" value="2">
                                        <label class="custom-control-label" for="diabetes_mellitus">
                                            Diabetes Mellitus (DM)
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="dislipidemia" class="custom-control-input" value="3">
                                        <label class="custom-control-label" for="dislipidemia">
                                            Dislipidemia
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="asma_bronquite" class="custom-control-input" value="4">
                                        <label class="custom-control-label" for="asma_bronquite">
                                            Asma / Bronquite
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="tuberculose_ativa" class="custom-control-input" value="5">
                                        <label class="custom-control-label" for="tuberculose_ativa">
                                            Tuberculose ativa
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="cardiopatias_cardiovasculares" class="custom-control-input" value="6">
                                        <label class="custom-control-label" for="cardiopatias_cardiovasculares">
                                            Cardiopatias e outras doenças cardiovasculares
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="outras_respiratorias" class="custom-control-input" value="7">
                                        <label class="custom-control-label" for="outras_respiratorias">
                                            Outras doenças Respiratórias
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="artrite_artrose_reumatismo" class="custom-control-input" value="8">
                                        <label class="custom-control-label" for="artrite_artrose_reumatismo">
                                            Artrite/Artrose/Reumatismo
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="doenca_autoimune" class="custom-control-input" value="9">
                                        <label class="custom-control-label" for="doenca_autoimune">
                                            Doença autoimune
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="doenca_renal" class="custom-control-input" value="10">
                                        <label class="custom-control-label" for="doenca_renal">
                                            Doença renal
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="doenca_neurologica" class="custom-control-input" value="11">
                                        <label class="custom-control-label" for="doenca_neurologica">
                                            Doença neurológica
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="cancer" class="custom-control-input" value="12">
                                        <label class="custom-control-label" for="cancer">
                                            Câncer
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="ansiedade" class="custom-control-input" value="13">
                                        <label class="custom-control-label" for="ansiedade">
                                            Ansiedade
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="depressao" class="custom-control-input" value="14">
                                        <label class="custom-control-label" for="depressao">
                                            Depressão
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="demencia" class="custom-control-input" value="15">
                                        <label class="custom-control-label" for="demencia">
                                            Demência
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="outras_questoes_mental" class="custom-control-input" value="16">
                                        <label class="custom-control-label" for="outras_questoes_mental">
                                            Outras questões de saúde mental
                                        </label>
                                    </div>
                                </div>
                            </div>

                                <div class="position-relative form-group">
                                    <label for="exampleCustomSelect" class="">
                                        Descreva as doenças assinaladas
                                    </label>

                                <div class="position-relative row form-group">
                                    <div class="col-sm-10">
                                        <textarea name="descreve_doencas" placeholder="(ex: qual doença neurológica) e outras condições de saúde:" id="descreve_doencas" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Já teve tuberculose?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="tuberculose" type="radio" class="form-check-input" value="sim"> Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="tuberculose" type="radio" class="form-check-input" value="não"> Não</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">É tabagista?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="tabagista" type="radio" class="form-check-input" value="sim"> Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="tabagista" type="radio" class="form-check-input" value="não"> Não</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Faz uso crônico de alcool?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="cronico_alcool" type="radio" class="form-check-input" value="sim"> Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="cronico_alcool" type="radio" class="form-check-input" value="não"> Não</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Faz uso crônico de outras drogas?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="outras_drogas" type="radio" class="form-check-input" value="sim"> Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="outras_drogas" type="radio" class="form-check-input" value="não"> Não</label></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">
                                                Toma remédio(s) de uso contínuo? Qual(is)?
                                            </label>
                                            <input name="remedios_consumidos" id="remedios_consumidos" placeholder="Qual(is)?" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Está gestante?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="gestante" type="radio" class="form-check-input" value="sim"> Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="gestante" type="radio" class="form-check-input" value="não"> Não</label></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Amamenta?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="amamenta" type="radio" class="form-check-input" value="sim"> Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="amamenta" type="radio" class="form-check-input" value="não"> Não</label></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Gestação é ou foi de alto risco?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="gestacao_alto_risco" type="radio" class="form-check-input" value="sim"> Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="gestacao_alto_risco" type="radio" class="form-check-input" value="não"> Não</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Está no pós-parto (40 dias após o parto)?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="pos_parto" type="radio" class="form-check-input" value="sim"> Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="pos_parto" type="radio" class="form-check-input" value="não"> Não</label></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">
                                                Data do parto
                                            </label>
                                            <input name="data_parto" id="data_parto" placeholder="00/00/0000" type="text" class="form-control date">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">
                                                Data da última menstruação (DUM)
                                            </label>
                                            <input name="data_ultima_mestrucao" id="data_ultima_mestrucao" placeholder="00/00/0000" type="text" class="form-control date">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleCustomSelect" class="">
                                                Trimestre da gestação no início do monitoramento
                                            </label>
                                            <select type="select" id="trimestre_gestacao" name="trimestre_gestacao" class="custom-select">
                                                <option value="">Selecione</option>
                                                <option>1o trimestre</option>
                                                <option>2o trimestre</option>
                                                <option>3o trimestre</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">
                                                Motivo do risco elevado na gravidez
                                            </label>
                                            <input name="motivo_risco_gravidez" id="motivo_risco_gravidez" placeholder="Qual(is)?" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Tem algum acompanhamento médico contínuo?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="acompanhamento_medico" type="radio" class="form-check-input" value="sim"> Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="acompanhamento_medico" type="radio" class="form-check-input" value="não"> Não</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">
                                                Qual a data da última consulta médica?
                                            </label>
                                            <input name="data_ultima_consulta" placeholder="00/00/0000" type="text" class="form-control date">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="exampleCustomSelect" class="">
                                                Onde/como acessa o sistema de saúde?
                                            </label>
                                            <select multiple="" type="select" id="sistema_saude" name="sistema_saude[]" class="custom-select">
                                                <option value="">Selecione</option>
                                                <option>É usuária/o do SUS (público)</option>
                                                <option>Tem convênio/plano de saúde</option>
                                                <option>Usuária/o de serviços pagos "populares" (Ex: Dr Consulta)</option>
                                                <option>Usuária/o de serviços particulares não cobertos por convênios</option>
                                            </select>
                                            <small class="form-text text-muted">Segure o shift para marcar mais de uma opção.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Tem acompanhamento médico na Unidade Básica de Saúde (UBS - posto) de referência?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="acompanhamento_ubs" type="radio" class="form-check-input" value="sim"> Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="acompanhamento_ubs" type="radio" class="form-check-input" value="não"> Não</label></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="position-relatives row fdorm-check">
                            <div class="col-sm-12 offset-sm-2s"><br />
                                <button type="submit" name="createPaciente" id="createPaciente" class="btn btn-secondary">Enviar</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </form>
                </div>

                <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                    <form id="createPacienteQAForm" method="POST" action="{{ route('paciente') }}">
                        @csrf
                        <div class="main-card mb-3 card">
                            <div class="card-body"><h5 class="card-title">Quadro atual</h5>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Primeiros sintomas</label>
                                            <textarea name="text" placeholder="descreva a evolução dos sintomas do início do quadro até o primeiro registro" id="examplsgwrweText" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Sintomas manifestados</label><br />
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="tosse" type="checkbox" value="tosse">
                                                <label class="form-check-label" for="tosse">Tosse</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="falta_de_ar" type="checkbox" value="falta de ar">
                                                <label class="form-check-label" for="febre">Falta de ar</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="febre" type="checkbox" value="febre">
                                                <label class="form-check-label" for="febre">Febre</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" type="checkbox" value="dor de cabeça">
                                                <label class="form-check-label" for="inlineCheckbox3">Dor de Cabeça</label>
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
                                                <label class="form-check-label" for="inlineCheckbox3">Enjoo ou vômitos</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="diarreia" type="checkbox" value="diarreia">
                                                <label class="form-check-label" for="diarreia">Diarréia</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="aumento_da_pressao" type="checkbox" value="aumento da pressão">
                                                <label class="form-check-label" for="aumento_da_pressao">Aumento da pressão</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="queda_brusca_de_pressao" type="checkbox" value="queda brusca de Pressão">
                                                <label class="form-check-label" for="sonolencia">Queda brusca de Pressão</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="pressao_baixa" type="checkbox" value="pressão baixa">
                                                <label class="form-check-label" for="pressao_baixa">Dor torácica (dor no peito) </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="sonolência_cansaco_importantes" type="checkbox" value="sonolência ou cansaço importantes">
                                                <label class="form-check-label" for="sonolência_cansaco_importantes">Sonolência ou cansaço importantes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="confusao_mental" type="checkbox" value="confusão mental">
                                                <label class="form-check-label" for="confusao_mental">Confusão mental</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="desmaio" type="checkbox" value="desmaio">
                                                <label class="form-check-label" for="desmaio">Desmaio</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="convulsao" type="checkbox" value="convulsao">
                                                <label class="form-check-label" for="convulsao">Convulsão</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="outros" type="checkbox" value="outros">
                                                <label class="form-check-label" for="outros">Outros</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Temperatura máxima (em graus)</label>
                                                <input name="data_nascimentod" type="text" placeholder="00,0" class=" form-control date" id="sfsfsfs" aria-describedby="data_nascimentoHelp">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Data temperatura máxima</label>
                                                <input name="data_nascimentoddd" type="text" class=" form-control date" id="data_nascisfsfsfsmento" aria-describedby="data_nascimentoHelp">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Saturação mais baixa registrada (%)</label>
                                                <input name="data_nascimsentosfsfsfs" type="text" placeholder="00 %" class=" form-control date" id="data_nasfsfsfcimento" aria-describedby="data_nascimentoHelp">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Data da saturação mais baixa</label>
                                                <input name="data_nascimentosffsf" type="text" class=" form-control date" id="data_nasfsfssssfcimento" aria-describedby="data_nascimentoHelp">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Frequência respiratória máxima</label>
                                                <input name="data_nascimentossfsf" type="text" placeholder="respirações por minuto - rpm" class=" form-control date" id="data_nasfsfscimento" aria-describedby="data_nascimentoHelp">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Data da Frequência respiratória máxima</label>
                                                <input name="data_nascimentosfsfsfs" type="text" class=" form-control date" id="data_nascimsfsfsfento" aria-describedby="data_nascimentoHelp">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pos2ition-relative row form-chec2k">
                                        <div class="col-sm-12 2offset-sm-2">
                                            <button type="submit" name="createPacienteQA" id="createPacienteQA" class="btn btn-secondary">Salvar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Monitoramento</h5>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Horário do monitoramento</label>
                                        <input name="data_nascimentosssf" type="text" class=" form-control date" id="data_nsfsfascimento" aria-describedby="data_nascimentoHelp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Sintomas atuais</label><br />
                                        <div class="form-check form-check-inline">
                                            <input name="sintomas[]" class="form-check-input" id="tosse2" type="checkbox" value="tosse">
                                            <label class="form-check-label" for="tosse">Tosse</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="sintomas[]" class="form-check-input" id="falta_de_ar" type="checkbox" value="falta de ar">
                                            <label class="form-check-label" for="falta_de_ar">Falta de ar</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="sintomas[]" class="form-check-input" id="febre2" type="checkbox" value="febre">
                                            <label class="form-check-label" for="febre">Febre</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="sintomas[]" class="form-check-input" type="checkbox" value="dor de cabeça">
                                            <label class="form-check-label" for="inlineCheckbox3">Dor de Cabeça</label>
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
                                            <input name="sintomas[]" class="form-check-input" id="outros_monit" type="checkbox" value="outros">
                                            <label class="form-check-label" for="outros_monit">Outros</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input name="doenca_cronica[]" class="form-control" type="text" placeholder="Outra (digite)">
                                            </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Temperatura atual (em graus)</label>
                                        <input name="data_nascimensfsfsfto" type="text" placeholder="00,0" class=" form-control date" id="data_nascsfsfsfimento" aria-describedby="data_nascimentoHelp">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Frequência cardíaca atual</label>
                                        <input name="data_nascimenssfsfto" type="text" placeholder="-- bpm" class=" form-control date" id="data_nsfsfsfascimento" aria-describedby="data_nascimentoHelp">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Algum sinal de gravidade nesse monitoramento?</label>
                                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="sim"> Sim</label></div>
                                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="não"> Não</label></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Saturação atual (%)</label>
                                        <input name="data_nascifsfsfmento" type="text" placeholder="00 %" class=" form-control date" id="data_nsfsfsascimento" aria-describedby="data_nascimentoHelp">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Pressão Arterial Atual</label>
                                        <input name="data_nascisffsfmento" type="text" placeholder="Ex: 12x8" class=" form-control date" id="data_nfsfsfascimento" aria-describedby="data_nascimentoHelp">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Equipe médica do projeto prescreveu algum medicamento?</label>
                                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="sim"> Sim</label></div>
                                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="não"> Não</label></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Frequência respiratória atual</label>
                                        <input name="data_nascisfsfsfmento" type="text" placeholder="-- rpm" class=" form-control date" id="data_nascsfsfsssfimento" aria-describedby="data_nascimentoHelp">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Medicamento prescrito pela equipe médica do projeto</label>
                                        <textarea name="text" id="ffsfswwwf" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            {{-- <form class=""> --}}
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Fazendo uso de alguma PIC (prática integrativa complementar - ex: medicina chinesa)?</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="sim"> Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="não"> Não</label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Fez escaldapés (atenção para restrições - ex: gestantes e diabeticos)</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="sim"> Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="não"> Não</label></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Sentiu melhora dos sintomas com escaldapés (atenção para restrições - ex: gestantes e diabeticos)</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> grande alívio</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> pouca melhora</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Fez inalação ou vaporização? </label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Inalação</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Vaporização</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Sentiu melhora dos sintomas com inalação ou vaporização: </label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> grande alívio</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> pouca melhora</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        *Consideramos um caso grave quando a pessoa reportar DESCONFORTO RESPIRATÓRIO IMPORTANTE, DOR TORÁCICA (DOR NO PEITO), CANSAÇO OU SONOLÊNCIA IMPORTANTES, QUEDA BRUSCA DE PRESSÃO, QUEDA DA SATURAÇÃO ABAIXO DE 93%, FREQUÊNCIA RESPIRATÓRIA ACIMA DE 24rpm (respirações por minuto), CONFUSÃO MENTAL, DESMAIO, CONVULSÕES. No caso de novo sinal de gravidade: assinalar no início do prontuário "Caso Ativo Grave".
                                    </div>
                                </div>

                                <div class="position-relatives row fdorm-check">
                                    <div class="col-sm-12 offset-sm-2s"><br />
                                        <button class="btn btn-secondary">Enviar</button>
                                    </div>
                                </div>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>

                <div class="tab-pane tabs-animation fade" id="tab-content-3" role="tabpanel">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Saúde mental</h5>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Quadro atual intensifica medos, angústias, ansiedade, tristezas ou preocupação?</label>
                                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Escreva sobre o estado emocional e detalhe os medos</label>
                                        <textarea name="text" id="exampleTsffsext" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relatives row fdorm-check">
                                <div class="col-sm-12 offset-sm-2s"><br />
                                    <button class="btn btn-secondary">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane tabs-animation fade" id="tab-content-4" role="tabpanel">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Serviços de Referência e Internação</h5>
                            {{-- <form class=""> --}}
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">A pessoa precisou ir a algum serviço de saúde?</label><br />
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="ubs" type="checkbox" value="UBS (Unidade Básica de Saúde - posto de saúde)">
                                                <label class="form-check-label" for="tosse">UBS (Unidade Básica de Saúde - posto de saúde)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="upa" type="checkbox" value="UPA (Unidade de Pronto Atendimento)">
                                                <label class="form-check-label" for="upa">UPA (Unidade de Pronto Atendimento)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="ama" type="checkbox" value="ama">
                                                <label class="form-check-label" for="ama">AMA</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="hospital_publico" type="checkbox" value="Hospital público">
                                                <label class="form-check-label" for="inlineCheckbox3">Hospital público</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="hospital_privado" type="checkbox" value="hospital privado">
                                                <label class="form-check-label" for="inlineCheckbox3">Hospital privado</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="doenca_cronica[]" class="form-control" type="text" placeholder="outro (qual?)">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Quantas idas a serviços de saúde?</label>
                                            <input name="data_nascimensfsfsto" type="text" placeholder="somente números" class=" form-control date" id="data_nascsffsfimento" aria-describedby="data_nascimentoHelp">
                                        </div>
                                    </div>
                                </div>

                                <div class="divider">
                                </div>


                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"><strong>Recebeu medicações para tratar COVID-19?</strong></label><br />
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="azitromicina" type="checkbox" value="Azitromicina">
                                                <label class="form-check-label" for="azitromicina">Azitromicina</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="outro_antibiotico" type="checkbox" value="outro antibiótico">
                                                <label class="form-check-label" for="outro_antibiotico">Outro antibiótico</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="ivermectina" type="checkbox" value="ivermectina">
                                                <label class="form-check-label" for="ivermectina">Ivermectina</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" type="checkbox" value="cloroquina/hidroxicloroquina">
                                                <label class="form-check-label" for="inlineCheckbox3">Cloroquina/Hidroxicloroquina</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" type="checkbox" value="oseltamivir (tamiflu)">
                                                <label class="form-check-label" for="inlineCheckbox3">Oseltamivir (Tamiflu)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" type="checkbox" value="algum antialérgico">
                                                <label class="form-check-label" for="inlineCheckbox3">Algum antialérgico</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" type="checkbox" value="algum corticóide">
                                                <label class="form-check-label" for="inlineCheckbox3">Algum corticóide</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" type="checkbox" value="algum antiinflamatório">
                                                <label class="form-check-label" for="inlineCheckbox3">Algum antiinflamatório</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" type="checkbox" value="vitamina D">
                                                <label class="form-check-label" for="inlineCheckbox3">Vitamina D</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" type="checkbox" value="zinco">
                                                <label class="form-check-label" for="inlineCheckbox3">Zinco</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" type="checkbox" value="outro medicamento">
                                                <label class="form-check-label" for="inlineCheckbox3">Outro medicamento</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Escreva o nome do medicamento prescrito</label>
                                            <textarea name="text" id="exampleTesffxt" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="divider">
                                </div>


                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"><strong>A pessoa teve algum problema com serviços de referência?</strong></label><br />
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="ubs2" type="checkbox" value="UBS (Unidade Básica de Saúde - posto de saúde)">
                                                <label class="form-check-label" for="ubs">UBS (Unidade Básica de Saúde - posto de saúde)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="upa2" type="checkbox" value="UPA (Unidade de Pronto Atendimento)">
                                                <label class="form-check-label" for="upa">UPA (Unidade de Pronto Atendimento)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="ama2" type="checkbox" value="ama">
                                                <label class="form-check-label" for="febre">AMA</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" type="checkbox" value="dor de cabeça">
                                                <label class="form-check-label" for="inlineCheckbox3">Hospital público</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" type="checkbox" value="perda de olfato">
                                                <label class="form-check-label" for="inlineCheckbox3">Hospital privado</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" type="checkbox" value="perda do paladar">
                                                <label class="form-check-label" for="inlineCheckbox3">outro (qual?)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Descreva o problema</label>
                                            <textarea name="text" id="exampleText" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="divider">
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Precisou de internação pelo quadro (suspeito ou confirmado)?</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Precisou de ambulância financiada pelo projeto?</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="divider">
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"><strong>Local de internação</strong></label><br />
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="hospital_publico_referencia" type="checkbox" value="Hospital público de referência">
                                                <label class="form-check-label" for="hospital_publico_referencia">Hospital público de referência</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="hospital_campanha" type="checkbox" value="Hospital de campanha">
                                                <label class="form-check-label" for="hospital_campanha">Hospital de campanha</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="hospital_particular_referencia" type="checkbox" value="Hospital particular de referência">
                                                <label class="form-check-label" for="febre">Hospital particular de referência</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" type="checkbox" value="Hospital municipal do Ipiranga (encaminhado pelo projeto)">
                                                <label class="form-check-label" for="inlineCheckbox3">Hospital municipal do Ipiranga (encaminhado pelo projeto)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" type="checkbox" value="Hospital privado financiado pelo projeto">
                                                <label class="form-check-label" for="inlineCheckbox3">Hospital privado financiado pelo projeto</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Nome do Hospital de internação</label>
                                            <input name="nome_hospital" id="exampleEmail1321" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="name">tempo de internação</label>
                                            <input name="tempo_internacao" id="exampleEmail11" placeholder="em dias - número" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="position-relatives row fdorm-check">
                                    <div class="col-sm-12 offset-sm-2s"><br />
                                        <button class="btn btn-secondary">Enviar</button>
                                    </div>
                                </div>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>

                <div class="tab-pane tabs-animation fade" id="tab-content-5" role="tabpanel">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Insumos Oferecidos pelo Projeto</h5>
                            {{-- <form class=""> --}}
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="name">Há condição de ficar isolada, sozinha, em um cômodo da casa?</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="name">Tem comida disponível, sem precisar sair?</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="name">Tem alguém para auxiliá-lo(a)?</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="name">Consegue realizar tarefas de autocuidado? (como tomar banho, cozinhar,  lavar a própria roupa)</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="divider">
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name"><strong>Precisa de algum tipo de ajuda?</strong></label><br />
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="comprar_remedios_continuo" type="checkbox" value="Comprar remédios de uso contínuo">
                                                <label class="form-check-label" for="comprar_remedios_continuo">Comprar remédios de uso contínuo</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="comprar_remedios" type="checkbox" value="Comprar remédios para o tratamento do quadro atual">
                                                <label class="form-check-label" for="comprar_remedios">Comprar remédios para o tratamento do quadro atual</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="comprar_alimento" type="checkbox" value="Comprar alimento ou outro produtos de necessidade básica">
                                                <label class="form-check-label" for="comprar_alimento">Comprar alimento ou outro produtos de necessidade básica</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" type="checkbox" value="Outros">
                                                <label class="form-check-label" for="Outros">Outros</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name"><strong>Tratamento foi prescrito por algum médico do projeto?</strong></label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name"><strong>Tratamento financiado</strong></label><br />
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="alopatico" type="checkbox" value="Alopático (medicamentos convencionais)">
                                                <label class="form-check-label" for="alopatico">Alopático (medicamentos convencionais)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas[]" class="form-check-input" id="pics" type="checkbox" value="PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)">
                                                <label class="form-check-label" for="febre">PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relatives row fdorm-check">
                                    <div class="col-sm-12 offset-sm-2s"><br />
                                        <button class="btn btn-secondary">Enviar</button>
                                    </div>
                                </div>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
          </div>
      </div>
@endsection
