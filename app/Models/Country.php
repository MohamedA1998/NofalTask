<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Country extends Model
{
    use HasFactory;

    public static function withTranslation($id = null)
    {
        $locale = config('app.locale', 'en');

        return DB::table('countries')
            ->when($id, function ($query) use ($id) {
                $query->where('countries.id', $id);
            })
            ->leftJoin('country_translations', function ($join) use ($locale) {
                $join->on('countries.id', '=', 'country_translations.country_id')
                    ->where('country_translations.language', '=', $locale);
            })
            ->select('countries.*', 'country_translations.name AS name')
            ->get();
    }

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
