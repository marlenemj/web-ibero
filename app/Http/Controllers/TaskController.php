<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //VISTA PRINCIPAL
    //LISTADO DE TAREAS
    public function index()
    {
        // Colección de Tareas
        $tareas = Task::all();

        return view('index')->with('tareas', $tareas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //VISTA CREAR
    //FORMULARIO DE CREACIÓN
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tarea = Task::create( [
            'name' => $request->name ,
            'description' => $request->description ,
            'status' => $request->status ,
            'due_date' => $request->due_date ,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    // VISTA DE UNA SOLA TAREA
    public function show($id)
    {
        $tarea = Task::find($id);

        return view('show')->with('tarea', $tarea);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    // ACTUALIZAR / EDITAR
    public function edit($id)
    {
        $tarea = Task::find($id);

        return view('edit')->with('tarea', $tarea);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //MODO NOOB
        $tarea = Task::find($id);

        $tarea->name = $request->name;
        $tarea->description = $request->description;
        $tarea->status = $request->status;
        $tarea->due_date = $request->due_date;

        $tarea->save();
        

        //Modo Pro
        /*
        $tarea = Task::find($id);

        $tarea->update([
            'name' => $request->name,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ])
        */

        //Regreso al usuario a la pantalla del detalle de tarea.
        return redirect()->route('tareas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    // BORRAR
    public function destroy($id)
    {
        $tarea = Task::find($id);
        $tarea->delete();

        return redirect()->route('tareas.index');
    }

    public function changeStatus($id)
    {
        $tarea = Task::find($id);

        if ($tarea->is_completed == false) {
            $tarea->is_completed = true;
        } else {
            $tarea->is_completed = false;
        }

        $tarea->save();

        return redirect()->back();
    }
}
