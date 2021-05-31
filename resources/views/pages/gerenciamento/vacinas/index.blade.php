@extends('layouts.app')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-syringe text-primary">
                    </i>
                </div>
                <div>Vacinas</div>
            </div>
            <div class="page-title-actions">
                <a href="{{route('vacinas.create')}}" role="button" data-toggle="tooltip" title="" data-placement="bottom" class="btn-shadow mr-3 btn btn-primary" data-original-title="Adicionar Nova Vácina">
                    <i class="fa fa-plus-circle"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Doses</th>
                                <th scope="col">Intevalo</th>
                                <th scope="col">Está Ativo</th>
                                <th scope="col">Inserido em</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vacinas as $vacina)
                            <tr>
                                <td>{{$vacina->name}}</td>
                                <td>{{$vacina->doses}}</td>
                                <td>
                                @if($vacina->doses == 1)
                                    Dose única
                                @else
                                    Entre {{$vacina->intervalo_inicial_proxima_dose}} e {{$vacina->intervalo_final_proxima_dose}} dias
                                @endif
                                </td>
                                <td>{{$vacina->is_active ? 'Sim' : 'Não'}}</td>
                                <td>{{$vacina->created_at->format('d/m/Y')}}</td>
                                <td><a href="{{route('vacinas.show', $vacina)}}" role="button" class="btn btn-primary">Ver</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
