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
  Crear Nuevo Proyecto
	</button>
	</div>
	</div>
</div>
		
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Proyecto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="POST" class="pe-4" action="{{ route('proyectos.store') }}">
      <div class="modal-body">
        
      	<!-- Nuestro campo de protección de formulario -->
		{{ csrf_field() }}

		<!-- Campos de formulario -->
		<div class="form-group mb-3">
			<label>Nombre de proyecto</label><br>
			<input class="form-control" type="text" name="name" placeholder="Nombre de Tarea">
		</div>

		<div class="form-group mb-3">
			<label>Descripción</label>
			<textarea class="form-control" name="description"></textarea>
		</div>
		
		<div class="form-group mb-3">
			<label>Fecha final</label>
			<input class="form-control" type="date" name="final_date">
		</div>

    <div class="form-group mb-3">
      <label>Color de proyecto</label>
      <input type="color" class="form-control" name="hex"></input>
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
				<h5 class="card-header">Listado de Proyectos</h5>
				<div class="card-body">
					<h5 class="card-title">Proyectos en curso</h5>
					<p class="card-text">Este es tu listado principal de proyectos, ponte a trabajar.</p>
        </div>
      </div>
    </div>
  </div>

          <div class="row">
            @foreach($proyectos as $proyecto)
            <div class="col-md-4 mt-4">
              <div class="card">
                <div class="line-color" style="height: 5px; width: 100%; background-color: {{ $proyecto->hex }}"></div>
                <div class="card-body">
                  <h4>{{ $proyecto->name }}</h4>
                  <p>{{ $proyecto->description }}</p>
                </div>

                <div class="tareas">
                  <ul>
                    @foreach($proyecto->tareas as $tarea)
                    <li>{{ $tarea->name }}</li>
                    @endforeach
                  </ul>
                </div>

                <a href="" class="btn btn-light btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal2{{$proyecto->id}}">Agregar Tarea</a>
              </div>
            </div>
            @endforeach
          </div>
        </div>

        @foreach($proyectos as $proyecto)
        <div class="modal fade" id="exampleModal2{{$proyecto->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <input type="hidden" name="project_id" value="{{ $proyecto->id }}">

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
@endforeach

        @endsection