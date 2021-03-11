@extends('layouts.master')

@section('content')
<div class="container">
	<form method="POST" action="{{ route('tareas.update', $tarea->id) }}">
		<!-- Nuestro campo de protección de formulario -->
		{{ csrf_field() }}
		{{ method_field('PUT') }}	

		<!-- Campos de formulario -->
		<div class="form-group mb-3">
			<label>Nombre de tarea</label><br>
			<input class="form-control" type="text" name="name" placeholder="Nombre de Tarea" value="{{ $tarea->name }}">
		</div>
		
		<div class="form-group mb-3">
			<label>Descripción</label>
			<textarea class="form-control" name="description">{{ $tarea->description }}</textarea>
		</div>
		
		<div class="form-group mb-3">
			<label>Fecha de entrega</label>
			<input class="form-control" type="date" name="due_date" value="{{ $tarea->due_date }}">
		</div>

		<br>
		<button class="btn btn-light" type="submit">Guardar tarea</button>
	</form>
</div>
	
@endsection