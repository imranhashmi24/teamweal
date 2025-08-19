<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authority extends Model
{
    use HasFactory, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'logo', 'title', 'title_ar'];


    public function opportunities()
    {
        return $this->hasMany(Opportunity::class);
    }

    public function getImageUrlAttribute($value)
    {
        $image = public_path(getFilePath('authority') .'/' . $this->logo);

        if (is_file($image)) {
            return asset(getFilePath('authority') .'/' . $this->logo);
        }
        return asset('assets/img/no-photo-available.png');
    }

}
