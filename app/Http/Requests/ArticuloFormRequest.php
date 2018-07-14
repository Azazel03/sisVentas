<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class ArticuloFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//retorna true para permitir la validacion de los datos
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        //reglas para validar en los formularios, required indica que es un campo obligatorio
            'idcategoria'=>'required',
            'codigo'=>'required|max:50',
            'nombre'=>'required|max:100',
            'stock'=>'required|numeric',//obliga al que el campo sea de tipo numerico
            'descripcion'=>'max:512',
            'imagen'=>'mimes:jpeg,bmp,png,jpg,ico,JPEG,JPG'//valida que los archivos de imagenes solo sean de esta extensión, si no lo son saldrá un mensaje de error
        ];
    }
}
