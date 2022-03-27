<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelos extends Model
{
    use HasFactory;
    public $table = "inv_modelos";
    protected $primarykey = "id_modelo";
    protected $fillable = ['id_modelo','fk_marca','nombre_modelo'];
    protected $keyType = "string";
    public $incrementing = true;
    public $timestamps = false;

}
