<?php

namespace App\Models;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;
    protected $fillable = ['nom'];

    // ,'ingredient_recipe','ingredient_id','recipe_id'

    public function recipes(){
        return $this->belongsToMany(Recipe::class)->withPivot('quantite');
    }
}
