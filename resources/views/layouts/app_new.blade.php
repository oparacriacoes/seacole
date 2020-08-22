<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Seacole</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Projeto Seacole, mais descrição em breve...">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{ asset('assets/main.css') }}" rel="stylesheet">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/2.9.0/jquery.serializejson.min.js" defer></script>

    <script type="text/javascript" src="{{ asset('js/jquery.mask.js') }}" defer></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}" defer></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.css">

    <script>
        const API_URL = "{{ env("APP_URL") }}" + "/api";
        const APP_URL = "{{ env("APP_URL") }}";      
    </script>  
    <script type="text/javascript" src="{{ asset('js/functions.js') }}" defer></script>
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-srcw">
                    <a href="{{ route('admin') }}">
                        <h2>Seacole</h2>
                    </a>
                </div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    
            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-database"> </i>
                                Calendário
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-edit"></i>
                                Estoque de kit
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-cog"></i>
                                Contatos
                            </a>
                        </li>
                    </ul>        
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="assets/images/avatars/maryseacole.png" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <button type="button" tabindex="0" class="dropdown-item">User Account</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </div>
                                    <div class="widget-subheading">
                                        Enfermeira
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>        </div>
            </div>
        </div>
        <style>
        .vertical-nav-menu i.metismenu-state-icon, .vertical-nav-menu i.metismenu-icon {
            position: relative;
        }
        </style>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>    <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <!-- Pacientes -->
                            <li class="app-sidebar__heading">
                                <i class="fas metismenu-state-icon fa-procedures nav-icon"></i> Pacientes</li>
                            <li>
                                <a href="{{ route('paciente') }}">
                                    <i class="fa fa-list-ul nav-icon caret-left"></i>
                                    Listar
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('paciente/add') }}">
                                    <i class="fa fa-plus-circle nav-icon caret-left"></i>
                                    Cadastrar
                                </a>
                            </li>
                            <!-- Agentes -->
                            <li class="app-sidebar__heading"><i class="fas metismenu-state-icon fa-medkit nav-icon"></i> Agentes</li>
                            <li>
                                <a href="index.html">
                                    <i class="fa fa-list-ul nav-icon caret-left"></i>
                                    Listar
                                </a>
                            </li>
                            <li>
                                <a href="index.html">
                                    <i class="fa fa-plus-circle nav-icon caret-left"></i>
                                    Cadastrar
                                </a>
                            </li>
                            <!-- Médicas/os -->
                            <li class="app-sidebar__heading"><i class="fas metismenu-state-icon fa-stethoscope nav-icon"></i> Médicas/os</li>
                            <li>
                                <a href="index.html">
                                    <i class="fa fa-list-ul nav-icon caret-left"></i>
                                    Listar
                                </a>
                            </li>
                            <li>
                                <a href="index.html">
                                    <i class="fa fa-plus-circle nav-icon caret-left"></i>
                                    Cadastrar
                                </a>
                            </li>
                            <!-- Psicólogas/os -->
                            <li class="app-sidebar__heading"><i class="fas metismenu-state-icon fa-hands-helping nav-icon"></i> Psicólogas/os</li>
                            <li>
                                <a href="index.html">
                                    <i class="fa fa-list-ul nav-icon caret-left"></i>
                                    Listar
                                </a>
                            </li>
                            <li>
                                <a href="index.html">
                                    <i class="fa fa-plus-circle nav-icon caret-left"></i>
                                    Cadastrar
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>  
            <div class="app-main__outer">
                <main class="py-4">
                    @yield('content')
                </main>
                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-left">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Agentes Populares de Saúde
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Uneafro
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="app-footer-right">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Instituto Peregum
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            FAQ
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://seacole.uneafrobrasil.org/js/jquery.mask.js"></script>
    <script>
        //JQUERY MASKS
      $('.date').mask('00/00/0000');
      //$('.time').mask('00:00:00');
      $('.time').mask('00:00');
      //$('.date_time').mask('00/00/0000 00:00:00');
      $('.cep').mask('00000-000');
      //$('.phone').mask('0000-0000');
      $('.phone_with_ddd').mask('(00) 0000-0000');
      $('.mobile_with_ddd').mask('(00) 0 0000-0000');
      //$('.mixed').mask('AAA 000-S0S');
      //$('.cpf').mask('000.000.000-00', {reverse: true});
      //$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
      $('.money').mask('000.000.000.000.000,00', {reverse: true});
      //$('.money2').mask("#.##0,00", {reverse: true});
      /*$('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
        translation: {
          'Z': {
            pattern: /[0-9]/, optional: true
          }
        }
      });*/
      //$('.ip_address').mask('099.099.099.099');
      //$('.percent').mask('##0,00%', {reverse: true});
      //$('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
      //$('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
      /*$('.fallback').mask("00r00r0000", {
          translation: {
            'r': {
              pattern: /[\/]/,
              fallback: '/'
            },
            placeholder: "__/__/____"
          }
        });*/
      //$('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
    </script>
    <script type="text/javascript" src="{{ asset('assets/scripts/main.js') }}"></script>
</body>
</html>
