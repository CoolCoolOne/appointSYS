@extends('layouts.main')

@section('title')

@section('content')


    @if (session('api_key_raw'))
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Токен сгенерирован успешно!</h4>
            <p>Ваш <strong>новый</strong> токен: <code>{{ session('api_key_raw') }}</code></p>
            <hr>
            <p class="mb-0">Старые токены удалены</p>
        </div>
    @endif

    {{-- Форма генерации токена/ключа --}}
    <form action="{{ route('generate-api-key') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success container-fluid mt-1 text-center">
            {{ $api_key_raw ? 'Сгенерировать API-KEY (старый будет удален)' : 'Сгенерировать API-KEY' }}
        </button>
    </form>


    <div class="card mt-3 text-white" style="background-color: rgb(32, 32, 40);">

        <div class="card-body">
            <h3>Документация по использованию API</h3>

            <p>Ваш API-ключ используется для доступа к защищенным маршрутам API через наш виджет или прямые запросы.</p>

            <h4 class="mt-4">1. Использование ключа в HTTP-запросе</h4>
            <p>Для аутентификации необходимо передать ваш уникальный ключ в заголовке HTTP-запроса <code>X-API-Key</code>.
                Это требуется для всех API-маршрутов.</p>

            <div class="card bg-dark p-3">
                <pre><code>GET http://80.93.61.14/api/...<br>X-API-Key: {{ $api_key_raw ? $api_key_raw : 'ВАШ_СЕКРЕТНЫЙ_КЛЮЧ_ОТ_ВИДЖЕТА' }}</code></pre>
            </div>
            <p class="mt-2">Также поддерживается передача ключа через параметр запроса <code>api_key</code>.</p>

            <h4 class="mt-4">2. Управление разрешенными доменами (Origin)</h4>
            <p>В целях безопасности мы проверяем домен (Origin), с которого отправляется запрос. Запросы будут работать
                только с тех сайтов, которые вы предварительно разрешили.</p>

            <p>Для тестирования (например postman, <code>curl</code>) добавление в список домен не нужно.</p>

            <p>Чтобы разрешить использование ключа на вашем сайте, вам необходимо <a href="{{ route('domains.create') }}" class="p-0 btn btn-link text-info" type="button">
                                <b>добавлять домены</b>
                            </a> в
                специальном разделе.</p> 

            <p>Если вы не добавите домен, вы получите ошибку <code>403 Forbidden (Origin not allowed for this API
                    key)</code>, даже если ваш API-ключ верный.</p>
            <p>
                Необходимо отправлять заголовок <code>Content-Type: application/json</code> для POST-запросов.
            </p>
            <br>




            <h4>3. Доступные маршруты:</h4>

            <table class="table table-dark table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Метод</th>
                        <th>Маршрут</th>
                        <th>Описание</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge bg-success">GET</span></td>
                        <td><code>/api/departaments</code></td>
                        <td>
                            Получение списка всех отделов.
                            <button class="btn btn-link btn-sm text-info p-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#responseDepartaments" aria-expanded="false"
                                aria-controls="responseDepartaments">
                                Примеры
                            </button>
                        </td>
                    </tr>
                    <tr id="responseDepartaments" class="collapse">
                        <td colspan="3">
                            <pre><code class="text-info">{
    "data": [
        {
            "id": 1,
            "name": "Репбазы"
        },
        {
            "id": 2,
            "name": "Залы"
        }
    ]
}</code></pre>
                        </td>
                    </tr>


                    <tr>
                        <td><span class="badge bg-success">GET</span></td>
                        <td><code>/api/departaments/{departmentId}/units</code></td>
                        <td>
                            Получение списка юнитов по ID отдела.
                            <button class="btn btn-link btn-sm text-info p-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#responseUnits" aria-expanded="false" aria-controls="responseUnits">
                                Примеры
                            </button>
                        </td>
                    </tr>
                    <tr id="responseUnits" class="collapse">
                        <td colspan="3">
                            <pre><code class="text-info">{
    "data": [
        {
            "id": 1,
            "name": "Зал белый",
            "duration_minutes": 30,
            "slots_by_date": []
        },
        {
            "id": 2,
            "name": "Зал оранж",
            "duration_minutes": 20,
            "slots_by_date": {
                "2025-12-02": [
                    { "id": 1, "slot_datetime": "2025-12-02 11:51:00" },
                    { "id": 2, "slot_datetime": "2025-12-02 12:11:00" },
                    { "id": 3, "slot_datetime": "2025-12-02 12:31:00" },
                    { "id": 4, "slot_datetime": "2025-12-02 12:51:00" },
                    { "id": 5, "slot_datetime": "2025-12-02 13:11:00" },
                    { "id": 6, "slot_datetime": "2025-12-02 13:31:00" },
                    { "id": 7, "slot_datetime": "2025-12-02 13:51:00" },
                    { "id": 8, "slot_datetime": "2025-12-02 14:11:00" },
                    { "id": 9, "slot_datetime": "2025-12-02 14:31:00" }
                ],
                "2025-12-03": [
                    { "id": 11, "slot_datetime": "2025-12-03 12:11:00" },
                    { "id": 12, "slot_datetime": "2025-12-03 12:31:00" },
                    { "id": 13, "slot_datetime": "2025-12-03 12:51:00" },
                    { "id": 14, "slot_datetime": "2025-12-03 13:11:00" },
                    { "id": 15, "slot_datetime": "2025-12-03 13:31:00" },
                    { "id": 16, "slot_datetime": "2025-12-03 13:51:00" },
                    { "id": 17, "slot_datetime": "2025-12-03 14:11:00" },
                    { "id": 18, "slot_datetime": "2025-12-03 14:31:00" }
                ],
                "2025-12-04": [
                    { "id": 19, "slot_datetime": "2025-12-04 11:51:00" },
                    { "id": 20, "slot_datetime": "2025-12-04 12:11:00" },
                    { "id": 21, "slot_datetime": "2025-12-04 12:31:00" },
                    { "id": 22, "slot_datetime": "2025-12-04 12:51:00" },
                    { "id": 23, "slot_datetime": "2025-12-04 13:11:00" },
                    { "id": 24, "slot_datetime": "2025-12-04 13:31:00" },
                    { "id": 25, "slot_datetime": "2025-12-04 13:51:00" },
                    { "id": 26, "slot_datetime": "2025-12-04 14:11:00" },
                    { "id": 27, "slot_datetime": "2025-12-04 14:31:00" }
                ]
            }
        }
    ],
    "meta": {
        "departament_id": 2,
        "departament_name": "Залы"
    }
}</code></pre>
                        </td>
                    </tr>

                    <!-- Маршрут 4: meetings/store (POST) -->
                    <tr>
                        <td><span class="badge bg-primary">POST</span></td>
                        <td><code>/api/meetings/store</code></td>
                        <td>
                            Создание новой встречи/бронирования.
                            <button class="btn btn-link btn-sm text-info p-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#requestBodyAndResponse" aria-expanded="false"
                                aria-controls="requestBodyAndResponse">
                                Примеры
                            </button>
                        </td>
                    </tr>
                    <tr id="requestBodyAndResponse" class="collapse">
                        <td colspan="3">
                            <p>Пример тела запроса:</p>
                            <pre><code class="text-info">{
    "unit_id": 2,
    "slot_id": 11,
    "name": "Иван Иванов",
    "email": "ivan@example.com",
    "phone": "89001234567" 
}</code></pre>
                            <p>Пример ответа:</p>
                            <pre><code class="text-info">{
    "message": "Встреча успешно создана со статусом \"pending\"!",
    "slot_id": 11,
    "booked_datetime": "2025-12-03 12:11:00",
    "status": "pending"
}</code></pre>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>









@endsection
