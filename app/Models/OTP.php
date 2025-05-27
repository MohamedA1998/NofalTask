<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{    
    protected $table = "otp";
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function expired()
    {
        return $this->expires_at < now();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->expires_at = now()->addMinutes(5);
        });
    }

}
