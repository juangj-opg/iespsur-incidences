<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Incidencias IESPSur - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href=" {{ asset('/storage/IESP_Sur_Logo.ico') }}">
    
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/1680769545.js" crossorigin="anonymous"></script>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    @yield('styles')

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    
  </head>
<body class="hold-transitio sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          
        </ul>
    
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          @guest
            <x-responsive-nav-link :href="route('login')"
                                    class="nav-link">
                {{ __('Iniciar sesión') }}
            </x-responsive-nav-link>
        @else
        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <x-responsive-nav-link :href="route('logout')"
                                  onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                  class="nav-link">
              {{ __('Cerrar sesión') }}
          </x-responsive-nav-link>
      </form>
        @endguest
        </ul>
      </nav>
      <!-- /.navbar -->
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src=" {{ asset('/storage/IESP_Sur_Logo.png') }}" alt="IESPSur Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Incidencias</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          @if (auth()->user())
            <a href="/datosPersonales/{{auth()->user()->id}}" class="d-block">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</a>
          @else
          <a href="#" class="d-block">Invitado</a>
          @endif
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">Incidencias</li>
            <li class="nav-item">
              <a href="/incidence/new" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>Crear Incidencia</p>
              </a>
            </li>
            @auth
            @if (auth()->user()->validated == "true")
            <li class="nav-item">
              <a href="/incidences/open/user/{{auth()->user()->id}}" class="nav-link"> <!-- Dar fix a esto -->
                <i class="nav-icon fas fa-table"></i>
                <p>Tus incidencias</p>
              </a>
            </li>          
          
            @if (auth()->user()->rol == "admin")

          <li class="nav-header">Adminstración</li>
          
            <li class="nav-item">
              <a href="/users" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Gestionar usuarios</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/incidences" class="nav-link">
                <i class="nav-icon fas fa-columns"></i>
                <p>Gestionar incidencias</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/aulas" class="nav-link">
                <i class="nav-icon fas fa-columns"></i>
                <p>Gestionar aulas</p>
              </a>
            </li>


            @endif
          <li class="nav-header">Ajustes</li>
          <li class="nav-item">
            <a href="/datos/{{auth()->user()->id}}" class="nav-link">
              <i class="fa-solid fa-user nav-icon"></i>
              <p>Datos personales</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/user/incidences/history/{{auth()->user()->id}}" class="nav-link">
              <i class="fas fa-clock-rotate-left nav-icon" ></i>
              <p>Historial de Incidencias</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/datos/edit/{{auth()->user()->id}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>Cambiar datos</p>
            </a>
          </li>
          @endif
          @endauth
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">    
          @yield('content')
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
    </div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src=" {{ asset('/jquery/jquery.min.js') }}"> </script>
<!-- Bootstrap 4 -->
<script src=" {{ asset('/bootstrap/js/bootstrap.bundle.min.js') }}"> </script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- Custom Scripts inpage -->
@yield('scripts')

</body>
</html>