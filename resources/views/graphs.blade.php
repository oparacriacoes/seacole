@extends('layouts.app_new')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Gráficos
                        <!--<div class="page-title-subheading">This is an example dashboard created using build-in elements and components.</div>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          <!-- CASOS MONITORADOS - INÍCIO -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                            NOVOS CASOS MONITORADOS
                        </div>
                    </div>
                    <div class="card-body">
                      <div id="casos_monitorados" style="height: 300px;"></div>
                      @linechart('Casos Monitorados', 'casos_monitorados')
                    </div>
                </div>
            </div>
            <!-- CASOS MONITORADOS - FIM -->

            <!-- MONITORADOS X EXCLUSIVO PSICOLOGIA - INÍCIO -->
              <div class="col-md-12 col-lg-6">
                  <div class="mb-3 card">
                      <div class="card-header-tab card-header-tab-animation card-header">
                          <div class="card-header-title">
                                MONITORADOS X EXCLUSIVO PSICOLOGIA
                          </div>
                      </div>
                      <div class="card-body">
                        <div id="monitorado_exclusivo_psicologia" style="height: 300px;"></div>
                        @donutchart('MonitoradosExclusivoPsicologia', 'monitorado_exclusivo_psicologia')
                      </div>
                  </div>
              </div>
              <!-- MONITORADOS X EXCLUSIVO PSICOLOGIA - FIM -->

              <!-- MONITORAMENTO X CADASTRADO (2) - INÍCIO -->
                <div class="col-md-12 col-lg-6">
                    <div class="mb-3 card">
                        <div class="card-header-tab card-header-tab-animation card-header">
                            <div class="card-header-title">
                                  SITUAÇÃO TOTAL DE CASOS MONITORADOS
                            </div>
                        </div>
                        <div class="card-body">
                          <div id="situacao_total_casos_monitorados" style="height: 300px;"></div>
                          @donutchart('SituacaoTotalCasosMonitorados', 'situacao_total_casos_monitorados')
                        </div>
                    </div>
                </div>
                <!-- MONITORAMENTO X CADASTRADO (2) - FIM -->

                <!-- MONITORAMENTO X CADASTRADO (3) - INÍCIO -->
                  <div class="col-md-12 col-lg-6">
                      <div class="mb-3 card">
                          <div class="card-header-tab card-header-tab-animation card-header">
                              <div class="card-header-title">
                                    SITUAÇÃO TOTAL DE CASOS MONITORADOS
                              </div>
                          </div>
                          <div class="card-body">
                            <div id="situacao_total_casos_monitorados_1" style="height: 300px;"></div>
                            @columnchart('SituacaoTotalCasosMonitorados1', 'situacao_total_casos_monitorados_1')
                          </div>
                      </div>
                  </div>
                  <!-- MONITORAMENTO X CADASTRADO (3) - FIM -->

                  <!-- MUNICÍPIOS - INÍCIO -->
                    <div class="col-md-12 col-lg-6">
                        <div class="mb-3 card">
                            <div class="card-header-tab card-header-tab-animation card-header">
                                <div class="card-header-title">
                                      MUNICÍPIOS - SEM MONITORAMENTO
                                </div>
                                <!--<ul class="nav">
                                    <li class="nav-item"><a href="javascript:void(0);" class="active nav-link">Last</a></li>
                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link second-tab-toggle">Current</a></li>
                                </ul>-->
                            </div>
                            <div class="card-body">
                              <div id="municipios" style="height: 300px;"></div>
                              @donutchart('Municipios', 'municipios')
                            </div>
                        </div>
                    </div>
                    <!-- MUNICÍPIOS - FIM -->
        </div>
    </div>
@endsection

@section('script')
@endsection
