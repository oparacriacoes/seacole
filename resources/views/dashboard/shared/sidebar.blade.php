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
    </div>

    <div class="scrollbar-sidebar ps">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu metismenu">
                <li class="app-sidebar__heading">Pacientes</li>
                <li>
                    <a href="{{ route('pacientes.index') }}">
                        <i class="metismenu-icon fas fa-procedures nav-icon"></i>
                        Todos
                    </a>
                    <a href="{{ route('pacientes.create') }}">
                        <i class="metismenu-icon fa fa-plus-circle nav-icon"></i>
                        Novo Paciente
                    </a>
                    @if(Auth::user()->is_admin)
                    <a href="{{ route('pacientes.exportar') }}">
                        <i class="metismenu-icon fas fa-file-export nav-icon"></i>
                        Exportar
                    </a>
                    @endif
                </li>

                @if(Auth::user()->is_admin)
                <li class="app-sidebar__heading">Gerenciamento</li>
                <li>
                    <a href="{{ route('agentes.index') }}">
                        <i class="metismenu-icon fas fa-medkit nav-icon""></i>
                                    Agentes
                                </a>
                            </li>
                            <li>
                                <a href=" {{ route('medicos.index') }}">
                            <i class="metismenu-icon fas fa-stethoscope nav-icon"></i>
                            Médicas/os
                    </a>
                </li>
                <li>
                    <a href="{{ route('psicologos.index') }}">
                        <i class="metismenu-icon fas fa-hands-helping"></i>
                        Psicólogas/os
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </div>

</div>
