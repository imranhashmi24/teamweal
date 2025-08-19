<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "phone",
        "interested_project",
        "capital",
        "message",
        "reply",
        "seen_at",
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'seen_at' => 'datetime',
    ];

    /**
     * Scope a query to only include unseen
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnseen($query)
    {
        return $query->whereNull('seen_at');
    }

    /**
     * Get the
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return $this->first_name.' '.$this->last_name;
    }
}
