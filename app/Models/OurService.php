<?php

namespace App\Models;

use App\Traits\LangDb;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurService extends Model
{
    use HasFactory, LangDb, Searchable;

    protected $fillable = [
        'title',
        'title_ar',
        'description',
        'description_ar',
        'image',
        'status',
    ];

    public static array $searchable = [
        'title',
        'title_ar',
        'description',
        'description_ar',
    ];


    public function lists()
    {
        return $this->hasMany(OurServiceList::class, 'our_service_id', 'id');
    }


    public function forms()
    {
        return $this->hasMany(OurServiceForm::class, 'our_service_id', 'id');
    }
}
