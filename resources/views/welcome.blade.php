@extends('layouts.master')
@section('title', 'Inicio')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 style="text-align: center">Página de Incidencias del IES Polígono Sur</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

<div class="row">
    <div class="col-lg-4 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ $data['incidencias_abiertas'] }}</h3>

          <p>Incidencias abiertas</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $data['users'] }}</h3>
          <p>Usuarios</p>
        </div>
        <div class="icon">
          <i class="ion ion-person"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-12">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ $data['incidencias'] }}</h3>

          <p>Incidencias totales</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
    </div>
  </div>

@stop