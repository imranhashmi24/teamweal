<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousWork extends Model
{
    use HasFactory, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'title_ar',
        'image',
    ];


    public function getImageUrlAttribute($value)
    {
        $image = public_path(getFilePath('previous_work') .'/'. $this->image);


        if (is_file($image)) {
            return asset(getFilePath('previous_work') .'/'.  $this->image);
        }
        return asset('assets/img/no-photo-available.png');
    }
}
