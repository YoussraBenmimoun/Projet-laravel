<?php

namespace App\Models;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['nom','image'];

    // ,'category_recipe','category_id','recipe_id'

    public function recipes(){
        return $this->belongsToMany(Recipe::class);
    }
}
