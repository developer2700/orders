<?php

namespace App\Http\Requests\Api;

class CreateProduct extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:products',
            'price' => 'required',
        ];
    }
}
