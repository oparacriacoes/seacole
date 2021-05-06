@extends('layouts.app')

@section('content')
    <div class="app-main__inner">
      <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-syringe text-success">
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

                  </div>
              </div>
          </div>
      </div>
    </div>
@endsection
