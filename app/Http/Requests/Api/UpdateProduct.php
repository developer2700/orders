<?php

namespace App\Http\Requests\Api;

class UpdateProduct extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price' => 'required',
            'name' => 'required|max:255,unique:products,' . $this->product,
        ];
    }

}
