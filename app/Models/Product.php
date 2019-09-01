<?php

namespace App\Models;

use App\Util\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use  Filterable;

    protected $tablename = "products";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'created_at',
        'updated_at',
    ];

    /**
     * The products'name that have some discount in percent.
     *
     * @var array
     */
    protected $discounted = [
        'Pepsi Cola' => [
            'quantity' => 3,
            'discount' => 20,
        ],
    ];


    /**
     * function to check if product has a discount
     *
     * @return discount array  if exist or 0
     */
    public function getDiscount()
    {
        if (array_key_exists($this->name, $this->discounted)) {
            return $this->discounted[$this->name];
        }
        return 0;
    }


}
