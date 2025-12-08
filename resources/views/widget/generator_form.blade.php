@extends('layouts.main')

@section('title', 'Генератор виджета')

@section('content')
    <div class="card mt-3" style="background-color: rgb(32, 32, 40);">
        <div class="card-body">
            <h3>Генератор кода виджета (IFrame)</h3>

            <form id="widget-form">
                <div class="mb-3">
                    <label for="department_id" class="form-label">Выберите отдел:</label>
                    <select id="department_id" class="form-select" onchange="generateSnippet()">
                        @foreach ($departaments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            <h4 class="mt-4">Сгенерированный IFrame сниппет:</h4>
            <div class="bg-dark p-3 rounded text-white">
                <pre><code id="snippet-output"></code></pre>
            </div>

            <div class="d-flex justify-content-between">
                <button class="btn btn-secondary mt-2" onclick="copySnippet()">Скопировать код</button>

                {{-- Кнопка для открытия модального окна предпросмотра --}}
                <button class="btn btn-success mt-2" onclick="loadPreviewAndShowModal()">
                    Предпросмотр виджета
                </button>

                <form action="{{ route('generate-api-key') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger mt-2">
                        {{ $userApiKey ? 'Сгенерировать новый API-KEY (старый будет удален)' : 'Сгенерировать API-KEY' }}
                    </button>
                </form>
            </div>


        </div>
    </div>

    <!-- Modal Predprosmotra -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="previewModalLabel">Предпросмотр виджета</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Контейнер для загрузки iFrame --}}
                    <div id="preview-container" style="width: 100%; height: 70vh;">
                        Загрузка предпросмотра...
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        const userApiKey = "{{ $userApiKey }}";
        const widgetIframeUrl = "{{ route('api-docs.show-iframe-widget') }}";

        function generateSnippet() {
            const departmentId = document.getElementById('department_id').value;
            const outputElement = document.getElementById('snippet-output');

            if (departmentId) {
                const snippet = `<!-- Виджет бронирования для выбранного отдела -->
<iframe 
    src="${widgetIframeUrl}?api_key=${userApiKey}&department_id=${departmentId}" 
    frameborder="0" 
    scrolling="no" 
    width="100%" 
    height="600px" 
    id="booking-widget-iframe">
</iframe>`;
                outputElement.textContent = snippet;
            } else {
                outputElement.textContent = 'Выберите отдел для генерации сниппета.';
            }
        }

        // Функция для загрузки iframe в модальное окно и его показа
        function loadPreviewAndShowModal() {
            const departmentId = document.getElementById('department_id').value;
            const previewContainer = document.getElementById('preview-container');

            if (departmentId) {
                const iframeSrc = `${widgetIframeUrl}?api_key=${userApiKey}&department_id=${departmentId}`;
                previewContainer.innerHTML =
                    `<iframe src="${iframeSrc}" frameborder="0" width="100%" height="100%"></iframe>`;

                // Ручная инициализация и показ модального окна Bootstrap
                const previewModalElement = document.getElementById('previewModal');
                const modal = new bootstrap.Modal(previewModalElement);
                modal.show();

            } else {
                previewContainer.innerHTML = '<p>Выберите отдел для предпросмотра.</p>';
            }
        }

        function copySnippet() {
            const snippetText = document.getElementById('snippet-output').textContent;
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            generateSnippet();
        });
    </script>
@endsection
