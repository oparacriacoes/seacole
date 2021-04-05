@extends('layouts.app_new')
@section('content')

<div class="app-main__inner">
  <div class="main-card mb-3 card">
    <div class="card-header">
        <div class="col-md-3">
            <a href="{{route('normalize.index', ['model' => 'pacientes'])}}">Pacientes</a>
        </div>
        <div class="col-md-3">
            <a href="{{route('normalize.index', ['model' => 'monitoramentos'])}}">Monitoramentos</a>
        </div>
        <div class="col-md-3">
            <a href="{{route('normalize.index', ['model' => 'servicos_internacao'])}}">Servicos Internacao</a>
        </div>
        <div class="col-md-3">
            <a href="{{route('normalize.index', ['model' => 'quadros'])}}">Quadros Atual</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    @foreach($fields as $field)
                        <th class="text-center">{{$field}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($collection as $row)
                <tr>
                    @foreach($fields as $field)
                        @if (is_array($row[$field]))
                            <td class="text-center @if($row[$field]['valid']) alert-green @elseif (!$row[$field]['valid'] && $row[$field]['new'] == 'ERROR') alert-danger @else alert-warning @endif">
                                {{ $row[$field]['old'] }}
                                <br/>
                                {{ $row[$field]['new'] }}
                            </td>
                        @else
                            <td class="text-center">
                                @if($field == 'paciente_id' || ($modelKey == 'pacientes' && $field == 'id'))
                                    <a href="{{route('paciente/edit', $row[$field])}}" target="_blank" rel="noopener noreferrer">
                                        {{$row[$field]}}
                                    </a>
                                @else
                                    {{$row[$field]}}
                                @endif
                            </td>
                        @endif
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>

</div>
@endsection
