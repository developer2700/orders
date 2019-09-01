<?php

namespace App\Http\Requests\Api;

class UpdateOrder extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required',
            'user_id' => 'required',
            'quantity' => 'required',
        ];
    }

}
