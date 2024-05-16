<?php

namespace App\Http\Controllers;

use App\Models\Mondongo;
use Illuminate\Http\Request;

class MondongoController extends Controller
{

    public function index()
    {
        $mondongos = Mondongo::all();
        return view('mondongos.index', compact('mondongos'));

        //alternativas a compact
        //return view('students.index')->with('students', $students);
        //return view('students.index', ['students' => $students]);
    }

    public function create()
    {
        return view('mondongos.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

         // Crear un nuevo estudiante usando el método `create` del modelo
        Mondongo::create($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('mondongos.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $mondongo = Mondongo::findOrFail($id);
        return view('mondongos.edit', compact('mondongo'));
    }

    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:1|max:255',
        ]);

        // Buscar el estudiante por su ID
        $mondongo = Mondongo::findOrFail($id);

        // Actualizar los datos del estudiante
        $mondongo->update($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('mondongos.index');
    }

    public function destroy(string $id)
    {
        $mondongo = Mondongo::findOrFail($id);

        $mondongo->delete();

        return redirect()->route('mondongos.index');
    }
}
