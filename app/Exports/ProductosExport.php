<?php

namespace App\Exports;

use App\Models\productosModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ProductosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return productosModel::select('idProducto', 'nombre', 'descripcion', 'precio', 'cantidad', 'categoriaId')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Descripción', 'Precio', 'Cantidad', 'Categoría ID'];
    }
}
