<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Seacole</title>

  <!-- Font Awesome Icons -->
  <!--<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">-->
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <!--<link rel="stylesheet" href="dist/css/adminlte.min.css">-->
  <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/2.9.0/jquery.serializejson.min.js" defer></script>

  <script type="text/javascript" src="{{ asset('js/jquery.mask.js') }}" defer></script>

  <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}"/>
  <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}" defer></script>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.css">

  <script type="text/javascript" src="{{ asset('js/functions.js') }}" defer></script>
  <link rel="stylesheet" href="{{ asset('css/custom-styles.css') }}" >
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Header -->
  @include('layouts/header')

  <!-- Sidebar -->
  @include('layouts/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Starter Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div>
        </div>
      </div>
    </div>-->
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content pt-4">
      @yield('sample')
      @yield('controlSideBar')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <!--<aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>-->
  <!-- /.control-sidebar -->

  <!-- Footer -->
  @include('layouts/footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<!--<script src="plugins/jquery/jquery.min.js"></script>-->
<script src="{{ asset('/bower_components/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<!--<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>-->
<script src="{{ asset('/bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<!--<script src="dist/js/adminlte.min.js"></script>-->
<script src="{{ asset('/bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
