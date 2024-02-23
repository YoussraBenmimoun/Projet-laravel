<?php

namespace App\Models;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commentary extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','contenu'];

    public function recipe(){
        return $this->belongsTo(Recipe::class,'recipe_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
