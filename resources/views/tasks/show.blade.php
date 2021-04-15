@extends('layouts.master')

@section('content')
	<div class="container">
		<a class="btn btn-light-si" href="{{ route('tareas.index') }}">Regresar</a>
	<hr>

	<div class="card card-tareas">
		<h4 class="card-header">{{ $tarea->name }}</h4>
		<div class="card-body card-textos">
			<p class="card-title">{{ $tarea->description }}</p>
			<p class="card-text">Modalidad: {{ $tarea->status }}</p>
			<p class="card-text">Fecha de entrega: {{ $tarea->due_date }}</p>
			@if($tarea->is_completed == false)
                  <p class="card-text">Estado: Incompleta</p>
                  @else
                  <p class="card-text">Estado: Completada</p>
                  @endif
		</div>
	</div>

	<div class="row">
	<div class="py-3 col-1">
		<a class="btn btn-light-si" href="{{ route('tareas.edit', $tarea->id) }}">EDITAR</a>
		<br>
	</div>

	<form method="POST" action="{{ route('tareas.destroy', $tarea->id )}}" class=" py-3 col-1">
		{{ csrf_field() }}
		{{ method_field('DELETE') }}	
		<button class="btn btn-dark" type="submit">BORRAR</button>
		</form>
	</div>

	</div>
	
@endsection