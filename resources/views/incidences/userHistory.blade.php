@extends('layouts.master')
@section('title', 'Incidencias')

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
                    <h1 style="text-align: center">Listado de incidencias</h1>
                </div>
            </div>
        </div>
    </section>


    <section id="filtro">
        @if (count($data['incidencias']) != 0)
            <div class="container">
                <div class="card">
                    <div class="card-header text-center">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                            aria-expanded="false" aria-controls="collapseExample">
                            <i class="fa-solid fa-magnifying-glass mr-2"></i>
                            Filtros
                        </button>
                    </div>

                    <div class="collapse" id="collapseExample">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="titulo">Título</label>
                                    <input type="text" name="titulo" id="titulo" class="form-control"
                                        onkeyup="Filter(event)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="aula">Aula</label>
                                    <select id="aula" class="form-control select2" onchange="Filter(event)">
                                        <option value="">Sin filtro</option>
                                        @foreach ($data['aulas'] as $aula)
                                            <option value="{{ $aula['aula'] }}">{{ $aula['aula'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="state">Estado</label>
                                    <select id="state" class="form-control select2" onchange="Filter(event)">
                                        <option value="">Sin filtro</option>
                                        <option value="Nuevo">Nuevo</option>
                                        <option value="Abierto">Abierto</option>
                                        <option value="Cerrado">Cerrado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>

    <section id="ListaIncidencias">
        @if (count($data['incidencias']) != 0)
            <table id="tablaIncidencias" class="table table-bordered table-striped" style="text-align: center">
                <thead class="dark">
                    <tr>
                        <th>Título</th>
                        <th>Aula</th>
                        <th>Estado</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Fecha de cierre</th>

                        <th>Acciones</th>
                    </tr>
                </thead>
                @foreach ($data['incidencias'] as $incidencia)
                    <tr>
                        <td class="align-middle">{{ $incidencia['title'] }} </td>
                        @foreach ($data['aulas'] as $aula)
                            @if ($aula['id'] === $incidencia['id_aula'])
                                <td class="align-middle"> {{ $aula['aula'] }} </td>
                            @endif
                        @endforeach

                        @if ($incidencia['state'] == 'new')
                            <td>
                                <span class="btn btn-success" style="border-radius: 10px; width: 80px;">
                                    Nuevo
                                </span>
                            </td>
                        @elseif($incidencia['state'] == 'open')
                            <td>
                                <span class="btn btn-warning" style="border-radius: 10px; width: 80px;">
                                    Abierto
                                </span>
                            </td>
                        @else
                            <td>
                                <span class="btn btn-danger" style="border-radius: 10px; width: 80px;">
                                    Cerrado
                                </span>
                            </td>
                        @endif
                        <td class="align-middle"> {{ $incidencia['create_date'] }} </td>
                        <td class="align-middle">
                            @if ($incidencia['update_date'])
                                {{ $incidencia['update_date'] }}
                            @else
                                No se ha actualizado
                            @endif
                        </td>
                        <td class="align-middle">
                            @if ($incidencia['close_date'])
                                {{ $incidencia['close_date'] }}
                            @else
                                No se ha cerrado
                            @endif
                        </td>
                        <td>
                            <a href="/incidence/info/{{ $incidencia['id_incidencia'] }}" style="border-radius: 13px"
                                class="btn btn-primary" title="Ver incidencia">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </section>

    <section id="mensajeListaVacia">
        @if (count($data['incidencias']) == 0)
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h4>No has realizado ninguna incidencia.</h4>
                        <p>Puedes crear una nueva incidencia dándole a la opción <b>Crear Incidencia</b> en el menú de la
                            izquierda.</p>
                    </div>
                </div>
            </div>
        @endif
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
            table = document.getElementById("tablaIncidencias");
            tr = table.getElementsByTagName("tr");

            // Filtro de limpieza, para si se pone un nuevo filtro, el anterior se borre.
            if (event.target.id == "state") {
                j = 2;
            } else if (event.target.id == "aula") {
                j = 1;
            } else {
                j = 0 // Titulo
            }

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
