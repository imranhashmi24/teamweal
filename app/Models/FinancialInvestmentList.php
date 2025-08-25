<?php

namespace App\Models;

use App\Traits\LangDb;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinancialInvestmentList extends Model
{
    use HasFactory, Searchable, LangDb;

    protected $fillable = [
        'service_id',
        'title',
        'title_ar',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(FinancialInvestment::class, 'service_id', 'id');
    }


    public static $searchable = [
        'title',
        'title_ar',
    ];
}
