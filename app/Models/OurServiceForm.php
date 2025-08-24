<?php

namespace App\Models;

use App\Traits\LangDb;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OurServiceForm extends Model
{
    use HasFactory, Searchable, LangDb;

    protected $fillable = [
        'our_service_id',
        'name',
        'name_ar',
        'type',
        'required',
        'col',
        'options',
        'options_ar',
        'placeholder',
        'placeholder_ar',
        'status',
    ];

    public function ourService()
    {
        return $this->belongsTo(OurService::class);
    }

    public function getOptionsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getOptionsArAttribute($value)
    {
        return json_decode($value, true);
    }
 
    public static $searchable = [
        'name',
        'name_ar',
    ];
}
