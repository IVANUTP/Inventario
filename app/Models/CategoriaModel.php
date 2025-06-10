<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaModel extends Model
{
    use HasFactory;

    protected $table = 'categorias'; // Nombre de la tabla en la BD
    protected $primaryKey = 'id_categoria'; // Clave primaria personalizada

    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion'];
    public function productos()
    {
        return $this->hasMany(productosModel::class, 'categoriaId', 'id_categoria');
    }
}
