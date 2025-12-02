<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
         // Получаем коллекцию свободных слотов, загруженных через Eager Loading
        $freeSlots = $this->whenLoaded('freeSlots');

        // Группируем слоты по дате 'Y-m-d'
        $groupedSlots = $freeSlots->groupBy(function ($slot) {
            // Используем Carbon для парсинга и форматирования строки даты/времени
            return Carbon::parse($slot->slot_datetime)->format('Y-m-d');
        });

        // "Превращаем" каждую внутреннюю группу в коллекцию ресурсов (SlotResource)
        $formattedGroupedSlots = $groupedSlots->map(function ($daySlotsCollection) {
            return SlotResource::collection($daySlotsCollection);
        });

        return [
            'id' => $this->id,
            'name' => $this->name,
            'duration_minutes' => $this->duration_minutes,
            // Выводим сгруппированные слоты под новым ключом
            'slots_by_date' => $formattedGroupedSlots,
        ];
    }
}
