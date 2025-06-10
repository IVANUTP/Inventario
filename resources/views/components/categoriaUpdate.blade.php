<div id="modal-editar" class="hidden fixed inset-0 bg-gray-200 bg-opacity-40 flex items-center justify-center z-50">

        <div class="bg-white rounded-lg p-6 w-full max-w-md relative shadow-xl">
            <h2 class="text-lg font-semibold mb-4">Editar Categoría</h2>
            <form method="POST" id="form-editar">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_categoria" id="edit-id">
                <div class="mb-3">
                    <label class="block text-sm">Nombre:</label>
                    <input type="text" name="nombre" id="edit-nombre" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-3">
                    <label class="block text-sm">Descripción:</label>
                    <textarea name="descripcion" id="edit-descripcion" class="w-full border rounded px-3 py-2"></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="cerrarModal()"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Cancelar</button>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
