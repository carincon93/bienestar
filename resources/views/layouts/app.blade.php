<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
</head>
<body>
    @if (session('status'))
        <div class="alert alert-success alert-dismissible animated" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
            {!! html_entity_decode(session('status')) !!}
        </div>
    @endif
    @if (session('status-danger'))
        <div class="alert alert-danger alert-dismissible animated" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
            {!! html_entity_decode(session('status-danger')) !!}
        </div>
    @endif
    {{-- @include('layouts.modal') --}}
    @include('layouts.modal_eliminar')
    @if (Auth::check())
        <aside id="sidebar">
            <div id="sidebar-logo">
                <a href="{{ url('admin/dashboard') }}"><img src="{{ asset('/images/logo-bienestar.svg') }}" alt="" class="img-responsive"></a>
            </div>
            <div id="sidebar-admin">
                <div>
                    <div>
                    </div>
                </div>
            </div>
            <div id="sidebar-content">
                <ul class="sidebar-menu list-unstyled">
                    {{-- <li class="li-item li-entrega clearfix" data-toggle="modal" data-target="#modalEntrega">
                        <div class="col-md-8">
                            <img src="{{ asset('images/suplemento.png') }}" alt="" class="img-responsive logo-suplemento-sidebar">
                        </div>
                        <div class="col-md-4">
                            Entregar
                        </div>
                    </li> --}}

                    <li class="li-item li-entrega">
                        <a href="{{ url('/') }}" class="clearfix">
                            <div class="col-md-8">
                                <img src="{{ asset('images/suplemento.png') }}" alt="" class="img-responsive logo-suplemento-sidebar">
                            </div>
                            <div class="col-md-4">
                                Entregar
                            </div>
                        </a>
                    </li>

                    <li class="li-item li-item-solicitudes">
                        <a href="{{ url('admin/dashboard') }}">
                            <i class="far fa-file-alt"></i>
                            Solicitudes
                        </a>
                    </li>

                    <li class="li-item li-item-import">
                        <a href="{{ url('admin/sistema') }}">
                            <i class="fa fa-fw fa-upload"></i>
                            Importar solicitudes
                        </a>
                    </li>

                    <li class="li-item">
                        <a href="{{ url('admin/registro_historico') }}"><i class="fas fa-history"></i>
                            Historial de entregas
                        </a>
                    </li>

                    <li class="li-item">
                        <a href="{{ url('admin/reportes') }}">
                            <i class="fa fa-fw fa-book"></i>
                            Reportes
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    @endif
    <main id="app">
        <div class="{{ Auth::check() ? 'app-check' : ''}}">
            <nav class="navbar navbar-default {{ Auth::check() ? 'mleft' : '' }}">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            @if(!Auth::check())
                                <li>
                                    <a href="{{ url('/') }}" class="logo-wrapper">
                                        <img src="{{ url('/images/logo1.png') }}" class="img-responsive logobienestar-navbar">
                                    </a>
                                </li>
                                <li class="dropdown dropdown-custom {{ count($errors) > 0 ? 'open' : '' }}">
                                    <a class="top-login dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Iniciar sesión</a>
                                    <div class="dropdown-menu login-box">
                                        <div class="">
                                            <form method="POST" action="{{ route('login') }}">
                                                {{ csrf_field() }}

                                                <div class="secpart-login">
                                                    <h4 class="login-title">Ingresa a tu cuenta</h4>
                                                </div>

                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} no-margin">
                                                    <div class="">
                                                        <i class="fa fa-fw fa-envelope icon-form"></i>
                                                        <input id="email" type="email" class="form-control form-login" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required autofocus>

                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                                                {{ $errors->first('email') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} no-margin">
                                                    <div class="">
                                                        <i class="fa fa-fw fa-key icon-form"></i>
                                                        <input id="password" type="password" class="form-control form-login" name="password" placeholder="Contraseña" required>

                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="secpart-login">
                                                    <div class="form-group">
                                                        <div class="">
                                                            <div class="checkbox">
                                                                <label class="control control--checkbox"> Recuerda mi cuenta
                                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                                    <div class="control__indicator"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="">
                                                            <button type="submit" id="login" class="btn btn-login">
                                                                Iniciar sesión
                                                            </button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @else
                                <li><span id="userImage" class="text-uppercase"></span></li>
                                <li class="dropdown dropdown-custom">
                                    <a id="nameUser" href="#" class="dropdown-toggle text-capitalize user-name" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{url('admin/password')}}">Cambiar mi contraseña</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" class="">
                                            <i class="fa fa-fw fa-sign-out"></i>
                                            Cerrar Sesión
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="main-content">
            <!-- <div class="row no-gutter"> -->
            <div class="container-fluid">
                <div class="col-md-12 big-content">
                    <!-- <div class="{{ Auth::guest() ? 'col-md-9' : 'col-md-12' }} big-content"> -->
                    <div class="informacion clearfix">
                        @yield('informacion')
                    </div>
                    @yield('content')
                </div>
                <!-- <div class="{{ Auth::guest() ? 'col-md-3 right-content' : ''}}">
                <div>
                @yield('right-content')
            </div>
        </div> -->
    </div>

</div>

</div>
</main>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
{{-- <script src="{{ asset('js/custom-file-input.js') }}"></script> --}}
<script src="{{ asset('js/custom.js') }}"></script>

@stack('scripts')

<script>
$(document).ready(function() {
    $('#myTable').DataTable();
    $('.datapickerr').datepicker({
        format: "yyyy/mm/dd",
        language: "es",
        autoclose: true
    });
});
</script>
</body>
</html>
