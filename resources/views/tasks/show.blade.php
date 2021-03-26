@extends('layouts.master')

@section('content')
	<div class="container">
		<a href="{{ route('tareas.index') }}">Regresar</a>
	<hr>

	<div class="card">
		<h4 class="card-header">{{ $tarea->name }}</h4>
		<div class="card-body">
			<p class="card-title">{{ $tarea->description }}</p>
			<p class="card-text">Fecha de entrega: {{ $tarea->due_date }}</p>
		</div>
	</div>

	<div class="py-3">
		<a href="{{ route('tareas.edit', $tarea->id) }}">EDITAR TAREA</a>
		<br>
	</div>

	<form method="POST" action="{{ route('tareas.destroy', $tarea->id )}}">
		{{ csrf_field() }}
		{{ method_field('DELETE') }}	
		<button class="btn btn-light" type="submit">BORRAR REGISTRO</button>
		</form>
	</div>
	
@endsection