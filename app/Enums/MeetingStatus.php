<?php

namespace App\Enums;

enum MeetingStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return __(
            'enums.booking_statuses.' . $this->value
        );
    }
}
