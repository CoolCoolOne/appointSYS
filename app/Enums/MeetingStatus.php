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

    public function bootstrapClass(): string
    {
        return match ($this->value) {
            self::PENDING->value => 'table-warning',
            self::CONFIRMED->value => 'table-success',
            self::CANCELLED->value => 'table-danger',
            self::COMPLETED->value => 'table-info',
            default => 'alert-info',
        };
    }

    public function isFinished(): bool
    {
        return in_array($this, [self::COMPLETED, self::CANCELLED]);
    }
}
