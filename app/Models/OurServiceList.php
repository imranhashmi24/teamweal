<?php

namespace App\Models;

use App\Traits\LangDb;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OurServiceList extends Model
{
    use HasFactory, Searchable, LangDb;

    protected $fillable = [
        'our_service_id',
        'title',
        'title_ar',
        'status',
    ];

    public function ourService()
    {
        return $this->belongsTo(OurService::class);
    }


    public static $searchable = [
        'title',
        'title_ar',
    ];
}
