@extends('layouts.master')
@section('title', 'Nueva incidencia')

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
                    <h1 style="text-align: center">Crear nueva incidencia</h1>
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
                <form action="/incidence/new" method="post">
                    @csrf
                    <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="InputTitle">Título</label>
                            <input type="text" class="form-control" name="title" id="InputTitle"
                                placeholder="Introduce el título" required>
                        </div>
                        <div class="form-group">
                            <label>Clase</label>
                            <select name="id_aula" class="form-control select2" style="width: 100%;">
                                @foreach ($data['aulas'] as $aula)
                                    <option value="{{ $aula['id'] }}">{{ $aula['aula'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Incidencia</label>
                            <textarea class="form-control" rows="3" name="description"
                                placeholder="Introduce la descripción de tu incidencia."></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Enviar Incidencia</button>
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
