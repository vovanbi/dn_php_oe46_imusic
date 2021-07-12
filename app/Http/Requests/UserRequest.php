<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fullname'=> 'required|max:50',
            'email'   => 'required|unique:users',
            'phone'   => 'required',
            'password'=> 'required|confirmed',
            'is_admin'=>'required',
            'avatar'  => 'nullable|mimes:jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'fullname.required'=> trans('user.required'),
            'fullname.unique'=> trans('user.unique'),
            'fullname.max' => trans('user.max'),
            'password.required'=> trans('user.required'),
            'phone.required'=> trans('user.required'),
            'is_admin.required'=> trans('user.required'),
            'avatar.nullable'=> trans('user.required'),
            'avatar.mimes'=> trans('user.mimes'),
            'email.required'=> trans('user.required'),
            'email.unique'=> trans('user.unique'),
         ];
    }
}
