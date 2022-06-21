<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nueva Incidencia</title>
    <style>
        .dark-header {
            color: #fff;
            background-color: #343a40 !important;
        }
    </style>
</head>

<body>
    <div style="width:500px; border-radius: 10px;">
        <div class="dark-header" style="width: 100%; height:100%; padding: 5px; border-radius: 10px;">
            <h3 style="text-align: center; padding-top: 5px;">Tu incidencia ha sido cerrada</h3>
        </div>

        <h3 style="text-align: center; margin-top: 10px;">{{$info[0]['title']}}</h3>
        <hr>
        <p style="  text-align: justify; text-justify: inter-word; margin: 15px;">
            {{$info[0]['description']}}
        </p>
        <hr>
        <h4 style="text-align: center">{{$info[1]['first_name']}} {{$info[1]['last_name']}} </h4>
    </div>

</html>
