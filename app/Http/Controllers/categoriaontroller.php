<?php

namespace App\Http\Controllers;
use Illuminate\Support\MessageBag;
use App\Models\CategoriaModel;
use Illuminate\Http\Request;

class categoriaontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CategoriaModel::query();

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%$buscar%")
                    ->orWhere('descripcion', 'like', "%$buscar%");
            });
        }

        $categoria = $query->paginate(5)->withQueryString(); // 5 por página

        return view('index', compact('categoria'));
    }

    public function store(Request $request)
    {
        //  Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser un texto válido.',
            'nombre.max' => 'El nombre no debe superar los 255 caracteres.',

            'descripcion.string' => 'La descripción debe ser un texto válido.',
            'descripcion.max' => 'La descripción no debe superar los 1000 caracteres.',
        ]);

        CategoriaModel::create($request->only('nombre', 'descripcion'));

        return redirect()->route('inicio')->with('success', 'Categoría agregada');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        $cat = CategoriaModel::findOrFail($id);
        $cat->update($request->only('nombre', 'descripcion'));

        return redirect()->route('inicio')->with('success', 'Categoría actualizada');
    }


    public function destroy($id)
    {
        $cat = CategoriaModel::findOrFail($id);

        // Verifica si hay productos relacionados
        if ($cat->productos()->count() > 0) {
            $errors = new MessageBag(['No puedes eliminar esta categoría porque tiene productos asociados.']);
            return redirect()->route('inicio')->withErrors($errors);
        }

        $cat->delete();

        return redirect()->route('inicio')->with('success', 'Categoría eliminada correctamente');
    }

}
