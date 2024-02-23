<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'visited_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
