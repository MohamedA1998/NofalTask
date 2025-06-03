<?php

namespace App\Enum;

enum Type: string
{
    case DOCTOR = 'doctor';
    case FOLLOWER = 'follower';

    public static function values(): array
    {
        return array_column(Type::cases(), 'value');
    }
}
