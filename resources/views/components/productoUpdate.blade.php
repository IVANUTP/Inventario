    <div id="modal-editar-producto"
        class="hidden fixed inset-0  bg-gray-200 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-xl relative shadow-xl">
            <h2 class="text-lg font-semibold mb-4">Editar Producto</h2>
            <form method="POST" id="form-editar-producto" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="idProducto" id="edit-idProducto">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm">Nombre:</label>
                        <input type="text" name="nombre" id="edit-nombre" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm">Precio:</label>
                        <input type="number" step="0.01" name="precio" id="edit-precio"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm">Cantidad:</label>
                        <input type="number" name="cantidad" id="edit-cantidad"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm">Categoría:</label>
                        <select name="categoriaId" id="edit-categoriaId" class="w-full border rounded px-3 py-2">
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm">Descripción:</label>
                        <textarea name="descripcion" id="edit-descripcion" class="w-full border rounded px-3 py-2"></textarea>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm">Imagen:</label>
                        <input type="file" name="img" id="edit-img" class="w-full border rounded px-3 py-2">
                    </div>
                </div>
                <div class="flex justify-end mt-4 gap-2">
                    <button type="button" onclick="cerrarModalProducto()"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Cancelar</button>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
