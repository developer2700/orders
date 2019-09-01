<?php

namespace App\Util\Filters;


class OrderFilter extends Filter
{
    /**
     * Filter by price greater than
     * Get all the orders by the price greater than $amount.
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
     * Filter by user's name .
     * Get all the orders by the name of user (firstname or lastname)
     *
     * @param $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function fullName($fullName)
    {
        return $this->builder->whereHas('user', function ($query) use ($fullName) {
            $query->where('firstName', 'like', $fullName . '%')
                ->orWhere('lastName', 'like', $fullName . '%');
        });
    }

    /**
     * Filter by product's name .
     * Get all the orders by the name of product
     *
     * @param $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function productName($name)
    {
        return $this->builder->whereHas('product', function ($query) use ($name) {
            $query->where('name', 'like', $name . '%');
        });
    }

    /* Filter by  product's or user's name.
     * Get all the orders by the name of user (firstname or lastname) or name of product.
     *
     * @param $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function text($name)
    {
        return $this->builder->whereHas('user', function ($query) use ($name) {
            $query->where('firstName', 'like', $name . '%')
                ->orWhere('lastName', 'like', $name . '%');
        })->orWhereHas('product', function ($query) use ($name) {
            $query->where('name', 'like', $name . '%');
        });
    }


    /* Filter by  order's createdTime
   * Get all the orders by the date of searche (all / since last week / today)
   *
   * @param $time
   * @return \Illuminate\Database\Eloquent\Builder
   */
    protected function createdTime($createdTime)
    {
        switch ($createdTime) {
            case 'today':
                return $this->builder->where('created_at', '>=', date('Y-m-d'));
                break;
            case 'week':
                return $this->builder->where('created_at', '>=', date('Y-m-d', strtotime('-7 days')));
                break;
            default :
                //nothing all of them
        }

    }


}
