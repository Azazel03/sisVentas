<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class CategoriaFormRequest extends Request
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
        return [
            'nombre'=>'required|max:50', //permite atrapar el nombre de formulario y que como maximo tenga 50 caracteres
            'descripcion'=>'max:256', //permite atrapar el descripcion de formulario y que como maximo tenga 256 caracteres
        ];
    }
}
