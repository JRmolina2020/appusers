@extends('layout')
@section('measure')
<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 principal">
@endsection
@section('titlepanel','Indicadores Ecónomicos de la empresa')
@section('content')
<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fi fi-male"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Usuarios registrados</span>
        <span class="info-box-number">{{$count }}</span>
      </div>
    </div>
  </div>
</div>
<home_app></home_app>
</div>
@endsection