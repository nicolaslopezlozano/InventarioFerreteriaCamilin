<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $connection = 'mysql';
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function articulos(){
        return $this->hasMany(Articulo::class);
    }
}
