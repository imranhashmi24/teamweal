<?php

namespace App\Models;

use App\Traits\LangDb;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvestmentOpportunityCategory extends Model
{
    use HasFactory, Searchable, LangDb;

    protected $fillable = [
        'title',
        'title_ar',
        'parent_id',
        'image',
        'status',
    ];

    public function parent()
    {
        return $this->belongsTo(InvestmentOpportunityCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(InvestmentOpportunityCategory::class, 'parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    public static $searchable = ['title', 'title_ar'];


    public function investmentOpportunities()
    {
        return $this->hasMany(InvestmentOpportunity::class, 'category_id');
    }
}
