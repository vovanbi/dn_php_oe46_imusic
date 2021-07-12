<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtistRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'=> 'required | unique:artists,name,'. $this->id,
            'info'=> 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=> trans('artist.required'),
            'name.unique'=> trans('artist.unique'),
            'info.required'=> trans('artist.required')
        ];
    }
}
