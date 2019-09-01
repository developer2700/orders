<?php

namespace App\Models;

use App\Util\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use  Filterable;

    protected $tablename = "orders";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'created_at',
        'updated_at',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'user',
        'product'
    ];


    /**
     * Make sure that total price  is multiply by quantity
     * we also check if product has a discount
     * @param $value
     * @return string
     */
    public function setPriceAttribute($value)
    {
        $price = $this->quantity * $this->product->price;
        $discounted = $this->product->getDiscount();

        if ($discounted &&
            isset($discounted['discount']) &&
            $this->quantity >= $discounted['quantity']) {
            $price -= $price * ($discounted['discount'] / 100);
        }
        $this->attributes['price'] = $price;
    }

    /**
     * Get the user that belongs to this order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that belongs to this order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
