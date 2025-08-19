<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Project extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title',
        'title_ar',
        'url',
        'image',
        'description',
        'description_ar',
    ];

    public function getImageUrlAttribute($value)
    {
        $image = public_path(getFilePath('project') .'/'. $this->image);

        if (is_file($image)) {
            return asset(getFilePath('project') .'/'.  $this->image);
        }

        return asset('assets/img/no-photo-available.png');
    }
}
