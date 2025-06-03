<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Follower extends Model
{

    public function getImageAttribute()
    {
        if (!$this->attributes['image']) {
            return '';
        }

        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }

        return Storage::url($this->attributes['image']);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
