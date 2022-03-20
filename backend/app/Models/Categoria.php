<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    public $table = "inv_categorias";
    protected $primarykey = "id_categoria";
    protected $fillable = ['id_categoria','descripcion','usuario_crea','fecha_crea','usuario_modifica','estado'];
    protected $keyType="string";
    public $incrementing = true;
    public $timestamps = false;

}
