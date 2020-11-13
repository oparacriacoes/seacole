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
                    <div>Dashboard
                        <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          <!-- GRÁFICO 1 - INÍCIO -->
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                            NOVOS CASOS MONITORADOS
                        </div>
                        <!--<ul class="nav">
                            <li class="nav-item"><a href="javascript:void(0);" class="active nav-link">Last</a></li>
                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link second-tab-toggle">Current</a></li>
                        </ul>-->
                    </div>
                    <div class="card-body">
                      <div id="casos_monitorados" style="height: 300px;"></div>
                      @linechart('Casos Monitorados', 'casos_monitorados')
                    </div>
                </div>
            </div>
            <!-- GRÁFICO 1 - FIM -->

            <!-- GRÁFICO 2 - INÍCIO -->
              <div class="col-md-12 col-lg-6">
                  <div class="mb-3 card">
                      <div class="card-header-tab card-header-tab-animation card-header">
                          <div class="card-header-title">
                                MONITORAMENTO X CADASTRADO
                          </div>
                          <!--<ul class="nav">
                              <li class="nav-item"><a href="javascript:void(0);" class="active nav-link">Last</a></li>
                              <li class="nav-item"><a href="javascript:void(0);" class="nav-link second-tab-toggle">Current</a></li>
                          </ul>-->
                      </div>
                      <div class="card-body">
                        <div id="monitoramento_cadastrado" style="height: 300px;"></div>
                        @donutchart('IMDB', 'monitoramento_cadastrado')
                      </div>
                  </div>
              </div>
              <!-- GRÁFICO 2 - FIM -->

              <!-- GRÁFICO 3 - INÍCIO -->
                <div class="col-md-12 col-lg-6">
                    <div class="mb-3 card">
                        <div class="card-header-tab card-header-tab-animation card-header">
                            <div class="card-header-title">
                                  MONITORAMENTO X CADASTRADO (2)
                            </div>
                            <!--<ul class="nav">
                                <li class="nav-item"><a href="javascript:void(0);" class="active nav-link">Last</a></li>
                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link second-tab-toggle">Current</a></li>
                            </ul>-->
                        </div>
                        <div class="card-body">
                          <div id="monitoramento_cadastrado_2" style="height: 300px;"></div>
                          @donutchart('IMDB', 'monitoramento_cadastrado_2')
                        </div>
                    </div>
                </div>
                <!-- GRÁFICO 3 - FIM -->
        </div>
    </div>
@endsection

@section('script')
@endsection
