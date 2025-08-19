<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, Searchable;

    protected $guarded = ['id'];


    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
