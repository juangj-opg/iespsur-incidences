@extends('layouts.master')
@section('title', 'Incidencia')

@section('styles')
    <style>
        .dark-header {
            color: #fff;
            background-color: #343a40 !important;
        }

        .timeline {
            position: relative;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            padding: 5rem;
            color: #c2c7d0;
            margin: 0 auto 1rem auto;
            overflow: hidden;
        }

        .timeline:after {
            content: "";
            position: absolute;
            top: 0;
            left: 50%;
            margin-left: -2px;
            border-right: 2px dashed #4b546f;
            height: 100%;
            display: block;
        }

        .timeline::before {
            background: inherit !important;
        }

        .timeline-row {
            padding-left: 50%;
            position: relative;
            margin-bottom: 30px;
        }

        .timeline-row .timeline-time {
            position: absolute;
            right: 50%;
            top: 15px;
            text-align: right;
            margin-right: 20px;
            color: black;
            font-size: 1.5rem;
        }

        .timeline-row .timeline-time small {
            display: block;
            font-size: 0.8rem;
        }

        .timeline-row .timeline-content {
            position: relative;
            padding: 20px 30px;
            background-color: #343a40;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }

        .timeline-row .timeline-content:after {
            content: "";
            position: absolute;
            top: 20px;
            height: 16px;
            width: 16px;
            background: #1a233a;
        }

        .timeline-row .timeline-content:before {
            content: "";
            position: absolute;
            top: 20px;
            right: -49px;
            width: 20px;
            height: 20px;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
            z-index: 10;
            background: #343a40;
            border: 2px dashed #4b546f;
        }

        .timeline-row .timeline-content h4 {
            margin: 0 0 20px 0;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            line-height: 150%;
        }

        .timeline-row .timeline-content p {
            margin-bottom: 30px;
            line-height: 150%;
        }

        .timeline-row .timeline-content i {
            font-size: 1.2rem;
            line-height: 100%;
            padding: 15px;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
            background: #242a30;
            margin-bottom: 10px;
            display: inline-block;
        }

        .timeline-row .timeline-content .thumbs {
            margin-bottom: 20px;
            display: flex;
        }

        .timeline-row .timeline-content .thumbs img {
            margin: 5px;
            max-width: 60px;
        }

        .timeline-row .timeline-content .badge {
            color: #ffffff;
            background: linear-gradient(120deg, #00b5fd 0%, #0047b1 100%);
        }

        .timeline-row:nth-child(even) .timeline-content {
            margin-left: 40px;
            text-align: left;
        }

        .timeline-row:nth-child(even) .timeline-content:after {
            left: -8px;
            right: initial;
            border-bottom: 0;
            border-left: 0;
            transform: rotate(-135deg);
        }

        .timeline-row:nth-child(even) .timeline-content:before {
            left: -52px;
            right: initial;
        }

        .timeline-row:nth-child(odd) {
            padding-left: 0;
            padding-right: 50%;
        }

        .timeline-row:nth-child(odd) .timeline-time {
            right: auto;
            left: 50%;
            text-align: left;
            margin-right: 0;
            margin-left: 20px;
        }

        .timeline-row:nth-child(odd) .timeline-content {
            margin-right: 40px;
        }

        .timeline-row:nth-child(odd) .timeline-content:after {
            right: -8px;
            border-left: 0;
            border-bottom: 0;
            transform: rotate(45deg);
        }

        @media (max-width: 992px) {
            .timeline {
                padding: 15px;
            }

            .timeline:after {
                border: 0;
            }

            .timeline .timeline-row:nth-child(odd) {
                padding: 0;
            }

            .timeline .timeline-row:nth-child(odd) .timeline-time {
                position: relative;
                top: 0;
                left: 0;
                margin: 0 0 10px 0;
            }

            .timeline .timeline-row:nth-child(odd) .timeline-content {
                margin: 0;
            }

            .timeline .timeline-row:nth-child(odd) .timeline-content:before {
                display: none;
            }

            .timeline .timeline-row:nth-child(odd) .timeline-content:after {
                display: none;
            }

            .timeline .timeline-row:nth-child(even) {
                padding: 0;
            }

            .timeline .timeline-row:nth-child(even) .timeline-time {
                position: relative;
                top: 0;
                left: 0;
                margin: 0 0 10px 0;
                text-align: left;
            }

            .timeline .timeline-row:nth-child(even) .timeline-content {
                margin: 0;
            }

            .timeline .timeline-row:nth-child(even) .timeline-content:before {
                display: none;
            }

            .timeline .timeline-row:nth-child(even) .timeline-content:after {
                display: none;
            }
        }
    </style>

    <style>
        .dark tr th {
            color: #fff;
            background-color: #343a40;
            border-color: #282f35;
        }

        .card {
            border: none;
            border-radius: 10px
        }

        .c-details span {
            font-weight: 300;
            font-size: 13px
        }

        .icon {
            width: 50px;
            height: 50px;
            background-color: #eee;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 39px
        }

        .badge span {
            width: 60px;
            height: 25px;
            padding-bottom: 3px;
            border-radius: 5px;
            display: flex;
            color: #fed85d;
            justify-content: center;
            align-items: center
        }

        .progress {
            height: 10px;
            border-radius: 10px
        }

        .progress div {
            background-color: red
        }

        .text1 {
            font-size: 14px;
            font-weight: 600
        }

        .text2 {
            color: #a5aec0
        }
    </style>

    <link rel="stylesheet" href=" {{ asset('/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card mt-3">
                    <div class="card-header text-center align-middle dark-header">
                        <h4>{{ $data['incidencia']['title'] }}</h4>
                        <hr>
                        <div class="mt-2"> Estado actual:
                            <div class="badge">
                                @if ($data['incidencia']['state'] == 'new')
                                    <td>
                                        <span style="background-color: #8dcc86; color:white">
                                            Nuevo
                                        </span>
                                    </td>
                                @elseif($data['incidencia']['state'] == 'open')
                                    <td>
                                        <span style="background-color: #fffbec;">
                                            Abierto
                                        </span>
                                    </td>
                                @else
                                    <td>
                                        <span style="background-color: #ff6961; color: white">
                                            Cerrado
                                        </span>
                                    </td>
                                @endif
                            </div>
                        </div>
                        <div class="text-secondary"> {{ $data['user']['first_name'] }} {{ $data['user']['last_name'] }}
                        </div>
                    </div>
                    <div class="card-body">
                        <p style="white-space: pre-wrap">{{ $data['incidencia']['description'] }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        {{ $data['fechaCreacion'] }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="timeline">
            @foreach ($data['historial'] as $historial)
                <div class="timeline-row">
                    <div class="timeline-time">
                        {{ $historial['hora'] }}<small>{{ $historial['dia'] }}</small>
                    </div>
                    <div class="timeline-content">
                        @if ($historial['comment'])
                            <h4> {{ $historial['user']['first_name'] }} {{ $historial['user']['last_name'] }} </h4>
                            <i class="icon-attachment"></i>
                            <p> {{ $historial['comment'] }} </p>
                        @else
                            <h4>Estado actual</h4>
                            <i class="icon-attachment"></i>
                            <p class="text-center">
                                @if ($historial['state'] == 'new')
                                    Se ha creado una nueva incidiencia.
                                @elseif($historial['state'] == 'open')
                                    Se ha cambiado el estado de la incidencia a: <b>Abierto</b>.
                                @elseif($historial['state'] == 'closed')
                                    Se ha cerrado la incidencia. <br>
                                    No se aceptan más respuestas a menos que un Administrador abra la incidencia nuevamente.
                                @endif
                            </p>
                        @endif
                        <div class="">
                            @if ($historial['comment'])
                                <span class="badge badge-pill">Comentario</span>
                                @if ($historial['user']['id'] == $data['user']['id'])
                                    <span class="badge badge-pill">Creador</span>
                                @endif
                                <span class="badge badge-pill">
                                    @if ($historial['user']['rol'] == 'admin')
                                        Administrador
                                    @else
                                        Usuario
                                    @endif
                                </span>
                            @else
                                <span class="badge badge-pill">Estado</span>
                                <span class="badge badge-pill">
                                    @if ($historial['state'] == 'new')
                                        Nuevo
                                    @elseif($historial['state'] == 'open')
                                        Abierto
                                    @elseif($historial['state'] == 'closed')
                                        Cerrado
                                    @endif
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($data['incidencia']['state'] == 'open' || auth()->user()->rol == 'admin')
                <div class="timeline-row">
                    <div class="timeline-content">
                        <form action="/incidence/info/{{ $data['incidencia']['id_incidencia'] }}" method="post">
                            @csrf
                            <h4>Añadir un Comentario</h4>
                            <input type="hidden" name="id_incidencia" value="{{ $data['incidencia']['id_incidencia'] }}">
                            <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                            <textarea name="comment" id="comment" cols="50" rows="2" placeholder="Escribe tu comentario aquí."
                                style="border-radius: 10px; border: 3px solid #242434; background: #DDDDDD" required></textarea>
                            <button type="submit" class="btn btn-secondary mt-3">Añadir comentario</button>
                        </form>
                    </div>
                </div>
            @endif


        </div>
    </div>
@stop
