<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disco extends Model
{
    protected $table = 'discos';
    public $timestamps = false;

    protected $fillable = [
    	'nombre',
    	'banda_id',
        'anio',
    	'portada'
    ];

    public function periodos()
    {
    	return $this->hasMany('App\Periodo');
    }

    public function banda()
    {
        return $this->belongsTo('App\Banda', 'banda_id');
    }
}
