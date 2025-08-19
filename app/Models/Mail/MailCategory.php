<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Mail\ContactPerson;
use App\Models\Service;

class MailCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function contacts()
    {
        return $this->hasMany(ContactPerson::class, 'category_id', 'id');
    }

    public function scopeType($query, $type)
    {
        $query->where('type', $type);
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'category_id', 'id');
    }
}
