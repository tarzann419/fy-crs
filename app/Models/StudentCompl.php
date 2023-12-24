<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentCompl extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // to retrieve open tickets
    public static function getOpenTickets()
    {
        return self::where('status', 'submitted')
            ->orWhere('status', 'in_progress')
            ->get();
    }

    public function images()
    {
        return $this->hasMany('App\Attachments', 'complaint_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachments::class, 'complaint_id');
    }

    // generate a unique identifier before saving the complain
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($complaint) {
            $complaint->unique_identifier = Str::uuid();
        });
    }
}
