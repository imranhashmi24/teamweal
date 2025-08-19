<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'custom_fields' => 'array',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function attachments()
    {
        return $this->hasMany(ServiceRequestAttachment::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->request_number = 'SR-' . date('Ymd') . '-' . strtoupper(uniqid());
        });
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeInReview($query)
    {
        return $query->where('status', 'in_review');
    }

    public function scopeTechnical($query)
    {
        return $query->where('service_type', 'technical');
    }

}