<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departament;
use Illuminate\Http\Request;
use App\Http\Resources\UnitResource;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function unitsByDepartment($departmentId)
    {
        // Находим департамент и загружаем связанные с ним юниты
        $departament = Departament::findOrFail($departmentId);
        $units = $departament->units()->with('freeSlots')->get();
        
        // Используем UnitResource для форматирования коллекции
        return UnitResource::collection($units)
            ->additional([
                'meta' => [
                    'departament_id' => $departament->id,
                    'departament_name' => $departament->name,
                ]
            ]);
    }

}
