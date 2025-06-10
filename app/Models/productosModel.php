<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class productosModel extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $primaryKey = 'idProducto';

    public $timestamps = true;
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'cantidad',
        'categoriaId',
        'img'
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaModel::class, 'categoriaId');
    }

}
