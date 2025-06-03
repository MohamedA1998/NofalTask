<?php

namespace App\Enum;

enum Gender: string
{
    case MALE = 'male';
    case FEMALE = 'female';

    public static function values(): array
    {
        return array_column(Gender::cases(), 'value');
    }
}
