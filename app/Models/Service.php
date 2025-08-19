<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory, Searchable;

    protected  $guarded = [];

    protected $with = 'category';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the
     *
     * @param  string  $value
     * @return string
     */
    public function getImageUrlAttribute($value)
    {
        $image = public_path(getFilePath('service') .'/'. $this->image);

        if (is_file($image)) {
            return asset(getFilePath('service') .'/'.  $this->image);
        }
        return asset('assets/img/no-photo-available.png');
    }

    // this is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();
        self::deleting(function ($service) { // before delete() method call this
            $image = public_path(getFilePath('service') . $service->image);
            if (is_file($image)) {
                unlink($image);
            }
        });
    }
}
