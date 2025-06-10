<?php

namespace App\Http\Controllers;

use App\Exports\ProductosExport;
use App\Models\productosModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class Reportes extends Controller
{
    public function index()
    {
        $productosPorMes = productosModel::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        // Opcional: traducir nombres de los meses


        $meses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];

        $labels = [];
        $datos = [];
        $productos=productosModel::all();

        foreach ($productosPorMes as $registro) {
            $labels[] = $meses[$registro->mes];
            $datos[] = $registro->total;
        }

        return view('Reportes', compact('labels', 'datos','productos'));
    }

    public function exportarExcel()
    {
        return Excel::download(new ProductosExport, 'productos.xlsx');
    }
}
