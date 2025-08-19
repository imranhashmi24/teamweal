<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mail\MailCategory;

class MailBox extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(MailCategory::class, 'category_id', 'id');
    }

    public function mail_domain()
    {
        return $this->belongsTo(DomainConfig::class, 'domain', 'id');
    }
}
