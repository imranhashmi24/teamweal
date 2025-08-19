<?php

namespace App\Models;

use App\Traits\LangDb;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends Model
{
    use HasFactory, LangDb;


    protected $fillable = [
        "user_id",
        "property_id"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }


}
