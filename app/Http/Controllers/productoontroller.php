<?php

namespace App\Http\Controllers;

use App\Models\CategoriaModel;
use App\Models\productosModel;
use Illuminate\Http\Request;

class productoontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = productosModel::query();

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%$buscar%")
                    ->orWhere('descripcion', 'like', "%$buscar%");
            });
        }

        $productos = $query->paginate(5)->withQueryString();
        $categorias = CategoriaModel::all();

        return view('productos', compact('productos', 'categorias'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required',
            'cantidad' => 'required|integer',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser un texto válido.',
            'nombre.max' => 'El nombre no debe superar los 255 caracteres.',

            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser un texto válido.',

            'precio.required' => 'El precio es obligatorio.',

            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
        ]);



        $path = $request->file('img')->store('productos', 'public');

        productosModel::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'categoriaId' => $request->categoriaId,
            'img' => $path,
        ]);

        return redirect()->route('productos')->with('success', 'Producto agregado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
            'categoriaId' => 'required|exists:categorias,id_categoria',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Buscar el producto
        $producto = productosModel::findOrFail($id);

        // Actualizar los campos
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;
        $producto->categoriaId = $request->categoriaId;

        // Si se sube una nueva imagen
        if ($request->hasFile('img')) {
            // Guardar la nueva imagen
            $producto->img = $request->file('img')->store('productos', 'public');
        }

        $producto->save();


        return redirect()->route('productos')->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = productosModel::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos')->with('success', 'Producto eliminado correctamente');
    }
}
