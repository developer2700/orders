<?php

namespace App\Util\Filters;


class UserFilter extends Filter
{
    /**
     * Filter by firstName.
     * Get all the users by the given firstName.
     *
     * @param $firstName
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function firstName($firstName)
    {
        return $this->builder->where('firstName', 'like', $firstName . '%');
    }

    /**
     * Filter by lastName.
     * Get all the users by the given $lastName.
     *
     * @param $lastName
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function lastName($lastName)
    {
        return $this->builder->where('lastName', 'like', $lastName . '%');
    }

    /**
     * Filter by fullName (firstName or lastName).
     * Get all the users by the given $fullName.
     *
     * @param $fullName
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function fullName($fullName)
    {
        return $this->builder
            ->where('firstName', 'like', $fullName . '%')
            ->orWhere('lastName', 'like', $fullName . '%');
    }


}
