<?php

namespace App\Models;

use App\Traits\LangDb;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvestmentOpportunity extends Model
{
    use HasFactory, Searchable, LangDb;

    protected $fillable = [
        'title',
        'title_ar',
        'description',
        'description_ar',
        'category_id',
        'image',
        'status',
    ];


    public function category()
    {
        return $this->belongsTo(InvestmentOpportunityCategory::class, 'category_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'id';
    }


    public static $searchable = [
        'title',
        'title_ar',
        'description',
        'description_ar',
    ];
}
