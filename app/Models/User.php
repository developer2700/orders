<?php

namespace App\Models;

use App\Util\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use  Filterable;

    protected $tablename = "users";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'firstName',
        'lastName',
        'created_at',
        'updated_at',
    ];

    /**
     * Get all the orders that belong to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class)->latest();
    }


    /**
     * Get user full name
     *
     * @return string fullname
     */
    public function getFullNameAttribute()
    {

        return $this->firstName . ' ' . $this->lastName;
    }

}
