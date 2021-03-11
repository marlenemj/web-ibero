@extends('layouts.master')

@section('content')

<div class="container-fluid mb-4">
	<div class="row align-items-center">
		<div class="col-md-8">
	<div class="title-page px-4 py-5">
		<h3 class="display-1">¡Bienvenido Usuario!</h3>
		<p class="lead">Esta es una gran aplicación de tareas, utilizala todos los días.</p>
	</div>
</div>
<div class="col-md-4">
	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Crear Nueva Tarea
	</button>
	</div>
	</div>
</div>
		
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Tarea</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="POST" class="pe-4" action="{{ route('tareas.store') }}">
      <div class="modal-body">
        
      	<!-- Nuestro campo de protección de formulario -->
		{{ csrf_field() }}

		<!-- Campos de formulario -->
		<div class="form-group mb-3">
			<label>Nombre de tarea</label><br>
			<input class="form-control" type="text" name="name" placeholder="Nombre de Tarea">
		</div>

		<div class="form-group mb-3">
			<label>Descripción</label>
			<textarea class="form-control" name="description"></textarea>
		</div>

		<div class="form-group mb-3">
                <label>Modalidad</label>
                <select class="form-control" name="status">
                    <option value="Individual">Individual</option>
                    <option value="Parejas">Parejas</option>
                    <option value="Equipo">Equipo</option>
                    <option value="Asistencia Externa">Asistencia Externa</option>
                </select>
            </div>
		
		<div class="form-group mb-3">
			<label>Fecha de entrega</label>
			<input class="form-control" type="date" name="due_date">
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
  </form>
    </div>
  </div>
</div>
	

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<h5 class="card-header">Listado de Tareas</h5>
				<div class="card-body">
					<h5 class="card-title">Tareas pendientes</h5>
					<p class="card-text">Este es tu listado principal de tareas, ponte a trabajar.</p>

					<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tarea</th>
      <th scope="col">Descripción</th>
      <th scope="col">Modalidad</th>
      <th scope="col">Fecha de Entrega</th>
      <th scope="col">Estado</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($tareas as $tarea)
    <tr>
      <th scope="row">{{ $tarea->id }}</th>
      <td>{{ $tarea->name }}</td>
      <td>{{ $tarea->description }}</td>
      <td>
          @if($tarea->status == 'Individual')
          <span class="badge bg-secondary">Individual</span>
          @endif
          @if($tarea->status == 'Parejas')
          <span class="badge bg-secondary">Parejas</span>
          @endif
          @if($tarea->status == 'Equipo')
          <span class="badge bg-secondary">Equipo</span>
          @endif
          @if($tarea->status == 'Asistencia Externa')
          <span class="badge bg-secondary">Asistencia Externa</span>
          @endif
      </td>
      <td>{{ $tarea->due_date }}</td>
      <th>
        @if($tarea->is_completed == true)
        <span class="badge bg-success">COMPLETA</span>
        @else
        <span class="badge bg-warning text-dark">INCOMPLETA</span>
        @endif
      </th>
      <td>
        <form method="POST" action="{{ route('completar.tarea', $tarea->id )}}">
    {{ csrf_field() }}
    @if($tarea->is_completed == true)
    <button class="btn btn-sm btn-light" type="submit">Descompletar</button>
    @else
    <button class="btn btn-sm btn-light" type="submit">Completar</button>
    @endif
    </form>

      	<a href="{{ route('tareas.show', $tarea->id) }}">Ver detalle</a>
      	<a href="javascript:void(0)" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#editarTarea_{{ $tarea->id }}">
  Editar
</a>
<form method="POST" action="{{ route('tareas.destroy', $tarea->id )}}">
		{{ csrf_field() }}
		{{ method_field('DELETE') }}	
		<button class="btn btn-sm btn-dark" type="submit">BORRAR</button>
		</form>
    </td>
    </tr>

    <div class="modal fade" id="editarTarea_{{ $tarea->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Tarea</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{ route('tareas.update', $tarea->id) }}">
      <div class="modal-body">
        
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
                <label>Modalidad</label>
                <select class="form-control" name="status">
                    <option value="Individual">Individual</option>
                    <option value="Parejas">Parejas</option>
                    <option value="Equipo">Equipo</option>
                    <option value="Asistencia Externa">Asistencia Externa</option>
                </select>
            </div>
		
		<div class="form-group mb-3">
			<label>Fecha de entrega</label>
			<input class="form-control" type="date" name="due_date" value="{{ $tarea->due_date }}">
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
  </form>
    </div>
  </div>
</div>
    	@endforeach
  </tbody>
</table>
			</div>
		</div>
	</div>
</div>
	
@endsection