<?php

namespace App\Util\Transformers;

class OrderTransformer extends Transformer
{
    protected $resourceName = 'order';


    /**
     * Transform a collection of order we can add extra data like custom attribute definded in Order model.
     *
     * @param Collection $order
     * @return array
     */
    public function transform($order)
    {
        $order['userFullname'] = $order->user->firstName . ' ' . $order->user->lastName;
        $order['productName'] = $order->product->name;
        $order['productPrice'] = $order->product->price;
        return $order;

    }
}
