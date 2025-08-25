<?php

namespace App\Models;

use App\Traits\LangDb;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory, Searchable, LangDb;

    protected $fillable = [
        'type',
        'title',
        'title_ar',
        'description',
        'description_ar',
        'image',
        'status',
    ];

    protected $searchable = [
        'title',
        'title_ar',
    ];


    public function lists()
    {
        return $this->hasMany(SectorList::class, 'service_id', 'id');
    }


    public function forms()
    {
        return $this->hasMany(SectorForm::class, 'service_id', 'id');
    }

}
