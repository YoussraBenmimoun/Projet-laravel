<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = ['titre','description','date_de_publication','image','temps_de_preparation','temps_de_cuisson','niveau_de_difficulte'];

    public function commentaries(){
        return $this->hasMany(Commentary::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function ingredients(){
        return $this->belongsToMany(Ingredient::class)->withPivot('quantite');
    }
    // public function user(){
    //     return $this->belongsTo(User::class);
    // }

}
