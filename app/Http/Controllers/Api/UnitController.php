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
        $department = Departament::findOrFail($departmentId);
        $units = $department->units()->get();
        
        // Используем UnitResource для форматирования коллекции
        return UnitResource::collection($units);
    }

}
