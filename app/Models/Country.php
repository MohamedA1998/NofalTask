<?php

namespace App\Models;

use App\Traits\TranslationTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Country extends Model
{
    use HasFactory, TranslationTrait;

    protected $appends = ['name'];

    public function getFlagAttribute()
    {
        if (!$this->attributes['flag']) {
            return '';
        }
        
        if (Str::startsWith($this->attributes['flag'], ['http://', 'https://'])) {
            return $this->attributes['flag'];
        }

        return Storage::url($this->attributes['flag']);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where("status", true);
    }
}
