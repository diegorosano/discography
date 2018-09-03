<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicios';
    public $timestamps = false;

    protected $fillable = ['nombre', 'precio', 'descripcion'];

    public function periodos()
    {
    	return $this->hasMany('App\Periodo');
    }
}
