@extends('layouts.master')
@section('title', 'Nueva Aula')

@section('styles')
    <style>
        .dark-header {
            color: #fff;
            background-color: #343a40 !important;
        }
    </style>
@stop

@section('content')

    <section id="titulo" class="content-header">
        <div class="container-fluid">
            <div class="row mb-12">
                <div class="col-sm-12">
                    <h1 style="text-align: center">Crear nueva Aula</h1>
                </div>
            </div>
        </div>
    </section>

    <div id="formularioIncidencia" class="row md-2">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <!-- general form elements -->
            <form action="/aula/new" method="post">
                @csrf
                <div class="card">
                    <div class="card-header dark-header">
                        <h3 class="card-title mt-2">Datos de la Aula</h3>
                        <button type="submit" class="btn btn-warning float-right">
                            <i class="nav-icon fas fa-edit mr-2"></i>
                            Añadir
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group text-center">
                            <label for="InputTitle">Aula</label>
                            <input type="text" class="form-control" name="aula" id="InputAula"
                                placeholder="Introduce el nombre de la aula" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </form>
        </div>
    </div>

@stop
