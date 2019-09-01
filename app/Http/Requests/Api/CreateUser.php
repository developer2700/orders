<?php

namespace App\Http\Requests\Api;

class CreateUser extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'email|max:255|unique:users',
        ];
    }
}
