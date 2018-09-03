<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banda extends Model
{
    protected $table = 'bandas';
    public $timestamps = false;

    protected $fillable = [
    	'nombre',
    	'descripcion',
    	'avatar'
    ];

    public function periodos()
    {
    	return $this->hasMany('App\Periodo');
    }

    public function usuarios()
    {
        return $this->hasMany('App\User');
    }

}
