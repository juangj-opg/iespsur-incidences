@extends('layouts.master')
@section('title', 'Editar usuario')

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
                    <h1 style="text-align: center">Cambiar mis datos personales</h1>

                </div>
            </div>
        </div>
    </section>

    <!-- Añadir un boton de editar por la parte superior de la vista -->
    <div id="formularioIncidencia" class="row md-2">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <form action="/datos/edit/{{$user['id']}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header dark-header align-middle">
                        <h3 class="card-title mt-2">Mis datos</h3>
                        <button type="submit" class="btn btn-warning float-right">
                            <i class="nav-icon fas fa-edit mr-2"></i>
                            Aceptar cambios
                        </button>
                    </div>
                    <input type="hidden" name="id" value="{{ $user['id'] }}">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="InputTitle">Nombre</label>
                                    <input type="text" class="form-control" name="first_name" id="InputFirstName"
                                        placeholder="Nombre del usuario" value={{ $user['first_name'] }} required>
                                </div>
                                <div class="col-md-3">
                                    <label for="InputTitle">Apellidos</label>
                                    <input type="text" class="form-control" name="last_name" id="InputLastName"
                                        placeholder="Apellidos del usuario" value="{{ $user['last_name'] }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="InputTitle">Correo eléctronico</label>
                                    <input type="email" class="form-control" name="email" id="InputEmail"
                                        placeholder="Correo eléctronico del usuario" value={{ $user['email'] }} required>
                                </div>
                                <div class="col-md-3">
                                    <label for="InputTitle">Teléfono</label>
                                    <input type="number" class="form-control" name="tel" id="InputTel"
                                        placeholder="Teléfono del usuario" value={{ $user['tel'] }} required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="InputTitle">DNI</label>
                                    <input type="text" class="form-control" name="dni" id="InputDNI"
                                        placeholder="DNI del usuario" value={{ $user['dni'] }} required>
                                </div>
                                <div class="col-md-4">
                                    <label for="genero">Género</label>
                                    <select id="genero" class="form-control select2" name="gender" onchange="Filter(event)">
                                        <option value="M" @if ($user['gender'] == 'M') selected @endif>Masculino
                                        </option>
                                        <option value="F" @if ($user['gender'] == 'F') selected @endif>Femenino
                                        </option>
                                        <option value="O" @if ($user['gender'] == 'O') selected @endif>Otro</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="notify_email">¿Puedo recibir correos?</label>
                                    <select id="notify_email" class="form-control select2" name="notify_email" onchange="Filter(event)">
                                        <option value="true" @if ($user['notify_email'] == 'true') selected @endif>Sí
                                        </option>
                                        <option value="false" @if ($user['notify_email'] == 'false') selected @endif>No
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
