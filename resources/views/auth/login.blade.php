@extends('layouts.formlogin', ['class' => 'login-page', 'page' => _('Pagina de Inicio'), 'contentClass' => 'login-page'])

@section('content')
    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
        <form class="form" method="post" action="{{ route('usuario') }}">
            @csrf
            <div class="card card-login card-white">
                <div class="card-header">
                    <img src="img/card-primary.png" alt="">
                    <h1 class="card-title">{{ _('Log in') }}</h1>
                </div>
                <div class="card-body">
                    <div class="input-group{{ $errors->has('login') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-email-85"></i>
                            </div>
                        </div>
                        <input type="login" name="login" class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" placeholder="{{ _('Usuario') }}">
                        @include('alerts.feedback', ['field' => 'login'])
                    </div>
                    <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <input type="password" placeholder="{{ _('Contraseña') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" href="" class="btn btn-primary btn-lg btn-block mb-3">{{ _('Iniciar Sesion') }}</button>
                    <div class="pull-left">
                        <h6>
                            <a href="{{ route('register') }}" class="link footer-link">{{ _('Crear cuenta!') }}</a>
                        </h6>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection