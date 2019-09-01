<?php

namespace App\Util\Filters;


class ProductFilter extends Filter
{
    /**
     * Filter by price greater than
     * Get all the products by the price greater than $amount.
     *
     * @param $amount
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function min_price($amount)
    {
        return $this->builder->where('price', '>=', $amount);
    }

    /**
     * Filter by price lower than amount
     * Get all the orders by the price lower than $amount.
     *
     * @param $amount
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function max_price($amount)
    {
        return $this->builder->where('price', '<=', $amount);
    }

    /**
     * Filter by name .
     * Get all the products by the name  .
     *
     * @param $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function name($name)
    {
        return $this->builder->where('name', 'like', $name . '%');
    }


}
