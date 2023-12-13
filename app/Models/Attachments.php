<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachments extends Model
{
    use HasFactory;

    protected $fillable = [
        'url', 'complaint_id'
    ];
    public function complaint()
    {
        return $this->belongsTo('App\StudentCompl', 'complaint_id');
    }
}
