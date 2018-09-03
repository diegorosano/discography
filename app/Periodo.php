<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = 'periodos';
    public $timestamps = false;

    protected $fillable = [
    	'banda_id',
    	'disco_id',
    	'servicio_id',
    	'pais_id',
    	'cantidad',
    	'total'
    ];

    public function banda()
    {
        return $this->belongsTo('App\Banda', 'banda_id');
    }

    public function disco()
    {
        return $this->belongsTo('App\Disco', 'disco_id');
    }

    public function servicio()
    {
        return $this->belongsTo('App\Servicio', 'servicio_id');
    }

    public function pais()
    {
        return $this->belongsTo('App\Pais', 'pais_id');
    }
}
