<?php

namespace App\Enums;
// use Illuminate\Validation\Rules\Enum;
// use BenSampo\Enum\Enum;

enum AppointmentStatus :int
{
    case SCHEDULED = 1;
    case CONFIRMED = 2;
    case CANCELLED = 3;

    public function color(): string
    {
        return match($this) {
            AppointmentStatus::SCHEDULED => 'primary',
            AppointmentStatus::CONFIRMED => 'success',
            AppointmentStatus::CANCELLED => 'danger',
        };
    }
}
