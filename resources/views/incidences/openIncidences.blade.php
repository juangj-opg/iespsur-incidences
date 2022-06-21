@extends('layouts.master')
@section('title', 'Incidencias')

@section('styles')
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

    <section id="titulo" class="content-header">
        <div class="container-fluid">
            <div class="row mb-12">
                <div class="col-sm-12">
                    <h1 style="text-align: center">Listado de incidencias</h1>
                </div>
            </div>
        </div>
    </section>

    <hr>
    
    <section id="listaIncidencias">
        <div class="container mt-4 mb-3">
            <div class="row">
                @foreach ($data['incidencias'] as $incidencia)
                    <div class="col-md-4 mt-2">
                        <a href="/incidence/info/{{ $incidencia['id_incidencia'] }}" style="color: inherit;">
                            <div class="card p-3 mb-2">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">
                                        <div class="ms-2 c-details">
                                            <h6 class="mb-0"> {{$incidencia['usuario']['first_name']}} {{$incidencia['usuario']['last_name']}}</h6>
                                            <span>
                                                @foreach ($data['aulas'] as $aula)
                                                    @if ($aula['id'] === $incidencia['id_aula'])
                                                        {{ $aula['aula'] }}
                                                    @endif
                                                @endforeach
                                            </span>
                                        </div>
                                    </div>
                                    <div class="badge">
                                        @if ($incidencia['state'] == 'new')
                                            <td>
                                                <span style="background-color: #8dcc86; color:white">
                                                    Nuevo
                                                </span>
                                            </td>
                                        @elseif($incidencia['state'] == 'open')
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
                                <div class="mt-4">
                                    <h3 class="heading" id="titulo"> {{ $incidencia['title'] }}
                                        <div class="mt-4">
                                            <hr>
                                            <div class="mt-3" id="comentarios">
                                                <span class="text1">
                                                    @if ($incidencia['comentarios'] > 0)
                                                        {{ $incidencia['comentarios'] }} Comentarios
                                                    @else
                                                     <span class="text2"> 0 Comentarios </span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="mensajeListaVacia">
        @if (count($data['incidencias']) == 0)
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h4>No has realizado ninguna incidencia o no tienenes ninguna incidencia abierta.</h4>
                        <p class="text-secondary">Puedes crear una nueva incidencia dándole a la opción <b>Crear
                                Incidencia</b> en el menú de la izquierda.</p>
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
