@extends('layouts.master')
@section('title', 'Aulas')

@section('styles')
    <style>
        .dark tr th {
            color: #fff;
            background-color: #343a40;
            border-color: #282f35;
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
                    <h1 style="text-align: center">Listado de aulas</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="filtro">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary " type="button" data-toggle="collapse" data-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa-solid fa-magnifying-glass mr-2"></i>
                        Filtros
                    </button>
                    <a href="/aula/new">
                    <button type="button" class="btn btn-warning float-right">
                        <i class="nav-icon fas fa-edit mr-2"></i>
                        Añadir aula
                    </button>
                    </a>
                </div>

                <div class="collapse" id="collapseExample">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col text-center">
                                <label for="aula">Aula</label>
                                <input type="text" name="aula" id="aula" class="form-control" onkeyup="Filter(event)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="listaAulas">
        <div class="container">
            <div class="row">
                <div class="col">
                    <table id="tablaAulas" class="table table-bordered table-striped" style="text-align: center">
                        <thead class="dark">
                            <tr>
                                <th>Aula</th>

                                <th>Acciones</th>
                            </tr>
                        </thead>
                        @foreach ($aulas as $aula)
                            <tr>
                                <td class="align-middle">{{ $aula['aula'] }} </td>
                                <td>
                                    <a href="/aula/edit/{{ $aula['id'] }}" style="border-radius: 13px"
                                        class="btn btn-warning" title="Editar aula">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop

@section('scripts')
    <script>
        function Filter(event) {
            // Declaración variables variables
            var input, filter, table, tr, td, i, txtValue, j;
            // input = document.getElementById("state");
            console.log(event.target.id)
            input = event.target // Esto recogerá la etiqueta de donde se llama la función y así recoger el valor.
            console.log(input.value);
            filter = input.value.toUpperCase();
            table = document.getElementById("tablaAulas");
            tr = table.getElementsByTagName("tr");

            j = 0 // Nombre del aula

            // Bucle en todas las filas de la tabla para buscar según el filtro
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[j];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

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
