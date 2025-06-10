@extends('layouts.layoutMain')
@section('title', 'Productos')
@include('utils.navegacion')
@include('components.productoUpdate')

@section('content')
    <div class="container mx-auto p-4">
        <form method="GET" action="{{ route('productos') }}" class="mb-6 flex flex-col sm:flex-row items-center gap-3">
            <input type="text" name="buscar" value="{{ request('buscar') }}"
                class="border border-gray-300 px-4 py-2 rounded-lg w-full sm:w-1/2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Buscar por nombre o descripción">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition shadow-sm">
                Buscar
            </button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2 bg-white shadow-lg rounded-lg p-4 border border-gray-200 overflow-x-auto">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Listado de Productos</h2>

                <table class="min-w-full table-auto text-sm text-left border-collapse">
                    <thead class="bg-blue-100 text-blue-800 uppercase tracking-wide text-xs">
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Nombre</th>
                            <th class="px-4 py-2 border">Descripción</th>
                            <th class="px-4 py-2 border">Precio</th>
                            <th class="px-4 py-2 border">Cantidad</th>
                            <th class="px-4 py-2 border">Categoria</th>
                            <th class="px-4 py-2 border">Imagen</th>
                            <th class="px-4 py-2 border text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productos as $producto)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $producto->idProducto }}</td>
                                <td class="px-4 py-2 border">{{ $producto->nombre }}</td>
                                <td class="px-4 py-2 border">{{ $producto->descripcion }}</td>
                                <td class="px-4 py-2 border">${{ number_format($producto->precio, 2) }}</td>
                                <td class="px-4 py-2 border">{{ $producto->cantidad }}</td>
                                <td class="px-4 py-2 border">
                                    {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                                </td>
                                <td class="px-4 py-2 border">
                                    <img src="{{ asset('storage/' . $producto->img) }}" class="w-12 h-12 object-cover"
                                        alt="Imagen">
                                </td>
                                <td class="px-4 py-2 border text-center">
                                    <div class="flex justify-center space-x-2">

                                        <button onclick='mostrarModalProducto(@json($producto))'
                                            class="bg-yellow-400 hover:bg-yellow-500 text-white p-2 rounded inline-flex items-center justify-center"
                                            title="Editar">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z">
                                                </path>
                                            </svg>
                                        </button>

                                        <form method="POST"
                                            action="{{ route('productos.destroy', $producto->idProducto) }}"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white p-2 rounded inline-flex items-center justify-center"
                                                title="Eliminar">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>



                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-gray-500">No hay productos registrados.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

                {{-- Paginación --}}
                <div class="mt-4">
                    {{ $productos->links() }}
                </div>
            </div>

            {{-- Formulario de agregar categoría --}}
            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Agregar Producto</h2>

                <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="nombre" class="block text-sm text-gray-700 mb-1">Nombre:</label>
                        <input type="text" name="nombre" id="nombre"
                            class="w-full border-gray-300 rounded-lg shadow-sm px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm text-gray-700 mb-1">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" class="w-full border-gray-300 rounded-lg shadow-sm px-3 py-2"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="precio" class="block text-sm text-gray-700 mb-1">Precio:</label>
                        <input type="number" name="precio" id="precio"
                            class="w-full border-gray-300 rounded-lg shadow-sm px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label for="cantidad" class="block text-sm text-gray-700 mb-1">Cantidad:</label>
                        <input type="number" name="cantidad" id="cantidad"
                            class="w-full border-gray-300 rounded-lg shadow-sm px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label for="categoriaId" class="block text-sm text-gray-700 mb-1">Categoría:</label>
                        <select name="categoriaId" id="categoriaId"
                            class="w-full border-gray-300 rounded-lg shadow-sm px-3 py-2">
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="img" class="block text-sm text-gray-700 mb-1">Imagen:</label>
                        <input type="file" name="img" id="img" accept="image/*"
                            class="w-full border-gray-300 rounded-lg shadow-sm px-3 py-2">
                        <!-- Contenedor del preview -->
                        <div id="preview-container" class="mt-4">
                            <img id="preview-image" src="" alt="Vista previa de la imagen"
                                class="hidden max-w-xs rounded shadow-md">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg transition">
                        Guardar Producto
                    </button>
                </form>
            </div>

        </div>
    </div>



    <script>
        function mostrarModalProducto(producto) {
            document.getElementById('modal-editar-producto').classList.remove('hidden');
            document.getElementById('edit-idProducto').value = producto.idProducto;
            document.getElementById('edit-nombre').value = producto.nombre;
            document.getElementById('edit-descripcion').value = producto.descripcion;
            document.getElementById('edit-precio').value = producto.precio;
            document.getElementById('edit-cantidad').value = producto.cantidad;
            document.getElementById('edit-categoriaId').value = producto.categoriaId;

            // Define la acción del formulario
            document.getElementById('form-editar-producto').action = `/productos/${producto.idProducto}`;
        }

        function cerrarModalProducto() {
            document.getElementById('modal-editar-producto').classList.add('hidden');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->any())
        <script>
            Swal.fire({
                title: 'Error de validación',
                icon: 'error',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif

    <script>
    const input = document.getElementById('img');
    const previewImage = document.getElementById('preview-image');

    input.addEventListener('change', function (e) {
        const file = e.target.files[0];

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function (event) {
                previewImage.src = event.target.result;
                previewImage.classList.remove('hidden');
            }

            reader.readAsDataURL(file);
        } else {
            previewImage.src = '';
            previewImage.classList.add('hidden');
        }
    });
</script>



@endsection
