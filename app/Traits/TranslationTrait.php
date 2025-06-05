<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait TranslationTrait
{
    public static function withTranslation($id = null, array $translationColumns = ['name'])
    {
        $locale = config('app.locale', 'en');
        $table = (new static)->getTable();
        $translationsTable = $table . '_translations';
        $foreignKey = Str::singular($table) . '_id';
        
        $select = ["$table.*", ...array_map(fn($col) => "$translationsTable.$col as $col", $translationColumns)];

        return static::query()
            ->when($id, fn($q) => $q->where("$table.id", $id))
            ->leftJoin($translationsTable, fn($join) => $join->on("$table.id", "=", "$translationsTable.$foreignKey")->where("$translationsTable.language", $locale))
            ->select($select);
    }

    public function getNameAttribute()
    {
        return $this->attributes['name'] ?? null;
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['description'] ?? null;
    }
}
