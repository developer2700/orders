<?php

namespace App\Util\Transformers;

class ProductTransformer extends Transformer
{
    protected $resourceName = 'product';


    /**
     * Transform a collection of product we can add extra data like custom attribute definded in product model.
     *
     * @param Collection $product
     * @return array
     */
    public function transform($product)
    {
        return $product;

    }
}
