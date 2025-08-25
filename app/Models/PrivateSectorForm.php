<?php

namespace App\Models;

use App\Traits\LangDb;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrivateSectorForm extends Model
{
    use HasFactory, Searchable, LangDb;

    protected $fillable = [
        'service_id',
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
        'conditional_on',
        'conditional_value',
        'display',
    ];

    public function service()
    {
        return $this->belongsTo(PrivateSector::class, 'service_id', 'id');
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
