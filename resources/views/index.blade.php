@extends('layouts.layoutMain')
@section('title', 'Inicio')
@section('content')
@include('utils.navegacion')
@include('components.categoriaUpdate')

    <div class="container mx-auto p-4">

        <form method="GET" action="{{ route('inicio') }}" class="mb-6 flex flex-col sm:flex-row items-center gap-3">
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
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Listado de Categorías</h2>

                <table class="min-w-full table-auto text-sm text-left border-collapse">
                    <thead class="bg-blue-100 text-blue-800 uppercase tracking-wide text-xs">
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Nombre</th>
                            <th class="px-4 py-2 border">Descripción</th>
                            <th class="px-4 py-2 border text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categoria as $cat)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $cat->id_categoria }}</td>
                                <td class="px-4 py-2 border">{{ $cat->nombre }}</td>
                                <td class="px-4 py-2 border">{{ $cat->descripcion }}</td>
                                <td class="px-4 py-2 border text-center">
                                    <div class="flex justify-center gap-2">
                                        <button onclick="mostrarModal({{ $cat }})"
                                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm"
                                            title="Editar">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z">
                                                </path>
                                            </svg>
                                        </button>
                                        <form method="POST" action="{{ route('categorias.destroy', $cat->id_categoria) }}"
                                            onsubmit="return confirm('¿Eliminar esta categoría?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
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
                                <td colspan="4" class="text-center py-4 text-gray-500">No hay categorías registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Paginación --}}
                <div class="mt-4">
                    {{ $categoria->links() }}
                </div>
            </div>

            {{-- Formulario de agregar categoría --}}
            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Agregar Categoría</h2>
                <form method="POST" action="{{ route('categorias.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm text-gray-700 mb-1">Nombre:</label>
                        <input type="text" name="nombre" id="nombre"
                            class="w-full border-gray-300 rounded-lg shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm text-gray-700 mb-1">Descripción:</label>
                        <textarea name="descripcion" id="descripcion"
                            class="w-full border-gray-300 rounded-lg shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg transition">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>



    <script>
        function mostrarModal(cat) {
            document.getElementById('modal-editar').classList.remove('hidden');
            document.getElementById('edit-id').value = cat.id_categoria;
            document.getElementById('edit-nombre').value = cat.nombre;
            document.getElementById('edit-descripcion').value = cat.descripcion;
            document.getElementById('form-editar').action = '/categorias/' + cat.id_categoria;
        }

        function cerrarModal() {
            document.getElementById('modal-editar').classList.add('hidden');
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

@endsection
