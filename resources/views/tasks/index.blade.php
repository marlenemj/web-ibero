@extends('layouts.master')

@section('content')

<div class="container mb-4">
	<div class="row align-items-center">
		<div class="col-md-8">
	<div class="title-page py-5 display-proyectos">
		<h3 class="display-1">Mis Tareas</h3>
		<p class="lead">Crea tareas y complétalas cuando las hayas terminado.</p>
	</div>
</div>
<div class="col-md-4 boton-crear d-flex justify-content-end">
	<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Crear Nueva Tarea
	</button>
	</div>
	</div>
</div>
		
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title modal-popup-title" id="exampleModalLabel">Crear Tarea</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="POST" class="form-popup" action="{{ route('tareas.store') }}">
      <div class="modal-body">
        
      	<!-- Nuestro campo de protección de formulario -->
		{{ csrf_field() }}

		<!-- Campos de formulario -->
		<div class="form-group mb-3">
			<label>Nombre de la tarea</label><br>
			<input class="form-control" type="text" name="name" placeholder="Nombre de Tarea">
		</div>

		<div class="form-group mb-3">
			<label>Descripción</label>
			<textarea class="form-control" name="description"></textarea>
		</div>

		<div class="form-group mb-3">
                <label>Proyectos</label>
                <select class="form-control" name="project_id">
                  @foreach($proyectos as $proyecto)
                    <option value="{{ $proyecto->id }}">{{ $proyecto->name }}</option>
                  @endforeach
                </select>
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
        <button type="button" class="btn btn-light-si" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-light-si">Guardar</button>
      </div>
  </form>
    </div>
  </div>
</div>
	

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-tareas">
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
          <span class="badge bg-secondary">INDIVIDUAL</span>
          @endif
          @if($tarea->status == 'Parejas')
          <span class="badge bg-secondary">PAREJAS</span>
          @endif
          @if($tarea->status == 'Equipo')
          <span class="badge bg-secondary">EQUIPO</span>
          @endif
          @if($tarea->status == 'Asistencia Externa')
          <span class="badge bg-secondary">ASISTENCIA EXTERNA</span>
          @endif
      </td>
      <td>{{ $tarea->due_date }}</td>
      <th>
        @if($tarea->is_completed == true)
        <span class="badge bg-success">COMPLETA</span>
        @else
        <span class="badge bg-warning">INCOMPLETA</span>
        @endif
      </th>
      <td>
        <form method="POST" action="{{ route('completar.tarea', $tarea->id )}}">
    {{ csrf_field() }}
    @if($tarea->is_completed == true)
    <button class="btn btn-sm btn-light-si row my-1" type="submit">Descompletar</button>
    @else
    <button class="btn btn-sm btn-light-si row my-1" type="submit">Completar</button>
    @endif
    </form>

      	<a href="javascript:void(0)" class="btn btn-sm btn-light-si row my-1" data-bs-toggle="modal" data-bs-target="#editarTarea_{{ $tarea->id }}">
        Editar
        </a>
        <a class="ver-detalle row d-flex justify-content-center my-1" href="{{ route('tareas.show', $tarea->id) }}">Ver detalle</a>
        
<form method="POST" action="{{ route('tareas.destroy', $tarea->id )}}">
		{{ csrf_field() }}
		{{ method_field('DELETE') }}	
		<button class="btn btn-sm btn-dark row my-1" type="submit">BORRAR</button>
		</form>
    </td>
    </tr>

    <div class="modal fade" id="editarTarea_{{ $tarea->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title modal-popup-title" id="exampleModalLabel">Editar Tarea</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" class="form-popup" action="{{ route('tareas.update', $tarea->id) }}">
      <div class="modal-body">
        
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
        <button type="button" class="btn btn-light-si" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-light-si">Guardar</button>
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