<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequestAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_request_id',
        'file_path',
        'original_name',
        'mime_type',
        'size'
    ];

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }
}