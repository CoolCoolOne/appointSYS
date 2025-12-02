<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SlotResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slot_datetime' => $this->slot_datetime,
            // 'is_occupied' здесь всегда будет false, его можно даже опустить
        ];
    }
}
