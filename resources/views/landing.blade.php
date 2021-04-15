@extends('layouts.master')

@section('content')
<section class="section-home">
<div class="px-4 pt-5 text-center border-bottom">
  <h1 class="display-4 fw-bold text-light">La mejor app de tareas y proyectos</h1>
  <div class="col-lg-6 mx-auto">
    <p class="lead mb-4 text-light">¿Cansado de sistemas muy complejos? Tenemos la app ideal para ti, esta es la mejor forma de registrar todas tus tareas/proyectos y trabajar de forma eficiente.</p>

    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5 botones-landing">
      <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4 me-sm-3">Registrate ahora</a>
      <a href="" class="btn btn-primary btn-lg px-4">Conoce más</a>
    </div>
  </div>
  <div class="overflow-hidden" style="max-height: 38vh;">
    <div class="container px-5">
      <img src="{{ asset('img/compu1.jpg') }}" class="img-fluid rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
    </div>
  </div>
</div>
</section>

@endsection
