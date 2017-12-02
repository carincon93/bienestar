<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\InsertOnDuplicateKey;
use App\Traits\DateTranslator;

class Aprendiz extends Model
{
    use InsertOnDuplicateKey;

    protected $table = 'aprendices';

    protected $fillable = [
        'nombre_completo',
        'tipo_documento',
        'numero_documento',
        'direccion',
        'barrio',
        'estrato',
        'telefono',
        'email',
        'programa_formacion',
        'numero_ficha',
        'jornada',
        'pregunta1',
        'pregunta3',
        'otro_apoyo',
        'compromiso_informar',
        'compromiso_normas',
        'justificacion_suplemento',
        'novedad_solicitud',
        'estado_beneficio',
        'estado_solicitud',
    ];

    public function scopeNumero_documento($query, $numero_documento)
    {
        if (trim($numero_documento) != '') {
            $query->where('numero_documento', '=', "$numero_documento")->where('estado_solicitud', 1);
        }
    }

    public function registros_historicos()
    {
    	return $this->hasMany('App\RegistroHistorico');
    }
}
