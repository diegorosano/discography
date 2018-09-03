<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = "paises";
    public $timestamps = false;

    protected $fillable = ['nombre'];

    public function periodos()
    {
    	return $this->hasMany('App\Periodo');
    }
}
