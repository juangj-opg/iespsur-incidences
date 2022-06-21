@extends('layouts.master')
@section('title', 'Editar incidencia')

@section('styles')
    <style>
        .dark-header {
            color: #fff;
            background-color: #343a40 !important;
        }
    </style>

    <link rel="stylesheet" href=" {{ asset('/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@stop

@section('content')

    <section id="titulo" class="content-header">
        <div class="container-fluid">
            <div class="row mb-12">
                <div class="col-sm-12">
                    <h1 style="text-align: center">Editar incidencia</h1>
                </div>
            </div>
        </div>
    </section>

    <div id="formularioIncidencia" class="row md-2">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <!-- general form elements -->
            <div class="card">
                <div class="card-header dark-header">
                    <h3 class="card-title">Datos de la Incidencia</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="/incidence/edit/{{ $data['incidencias']['id_incidencia'] }}" method="post">
                    @csrf
                    <input type="hidden" name="id_incidencia" value="{{ $data['incidencias']['id_incidencia'] }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="InputTitle">Título</label>
                            <input type="text" class="form-control" name="title" id="InputTitle"
                                placeholder="Introduce el título" value="{{ $data['incidencias']['title'] }}" required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Clase</label>
                                    <select name="id_aula" class="form-control select2" style="width: 100%;">
                                        @foreach ($data['aulas'] as $aula)
                                            <option value="{{ $aula['id'] }}"
                                                @if ($data['incidencias']['id_aula'] == $aula['id']) selected @endif>
                                                {{ $aula['aula'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Estado</label>
                                    <select name="state" class="form-control select2" style="width: 100%;">
                                        <option value="new" @if ($data['incidencias']['state'] == 'new') selected @endif>Nuevo
                                        </option>
                                        <option value="open" @if ($data['incidencias']['state'] == 'open') selected @endif>Abierto
                                        </option>
                                        <option value="closed" @if ($data['incidencias']['state'] == 'closed') selected @endif>Cerrado
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Incidencia</label>
                            <textarea class="form-control" rows="3" name="description"
                                placeholder="Introduce la descripción de tu incidencia.">{{ $data['incidencias']['description'] }}</textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Editar Incidencia</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop

@section('scripts')

    <!-- Select2 -->
    <script src=" {{ asset('/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {
            $('.select2').select2()
        })

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>

@stop
