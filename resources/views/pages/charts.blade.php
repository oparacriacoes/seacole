@extends('layouts.app')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph3 text-primary">
                    </i>
                </div>
                <div>Gráficos
                    <div class="page-title-subheading">Veja as informações algum texto aqui depois pois estou sem criatividade //TODO</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <form action="">
                        <div class="form-row">
                            <div class="col-md-7">
                                <div class="position-relative form-group">
                                    <label for="chart" class="">Gráfico</label>
                                    <x-forms.select property="chart" value="1" :items="$charts"/>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="periodo_de" class="">De</label>
                                    <input name="password" id="periodo_de" name="pedriodo_de" type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="periodo_ate" class="">Até</label>
                                    <input name="password" id="periodo_ate" name="pedriodo_ate" type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative form-group">
                                    <label for="periodo_ate" class="">&nbsp;</label>
                                    <button class="btn btn-primary btn-block">
                                        Gerar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

    </div>

</div>
@endsection
