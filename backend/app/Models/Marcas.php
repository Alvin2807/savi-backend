<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    use HasFactory;

    public $table ="inv_marcas";
    protected $primarykey ="id_marca";
    protected $fillable = ['id_marca','nombre_marca'];
    protected $keyType = "string";
    public $incrementing = true;
    public $timestamps = false;
}
