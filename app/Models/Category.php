<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\LangDb;
class Category extends Model
{
    use HasFactory, LangDb;

    protected $fillable = [
        'parent_id',
        'name',
        'name_ar',
        'is_featured',
    ];

    public static function marketing()
    {
        return self::query()->whereBetween('id', [26, '36'])->get();
    }

    public function getImageUrlAttribute($value)
    {
        $image = public_path(getFilePath('category') .'/' . $this->image);

        if (is_file($image)) {
            return asset(getFilePath('category') .'/' . $this->image);
        }
        return asset('assets/img/no-photo-available.png');
    }


    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    // this is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();
        self::deleting(function ($category) { // before delete() method call this
            $category->services()->each(function ($service) {
                $service->delete(); // <-- direct deletion
            });

            $image = public_path(getFilePath('category') .'/' . $category->image);
            if (is_file($image)) {
                unlink($image);
            }
        });
    }
    
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
