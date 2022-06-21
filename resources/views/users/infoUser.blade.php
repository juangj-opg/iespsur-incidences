@extends('layouts.master')
@section('title', 'Datos del Usuario')

@section('content')



    <!-- Pendiente de cambiar estilos y vista -->
    <section id="titulo" class="content-header">
        <div class="container-fluid">
            <div class="row mb-12">
                <div class="col-sm-12">
                    <h1 style="text-align: center">Datos del usuario</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Añadir un boton de editar por la parte superior de la vista -->
    <section id="infoUser">
        <div class="container">
            <div class="main-body">

                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <div class="mt-3">
                                        <h4>{{ $user['first_name'] }} {{ $user['last_name'] }}</h4>
                                        <p class="text-secondary mb-1">
                                            @if ($user['rol'] == 'admin')
                                                Administrador
                                            @else
                                                Usuario
                                            @endif
                                        </p>
                                        <hr>
                                        <a href="/user/edit/{{$user['id']}}">
                                            <button class="btn btn-outline-warning">
                                                <i class="fa fa-edit mr-2"></i>
                                                Editar
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header text-center mt-2">
                                <h5>¿Está el usuario validado?</h5>
                            </div>
                            <div class="card-body text-center">
                                @if ($user['validated'] == 'true')
                                    Sí, está validado.
                                @else
                                    No, no está validado.
                                @endif
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header text-center mt-2">
                                <h5>¿Puede recibir correos eléctronicos?</h5>
                            </div>
                            <div class="card-body text-center">
                                @if ($user['notify_email'] == 'true')
                                    Sí, puede recibir coreos.
                                @else
                                    No, no puede recibir correos.
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nombre completo</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user['first_name'] }} {{ $user['last_name'] }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">DNI</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user['dni'] }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Rol</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if ($user['rol'] == 'admin')
                                            Administrador
                                        @else
                                            Usuario
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user['email'] }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Teléfono</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if ($user['tel'])
                                            {{ $user['tel'] }}
                                        @else
                                            No específicado
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Género</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if ($user['gender'] == 'M')
                                            Masculino
                                        @elseif($user['gender'] == 'F')
                                            Femenino
                                        @elseif($user['gender'] == 'O')
                                            Otro
                                        @else
                                            No específicado
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header text-center mt-2">
                                <h5>Fecha de la última actualización de los datos del usuario</h5>
                            </div>
                            <div class="card-body text-center">
                                @if ($user['last_update'])
                                    {{ $user['last_update'] }}
                                @else
                                    Este usuario no ha actualizado sus datos.
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@stop
