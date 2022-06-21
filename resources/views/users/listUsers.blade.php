@extends('layouts.master')
@section('title', 'Lista de Usuarios')

@section('styles')
    <style>
        .dark tr th {
            color: #fff;
            background-color: #343a40;
            border-color: #282f35;
        }

        .circle {
            border-radius: 50px !important;
        }
    </style>

    <link rel="stylesheet" href=" {{ asset('/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@stop

@section('content')

    <section class="content-header" id="titulo">
        <div class="container-fluid">
            <div class="row mb-12">
                <div class="col-sm-12">
                    <h1 style="text-align: center">Listado de usuarios</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="filtro">
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
                            <div class="col-md-4">
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" class="form-control" onkeyup="Filter(event)">
                            </div>
                            <div class="col-md-8">
                                <label for="email">Correo</label>
                                <input type="email" id="email" class="form-control" onkeyup="Filter(event)">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="validado">Validado</label>
                                <select id="validado" class="form-control select2" onchange="Filter(event)">
                                    <option value="">Sin filtro</option>
                                    <option value="validado">Sí</option>
                                    <option value="noValidado">No</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="rol">Rol</label>
                                <select id="rol" class="form-control select2" onchange="Filter(event)">
                                    <option value="">Sin filtro</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Usuario">Usuario</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="listaUsuarios">
        <table id="tablaUsuarios" class="table table-bordered table-hover" style="text-align: center">
            <thead class="dark">
                <tr>
                    <th>Nombre</th>
                    <th>Validado</th>
                    <th>Rol</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            @foreach ($users as $user)
                <tr>
                    <td class="align-middle"> {{ $user['first_name'] }} {{ $user['last_name'] }} </td>

                    @if ($user['validated'] == 'true')
                        <td class="align-middle" id="validado">
                            <button class="btn btn-success circle">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </td>
                    @else
                        <td class="align-middle" id="noValidado">
                            <button class="btn btn-danger circle">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </td>
                    @endif

                    <td class="align-middle">
                        @if ($user['rol'] == 'admin')
                            Administrador
                        @else
                            Usuario
                        @endif
                    </td> <!-- Ponerle función para ponerle una franja de colores según rol -->
                    <td class="align-middle"> {{ $user['email'] }} </td>
                    <td class="align-middle">
                        <a href="/user/info/{{ $user['id'] }}" style="border-radius: 13px" class="btn btn-primary"
                            title="Ver Usuario">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="/user/edit/{{ $user['id'] }}" style="border-radius: 13px" class="btn btn-warning"
                            title="Editar Usuario">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@stop

@section('scripts')
    <script>
        function Filter(event) {
            // Declaración variables
            var input, filter, table, tr, td, i, txtValue, j, idInput;
            console.log(event.target.id)
            input = event.target // Esto recogerá la etiqueta de donde se llama la función y así recoger el valor.
            console.log(input.value);
            filter = input.value.toUpperCase();
            table = document.getElementById("tablaUsuarios");
            tr = table.getElementsByTagName("tr");

            // Filtro de limpieza, para si se pone un nuevo filtro, el anterior se borre.
            idInput = event.target.id
            if (idInput == "rol") {
                j = 2;
            } else if (idInput == "validado") {
                j = 1;
            } else if (idInput == "nombre") {
                j = 0;
            } else {
                j = 3 // Email
            }

            // Bucle en todas las filas de la tabla para buscar según el filtro
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[j];
                if (td) {
                    if (j != 1 || (j == 1 && filter == "")) { // Si el filtro es el de iconos, pero está vacío, irá por este
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    } else { // Si es el filtro de los iconos, usará este
                        inputId = td.id.toUpperCase();
                        if (inputId == filter) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
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
