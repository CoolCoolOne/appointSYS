<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departament;

class WidgetController extends Controller
{
    /**
     * Показывает форму для генерации сниппета (для админки)
     */
    public function createGeneratorForm()
    {
        $departaments = Departament::all();

        $userApiKey = auth()->user()->api_key ?? 'ВАШ_СЕКРЕТНЫЙ_КЛЮЧ';

        return view('widget.generator_form', [
            'departaments' => $departaments,
            'userApiKey' => $userApiKey
        ]);
    }

    /**
     * Отдает полную HTML-страницу виджета для загрузки в iframe
     */
    public function showIframeWidget(Request $request)
    {
        $apiKey = $request->query('api_key');
        $departmentId = $request->query('department_id');

        if (!$apiKey || !$departmentId) {
            return response("Ошибка: Отсутствуют необходимые параметры API ключа или ID департамента.", 400);
        }

        return view('widget.iframe_content', [
            'apiKey' => $apiKey,
            'departmentId' => $departmentId
        ]);
    }
}
