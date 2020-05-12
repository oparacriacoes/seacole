<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('admin') }}" class="brand-link">
    <!--<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">-->
         <img src="{{ asset('/bower_components/admin-lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
    <span class="brand-text font-weight-light">Seacole</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <!--<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
        <img src="{{ asset('/bower_components/admin-lte/dist/img/user-avatar.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('admin') }}" class="d-block">{{ \Auth::user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link active">
            <i class="fas fa-procedures nav-icon"></i>
            <p>
              Pacientes
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('paciente') }}" class="nav-link">
                <i class="fas fa-list-ul nav-icon"></i>
                <p>Listar Pacientes</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('paciente/add') }}" class="nav-link">
                <i class="fas fa-plus-circle nav-icon"></i>
                <p>Cadastrar Paciente</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link active">
            <i class="fas fa-medkit nav-icon"></i>
            <p>
              Agentes
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('agente') }}" class="nav-link">
                <i class="fas fa-list-ul nav-icon"></i>
                <p>Listar Agentes</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('agente/add') }}" class="nav-link">
                <i class="fas fa-plus-circle nav-icon"></i>
                <p>Cadastrar Agente</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link active">
            <i class="fas fa-stethoscope nav-icon"></i>
            <p>
              Médicos
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('medico') }}" class="nav-link">
                <i class="fas fa-list-ul nav-icon"></i>
                <p>Listar Médicos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('medico/add') }}" class="nav-link">
                <i class="fas fa-plus-circle nav-icon"></i>
                <p>Cadastrar Médico</p>
              </a>
            </li>
          </ul>
        </li>

        <a class="btn btn-danger" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Sair') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <!--<li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Simple Link
              <span class="right badge badge-danger">New</span>
            </p>
          </a>
        </li>-->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
