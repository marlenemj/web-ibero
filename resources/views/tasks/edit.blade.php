@extends('layouts.master')

@section('content')
<div class="container d-flex justify-content-center">
	<form method="POST" action="{{ route('tareas.update', $tarea->id) }}" class="col-9 vista-editar">
		<!-- Nuestro campo de protección de formulario -->
		{{ csrf_field() }}
		{{ method_field('PUT') }}	

		<!-- Campos de formulario -->
		<div class="form-group mb-3">
			<label>Nombre de la tarea</label><br>
			<input class="form-control" type="text" name="name" placeholder="Nombre de Tarea" value="{{ $tarea->name }}">
		</div>
		
		<div class="form-group mb-3">
			<label>Descripción</label>
			<textarea class="form-control" name="description">{{ $tarea->description }}</textarea>
		</div>

		<div class="form-group mb-3">
                    <label class="edit-title">Modalidad</label>
                    <select class="form-control" name="status">
                    	<option selected="selected">{{ $tarea->status }}</option>
                        <option value="Individual">Individual</option>
                        <option value="Por Equipo">Por Equipo</option>
                        <option value="Parejas">Parejas</option>
                        <option value="Asistencia Externa">Asistencia Externa</option>
                    </select>
        </div>
		
		<div class="form-group mb-3">
			<label>Fecha de entrega</label>
			<input class="form-control" type="date" name="due_date" value="{{ $tarea->due_date }}">
		</div>

		<br>
		<button class="btn btn-light-si" type="submit">Guardar tarea</button>
	</form>
</div>
	
@endsection