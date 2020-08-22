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
                  </div>    </div>
          </div>
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

          </ul>
          <div class="tab-content">
              <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                  <div class="main-card mb-3 card">
                      <div class="card-body">
                          <h5 class="card-title">SITUAÇÃO DO CASO</h5>
                          <form class="">
                              <div class="form-row">
                                  <div class="col-12 col-md-3">
                                      <div class="form-group">
                                          <label for="name">Data início sintomas *</label>
                                          <input name="data_nascimento" type="text" class="date required form-control" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-3">
                                      <div class="form-group">
                                          <label for="name">Data início monitoramento *</label>
                                          <input name="data_nascimento" type="text" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-3">
                                      <div class="form-group">
                                          <label for="name">Data de finalização do caso (alta) *</label>
                                          <input name="data_nascimento" type="text" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="position-relative form-group">
                                          <label for="exampleCustomSelect" class="">
                                              SITUAÇÃO
                                          </label>
                                          <select type="select" id="exampleCustomSelect" name="customSelect" class="custom-select">
                                              <option value="">Selecione</option>
                                              <option>Caso ativo GRAVE</option>
                                              <option>Caso ativo LEVE</option>
                                              <option>Contato com caso confirmado - ativo</option>
                                              <option>Outras situações (sem relação com COVID-19) - ativos</option>
                                              <option>Caso finalizado GRAVE</option>
                                              <option>Caso finalizado LEVE</option>
                                              <option>Contato com caso confirmado - finalizado</option>
                                              <option>Outras situações (sem relação com COVID-19) - finalizado</option>
                                              <option>Monitoramento encerrado - segue apenas com psicólogos</option>
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
                                          <select type="select" id="exampleCustomSelect" name="customSelect" class="custom-select">
                                              <option value="">Selecione</option>
                                              <option>Value 1</option>
                                              <option>Value 2</option>
                                              <option>Value 3</option>
                                              <option>Value 4</option>
                                              <option>Value 5</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="position-relative form-group">
                                          <label for="exampleCustomSelect" class="">
                                              Médica Responsável
                                          </label>
                                          <select type="select" id="exampleCustomSelect" name="customSelect" class="custom-select">
                                              <option value="">Selecione</option>
                                              <option>Value 1</option>
                                              <option>Value 2</option>
                                              <option>Value 3</option>
                                              <option>Value 4</option>
                                              <option>Value 5</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="position-relative form-group">
                                          <label for="exampleCustomSelect" class="">
                                              Psicóloga Responsável
                                          </label>
                                          <select type="select" id="exampleCustomSelect" name="customSelect" class="custom-select">
                                              <option value="">Selecione</option>
                                              <option>Value 1</option>
                                              <option>Value 2</option>
                                              <option>Value 3</option>
                                              <option>Value 4</option>
                                              <option>Value 5</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="position-relative form-group">
                                          <label for="exampleCustomSelect" class="">
                                              Articuladora Responsável
                                          </label>
                                          <select type="select" id="exampleCustomSelect" name="customSelect" class="custom-select">
                                              <option value="">Selecione</option>
                                              <option>Débora</option>
                                              <option>Luciana</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>

                  <div class="main-card mb-3 card">
                      <div class="card-body">
                          <h5 class="card-title">DADOS DE IDENTIFICAÇÃO</h5>
                          <form class="">

                              <div class="form-row">
                                  <div class="col-md-6">
                                      <div class="position-relative form-group">
                                          <label for="exampleEmail11" class="">
                                          Nome Completo (obrigatório)
                                          </label>
                                          <input name="email" id="exampleEmail11" placeholder="Nome Completo" type="text" class="form-control">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="position-relative form-group">
                                          <label for="exampleEmail11" class="">
                                          Nome Social
                                          </label>
                                          <input name="email" id="exampleEmail11" placeholder="Nome Social" type="text" class="form-control">
                                      </div>
                                  </div>
                              </div>

                              <div class="form-row">
                                  <div class="col-md-4">
                                      <div class="position-relative form-group">
                                          <label for="exampleEmail11" class="">
                                              Telefone fixo
                                          </label>
                                          <input name="email" id="exampleEmail11" placeholder="Somente número e com DDDD" type="text" class="form-control phone_with_ddd">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="position-relative form-group">
                                          <label for="exampleEmail11" class="">
                                              Telefone celular
                                          </label>
                                          <input name="email" id="exampleEmail11" placeholder="Somente número e com DDDD" type="text" class="form-control mobile_with_ddd">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="position-relative form-group">
                                          <label for="examplePassword11" class="">
                                              Data de Nascimento
                                          </label>
                                          <input name="data_nascimento" type="text" placeholder="Data de Nascimento" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>
                              </div>

                              <div class="form-row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="name">Responsável</label>
                                          <input name="data_nascimento" type="text" class="required form-control ddate" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="name">Email</label>
                                          <input name="data_nascimento" type="text" class="required form-control ddate" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="name">CEP</label>
                                          <input name="data_nascimento" placeholder="Somente números" type="text" class="required form-control cep" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>
                              </div>


                              <div class="form-row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="name">Logradouro</label>
                                          <input name="data_nascimento" type="text" class="required form-control ddate" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>

                                  <div class="col-md-2">
                                      <div class="form-group">
                                          <label for="name">Número</label>
                                          <input name="data_nascimento" type="text" class="required form-control ddate" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="name">Complemento</label>
                                          <input name="data_nascimento" type="text" class="required form-control ddate" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>
                              </div>


                              <div class="form-row">
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label for="name">Bairro</label>
                                          <input name="data_nascimento" type="text" class="required form-control ddate" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>

                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label for="name">Cidade</label>
                                          <input name="data_nascimento" type="text" class="required form-control ddate" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group">
                                          <label for="name">UF</label>
                                          <input name="data_nascimento" type="text" class="required form-control ddate" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="name">Ponto de referência</label>
                                          <input name="data_nascimento" type="text" class="required form-control ddate" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>
                              </div>


                              <div class="form-row">
                                  <div class="col-md-4">
                                      <div class="position-relative form-group">
                                          <label for="exampleCustomSelect" class="">
                                              Identidade de genero
                                          </label>
                                          <select type="select" id="exampleCustomSelect" name="customSelect" class="custom-select">
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
                                          <select type="select" id="exampleCustomSelect" name="customSelect" class="custom-select">
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
                                          <select type="select" id="exampleCustomSelect" name="customSelect" class="custom-select">
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
                                              <input name="data_nascimento" type="text" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label for="name">Recebe auxílio emergencial</label>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label for="name">Valor exato da renda familiar</label>
                                              <input name="data_nascimento" type="text" placeholder="0.000,00" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </form>
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
                                      <select type="select" id="exampleCustomSelect" name="customSelect" class="custom-select">
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
                                      <input name="data_nascimento" placeholder="Data do teste confirmatório" type="text" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                  </div>
                              </div>
                              <div class="col-md-3">
                              <div class="position-relative form-group"><label for="exampleCustomMutlipleSelect" class="">
                                  Testes realizados?
                                  
                              </label>
                              <select multiple="" type="select" id="exampleCustomMutlipleSelect" name="customSelect" class="custom-select">
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
                                      <select type="select" id="exampleCustomSelect" name="customSelect" class="custom-select">
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
                                      <textarea name="text" placeholder="ex: repetiu teste, novas datas de testes, etc" id="exampleText" class="form-control"></textarea>
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
                                          <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input">
                                              <label class="custom-control-label" for="exampleCustomInline">
                                                  Hipertensão arterial sistêmica (HAS)
                                              </label>
                                          </div>
                                          <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input">
                                              <label class="custom-control-label" for="exampleCustomInline">
                                                  Diabetes Mellitus (DM)
                                              </label>
                                          </div>
                                          <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input">
                                              <label class="custom-control-label" for="exampleCustomInline">
                                                  Dislipidemia 
                                              </label>
                                          </div>
                                          <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input">
                                              <label class="custom-control-label" for="exampleCustomInline">
                                                  Asma / Bronquite
                                              </label>
                                          </div>
                                          <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input">
                                              <label class="custom-control-label" for="exampleCustomInline">
                                                  Tuberculose ativa
                                              </label>
                                          </div>
                                          <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input">
                                              <label class="custom-control-label" for="exampleCustomInline">
                                                  Cardiopatias e outras doenças cardiovasculares
                                              </label>
                                          </div>
                                          <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input">
                                              <label class="custom-control-label" for="exampleCustomInline">
                                                  Outras doenças Respiratórias
                                              </label>
                                          </div>
                                          <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input">
                                              <label class="custom-control-label" for="exampleCustomInline">
                                                  Artrite/Artrose/Reumatismo
                                              </label>
                                          </div>
                                          <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input">
                                              <label class="custom-control-label" for="exampleCustomInline">
                                                  Doença autoimune
                                              </label>
                                          </div>
                                          <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input">
                                              <label class="custom-control-label" for="exampleCustomInline">
                                                  Doença renal
                                              </label>
                                          </div>
                                          <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input">
                                              <label class="custom-control-label" for="exampleCustomInline">
                                                  Doença neurológica
                                              </label>
                                          </div>
                                          <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input">
                                              <label class="custom-control-label" for="exampleCustomInline">
                                                  Câncer
                                              </label>
                                          </div>
                                          <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input">
                                              <label class="custom-control-label" for="exampleCustomInline">
                                                  Ansiedade
                                              </label>
                                          </div>
                                          <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input">
                                              <label class="custom-control-label" for="exampleCustomInline">
                                                  Depressão
                                              </label>
                                          </div>
                                          <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input">
                                              <label class="custom-control-label" for="exampleCustomInline">
                                                  Demência
                                              </label>
                                          </div>
                                          <div class="custom-checkbox custom-control custom-control-inline"><input type="checkbox" id="exampleCustomInline" class="custom-control-input">
                                              <label class="custom-control-label" for="exampleCustomInline">
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
                                      <textarea name="text" placeholder="(ex: qual doença neurológica) e outras condições de saúde:" id="exampleText" class="form-control"></textarea>
                                  </div>
                              </div>

                              <div class="form-row">
                                  <div class="col-md-3">
                                      <div class="position-relative form-group">
                                          <div class="form-group">
                                              <label for="name">Já teve tuberculose?</label>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="position-relative form-group">
                                          <div class="form-group">
                                              <label for="name">É tabagista?</label>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                          </div>
                                      </div>
                                  </div> 
                                  <div class="col-md-3">
                                      <div class="position-relative form-group">
                                          <div class="form-group">
                                              <label for="name">Faz uso crônico de alcool?</label>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                          </div>
                                      </div>
                                  </div> 
                                  <div class="col-md-3">
                                      <div class="position-relative form-group">
                                          <div class="form-group">
                                              <label for="name">Faz uso crônico de outras drogas?</label>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
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
                                          <input name="email" id="exampleEmail11" placeholder="Qual(is)?" type="text" class="form-control">
                                      </div>
                                  </div>
                              </div>



                              <div class="form-row">
                                  <div class="col-md-3">
                                      <div class="position-relative form-group">
                                          <div class="form-group">
                                              <label for="name">Está gestante?</label>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-md-2">
                                      <div class="position-relative form-group">
                                          <div class="form-group">
                                              <label for="name">Amamenta?</label>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                          </div>
                                      </div>
                                  </div> 

                                  <div class="col-md-3">
                                      <div class="position-relative form-group">
                                          <div class="form-group">
                                              <label for="name">Gestação é ou foi de alto risco?</label>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="position-relative form-group">
                                          <div class="form-group">
                                              <label for="name">Está no pós-parto (40 dias após o parto)?</label>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
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
                                          <input name="email" id="exampleEmail11" placeholder="00/00/0000" type="text" class="form-control">
                                      </div>
                                  </div> 

                                  <div class="col-md-3">
                                      <div class="position-relative form-group">
                                          <label for="exampleEmail11" class="">
                                              Data da última menstruação (DUM)
                                          </label>
                                          <input name="email" id="exampleEmail11" placeholder="00/00/0000" type="text" class="form-control">
                                      </div>
                                  </div> 

                                  <div class="col-md-4">
                                      <div class="position-relative form-group">
                                          <label for="exampleCustomSelect" class="">
                                              Trimestre da gestação no início do monitoramento
                                          </label>
                                          <select type="select" id="exampleCustomSelect" name="customSelect" class="custom-select">
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
                                          <input name="email" id="exampleEmail11" placeholder="Qual(is)?" type="text" class="form-control">
                                      </div>
                                  </div>
                              </div>

                              <div class="form-row">
                                  <div class="col-md-3">
                                      <div class="position-relative form-group">
                                          <div class="form-group">
                                              <label for="name">Tem algum acompanhamento médico contínuo?</label>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="position-relative form-group">
                                          <label for="exampleEmail11" class="">
                                              Qual a data da última consulta médica?
                                          </label>
                                          <input name="data" placeholder="00/00/0000" type="text" class="form-control date">
                                      </div>
                                  </div>

                                  <div class="col-md-3">
                                      <div class="position-relative form-group">
                                          <label for="exampleCustomSelect" class="">
                                              Onde/como acessa o sistema de saúde?
                                          </label>
                                          <select multiple="" type="select" id="exampleCustomMutlipleSelect" name="customSelect" class="custom-select">
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
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                              <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                          </div>
                                      </div>
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


              <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                  <div class="main-card mb-3 card">
                      <div class="card-body"><h5 class="card-title">Quadro atual</h5>
                          <form class="">
                              <div class="form-row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="name">Primeiros sintomas</label>
                                          <textarea name="text" placeholder="descreva a evolução dos sintomas do início do quadro até o primeiro registro" id="exampleText" class="form-control"></textarea>
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
                                              <input name="sintomas[]" class="form-check-input" id="febre" type="checkbox" value="febre">
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
                                              <input name="sintomas[]" class="form-check-input" id="sonolencia" type="checkbox" value="sonolência">
                                              <label class="form-check-label" for="sonolencia">Diarréia</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="sonolencia" type="checkbox" value="sonolência">
                                              <label class="form-check-label" for="sonolencia">Aumento da pressão</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="sonolencia" type="checkbox" value="sonolência">
                                              <label class="form-check-label" for="sonolencia">Queda brusca de Pressão</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="pressao_baixa" type="checkbox" value="pressão baixa">
                                              <label class="form-check-label" for="pressao_baixa">Dor torácica (dor no peito) </label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="falta_de_ar" type="checkbox" value="falta de ar">
                                              <label class="form-check-label" for="falta_de_ar">Sonolência ou cansaço importantes</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="falta_de_ar" type="checkbox" value="falta de ar">
                                              <label class="form-check-label" for="falta_de_ar">Confusão mental</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="falta_de_ar" type="checkbox" value="falta de ar">
                                              <label class="form-check-label" for="falta_de_ar">Desmaio</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="falta_de_ar" type="checkbox" value="falta de ar">
                                              <label class="form-check-label" for="falta_de_ar">Convulsão</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="falta_de_ar" type="checkbox" value="falta de ar">
                                              <label class="form-check-label" for="falta_de_ar">Outros</label>
                                          </div>
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
                                          <input name="data_nascimento" type="text" placeholder="00,0" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                      <div class="form-group">
                                          <label for="name">Data temperatura máxima</label>
                                          <input name="data_nascimento" type="text" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="name">Saturação mais baixa registrada (%)</label>
                                          <input name="data_nascimento" type="text" placeholder="00 %" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                      <div class="form-group">
                                          <label for="name">Data da saturação mais baixa</label>
                                          <input name="data_nascimento" type="text" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="name">Frequência respiratória máxima</label>
                                          <input name="data_nascimento" type="text" placeholder="respirações por minuto - rpm" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                      <div class="form-group">
                                          <label for="name">Data da Frequência respiratória máxima</label>
                                          <input name="data_nascimento" type="text" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                      </div>
                                  </div>
                              </div>
                              <div class="pos2ition-relative row form-chec2k">
                                  <div class="col-sm-12 2offset-sm-2">
                                      <button class="btn btn-secondary">Salvar</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>

              <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
                  <div class="main-card mb-3 card">
                      <div class="card-body"><h5 class="card-title">Monitoramento</h5>
                          <div class="form-row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="name">Horário do monitoramento</label>
                                      <input name="data_nascimento" type="text" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="name">Sintomas atuais</label><br />
                                      <div class="form-check form-check-inline">
                                          <input name="sintomas[]" class="form-check-input" id="tosse" type="checkbox" value="tosse">
                                          <label class="form-check-label" for="tosse">Tosse</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                          <input name="sintomas[]" class="form-check-input" id="febre" type="checkbox" value="febre">
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
                                          <input name="sintomas[]" class="form-check-input" id="falta_de_ar" type="checkbox" value="falta de ar">
                                          <label class="form-check-label" for="falta_de_ar">Outros</label>
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
                                      <input name="data_nascimento" type="text" placeholder="00,0" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                  </div>
                                  <div class="form-group">
                                      <label for="name">Frequência cardíaca atual</label>
                                      <input name="data_nascimento" type="text" placeholder="-- bpm" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                  </div>
                                  <div class="form-group">
                                      <label for="name">Algum sinal de gravidade nesse monitoramento?</label>
                                      <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                      <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="name">Saturação atual (%)</label>
                                      <input name="data_nascimento" type="text" placeholder="00 %" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                  </div>
                                  <div class="form-group">
                                      <label for="name">Pressão Arterial Atual</label>
                                      <input name="data_nascimento" type="text" placeholder="Ex: 12x8" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                  </div>
                                  <div class="form-group">
                                      <label for="name">Equipe médica do projeto prescreveu algum medicamento?</label>
                                      <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                      <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="name">Frequência respiratória atual</label>
                                      <input name="data_nascimento" type="text" placeholder="-- rpm" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
                                  </div>
                                  <div class="form-group">
                                      <label for="name">Medicamento prescrito pela equipe médica do projeto</label>
                                      <textarea name="text" id="exampleText" class="form-control"></textarea>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="main-card mb-3 card">
                      <div class="card-body">
                          <form class="">
                              <div class="form-row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="name">Fazendo uso de alguma PIC (prática integrativa complementar - ex: medicina chinesa)?</label>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="name">Fez escaldapés (atenção para restrições - ex: gestantes e diabeticos)</label>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Sim</label></div>
                                          <div class="position-relative1 form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Não</label></div>
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
                          </form>
                      </div>
                  </div>
              </div>



              <div class="tab-pane tabs-animation fade" id="tab-content-3" role="tabpanel">
                  <div class="main-card mb-3 card">
                      <div class="card-body"><h5 class="card-title">Saúde mental</h5>
                          <form class="">
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
                                          <textarea name="text" id="exampleText" class="form-control"></textarea>
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
                          <form class="">
                              <div class="form-row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="name">A pessoa precisou ir a algum serviço de saúde?</label><br />
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="tosse" type="checkbox" value="tosse">
                                              <label class="form-check-label" for="tosse">UBS (Unidade Básica de Saúde - posto de saúde)</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="febre" type="checkbox" value="febre">
                                              <label class="form-check-label" for="febre">UPA (Unidade de Pronto Atendimento)</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="febre" type="checkbox" value="febre">
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
                                              <input name="doenca_cronica[]" class="form-control" type="text" placeholder="outro (qual?)">
                                              </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="name">Quantas idas a serviços de saúde?</label>
                                          <input name="data_nascimento" type="text" placeholder="somente números" class="required form-control date" id="data_nascimento" aria-describedby="data_nascimentoHelp">
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
                                              <input name="sintomas[]" class="form-check-input" id="tosse" type="checkbox" value="tosse">
                                              <label class="form-check-label" for="tosse">Azitromicina</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="febre" type="checkbox" value="febre">
                                              <label class="form-check-label" for="febre">Outro antibiótico</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="febre" type="checkbox" value="febre">
                                              <label class="form-check-label" for="febre">Ivermectina</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" type="checkbox" value="dor de cabeça">
                                              <label class="form-check-label" for="inlineCheckbox3">Cloroquina/Hidroxicloroquina</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" type="checkbox" value="perda de olfato">
                                              <label class="form-check-label" for="inlineCheckbox3">Oseltamivir (Tamiflu)</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" type="checkbox" value="perda do paladar">
                                              <label class="form-check-label" for="inlineCheckbox3">Algum antialérgico</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" type="checkbox" value="perda do paladar">
                                              <label class="form-check-label" for="inlineCheckbox3">Algum corticóide</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" type="checkbox" value="perda do paladar">
                                              <label class="form-check-label" for="inlineCheckbox3">Algum antiinflamatório</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" type="checkbox" value="perda do paladar">
                                              <label class="form-check-label" for="inlineCheckbox3">Vitamina D</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" type="checkbox" value="perda do paladar">
                                              <label class="form-check-label" for="inlineCheckbox3">Zinco</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" type="checkbox" value="perda do paladar">
                                              <label class="form-check-label" for="inlineCheckbox3">Outro medicamento</label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="name">Escreva o nome do medicamento prescrito</label>
                                          <textarea name="text" id="exampleText" class="form-control"></textarea>
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
                                              <input name="sintomas[]" class="form-check-input" id="tosse" type="checkbox" value="tosse">
                                              <label class="form-check-label" for="tosse">UBS (Unidade Básica de Saúde - posto de saúde)</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="febre" type="checkbox" value="febre">
                                              <label class="form-check-label" for="febre">UPA (Unidade de Pronto Atendimento)</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="febre" type="checkbox" value="febre">
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
                                              <input name="sintomas[]" class="form-check-input" id="tosse" type="checkbox" value="tosse">
                                              <label class="form-check-label" for="tosse">Hospital público de referência</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="febre" type="checkbox" value="febre">
                                              <label class="form-check-label" for="febre">Hospital de campanha</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="febre" type="checkbox" value="febre">
                                              <label class="form-check-label" for="febre">Hospital particular de referência</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" type="checkbox" value="dor de cabeça">
                                              <label class="form-check-label" for="inlineCheckbox3">Hospital municipal do Ipiranga (encaminhado pelo projeto)</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" type="checkbox" value="perda de olfato">
                                              <label class="form-check-label" for="inlineCheckbox3">Hospital privado financiado pelo projeto</label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="name">Nome do Hospital de internação</label>
                                          <input name="email" id="exampleEmail11" type="text" class="form-control">
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group">
                                          <label for="name">tempo de internação</label>
                                          <input name="email" id="exampleEmail11" placeholder="em dias - número" type="text" class="form-control">
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


              <div class="tab-pane tabs-animation fade" id="tab-content-5" role="tabpanel">
                  <div class="main-card mb-3 card">
                      <div class="card-body">
                          <h5 class="card-title">Insumos Oferecidos pelo Projeto</h5>
                          <form class="">
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
                                              <input name="sintomas[]" class="form-check-input" id="tosse" type="checkbox" value="tosse">
                                              <label class="form-check-label" for="tosse">Comprar remédios de uso contínuo</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="febre" type="checkbox" value="febre">
                                              <label class="form-check-label" for="febre">Comprar remédios para o tratamento do quadro atual</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="febre" type="checkbox" value="febre">
                                              <label class="form-check-label" for="febre">Comprar alimento ou outro produtos de necessidade básica</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" type="checkbox" value="dor de cabeça">
                                              <label class="form-check-label" for="inlineCheckbox3">Outros</label>
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
                                              <input name="sintomas[]" class="form-check-input" id="tosse" type="checkbox" value="tosse">
                                              <label class="form-check-label" for="tosse">Alopático (medicamentos convencionais)</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input name="sintomas[]" class="form-check-input" id="febre" type="checkbox" value="febre">
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

                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
@endsection
