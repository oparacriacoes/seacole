<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('admin') }}" class="nav-link">Home</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <!--<li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="#" class="dropdown-item">
          <div class="media">
            <img src="{{ asset('/bower_components/admin-lte/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Brad Diesel
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">Call me whenever you can...</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <div class="media">
            <img src="{{ asset('/bower_components/admin-lte/dist/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                John Pierce
                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">I got your message bro</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <div class="media">
            <img src="{{ asset('/bower_components/admin-lte/dist/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Nora Silvester
                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">The subject goes here</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
      </div>
    </li>-->

    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if(\Auth::user()->role === 'agente')
        <span class="badge badge-warning navbar-badge"><?php echo count(\Auth::user()->agente->unreadNotifications); ?></span>
        @else
        <span class="badge badge-warning navbar-badge">0</span>
        @endif
      </a>
      <div class="dropdown-menu notifications-dropdown dropdown-menu-right">
        <span class="dropdown-header">Notificações</span>
        <div class="dropdown-divider"></div>
        <!--<a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 new messages
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>-->
        <!--<div class="dropdown-divider"></div>-->
        <!--<a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 8 friend requests
          <span class="float-right text-muted text-sm">12 hours</span>
        </a>-->
        <!--<div class="dropdown-divider"></div>-->
        @if(\Auth::user()->role === 'agente')
        @foreach(\Auth::user()->agente->unreadNotifications as $notification)
        <a href="{{ route('paciente/notify/dismiss', [$notification->id,$notification->data['paciente_id']]) }}" class="dropdown-item">
          <i class="fas fa-check-circle mr-2"></i> {{ \App\Paciente::find($notification->data['paciente_id'])->user->name }}
          <span class="float-right text-muted text-sm">{{ $notification->data['action'] }}</span>
        </a>
        <div class="pl-2 pr-2">
          <div class="dropdown-divider"></div>
        </div>
        @endforeach
        @endif
        <!--<a href="#" class="dropdown-item dropdown-footer">Ver tudo</a>-->
      </div>
    </li>

    @if(strpos(\Request::path(), 'admin/paciente/edit') !== false)
    <li class="nav-item">
      @if(isset($items))
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-tasks" style="color: #007bff;"></i></a>
      @else
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-tasks" style="color: #dc3545;"></i></a>
      @endif
    </li>
    @endif
  </ul>
</nav>
<!-- /.navbar -->
