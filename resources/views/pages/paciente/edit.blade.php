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
                          <div class="page-title-subheading">Projeto Agentes Populares de Saúde.
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

          <!-- ALERTS DE RETORNO DO BACKEND -->
          @if(session('success'))
          <div class="row">
            <div class="col">
              <div class="alert alert-success info" role="alert">
                {{ session('success') }}
              </div>
            </div>
          </div>
          @endif
          @if(session('error'))
          <div class="row">
            <div class="col">
              <div class="alert alert-danger info" role="alert">
                {{ session('error') }}
              </div>
            </div>
          </div>
          @endif

          <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
              <li class="nav-item">
                  <a class="nav-link active" id="tab0" data-toggle="tab" href="#tab-content-0">
                      <span>Geral</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="tab2" data-toggle="tab" href="#tab-content-1">
                      <span>Quadro Atual</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="tab3" data-toggle="tab" href="#tab-content-2">
                      <span>Monitoramento</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="tab4" data-toggle="tab" href="#tab-content-3">
                      <span>Saúde mental</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="tab5" data-toggle="tab" href="#tab-content-4">
                      <span>Serviços de Referência e Internação</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="tab6" data-toggle="tab" href="#tab-content-5">
                      <span>Insumos Oferecidos pelo Projeto</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="tab6" data-toggle="tab" href="#tab-content-6">
                      <span>Prontuário</span>
                  </a>
              </li>
          </ul>
          <div class="tab-content">
              <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <form id="createPacienteForm" method="POST" action="{{ route('paciente.update', $paciente->id) }}">
                    @csrf
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">SITUAÇÃO DO CASO</h5>
                            {{-- <form class=""> --}}
                                <div class="form-row">
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="name">Data início sintomas de COVID-19</label>
                                            <input name="data_inicio_sintoma" type="text" class="date form-control" id="data_inicio_sintoma" aria-describedby="data_nascimentoHelp" value="{{ $paciente->data_inicio_sintoma }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="name">Data início monitoramento Agentes</label>
                                            <input name="data_inicio_monitoramento" type="text" class="form-control date" id="data_inicio_monitoramento" aria-describedby="data_nascimentoHelp" value="{{ $paciente->data_inicio_monitoramento }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="name">Data finalização do monitoramento Agentes (alta)</label>
                                            <input name="data_finalizacao_caso" type="text" class="form-control date" id="data_finalizacao_caso" aria-describedby="data_nascimentoHelp" value="{{ $paciente->data_finalizacao_caso }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="data_inicio_ac_psicologico">Data início ac Psicológico</label>
                                            <input name="data_inicio_ac_psicologico" type="text" class="form-control date" id="data_inicio_ac_psicologico" value="{{ $paciente->data_inicio_ac_psicologico }}" >
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="data_encerramento_ac_psicologico">Data encerramento ac Psicológico</label>
                                            <input name="data_encerramento_ac_psicologico" type="text" class="form-control date" id="data_encerramento_ac_psicologico" value="{{ $paciente->data_encerramento_ac_psicologico }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="exampleCustomSelect" class="">
                                                SITUAÇÃO
                                            </label>
                                            <select type="select" id="situacao" aria-describedby="situacaoHelp" name="situacao" class="custom-select">
                                                <option value="">Selecione</option>
                                                <option value="1" <?php if( $paciente->situacao === '1' ){ echo 'selected=selected'; } ?> >Caso ativo GRAVE</option>
                                                <option value="2" <?php if( $paciente->situacao === '2' ){ echo 'selected=selected'; } ?> >Caso ativo LEVE</option>
                                                <option value="3" <?php if( $paciente->situacao === '3' ){ echo 'selected=selected'; } ?> >Contato caso confirmado - ativo</option>
                                                <option value="4" <?php if( $paciente->situacao === '4' ){ echo 'selected=selected'; } ?> >Outras situações (sem relação com COVID-19) - ativos</option>
                                                <option value="5" <?php if( $paciente->situacao === '5' ){ echo 'selected=selected'; } ?> >Exclusivo psicologia - ativo</option>
                                                <option value="6" <?php if( $paciente->situacao === '6' ){ echo 'selected=selected'; } ?> >Monitoramento encerrado GRAVE - segue apenas com psicólogos</option>
                                                <option value="7" <?php if( $paciente->situacao === '7' ){ echo 'selected=selected'; } ?> >Monitoramento encerrado LEVE - segue apenas com psicólogos</option>
                                                <option value="8" <?php if( $paciente->situacao === '8' ){ echo 'selected=selected'; } ?> >Monitoramento encerrado contato - segue apenas com psicólogos</option>
                                                <option value="9" <?php if( $paciente->situacao === '9' ){ echo 'selected=selected'; } ?> >Monitoramento encerrado outros - segue apenas com psicólogos</option>
                                                <option value="10" <?php if( $paciente->situacao === '10' ){ echo 'selected=selected'; } ?> >Caso finalizado GRAVE</option>
                                                <option value="11" <?php if( $paciente->situacao === '11' ){ echo 'selected=selected'; } ?> >Caso finalizado LEVE</option>
                                                <option value="12" <?php if( $paciente->situacao === '12' ){ echo 'selected=selected'; } ?> >Contato com caso confirmado - finalizado</option>
                                                <option value="13" <?php if( $paciente->situacao === '13' ){ echo 'selected=selected'; } ?> >Outras situações (sem relação com COVID-19) - finalizado</option>
                                                <option value="14" <?php if( $paciente->situacao === '14' ){ echo 'selected=selected'; } ?> >Exclusivo psicologia - finalizado</option>
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
                                                <!--<option value="{{ $agente->id }}" <?php if( \Auth::user()->role === 'agente' && \Auth::user()->agente->id === $agente->id ){ echo 'selected=selected'; } ?> >{{ $agente->user->name }}</option>-->
                                                <option value="{{ $agente->id }}" <?php if( $paciente->agente_id === $agente->id ){ echo 'selected=selected'; } ?> >{{ $agente->user->name }}</option>
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
                                                <option value="{{ $medico->id }}" <?php if( $paciente->medico_id === $medico->id ){ echo 'selected=selected'; } ?> >{{ $medico->user->name }}</option>
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
                                                <option value="{{ $psicologo->id }}" <?php if( $paciente->psicologo_id === $psicologo->id ){ echo 'selected=selected'; } ?> >{{ $psicologo->user->name }}</option>
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
                                                <option value="{{ $articuladora->id }}" <?php if( $paciente->articuladora_responsavel === $articuladora->id ){ echo 'selected=selected'; } ?> >{{ $articuladora->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--<div class="col-md-3">
                                      <div class="position-relative form-group">
                                        <label for="saude_mental" class="">
                                            Saúde Mental
                                        </label>
                                        <select type="select" name="saude_mental" class="custom-select">
                                            <option value="">Selecione</option>
                                            <option value="ativo" @if($paciente->saude_mental === 'ativo'){{ 'selected' }}@endif >Exclusivo psicologia ativo</option>
                                            <option value="encerrado" @if($paciente->saude_mental === 'encerrado'){{ 'selected' }}@endif >Exclusivo psicologia encerrado</option>
                                        </select>
                                      </div>
                                    </div>-->
                                    <div class="col-md-3">
                                      <div class="position-relative form-group">
                                        <label for="acompanhamento_psicologico" class="">
                                            Acompanhamento psicológico
                                        </label>
                                        <br>
                                        <div class="custom-checkbox custom-control custom-control-inline">
                                          <input type="checkbox" name="acompanhamento_psicologico[]" id="individual" class="custom-control-input" value="individual" <?php if($acompanhamento_psicologico && in_array('individual', $acompanhamento_psicologico)){ echo 'checked=checked'; } ?> >
                                          <label class="custom-control-label" for="individual">
                                              Individual
                                          </label>
                                        </div>
                                      </div>
                                      <div class="position-relative form-group">
                                        <div class="custom-checkbox custom-control custom-control-inline">
                                          <input type="checkbox" name="acompanhamento_psicologico[]" id="em_grupo" class="custom-control-input" value="em grupo" <?php if($acompanhamento_psicologico && in_array('em grupo', $acompanhamento_psicologico)){ echo 'checked=checked'; } ?> >
                                          <label class="custom-control-label" for="em_grupo">
                                              Em grupo
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="form-group">
                                          <label for="atendimento_semanal_psicologia">Atendimento semanal psicologia</label>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="atendimento_semanal_psicologia" type="radio" class="form-check-input" value="seg" @if($paciente->atendimento_semanal_psicologia === 'seg'){{ 'checked' }} @endif > Segunda</label></div>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="atendimento_semanal_psicologia" type="radio" class="form-check-input" value="ter" @if($paciente->atendimento_semanal_psicologia === 'ter'){{ 'checked' }} @endif > Terça</label></div>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="atendimento_semanal_psicologia" type="radio" class="form-check-input" value="qua" @if($paciente->atendimento_semanal_psicologia === 'qua'){{ 'checked' }} @endif > Quarta</label></div>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="atendimento_semanal_psicologia" type="radio" class="form-check-input" value="qui" @if($paciente->atendimento_semanal_psicologia === 'qui'){{ 'checked' }} @endif > Quinta</label></div>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="atendimento_semanal_psicologia" type="radio" class="form-check-input" value="sex" @if($paciente->atendimento_semanal_psicologia === 'sex'){{ 'checked' }} @endif > Sexta</label></div>
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <label for="horario_at_psicologia">Horário at. psicologia</label>
                                      <input name="horario_at_psicologia" id="horario_at_psicologia" placeholder="Horário atendimento" type="text" class="required form-control hour" value="{{ $paciente->horario_at_psicologia }}">
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
                                            <input name="name" id="name" aria-describedby="nameHelp" value="{{ $paciente->user->name }}" placeholder="Nome Completo" type="text" class="required form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">
                                            Nome Social
                                            </label>
                                            <input name="name_social" id="name_social" placeholder="Nome Social" type="text" class="form-control" value="{{ $paciente->name_social }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">
                                                Telefone fixo
                                            </label>
                                            <input name="fone_fixo" id="fone_fixo" placeholder="Somente número e com DDDD" type="text" class="form-control phone_with_ddd" value="{{ $paciente->fone_fixo }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">
                                                Telefone celular
                                            </label>
                                            <input name="fone_celular" id="fone_celular" placeholder="Somente número e com DDDD" type="text" class="form-control mobile_with_ddd" value="{{ $paciente->fone_celular }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="examplePassword11" class="">
                                                Data de Nascimento
                                            </label>
                                            <input name="data_nascimento" type="text" placeholder="Data de Nascimento" class=" form-control date" id="data_nascimento" aria-describeddata_nascimentoby="data_nascimentoHelp" value="{{ $paciente->data_nascimento }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Responsável</label>
                                            <input name="responsavel_residencia" type="text" class=" form-control ddate" id="responsavel_residencia" aria-describedby="responsavel_residenciaHelp" value="{{ $paciente->responsavel_residencia }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Email</label>
                                            <input name="email" type="email" class=" form-control ddate" id="email" aria-describedby="emailHelp" value="{{ $paciente->user->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">CEP</label>
                                            <input name="endereco_cep" placeholder="Somente números" type="text" class=" form-control cep" id="endereco_cep" aria-describedby="endereco_cepHelp" value="{{ $paciente->endereco_cep }}">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Logradouro</label>
                                            <input name="endereco_rua" type="text" class=" form-control ddate" id="endereco_rua" aria-describedby="endereco_ruaHelp" value="{{ $paciente->endereco_rua }}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="name">Número</label>
                                            <input name="endereco_numero" type="text" class=" form-control ddate" id="endereco_numero" aria-describedby="endereco_numeroHelp" value="{{ $paciente->endereco_numero }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Complemento</label>
                                            <input name="endereco_complemento" type="text" class=" form-control ddate" id="endereco_complemento" aria-describedby="endereco_complementoHelp" value="{{ $paciente->endereco_complemento }}">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="name">Bairro</label>
                                            <input name="endereco_bairro" type="text" class=" form-control" id="endereco_bairro" value="{{ $paciente->endereco_bairro }}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="name">Cidade</label>
                                            <input name="endereco_cidade" type="text" class=" form-control" id="endereco_cidade" value="{{ $paciente->endereco_cidade }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="name">UF</label>
                                            <input name="endereco_uf" type="text" class=" form-control" id="endereco_uf" value="{{ $paciente->endereco_uf }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Ponto de referência</label>
                                            <input name="ponto_referencia" type="text" class=" form-control" id="ponto_referencia" value="{{ $paciente->ponto_referencia }}">
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
                                                <option <?php if( $paciente->identidade_genero === 'mulher cis' ){ echo 'selected=selected'; } ?> >mulher cis</option>
                                                <option <?php if( $paciente->identidade_genero === 'mulher trans' ){ echo 'selected=selected'; } ?> >mulher trans</option>
                                                <option <?php if( $paciente->identidade_genero === 'homem cis' ){ echo 'selected=selected'; } ?> >homem cis</option>
                                                <option <?php if( $paciente->identidade_genero === 'homem trans' ){ echo 'selected=selected'; } ?> >homem trans</option>
                                                <option <?php if( $paciente->identidade_genero === 'não-binário' ){ echo 'selected=selected'; } ?> >não-binário</option>
                                                <option <?php if( $paciente->identidade_genero === 'outro' ){ echo 'selected=selected'; } ?> >outro</option>
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
                                                <option <?php if( $paciente->orientacao_sexual === 'heterossexual' ){ echo 'selected=selected'; } ?> >heterossexual</option>
                                                <option <?php if( $paciente->orientacao_sexual === 'homossexual' ){ echo 'selected=selected'; } ?> >homossexual</option>
                                                <option <?php if( $paciente->orientacao_sexual === 'bissexual' ){ echo 'selected=selected'; } ?> >bissexual</option>
                                                <option <?php if( $paciente->orientacao_sexual === 'outro' ){ echo 'selected=selected'; } ?> >outro</option>
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
                                                <option <?php if( $paciente->cor_raca === 'Preta' ){ echo 'selected=selected'; } ?> >Preta</option>
                                                <option <?php if( $paciente->cor_raca === 'Parda' ){ echo 'selected=selected'; } ?> >Parda</option>
                                                <option <?php if( $paciente->cor_raca === 'Branca' ){ echo 'selected=selected'; } ?> >Branca</option>
                                                <option <?php if( $paciente->cor_raca === 'Amarela' ){ echo 'selected=selected'; } ?> >Amarela</option>
                                                <option <?php if( $paciente->cor_raca === 'Indígena' ){ echo 'selected=selected'; } ?> >Indígena</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="name">Nº Pessoas na Residência</label>
                                                <input name="numero_pessoas_residencia" type="number" class=" form-control" id="numero_pessoas_residencia" value="{{ $paciente->numero_pessoas_residencia }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="name">Recebe auxílio emergencial</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="auxilio_emergencial" type="radio" class="form-check-input" value="sim" <?php if( $paciente->auxilio_emergencial === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="auxilio_emergencial" type="radio" class="form-check-input" value="não" <?php if( $paciente->auxilio_emergencial === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="name">Valor exato da renda familiar</label>
                                                <input name="renda_residencia" type="text" placeholder="0.000,00" class=" form-control money" id="renda_residencia" value="{{ $paciente->renda_residencia }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                          <label for="como_chegou_ao_projeto">Como chegou ao projeto?</label>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="núcleo da Uneafro" @if($paciente->como_chegou_ao_projeto === 'núcleo da Uneafro'){{ 'checked' }} @endif > núcleo da Uneafro</label></div>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="faixa ou cartaz na rua" @if($paciente->como_chegou_ao_projeto === 'faixa ou cartaz na rua'){{ 'checked' }} @endif > faixa ou cartaz na rua</label></div>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="carro ou bicicleta de som" @if($paciente->como_chegou_ao_projeto === 'carro ou bicicleta de som'){{ 'checked' }} @endif > carro ou bicicleta de som</label></div>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="whatsapp" @if($paciente->como_chegou_ao_projeto === 'whatsapp'){{ 'checked' }} @endif > whatsapp</label></div>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="instagram" @if($paciente->como_chegou_ao_projeto === 'instagram'){{ 'checked' }} @endif > instagram</label></div>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="facebook" @if($paciente->como_chegou_ao_projeto === 'facebook'){{ 'checked' }} @endif > facebook</label></div>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="twitter" @if($paciente->como_chegou_ao_projeto === 'twitter'){{ 'checked' }} @endif > twitter</label></div>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="e-mail" @if($paciente->como_chegou_ao_projeto === 'e-mail'){{ 'checked' }} @endif > e-mail</label></div>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="indicação de amigo, vizinho ou familiar" @if($paciente->como_chegou_ao_projeto === 'indicação de amigo, vizinho ou familiar'){{ 'checked' }} @endif > indicação de amigo, vizinho ou familiar</label></div>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="como_chegou_ao_projeto" type="radio" class="form-check-input" value="Outro" @if($paciente->como_chegou_ao_projeto === 'Outro'){{ 'checked' }} @endif > Outro</label></div>
                                          <input name="como_chegou_ao_projeto_outro" type="text" placeholder="Outro qual?" class=" form-control" id="como_chegou_ao_projeto_outro" value="{{ $paciente->como_chegou_ao_projeto_outro }}">
                                        </div>
                                        <div class="col">
                                          <label for="nucleo_uneafro_qual">Núcleo da Uneafro: qual?</label>
                                          <select type="select" id="nucleo_uneafro_qual" name="nucleo_uneafro_qual" class="custom-select">
                                              <option value="">Selecione</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'CONCEIÇÃO EVARISTO'){{ 'selected' }} @endif >CONCEIÇÃO EVARISTO</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'UNEAFRO YABÁS'){{ 'selected' }} @endif >UNEAFRO YABÁS</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'MANDELA'){{ 'selected' }} @endif >MANDELA</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'GUERREIROS ALVINÓPOLIS'){{ 'selected' }} @endif >GUERREIROS ALVINÓPOLIS</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'MARIELLE FRANCO'){{ 'selected' }} @endif >MARIELLE FRANCO</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'KLEBER CRIOULO'){{ 'selected' }} @endif >KLEBER CRIOULO</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'VILA FÁTIMA'){{ 'selected' }} @endif >VILA FÁTIMA</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'UNEAFRO MABEL ASSIS'){{ 'selected' }} @endif >UNEAFRO MABEL ASSIS</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'BOM PASTOR'){{ 'selected' }} @endif >BOM PASTOR</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'UNEAFRO ASSIS'){{ 'selected' }} @endif >UNEAFRO ASSIS</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'MARGARIDA ALVES'){{ 'selected' }} @endif >MARGARIDA ALVES</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'DONA NAZINHA'){{ 'selected' }} @endif >DONA NAZINHA</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'LUIZA MAHIN'){{ 'selected' }} @endif >LUIZA MAHIN</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'CLEMENTINA DE JESUS'){{ 'selected' }} @endif >CLEMENTINA DE JESUS</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'NÚCLEO LÁ DA LESTE'){{ 'selected' }} @endif >NÚCLEO LÁ DA LESTE</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'SÉRGIO LAPALOMA'){{ 'selected' }} @endif >SÉRGIO LAPALOMA</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'SUELI CARNEIRO'){{ 'selected' }} @endif >SUELI CARNEIRO</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'TIA JURA'){{ 'selected' }} @endif >TIA JURA</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'NOVA PALESTINA'){{ 'selected' }} @endif >NOVA PALESTINA</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'RAQUEL TRINDADE'){{ 'selected' }} @endif >RAQUEL TRINDADE</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'ASSATA SHAKUR'){{ 'selected' }} @endif >ASSATA SHAKUR</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'ILDA MARTINS'){{ 'selected' }} @endif >ILDA MARTINS</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'UNEAFRO MOGI'){{ 'selected' }} @endif >UNEAFRO MOGI</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'CAROLINA MARIA DE JESUS'){{ 'selected' }} @endif >CAROLINA MARIA DE JESUS</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'UNEAFRO NA DISCIPLINA'){{ 'selected' }} @endif >UNEAFRO NA DISCIPLINA</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'UNEAFRO QUILOMBAQUE'){{ 'selected' }} @endif >UNEAFRO QUILOMBAQUE</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'XI DE AGOSTO'){{ 'selected' }} @endif >XI DE AGOSTO</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'EDUCAÇÃO LIBERTA'){{ 'selected' }} @endif >EDUCAÇÃO LIBERTA</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'ROSA PARKS'){{ 'selected' }} @endif >ROSA PARKS</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'ANTÔNIO CANDEIA FILHO'){{ 'selected' }} @endif >ANTÔNIO CANDEIA FILHO</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'UNEAFRO MSTC'){{ 'selected' }} @endif >UNEAFRO MSTC</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'UNEAFRO LUZ'){{ 'selected' }} @endif >UNEAFRO LUZ</option>
                                              <option @if($paciente->nucleo_uneafro_qual === 'NÚCLEO OBARÁ'){{ 'selected' }} @endif >NÚCLEO OBARÁ</option>
                                          </select>
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
                                            <option <?php if( $paciente->sintomas_iniciais === 'suspeito' ){ echo 'selected=selected'; } ?> >suspeito</option>
                                            <option <?php if( $paciente->sintomas_iniciais === 'confirmado' ){ echo 'selected=selected'; } ?> >confirmado</option>
                                            <option <?php if( $paciente->sintomas_iniciais === 'descartado' ){ echo 'selected=selected'; } ?> >descartado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">
                                            Data do teste confirmatório
                                        </label>
                                        <input name="data_teste_confirmatorio" placeholder="Data do teste confirmatório" type="text" class=" form-control date" id="data_teste_confirmatorio" value="{{ $paciente->data_teste_confirmatorio }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="position-relative form-group">
                                    <label class="">
                                        Testes realizados?
                                    </label>
                                    <br>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input type="checkbox" name="teste_utilizado[]" id="pcr" class="custom-control-input" value="PCR" <?php if( $teste_utilizado && is_array($teste_utilizado) && in_array('PCR', $teste_utilizado) ){ echo 'checked=checked'; } elseif( $teste_utilizado === 'PCR' ){ echo 'checked=checked'; } ?> >
                                      <label class="custom-control-label" for="pcr">
                                          PCR
                                      </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input type="checkbox" name="teste_utilizado[]" id="sorologias" class="custom-control-input" value="sorologias (IgM/IgG)" <?php if( $teste_utilizado && is_array($teste_utilizado) && in_array('sorologias (IgM/IgG)', $teste_utilizado) ){ echo 'checked=checked'; } elseif( $teste_utilizado === 'sorologias (IgM/IgG)' ){ echo 'checked=checked'; } ?> >
                                      <label class="custom-control-label" for="sorologias">
                                          sorologias (IgM/IgG)
                                      </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input type="checkbox" name="teste_utilizado[]" id="teste_rapido" class="custom-control-input" value="teste rápido" <?php if( $teste_utilizado && is_array($teste_utilizado) && in_array('teste rápido', $teste_utilizado) ){ echo 'checked=checked'; } elseif( $teste_utilizado === 'teste rápido' ){ echo 'checked=checked'; } ?> >
                                      <label class="custom-control-label" for="teste_rapido">
                                          Teste Rápido
                                      </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                      <input type="checkbox" name="teste_utilizado[]" id="nao_informado" class="custom-control-input" value="não informado" <?php if( $teste_utilizado && is_array($teste_utilizado) && in_array('não informado', $teste_utilizado) ){ echo 'checked=checked'; } elseif( $teste_utilizado === 'não informado' ){ echo 'checked=checked'; } ?> >
                                      <label class="custom-control-label" for="nao_informado">
                                          Não Informado
                                      </label>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="exampleCustomSelect" class="">
                                            Resultados encontrados
                                        </label>
                                        <br>
                                        <div class="custom-checkbox custom-control custom-control-inline">
                                          <input type="checkbox" name="resultado_teste[]" id="pcr_positivo" class="custom-control-input" value="PCR positivo" <?php if( $resultado_teste && is_array($resultado_teste) && in_array('PCR positivo', $resultado_teste ) ){ echo 'checked=checked'; } elseif( $resultado_teste === 'PCR positivo' ){ echo 'checked=checked'; } ?> >
                                          <label class="custom-control-label" for="pcr_positivo">
                                              PCR positivo
                                          </label>
                                        </div>
                                        <div class="custom-checkbox custom-control custom-control-inline">
                                          <input type="checkbox" name="resultado_teste[]" id="pcr_negativo" class="custom-control-input" value="PCR negativo" <?php if( $resultado_teste && is_array($resultado_teste) && in_array('PCR negativo', $resultado_teste ) ){ echo 'checked=checked'; } elseif( $resultado_teste === 'PCR negativo' ){ echo 'checked=checked'; } ?> >
                                          <label class="custom-control-label" for="pcr_negativo">
                                              PCR negativo
                                          </label>
                                        </div>
                                        <div class="custom-checkbox custom-control custom-control-inline">
                                          <input type="checkbox" name="resultado_teste[]" id="igm_positivo" class="custom-control-input" value="IgM positivo" <?php if( $resultado_teste && is_array($resultado_teste) && in_array('IgM positivo', $resultado_teste ) ){ echo 'checked=checked'; } elseif( $resultado_teste === 'IgM positivo' ){ echo 'checked=checked'; } ?> >
                                          <label class="custom-control-label" for="igm_positivo">
                                              IgM positivo
                                          </label>
                                        </div>
                                        <div class="custom-checkbox custom-control custom-control-inline">
                                          <input type="checkbox" name="resultado_teste[]" id="igm_negativo" class="custom-control-input" value="IgM negativo" <?php if( $resultado_teste && is_array($resultado_teste) && in_array('IgM negativo', $resultado_teste ) ){ echo 'checked=checked'; } elseif( $resultado_teste === 'IgM negativo' ){ echo 'checked=checked'; } ?> >
                                          <label class="custom-control-label" for="igm_negativo">
                                              IgM negativo
                                          </label>
                                        </div>
                                        <div class="custom-checkbox custom-control custom-control-inline">
                                          <input type="checkbox" name="resultado_teste[]" id="igg_positivo" class="custom-control-input" value="IgG positivo" <?php if( $resultado_teste && is_array($resultado_teste) && in_array('IgG positivo', $resultado_teste ) ){ echo 'checked=checked'; } elseif( $resultado_teste === 'IgG positivo' ){ echo 'checked=checked'; } ?> >
                                          <label class="custom-control-label" for="igg_positivo">
                                              IgG positivo
                                          </label>
                                        </div>
                                        <div class="custom-checkbox custom-control custom-control-inline">
                                          <input type="checkbox" name="resultado_teste[]" id="igg_negativo" class="custom-control-input" value="IgG negativo" <?php if( $resultado_teste && is_array($resultado_teste) && in_array('IgG negativo', $resultado_teste ) ){ echo 'checked=checked'; } elseif( $resultado_teste === 'IgG negativo' ){ echo 'checked=checked'; } ?> >
                                          <label class="custom-control-label" for="igg_negativo">
                                              IgG negativo
                                          </label>
                                        </div>
                                        <!--<select type="select" id="resultado_teste" name="resultado_teste" class="custom-select">
                                            <option value="">Selecione</option>
                                            <option <?php if( $paciente->resultado_teste === 'PCR positivo' ){ echo 'selected=selected'; } ?> >PCR positivo</option>
                                            <option <?php if( $paciente->resultado_teste === 'PCR negativo' ){ echo 'selected=selected'; } ?> >PCR negativo</option>
                                            <option <?php if( $paciente->resultado_teste === 'IgM positivo' ){ echo 'selected=selected'; } ?> >IgM positivo</option>
                                            <option <?php if( $paciente->resultado_teste === 'IgM negativo' ){ echo 'selected=selected'; } ?> >IgM negativo</option>
                                            <option <?php if( $paciente->resultado_teste === 'IgG positivo' ){ echo 'selected=selected'; } ?> >IgG positivo</option>
                                            <option <?php if( $paciente->resultado_teste === 'IgG negativo' ){ echo 'selected=selected'; } ?> >IgG negativo</option>
                                        </select>-->
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Outras informações sobre teste</label>
                                        <textarea name="outras_informacao" placeholder="ex: repetiu teste, novas datas de testes, etc" id="outras_informacao" class="form-control">{{ $paciente->outras_informacao }}</textarea>
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
                                        <input type="checkbox" name="doenca_cronica[]" id="hipertensao_arterial_sistemica" class="custom-control-input" value="1" <?php if( $cronicas && in_array('1', $cronicas) ){ echo 'checked=checked'; } ?> >
                                        <label class="custom-control-label" for="hipertensao_arterial_sistemica">
                                            Hipertensão arterial sistêmica (HAS)
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="diabetes_mellitus" class="custom-control-input" value="2" <?php if( $cronicas && in_array('2', $cronicas) ){ echo 'checked=checked'; } ?> >
                                        <label class="custom-control-label" for="diabetes_mellitus">
                                            Diabetes Mellitus (DM)
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="dislipidemia" class="custom-control-input" value="3" <?php if( $cronicas && in_array('3', $cronicas) ){ echo 'checked=checked'; } ?> >
                                        <label class="custom-control-label" for="dislipidemia">
                                            Dislipidemia
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="asma_bronquite" class="custom-control-input" value="4" <?php if( $cronicas && in_array('4', $cronicas) ){ echo 'checked=checked'; } ?> >
                                        <label class="custom-control-label" for="asma_bronquite">
                                            Asma / Bronquite
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="tuberculose_ativa" class="custom-control-input" value="5" <?php if( $cronicas && in_array('5', $cronicas) ){ echo 'checked=checked'; } ?> >
                                        <label class="custom-control-label" for="tuberculose_ativa">
                                            Tuberculose ativa
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="cardiopatias_cardiovasculares" class="custom-control-input" value="6" <?php if( $cronicas && in_array('6', $cronicas) ){ echo 'checked=checked'; } ?> >
                                        <label class="custom-control-label" for="cardiopatias_cardiovasculares">
                                            Cardiopatias e outras doenças cardiovasculares
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="outras_respiratorias" class="custom-control-input" value="7" <?php if( $cronicas && in_array('7', $cronicas) ){ echo 'checked=checked'; } ?> >
                                        <label class="custom-control-label" for="outras_respiratorias">
                                            Outras doenças Respiratórias
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="artrite_artrose_reumatismo" class="custom-control-input" value="8" <?php if( $cronicas && in_array('8', $cronicas) ){ echo 'checked=checked'; } ?> >
                                        <label class="custom-control-label" for="artrite_artrose_reumatismo">
                                            Artrite/Artrose/Reumatismo
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="doenca_autoimune" class="custom-control-input" value="9" <?php if( $cronicas && in_array('9', $cronicas) ){ echo 'checked=checked'; } ?> >
                                        <label class="custom-control-label" for="doenca_autoimune">
                                            Doença autoimune
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="doenca_renal" class="custom-control-input" value="10" <?php if( $cronicas && in_array('10', $cronicas) ){ echo 'checked=checked'; } ?> >
                                        <label class="custom-control-label" for="doenca_renal">
                                            Doença renal
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="doenca_neurologica" class="custom-control-input" value="11" <?php if( $cronicas && in_array('11', $cronicas) ){ echo 'checked=checked'; } ?> >
                                        <label class="custom-control-label" for="doenca_neurologica">
                                            Doença neurológica
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="cancer" class="custom-control-input" value="12" <?php if( $cronicas && in_array('12', $cronicas) ){ echo 'checked=checked'; } ?> >
                                        <label class="custom-control-label" for="cancer">
                                            Câncer
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="ansiedade" class="custom-control-input" value="13" <?php if( $cronicas && in_array('13', $cronicas) ){ echo 'checked=checked'; } ?> >
                                        <label class="custom-control-label" for="ansiedade">
                                            Ansiedade
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="depressao" class="custom-control-input" value="14" <?php if( $cronicas && in_array('14', $cronicas) ){ echo 'checked=checked'; } ?> >
                                        <label class="custom-control-label" for="depressao">
                                            Depressão
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="demencia" class="custom-control-input" value="15" <?php if( $cronicas && in_array('15', $cronicas) ){ echo 'checked=checked'; } ?> >
                                        <label class="custom-control-label" for="demencia">
                                            Demência
                                        </label>
                                    </div>
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="doenca_cronica[]" id="outras_questoes_mental" class="custom-control-input" value="16" <?php if( $cronicas && in_array('16', $cronicas) ){ echo 'checked=checked'; } ?> >
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
                                        <textarea name="descreve_doencas" placeholder="(ex: qual doença neurológica) e outras condições de saúde:" id="descreve_doencas" class="form-control">{{ $paciente->descreve_doencas }}</textarea>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Já teve tuberculose?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="tuberculose" type="radio" class="form-check-input" value="sim" <?php if( $paciente->tuberculose === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="tuberculose" type="radio" class="form-check-input" value="não" <?php if( $paciente->tuberculose === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">É tabagista?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="tabagista" type="radio" class="form-check-input" value="sim" <?php if( $paciente->tabagista === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="tabagista" type="radio" class="form-check-input" value="não" <?php if( $paciente->tabagista === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Faz uso crônico de alcool?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="cronico_alcool" type="radio" class="form-check-input" value="sim" <?php if( $paciente->cronico_alcool === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="cronico_alcool" type="radio" class="form-check-input" value="não" <?php if( $paciente->cronico_alcool === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Faz uso crônico de outras drogas?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="outras_drogas" type="radio" class="form-check-input" value="sim" <?php if( $paciente->outras_drogas === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="outras_drogas" type="radio" class="form-check-input" value="não" <?php if( $paciente->outras_drogas === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
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
                                            <input name="remedios_consumidos" id="remedios_consumidos" placeholder="Qual(is)?" type="text" class="form-control" value="{{ $paciente->remedios_consumidos }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Está gestante?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="gestante" type="radio" class="form-check-input" value="sim" <?php if( $paciente->gestante === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="gestante" type="radio" class="form-check-input" value="não" <?php if( $paciente->gestante === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Amamenta?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="amamenta" type="radio" class="form-check-input" value="sim" <?php if( $paciente->amamenta === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="amamenta" type="radio" class="form-check-input" value="não" <?php if( $paciente->amamenta === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Gestação é ou foi de alto risco?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="gestacao_alto_risco" type="radio" class="form-check-input" value="sim" <?php if( $paciente->gestacao_alto_risco === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="gestacao_alto_risco" type="radio" class="form-check-input" value="não" <?php if( $paciente->gestacao_alto_risco === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Está no pós-parto (40 dias após o parto)?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="pos_parto" type="radio" class="form-check-input" value="sim" <?php if( $paciente->pos_parto === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="pos_parto" type="radio" class="form-check-input" value="não" <?php if( $paciente->pos_parto === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
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
                                            <input name="data_parto" id="data_parto" placeholder="00/00/0000" type="text" class="form-control date" value="{{ $paciente->data_parto }}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">
                                                Data da última menstruação (DUM)
                                            </label>
                                            <input name="data_ultima_mestrucao" id="data_ultima_mestrucao" placeholder="00/00/0000" type="text" class="form-control date" value="{{ $paciente->data_ultima_mestrucao }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleCustomSelect" class="">
                                                Trimestre da gestação no início do monitoramento
                                            </label>
                                            <select type="select" id="trimestre_gestacao" name="trimestre_gestacao" class="custom-select">
                                                <option value="">Selecione</option>
                                                <option <?php if( $paciente->trimestre_gestacao === '1o trimestre' ){ echo 'selected=selected'; } ?> >1o trimestre</option>
                                                <option <?php if( $paciente->trimestre_gestacao === '2o trimestre' ){ echo 'selected=selected'; } ?> >2o trimestre</option>
                                                <option <?php if( $paciente->trimestre_gestacao === '3o trimestre' ){ echo 'selected=selected'; } ?> >3o trimestre</option>
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
                                            <input name="motivo_risco_gravidez" id="motivo_risco_gravidez" placeholder="Qual(is)?" type="text" class="form-control" value="{{ $paciente->motivo_risco_gravidez }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Tem algum acompanhamento médico contínuo?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="acompanhamento_medico" type="radio" class="form-check-input" value="sim" <?php if( $paciente->acompanhamento_medico === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="acompanhamento_medico" type="radio" class="form-check-input" value="não" <?php if( $paciente->acompanhamento_medico === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">
                                                Qual a data da última consulta médica?
                                            </label>
                                            <input name="data_ultima_consulta" placeholder="00/00/0000" type="text" class="form-control date" value="{{ $paciente->data_ultima_consulta }}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label class="">
                                                Onde/como acessa o sistema de saúde?
                                            </label>
                                            <div class="custom-checkbox custom-control custom-control-inline">
                                              <input type="checkbox" name="sistema_saude[]" id="sus" class="custom-control-input" value="É usuária/o do SUS (público)" <?php if( $sistema_saude && in_array('É usuária/o do SUS (público)', $sistema_saude) ){ echo 'checked=checked'; } ?> >
                                              <label class="custom-control-label" for="sus">
                                                  É usuária/o do SUS (público)
                                              </label>
                                            </div>
                                            <div class="custom-checkbox custom-control custom-control-inline">
                                              <input type="checkbox" name="sistema_saude[]" id="convenio" class="custom-control-input" value="Tem convênio/plano de saúde" <?php if( $sistema_saude && in_array('Tem convênio/plano de saúde', $sistema_saude) ){ echo 'checked=checked'; } ?> >
                                              <label class="custom-control-label" for="convenio">
                                                  Tem convênio/plano de saúde
                                              </label>
                                            </div>
                                            <div class="custom-checkbox custom-control custom-control-inline">
                                              <input type="checkbox" name="sistema_saude[]" id="pagos_populares" class="custom-control-input" value="Usuária/o de serviços pagos 'populares' (Ex: Dr Consulta)" <?php if( $sistema_saude && in_array("Usuária/o de serviços pagos 'populares' (Ex: Dr Consulta)", $sistema_saude) ){ echo 'checked=checked'; } ?> >
                                              <label class="custom-control-label" for="pagos_populares">
                                                  Usuária/o de serviços pagos "populares" (Ex: Dr Consulta)
                                              </label>
                                            </div>
                                            <div class="custom-checkbox custom-control custom-control-inline">
                                              <input type="checkbox" name="sistema_saude[]" id="particulares" class="custom-control-input" value="Usuária/o de serviços particulares não cobertos por convênios" <?php if( $sistema_saude && in_array('Usuária/o de serviços particulares não cobertos por convênios', $sistema_saude) ){ echo 'checked=checked'; } ?> >
                                              <label class="custom-control-label" for="particulares">
                                                  Usuária/o de serviços particulares não cobertos por convênios
                                              </label>
                                            </div>
                                            <!--<select multiple="" type="select" id="sistema_saude" name="sistema_saude[]" class="custom-select">
                                                <option value="">Selecione</option>
                                                <option <?php if( $sistema_saude && in_array('É usuária/o do SUS (público)', $sistema_saude) ){ echo 'selected=selected'; } ?> >É usuária/o do SUS (público)</option>
                                                <option <?php if( $sistema_saude && in_array('Tem convênio/plano de saúde', $sistema_saude) ){ echo 'selected=selected'; } ?> >Tem convênio/plano de saúde</option>
                                                <option <?php if( $sistema_saude && in_array('Usuária/o de serviços pagos "populares" (Ex: Dr Consulta)', $sistema_saude) ){ echo 'selected=selected'; } ?> >Usuária/o de serviços pagos "populares" (Ex: Dr Consulta)</option>
                                                <option <?php if( $sistema_saude && in_array('Usuária/o de serviços particulares não cobertos por convênios', $sistema_saude) ){ echo 'selected=selected'; } ?> >Usuária/o de serviços particulares não cobertos por convênios</option>
                                            </select>
                                            <small class="form-text text-muted">Segure o shift para marcar mais de uma opção.</small>-->
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <div class="form-group">
                                                <label for="name">Tem acompanhamento médico na Unidade Básica de Saúde (UBS - posto) de referência?</label>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="acompanhamento_ubs" type="radio" class="form-check-input" value="sim" <?php if( $paciente->acompanhamento_ubs === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                                <div class="position-relative1 form-check"><label class="form-check-label"><input name="acompanhamento_ubs" type="radio" class="form-check-input" value="não" <?php if( $paciente->acompanhamento_ubs === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="position-relatives row fdorm-check">
                            <div class="col-sm-12 offset-sm-2s"><br />
                                <button type="submit" id="createPaciente" class="btn btn-secondary">Enviar</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </form>
                </div>

                <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                    <form id="createPacienteQAForm" method="POST" action="{{ route('paciente.quadro-atual') }}">
                        @csrf
                        <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                        <div class="main-card mb-3 card">
                            <div class="card-body"><h5 class="card-title">Quadro atual</h5>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="primeira_sintoma">Primeiros sintomas</label>
                                            <textarea name="primeira_sintoma" placeholder="descreva a evolução dos sintomas do início do quadro até o primeiro registro" id="primeira_sintoma" class="form-control">@if($quadro) {{ $quadro->primeira_sintoma }} @endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sintomas_manifestados">Sintomas manifestados</label><br />
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas_manifestados[]" class="form-check-input" id="tosse" type="checkbox" value="tosse" <?php if( $sintomas_quadro && in_array('tosse', $sintomas_quadro ) ) { echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="tosse">Tosse</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas_manifestados[]" class="form-check-input" id="falta_de_ar" type="checkbox" value="falta de ar" <?php if( $sintomas_quadro && in_array('falta de ar', $sintomas_quadro ) ) { echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="febre">Falta de ar</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas_manifestados[]" class="form-check-input" id="febre" type="checkbox" value="febre" <?php if( $sintomas_quadro && in_array('febre', $sintomas_quadro ) ) { echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="febre">Febre</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas_manifestados[]" class="form-check-input" type="checkbox" value="dor de cabeça" <?php if( $sintomas_quadro && in_array('dor de cabeça', $sintomas_quadro ) ) { echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="inlineCheckbox3">Dor de Cabeça</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas_manifestados[]" class="form-check-input" type="checkbox" value="perda de olfato" <?php if( $sintomas_quadro && in_array('perda de olfato', $sintomas_quadro ) ) { echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="inlineCheckbox3">Perda do olfato</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas_manifestados[]" class="form-check-input" type="checkbox" value="perda do paladar" <?php if( $sintomas_quadro && in_array('perda do paladar', $sintomas_quadro ) ) { echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="inlineCheckbox3">Perda do paladar</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas_manifestados[]" class="form-check-input" type="checkbox" value="enjoo" <?php if( $sintomas_quadro && in_array('enjoo', $sintomas_quadro ) ) { echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="inlineCheckbox3">Enjoo ou vômitos</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas_manifestados[]" class="form-check-input" id="diarreia" type="checkbox" value="diarreia" <?php if( $sintomas_quadro && in_array('diarreia', $sintomas_quadro ) ) { echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="diarreia">Diarréia</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas_manifestados[]" class="form-check-input" id="aumento_da_pressao" type="checkbox" value="aumento da pressão" <?php if( $sintomas_quadro && in_array('aumento da pressão', $sintomas_quadro ) ) { echo 'checked=checked'; } ?>>
                                                <label class="form-check-label" for="aumento_da_pressao">Aumento da pressão</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas_manifestados[]" class="form-check-input" id="queda_brusca_de_pressao" type="checkbox" value="queda brusca de Pressão" <?php if( $sintomas_quadro && in_array('queda brusca de Pressão', $sintomas_quadro ) ) { echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="sonolencia">Queda brusca de Pressão</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas_manifestados[]" class="form-check-input" id="pressao_baixa" type="checkbox" value="pressão baixa" <?php if( $sintomas_quadro && in_array('pressão baixa', $sintomas_quadro ) ) { echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="pressao_baixa">Dor torácica (dor no peito) </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas_manifestados[]" class="form-check-input" id="sonolência_cansaco_importantes" type="checkbox" value="sonolência ou cansaço importantes" <?php if( $sintomas_quadro && in_array('sonolência ou cansaço importantes', $sintomas_quadro ) ) { echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="sonolência_cansaco_importantes">Sonolência ou cansaço importantes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas_manifestados[]" class="form-check-input" id="confusao_mental" type="checkbox" value="confusão mental" <?php if( $sintomas_quadro && in_array('confusão mental', $sintomas_quadro ) ) { echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="confusao_mental">Confusão mental</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas_manifestados[]" class="form-check-input" id="desmaio" type="checkbox" value="desmaio" <?php if( $sintomas_quadro && in_array('desmaio', $sintomas_quadro ) ) { echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="desmaio">Desmaio</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas_manifestados[]" class="form-check-input" id="convulsao" type="checkbox" value="convulsao" <?php if( $sintomas_quadro && in_array('convulsao', $sintomas_quadro ) ) { echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="convulsao">Convulsão</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="sintomas_manifestados[]" class="form-check-input" id="outros" type="checkbox" value="outros" <?php if( $sintomas_quadro && in_array('outros', $sintomas_quadro ) ) { echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="outros">Outros</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                              <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="temperatura_max">Temperatura máxima (em graus)</label>
                                        <input name="temperatura_max" type="text" placeholder="00,0" class="form-control temperature" id="temperatura_max" value="@if($quadro) {{ $quadro->temperatura_max }} @endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="data_temp_max">Data temperatura máxima</label>
                                        <input name="data_temp_max" type="text" class=" form-control date" id="data_temp_max" value="@if($quadro) {{ $quadro->data_temp_max }} @endif">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="saturacao_baixa">Saturação mais baixa registrada (%)</label>
                                        <input name="saturacao_baixa" type="text" placeholder="00 %" class=" form-control saturation" id="saturacao_baixa" value="@if($quadro) {{ $quadro->saturacao_baixa }} @endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="data_sat_max">Data da saturação mais baixa</label>
                                        <input name="data_sat_max" type="text" class=" form-control date" id="data_sat_max" value="@if($quadro) {{ $quadro->data_sat_max }} @endif">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="frequencia_max">Frequência respiratória máxima</label>
                                        <input name="frequencia_max" type="text" placeholder="respirações por minuto - rpm" class=" form-control" id="frequencia_max" value="@if($quadro) {{ $quadro->frequencia_max }} @endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="data_freq_max">Data da Frequência respiratória máxima</label>
                                        <input name="data_freq_max" type="text" class=" form-control date" id="data_freq_max" value="@if($quadro) {{ $quadro->data_freq_max }} @endif">
                                    </div>
                                </div>
                              </div>
                              <div class="pos2ition-relative row form-chec2k">
                                  <div class="col-sm-12 2offset-sm-2">
                                      <button type="submit" id="createPacienteQA" class="btn btn-secondary">Salvar</button>
                                  </div>
                              </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
                  <!-- ABRE FORM MONITORAMENTO -->
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Monitoramento</h5>
                          <form id="monitoramento_form" action="{{ route('paciente.monitoramento', $paciente->id) }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data_monitoramento">Data do monitoramento</label>
                                        <input name="data_monitoramento" type="text" class="date form-control" id="data_monitoramento" value="@if($monitoramento) {{ $monitoramento->data_monitoramento }} @endif">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="horario_monotiramento">Horário do monitoramento</label>
                                        <input name="horario_monotiramento" type="text" class=" form-control hour" id="horario_monotiramento" value="@if($monitoramento) {{ $monitoramento->horario_monotiramento }} @endif">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sintomas_atuais">Sintomas atuais</label><br />
                                        <div class="form-check form-check-inline">
                                            <input name="sintomas_atuais[]" class="form-check-input" type="checkbox" value="tosse" <?php if( $monitoramento_sintomas && in_array('tosse', $monitoramento_sintomas) ){ echo 'checked=checked'; } ?> >
                                            <label class="form-check-label" for="tosse">Tosse</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="sintomas_atuais[]" class="form-check-input" type="checkbox" value="falta de ar" <?php if( $monitoramento_sintomas && in_array('falta de ar', $monitoramento_sintomas) ){ echo 'checked=checked'; } ?> >
                                            <label class="form-check-label" for="falta_de_ar">Falta de ar</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="sintomas_atuais[]" class="form-check-input" type="checkbox" value="febre" <?php if( $monitoramento_sintomas && in_array('febre', $monitoramento_sintomas) ){ echo 'checked=checked'; } ?> >
                                            <label class="form-check-label" for="febre">Febre</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="sintomas_atuais[]" class="form-check-input" type="checkbox" value="dor de cabeça" <?php if( $monitoramento_sintomas && in_array('dor de cabeça', $monitoramento_sintomas) ){ echo 'checked=checked'; } ?> >
                                            <label class="form-check-label" for="inlineCheckbox3">Dor de Cabeça</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="sintomas_atuais[]" class="form-check-input" type="checkbox" value="perda de olfato" <?php if( $monitoramento_sintomas && in_array('perda de olfato', $monitoramento_sintomas) ){ echo 'checked=checked'; } ?> >
                                            <label class="form-check-label" for="inlineCheckbox3">Perda do olfato</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="sintomas_atuais[]" class="form-check-input" type="checkbox" value="perda do paladar" <?php if( $monitoramento_sintomas && in_array('perda do paladar', $monitoramento_sintomas) ){ echo 'checked=checked'; } ?> >
                                            <label class="form-check-label" for="inlineCheckbox3">Perda do paladar</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="sintomas_atuais[]" class="form-check-input" type="checkbox" value="outros" <?php if( $monitoramento_sintomas && in_array('outros', $monitoramento_sintomas) ){ echo 'checked=checked'; } ?> >
                                            <label class="form-check-label" for="outros_monit">Outros</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input name="sintomas_outro" class="form-control" type="text" placeholder="Outro (digite)" value="@if($monitoramento) {{ $monitoramento->sintomas_outro }} @endif">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="temperatura_atual">Temperatura atual (em graus)</label>
                                        <input name="temperatura_atual" type="text" placeholder="00,0" class=" form-control temperature" id="temperatura_atual" value="@if($monitoramento) {{ $monitoramento->temperatura_atual }} @endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="frequencia_cardiaca_atual">Frequência cardíaca atual</label>
                                        <input name="frequencia_cardiaca_atual" type="text" placeholder="-- bpm" class="form-control" id="frequencia_cardiaca_atual" value="@if($monitoramento) {{ $monitoramento->frequencia_cardiaca_atual }} @endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="algum_sinal">Algum sinal de gravidade nesse monitoramento?</label>
                                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="algum_sinal" type="radio" class="form-check-input" value="sim" <?php if( $monitoramento && $monitoramento->algum_sinal === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="algum_sinal" type="radio" class="form-check-input" value="não" <?php if( $monitoramento && $monitoramento->algum_sinal === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="saturacao_atual">Saturação atual (%)</label>
                                        <input name="saturacao_atual" type="text" placeholder="00 %" class=" form-control saturation" id="saturacao_atual" value="@if($monitoramento) {{ $monitoramento->saturacao_atual }} @endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="pressao_arterial_atual">Pressão Arterial Atual</label>
                                        <input name="pressao_arterial_atual" type="text" placeholder="Ex: 12x8" class=" form-control" id="pressao_arterial_atual" value="@if($monitoramento) {{ $monitoramento->pressao_arterial_atual }} @endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="equipe_medica">Equipe médica do projeto prescreveu algum medicamento?</label>
                                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="equipe_medica" type="radio" class="form-check-input" value="sim" <?php if( $monitoramento && $monitoramento->equipe_medica === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="equipe_medica" type="radio" class="form-check-input" value="não" <?php if( $monitoramento && $monitoramento->equipe_medica === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="frequencia_respiratoria_atual">Frequência respiratória atual</label>
                                        <input name="frequencia_respiratoria_atual" type="text" placeholder="-- rpm" class="form-control" id="frequencia_respiratoria_atual" value="@if($monitoramento) {{ $monitoramento->frequencia_respiratoria_atual }} @endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="medicamento">Medicamento prescrito pela equipe médica do projeto</label>
                                        <textarea name="medicamento" id="medicamento" class="form-control">@if($monitoramento) {{ $monitoramento->medicamento }} @endif</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="main-card mb-3 card">
                        <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fazendo_uso_pic">Fazendo uso de alguma PIC (prática integrativa complementar - ex: medicina chinesa)?</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="fazendo_uso_pic" type="radio" class="form-check-input" value="sim" <?php if( $monitoramento && $monitoramento->fazendo_uso_pic === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="fazendo_uso_pic" type="radio" class="form-check-input" value="não" <?php if( $monitoramento && $monitoramento->fazendo_uso_pic === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fez_escalapes">Fez escaldapés (atenção para restrições - ex: gestantes e diabeticos)</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="fez_escalapes" type="radio" class="form-check-input" value="sim" <?php if( $monitoramento && $monitoramento->fez_escalapes === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="fez_escalapes" type="radio" class="form-check-input" value="não" <?php if( $monitoramento && $monitoramento->fez_escalapes === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="melhora_sintoma_escaldapes">Sentiu melhora dos sintomas com escaldapés (atenção para restrições - ex: gestantes e diabeticos)</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="melhora_sintoma_escaldapes" type="radio" class="form-check-input" value="grande alívio" <?php if( $monitoramento && $monitoramento->melhora_sintoma_escaldapes === 'grande alívio' ){ echo 'checked=checked'; } ?> > grande alívio</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="melhora_sintoma_escaldapes" type="radio" class="form-check-input" value="pouca melhora" <?php if( $monitoramento && $monitoramento->melhora_sintoma_escaldapes === 'pouca melhora' ){ echo 'checked=checked'; } ?> > pouca melhora</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="melhora_sintoma_escaldapes" type="radio" class="form-check-input" value="não" <?php if( $monitoramento && $monitoramento->melhora_sintoma_escaldapes === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fes_inalacao">Fez inalação ou vaporização? </label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="fes_inalacao" type="radio" class="form-check-input" value="inalação" <?php if( $monitoramento && $monitoramento->fes_inalacao === 'inalação' ){ echo 'checked=checked'; } ?> > Inalação</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="fes_inalacao" type="radio" class="form-check-input" value="vaporização" <?php if( $monitoramento && $monitoramento->fes_inalacao === 'vaporização' ){ echo 'checked=checked'; } ?> > Vaporização</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="fes_inalacao" type="radio" class="form-check-input" value="não" <?php if( $monitoramento && $monitoramento->fes_inalacao === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="melhoria_sintomas_inalacao">Sentiu melhora dos sintomas com inalação ou vaporização: </label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="melhoria_sintomas_inalacao" type="radio" class="form-check-input" value="grande alívio" <?php if( $monitoramento && $monitoramento->melhoria_sintomas_inalacao === 'grande alívio' ){ echo 'checked=checked'; } ?> > grande alívio</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="melhoria_sintomas_inalacao" type="radio" class="form-check-input" value="pouca melhora" <?php if( $monitoramento && $monitoramento->melhoria_sintomas_inalacao === 'pouca melhora' ){ echo 'checked=checked'; } ?> > pouca melhora</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="melhoria_sintomas_inalacao" type="radio" class="form-check-input" value="não" <?php if( $monitoramento && $monitoramento->melhoria_sintomas_inalacao === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
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
                            </form>
                        </div>
                    </div>
                    <!-- FECHA FORM MONITORAMENTO -->
                </div>

                <div class="tab-pane tabs-animation fade" id="tab-content-3" role="tabpanel">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Saúde mental</h5>
                          <form action="{{ route('paciente.saude-mental', $paciente->id) }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="quadro_atual">Quadro atual intensifica medos, angústias, ansiedade, tristezas ou preocupação?</label>
                                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="quadro_atual" type="radio" class="form-check-input" value="sim" <?php if( $saude_mental && $saude_mental->quadro_atual === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                        <div class="position-relative1 form-check"><label class="form-check-label"><input name="quadro_atual" type="radio" class="form-check-input" value="não" <?php if( $saude_mental && $saude_mental->quadro_atual === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="detalhes_medos">Escreva sobre o estado emocional e detalhe os medos</label>
                                        <textarea name="detalhes_medos" id="detalhes_medos" class="form-control">@if($saude_mental) {{ $saude_mental->detalhes_medos }} @endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relatives row fdorm-check">
                                <div class="col-sm-12 offset-sm-2s"><br />
                                    <button class="btn btn-secondary">Enviar</button>
                                </div>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane tabs-animation fade" id="tab-content-4" role="tabpanel">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Serviços de Referência e Internação</h5>
                            <form id="internacao_form" action="{{ route('paciente.internacao', $paciente->id) }}" method="post">
                              @csrf
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="precisou_servico">A pessoa precisou ir a algum serviço de saúde?</label><br />
                                            <div class="form-check form-check-inline">
                                                <input name="precisou_servico[]" class="form-check-input" id="ubs" type="checkbox" value="UBS (Unidade Básica de Saúde - posto de saúde)" <?php if( $internacao_servico && in_array('UBS (Unidade Básica de Saúde - posto de saúde)', $internacao_servico) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="ubs">UBS (Unidade Básica de Saúde - posto de saúde)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="precisou_servico[]" class="form-check-input" id="upa" type="checkbox" value="UPA (Unidade de Pronto Atendimento)" <?php if( $internacao_servico && in_array('UPA (Unidade de Pronto Atendimento)', $internacao_servico) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="upa">UPA (Unidade de Pronto Atendimento)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="precisou_servico[]" class="form-check-input" id="ama" type="checkbox" value="ama" <?php if( $internacao_servico && in_array('ama', $internacao_servico) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="ama">AMA</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="precisou_servico[]" class="form-check-input" id="hospital_publico" type="checkbox" value="Hospital público" <?php if( $internacao_servico && in_array('Hospital público', $internacao_servico) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="hospital_publico">Hospital público</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="precisou_servico[]" class="form-check-input" id="hospital_privado" type="checkbox" value="hospital privado" <?php if( $internacao_servico && in_array('hospital privado', $internacao_servico) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="hospital_privado">Hospital privado</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="precisou_servico_outro" class="form-control" type="text" placeholder="outro (qual?)" value="@if($internacao) {{ $internacao->precisou_servico_outro }} @endif">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="quant_ida_servico">Quantas idas a serviços de saúde?</label>
                                            <input name="quant_ida_servico" type="text" placeholder="somente números" class=" form-control" id="quant_ida_servico" value="@if($internacao) {{ $internacao->quant_ida_servico }} @endif" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="data_ultima_ida_servico_de_saude">Data da última ida a serviço de saúde</label>
                                            <input name="data_ultima_ida_servico_de_saude" type="text" placeholder="dd/mm/aaaa" class="form-control date" id="data_ultima_ida_servico_de_saude" value="@if($internacao) {{ $internacao->data_ultima_ida_servico_de_saude }} @endif">
                                        </div>
                                    </div>
                                </div>

                                <div class="divider">
                                </div>


                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="recebeu_med_covid"><strong>Recebeu medicações para tratar COVID-19?</strong></label><br />
                                            <div class="form-check form-check-inline">
                                                <input name="recebeu_med_covid[]" class="form-check-input" id="azitromicina" type="checkbox" value="Azitromicina" <?php if( $internacao_remedio && in_array('Azitromicina', $internacao_remedio) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="azitromicina">Azitromicina</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="recebeu_med_covid[]" class="form-check-input" id="outro_antibiotico" type="checkbox" value="outro antibiótico" <?php if( $internacao_remedio && in_array('outro antibiótico', $internacao_remedio) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="outro_antibiotico">Outro antibiótico</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="recebeu_med_covid[]" class="form-check-input" id="ivermectina" type="checkbox" value="ivermectina" <?php if( $internacao_remedio && in_array('ivermectina', $internacao_remedio) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="ivermectina">Ivermectina</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="recebeu_med_covid[]" class="form-check-input" type="checkbox" value="cloroquina/hidroxicloroquina" <?php if( $internacao_remedio && in_array('cloroquina/hidroxicloroquina', $internacao_remedio) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="inlineCheckbox3">Cloroquina/Hidroxicloroquina</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="recebeu_med_covid[]" class="form-check-input" type="checkbox" value="oseltamivir (tamiflu)" <?php if( $internacao_remedio && in_array('oseltamivir (tamiflu)', $internacao_remedio) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="inlineCheckbox3">Oseltamivir (Tamiflu)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="recebeu_med_covid[]" class="form-check-input" type="checkbox" value="algum antialérgico" <?php if( $internacao_remedio && in_array('algum antialérgico', $internacao_remedio) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="inlineCheckbox3">Algum antialérgico</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="recebeu_med_covid[]" class="form-check-input" type="checkbox" value="algum corticóide" <?php if( $internacao_remedio && in_array('algum corticóide', $internacao_remedio) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="inlineCheckbox3">Algum corticóide</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="recebeu_med_covid[]" class="form-check-input" type="checkbox" value="algum antiinflamatório" <?php if( $internacao_remedio && in_array('algum antiinflamatório', $internacao_remedio) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="inlineCheckbox3">Algum antiinflamatório</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="recebeu_med_covid[]" class="form-check-input" type="checkbox" value="vitamina D" <?php if( $internacao_remedio && in_array('vitamina D', $internacao_remedio) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="inlineCheckbox3">Vitamina D</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="recebeu_med_covid[]" class="form-check-input" type="checkbox" value="zinco" <?php if( $internacao_remedio && in_array('zinco', $internacao_remedio) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="inlineCheckbox3">Zinco</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="recebeu_med_covid[]" class="form-check-input" type="checkbox" value="outro medicamento" <?php if( $internacao_remedio && in_array('outro medicamento', $internacao_remedio) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="inlineCheckbox3">Outro medicamento</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nome_medicamento">Escreva o nome do medicamento prescrito</label>
                                            <textarea name="nome_medicamento" id="nome_medicamento" class="form-control">@if($internacao) {{ $internacao->nome_medicamento }} @endif</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="divider">
                                </div>


                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="teve_algum_problema"><strong>A pessoa teve algum problema com serviços de referência?</strong></label><br />
                                            <div class="form-check form-check-inline">
                                                <input name="teve_algum_problema[]" class="form-check-input" id="ubs2" type="checkbox" value="UBS (Unidade Básica de Saúde - posto de saúde)" <?php if( $internacao_problema && in_array('UBS (Unidade Básica de Saúde - posto de saúde)', $internacao_problema) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="ubs2">UBS (Unidade Básica de Saúde - posto de saúde)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="teve_algum_problema[]" class="form-check-input" id="upa2" type="checkbox" value="UPA (Unidade de Pronto Atendimento)" <?php if( $internacao_problema && in_array('UPA (Unidade de Pronto Atendimento)', $internacao_problema) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="upa2">UPA (Unidade de Pronto Atendimento)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="teve_algum_problema[]" class="form-check-input" id="ama2" type="checkbox" value="ama" <?php if( $internacao_problema && in_array('ama', $internacao_problema) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="ama2">AMA</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="teve_algum_problema[]" class="form-check-input" id="hospital_publico_2" type="checkbox" value="Hospital público" <?php if( $internacao_problema && in_array('Hospital público', $internacao_problema) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="hospital_publico_2">Hospital público</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="teve_algum_problema[]" class="form-check-input" id="hospital_privado_2" type="checkbox" value="Hospital privado" <?php if( $internacao_problema && in_array('Hospital privado', $internacao_problema) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="hospital_privado_2">Hospital privado</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="teve_algum_problema[]" class="form-check-input" type="checkbox" value="Outro (qual?)" <?php if( $internacao_problema && in_array('Outro (qual?)', $internacao_problema) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="teve_algum_problema[]">Outro (qual?)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="descreva_problema">Descreva o problema</label>
                                            <textarea name="descreva_problema" id="descreva_problema" class="form-control">@if($internacao) {{ $internacao->descreva_problema }} @endif</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="divider">
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="precisou_internacao">Precisou de internação pelo quadro (suspeito ou confirmado)?</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="precisou_internacao" type="radio" class="form-check-input" value="sim" <?php if( $internacao && $internacao->precisou_internacao === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="precisou_internacao" type="radio" class="form-check-input" value="não" <?php if( $internacao && $internacao->precisou_internacao === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="precisou_ambulancia">Precisou de ambulância financiada pelo projeto?</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="precisou_ambulancia" type="radio" class="form-check-input" value="sim" <?php if( $internacao && $internacao->precisou_ambulancia === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="precisou_ambulancia" type="radio" class="form-check-input" value="não" <?php if( $internacao && $internacao->precisou_ambulancia === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="divider">
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="local_internacao"><strong>Local de internação</strong></label><br />
                                            <div class="form-check form-check-inline">
                                                <input name="local_internacao[]" class="form-check-input" id="hospital_publico_referencia" type="checkbox" value="Hospital público de referência" <?php if( $internacao_local && in_array('Hospital público de referência', $internacao_local) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="hospital_publico_referencia">Hospital público de referência</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="local_internacao[]" class="form-check-input" id="hospital_campanha" type="checkbox" value="Hospital de campanha" <?php if( $internacao_local && in_array('Hospital de campanha', $internacao_local) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="hospital_campanha">Hospital de campanha</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="local_internacao[]" class="form-check-input" id="hospital_particular_referencia" type="checkbox" value="Hospital particular de referência" <?php if( $internacao_local && in_array('Hospital particular de referência', $internacao_local) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="febre">Hospital particular de referência</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="local_internacao[]" class="form-check-input" type="checkbox" value="Hospital municipal do Ipiranga (encaminhado pelo projeto)" <?php if( $internacao_local && in_array('Hospital municipal do Ipiranga (encaminhado pelo projeto)', $internacao_local) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="inlineCheckbox3">Hospital municipal do Ipiranga (encaminhado pelo projeto)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="local_internacao[]" class="form-check-input" type="checkbox" value="Hospital privado financiado pelo projeto" <?php if( $internacao_local && in_array('Hospital privado financiado pelo projeto', $internacao_local) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="inlineCheckbox3">Hospital privado financiado pelo projeto</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nome_hospital">Nome do Hospital de internação</label>
                                            <input name="nome_hospital" id="nome_hospital" type="text" class="form-control" value="@if($internacao) {{ $internacao->nome_hospital }} @endif">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="tempo_internacao">Tempo de internação</label>
                                            <input name="tempo_internacao" id="tempo_internacao" placeholder="em dias - número" type="text" class="form-control" value="@if($internacao) {{ $internacao->tempo_internacao }} @endif" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="data_entrada_internacao">Data de entrada da internação</label>
                                            <input name="data_entrada_internacao" id="data_entrada_internacao" placeholder="dd/mm/aaaa" type="text" class="date form-control" value="@if($internacao) {{ $internacao->data_entrada_internacao }} @endif">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="data_alta_hospitalar">Data da alta hospitalar</label>
                                            <input name="data_alta_hospitalar" id="data_alta_hospitalar" placeholder="dd/mm/aaaa" type="text" class="date form-control" value="@if($internacao) {{ $internacao->data_alta_hospitalar }} @endif">
                                        </div>
                                    </div>
                                </div>


                                <div class="position-relatives row form-check">
                                    <div class="col-sm-12 offset-sm-2s"><br />
                                        <button class="btn btn-secondary">Enviar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane tabs-animation fade" id="tab-content-5" role="tabpanel">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Insumos Oferecidos pelo Projeto</h5>
                            <form id="insumo_form" action="{{ route('paciente.insumos', $paciente->id) }}" method="post">
                              @csrf
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="condicao_ficar_isolada">Há condição de ficar isolada, sozinha, em um cômodo da casa?</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="condicao_ficar_isolada" type="radio" class="form-check-input" value="sim" <?php if( $insumos && $insumos->condicao_ficar_isolada === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="condicao_ficar_isolada" type="radio" class="form-check-input" value="não" <?php if( $insumos && $insumos->condicao_ficar_isolada === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tem_comida">Tem comida disponível, sem precisar sair?</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="tem_comida" type="radio" class="form-check-input" value="sim" <?php if( $insumos && $insumos->tem_comida === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="tem_comida" type="radio" class="form-check-input" value="não" <?php if( $insumos && $insumos->tem_comida === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tem_alguem">Tem alguém para auxiliá-lo(a)?</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="tem_alguem" type="radio" class="form-check-input" value="sim" <?php if( $insumos && $insumos->tem_alguem === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="tem_alguem" type="radio" class="form-check-input" value="não" <?php if( $insumos && $insumos->tem_alguem === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tarefas_autocuidado">Consegue realizar tarefas de autocuidado? (como tomar banho, cozinhar,  lavar a própria roupa)</label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="tarefas_autocuidado" type="radio" class="form-check-input" value="sim" <?php if( $insumos && $insumos->tarefas_autocuidado === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="tarefas_autocuidado" type="radio" class="form-check-input" value="não" <?php if( $insumos && $insumos->tarefas_autocuidado === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="divider"></div>

                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="precisa_tipo_ajuda"><strong>Precisa de algum tipo de ajuda?</strong></label><br />
                                            <div class="form-check form-check-inline">
                                                <input name="precisa_tipo_ajuda[]" class="form-check-input" id="comprar_remedios_continuo" type="checkbox" value="Comprar remédios de uso contínuo" <?php if( $insumos_ajuda &&  in_array('Comprar remédios de uso contínuo', $insumos_ajuda) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="comprar_remedios_continuo">Comprar remédios de uso contínuo</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="precisa_tipo_ajuda[]" class="form-check-input" id="comprar_remedios" type="checkbox" value="Comprar remédios para o tratamento do quadro atual" <?php if( $insumos_ajuda &&  in_array('Comprar remédios para o tratamento do quadro atual', $insumos_ajuda) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="comprar_remedios">Comprar remédios para o tratamento do quadro atual</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="precisa_tipo_ajuda[]" class="form-check-input" id="comprar_alimento" type="checkbox" value="Comprar alimento ou outro produtos de necessidade básica" <?php if( $insumos_ajuda &&  in_array('Comprar alimento ou outro produtos de necessidade básica', $insumos_ajuda) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="comprar_alimento">Comprar alimento ou outro produtos de necessidade básica</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="precisa_tipo_ajuda[]" class="form-check-input" type="checkbox" value="Outros" <?php if( $insumos_ajuda &&  in_array('Outros', $insumos_ajuda) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="Outros">Outros</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tratamento_prescrito"><strong>Tratamento foi prescrito por algum médico do projeto?</strong></label>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="tratamento_prescrito" type="radio" class="form-check-input" value="sim" <?php if( $insumos && $insumos->tratamento_prescrito === 'sim' ){ echo 'checked=checked'; } ?> > Sim</label></div>
                                            <div class="position-relative1 form-check"><label class="form-check-label"><input name="tratamento_prescrito" type="radio" class="form-check-input" value="não" <?php if( $insumos && $insumos->tratamento_prescrito === 'não' ){ echo 'checked=checked'; } ?> > Não</label></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tratamento_financiado"><strong>Tratamento financiado</strong></label><br />
                                            <div class="form-check form-check-inline">
                                                <input name="tratamento_financiado[]" class="form-check-input" id="alopatico" type="checkbox" value="Alopático (medicamentos convencionais)" <?php if( $insumos_tratamento &&  in_array('Alopático (medicamentos convencionais)', $insumos_tratamento) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="alopatico">Alopático (medicamentos convencionais)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="tratamento_financiado[]" class="form-check-input" id="pics" type="checkbox" value="PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)" <?php if( $insumos_tratamento &&  in_array('PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)', $insumos_tratamento) ){ echo 'checked=checked'; } ?> >
                                                <label class="form-check-label" for="febre">PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="divider"></div>

                                <div class="form-row">
                                  <div class="col-md-4">
                                    >>> KIT <<<
                                  </div>
                                </div>

                                <div class="position-relatives row fdorm-check">
                                    <div class="col-sm-12 offset-sm-2s"><br />
                                        <button class="btn btn-secondary">Enviar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane tabs-animation fade" id="tab-content-6" role="tabpanel">
                  <div class="main-card mb-3 card">
                    <div class="card-body">

                      <div class="row">
                        @foreach($prontuarios as $prontuario)
                        <div class="col-4 col-md-4">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Data: {{ $prontuario->data_monitoramento }} - Hora: {{ $prontuario->horario_monotiramento }}</h5>
                              <p class="card-text">
                                <strong>Sintomas: </strong>
                                <?php
                                $sintomas = unserialize($prontuario->sintomas_atuais);
                                if($sintomas){
                                  for($c=0;$c<count($sintomas);$c++){
                                    echo ucfirst($sintomas[$c]).', ';
                                  }
                                }
                                ?>
                              </p>
                              <p class="card-text"><strong>Outros Sintomas: </strong>{{ ucfirst($prontuario->sintomas_outro) }}</p>
                              <p class="card-text"><strong>Temperatura: </strong>{{ $prontuario->temperatura_atual }}</p>
                              <p class="card-text"><strong>Frequência Cardíaca: </strong>{{ $prontuario->frequencia_cardiaca_atual }}</p>
                              <p class="card-text"><strong>Frequência Respiratória: </strong>{{ $prontuario->frequencia_respiratoria_atual }}</p>
                              <p class="card-text"><strong>Saturação: </strong>{{ $prontuario->saturacao_atual }}</p>
                              <p class="card-text"><strong>Pressão Arterial: </strong>{{ $prontuario->pressao_arterial_atual }}</p>
                              <p class="card-text"><strong>Medicamento Prescrito? </strong>{{ ucfirst($prontuario->equipe_medica) }}</p>
                              @if($prontuario->equipe_medica === 'sim')<p class="card-text"><strong>Qual? </strong>{{ ucfirst($prontuario->medicamento) }}</p>@endif
                              <p class="card-text"><strong>Sinal de Gravidade: </strong>{{ ucfirst($prontuario->algum_sinal) }}</p>
                              <p class="card-text"><strong>PIC: </strong>{{ ucfirst($prontuario->fazendo_uso_pic) }}</p>
                              <p class="card-text"><strong>Escaldapés: </strong>{{ ucfirst($prontuario->fez_escalapes) }}</p>
                              <p class="card-text"><strong>Sentiu Melhoras com Escaldapés: </strong>{{ ucfirst($prontuario->melhora_sintoma_escaldapes) }}</p>
                              <p class="card-text"><strong>Inalação/Vaporização: </strong>{{ ucfirst($prontuario->fes_inalacao) }}</p>
                              <p class="card-text"><strong>Sentiu Melhoras com Inalação/Vaporização: </strong>{{ ucfirst($prontuario->melhoria_sintomas_inalacao) }}</p>
                            </div>
                          </div>
                        </div>
                        @endforeach
                        @if($prontuarios->isEmpty())
                        <div class="col-12 col-md-12">
                          Sem dados no prontuário.
                        </div>
                        @endif
                      </div>

                    </div>
                  </div>
                </div>
          </div>
      </div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://seacole.uneafrobrasil.org/js/jquery.mask.js"></script>
<script>
$('.temperature').mask('00,0');
$('.saturation').mask('00');
$('.hour').mask('00:00');
$('.info').css('cursor', 'pointer');
$('.info').click(function(){
  $(this).fadeOut();
})

//VIACEP
function limpa_formulário_cep() {
    $("#address_street").val("");
    $("#address_neighborhood").val("");
    $("#address_city").val("");
    $("#address_state").val("");
}

$("#endereco_cep").blur(function() {
    var cep = $(this).val().replace(/\D/g, '');

    if (cep != "") {
        var validacep = /^[0-9]{8}$/;

        if(validacep.test(cep)) {
            $("#endereco_rua").val("...");
            $("#endereco_bairro").val("...");
            $("#endereco_cidade").val("...");
            $("#endereco_uf").val("...");

            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                if (!("erro" in dados)) {
                    $("#endereco_rua").val(dados.logradouro);
                    $("#endereco_bairro").val(dados.bairro);
                    $("#endereco_cidade").val(dados.localidade);
                    $("#endereco_uf").val(dados.uf);
                }
                else {
                    limpa_formulário_cep();
                    alert("CEP não encontrado.");
                }
            });
        }
        else {
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    }
    else {
        limpa_formulário_cep();
    }
});
//VIACEP FIM
</script>
@endsection
