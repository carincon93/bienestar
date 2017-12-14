<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AprendizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('PUT')) {
            return [
                'nombre_completo'           =>  'required|max:128',
                'tipo_documento'            =>  'required|max:32',
                'numero_documento'          =>  'required|max:12|unique:aprendices,numero_documento,'.$this->route()->aprendiz.',id',
                'direccion'                 =>  'required|max:91',
                'barrio'                    =>  'required|max:64',
                'estrato'                   =>  'required|max:6',
                'email'                     =>  'required|max:191|unique:aprendices,id,:id',
                'programa_formacion'        =>  'required|max:128',
                'numero_ficha'              =>  'required|max:11',
                'jornada'                   =>  'required|max:32',
                'pregunta1'                 =>  'required',
                'pregunta3'                 =>  'required',
                'otro_apoyo'                =>  'required|max:128',
                'compromiso_informar'       =>  'max:2',
                'compromiso_normas'         =>  'max:2',
                'justificacion_suplemento'  =>  'required',
            ];
        } else {
            return [
                'nombre_completo'           =>  'required|max:128',
                'tipo_documento'            =>  'required|max:32',
                'numero_documento'          =>  'required|max:12|unique:aprendices',
                'direccion'                 =>  'required|max:91',
                'barrio'                    =>  'required|max:64',
                'estrato'                   =>  'required|max:6',
                'email'                     =>  'required|max:191|unique:aprendices',
                'programa_formacion'        =>  'required|max:128',
                'numero_ficha'              =>  'required|max:11',
                'jornada'                   =>  'required|max:32',
                'pregunta1'                 =>  'required',
                'pregunta3'                 =>  'required',
                'otro_apoyo'                =>  'required|max:128',
                'compromiso_informar'       =>  'max:2',
                'compromiso_normas'         =>  'max:2',
                'justificacion_suplemento'  =>  'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'nombre_completo.required'           =>  'El nombre completo es requerido',
            'nombre_completo.max'                =>  'El máximo permitido de caracteres es 128',
            'tipo_documento.required'            =>  'El tipo de documento es requerido',
            'tipo_documento.max'                 =>  'El máximo permitido de caracteres es 32',
            'numero_documento.required'          =>  'El número de documento es requerido',
            'numero_documento.max'               =>  'El máximo permitido de caracteres es 12',
            'numero_documento.unique'            =>  'Este número de documento ya existe',
            'direccion.required'                 =>  'El dirección es requerido',
            'direccion.max'                      =>  'El máximo permitido de caracteres es 91',
            'barrio.required'                    =>  'El barrio es requerido',
            'barrio.max'                         =>  'El máximo permitido de caracteres es 64',
            'estrato.required'                   =>  'El estrato es requerido',
            'estrato.max'                        =>  'El máximo permitido de caracteres es 6',
            'email.required'                     =>  'El correo electrónico es requerido',
            'email.max'                          =>  'El máximo permitido de caracteres es 191',
            'email.unique'                       =>  'Este correo electrónico ya existe',
            'programa_formacion.required'        =>  'El programa de formación es requerido',
            'programa_formacion.max'             =>  'El máximo permitido de caracteres es 128',
            'numero_ficha.required'              =>  'El número de ficha es requerido',
            'numero_ficha.max'                   =>  'El máximo permitido de caracteres es 11',
            'jornada.required'                   =>  'La jornada es requerido',
            'jornada.max'                        =>  'El máximo permitido de caracteres es 32',
            'pregunta1.required'                 =>  'Este campo es requerido',
            'pregunta2.required'                 =>  'Este campo es requerido',
            'pregunta3.required'                 =>  'Este campo es requerido',
            'otro_apoyo.required'                =>  'Este campo es requerido',
            'compromiso_informar.max'            =>  'El máximo permitido de caracteres es 2',
            'compromiso_normas.max'              =>  'El máximo permitido de caracteres es 32',
            'justificacion_suplemento.required'  =>  'Este campo es requerido',
        ];
    }
}
