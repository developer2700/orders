<?php

namespace App\Http\Requests\Api;

class CreateOrder extends ApiRequest
{
    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    /*protected function validationData()
    {
        return $this->get('order') ?: [];
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ];
    }
}
