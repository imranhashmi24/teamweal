<?php

namespace App\Models;

use App\Traits\LangDb;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialInvestment extends Model
{
    use HasFactory, Searchable, LangDb;

    protected $fillable = [
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
        return $this->hasMany(FinancialInvestmentList::class, 'service_id', 'id');
    }


    public function forms()
    {
        return $this->hasMany(FinancialInvestmentForm::class, 'service_id', 'id');
    }

}
