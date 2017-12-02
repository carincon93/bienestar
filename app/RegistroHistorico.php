<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DateTranslator;

class RegistroHistorico extends Model
{
    protected $table = 'registros_historicos';

    protected $fillable = [
        'aprendiz_id', 'fecha',
    ];

    public $timestamps = false;


    public function aprendiz()
    {
    	return $this->belongsTo('App\Aprendiz');
    }
}
