<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function groceryLists()
    {
        return $this->hasMany(GroceryList::class);
    }

    public function recipeCategories()
    {
        return $this->hasMany(RecipeCategory::class);
    }
}
