<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Виджет бронирования</title>
    <style id="widget-dynamic-styles">
        /* Этот блок будет динамически заполнен через JS */
    </style>
    <style>
        /* Общие стили, не зависящие от URL */
        body { 
            font-family: sans-serif; 
            margin: 0; 
            padding: 0;
            color: #fff;
            background-repeat: repeat;
            background-color: #f4f4f4;
        }
        .booking-widget-inner { 
            max-width: 1000px; 
            margin: auto; 
            padding: 20px; 
            background-color: rgba(0, 0, 0, 0.4); 
            min-height: 90vh;
        }
        .widget-title {
            display: flex;
            align-items: center;
            color: #53d8fb;
        }
        .widget-title::before {
            content: "";
            display: inline-block;
            width: 25px;
            height: 25px;
            margin-right: 10px;
            background-size: contain;
            background-repeat: no-repeat;
        }
        .unit-card { 
            background: rgba(255, 255, 255, 0.1); 
            padding: 20px; 
            margin-bottom: 20px; 
            border-radius: 8px; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5); 
            border: 1px solid rgba(255, 255, 255, 0.2); 
        }
        h2 { color: #fff; }
        .date-selector { 
            margin-top: 15px; margin-bottom: 10px; padding: 8px; border-radius: 4px; border: 1px solid #aaa;
            background: #333; color: white; width: 100%;
        }
        .time-slots { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
        .time-slot-btn { 
            padding: 10px 15px; background-color: #53d8fb; color: #1a1a2e; border: none; border-radius: 4px; 
            cursor: pointer; transition: background-color 0.3s; font-weight: bold;
        }
        .time-slot-btn:hover { background-color: #3af0ff; }
        .no-slots { color: #aaa; font-style: italic; }
        .error { color: #e3342f; padding: 10px; background-color: rgba(227, 52, 47, 0.1); border: 1px solid #e3342f; border-radius: 4px; }
        .widget-modal { display: none; position: fixed; z-index: 10; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8); justify-content: center; align-items: center; }
        .modal-content { background-color: #1a1a2e; padding: 30px; border: 1px solid #53d8fb; width: 80%; max-width: 400px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.5); }
        .close-btn { color: #aaa; float: right; font-size: 32px; font-weight: bold; cursor: pointer; }
        .close-btn:hover, .close-btn:focus { color: white; }
        .modal-input { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #53d8fb; border-radius: 4px; box-sizing: border-box; background: #0f3460; color: white; }
        .modal-input::placeholder { color: #aaa; opacity: 1; }
        .modal-submit { width: 100%; padding: 12px; background-color: #38c172; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        .modal-submit:hover { background-color: #2ebc68; }
    </style>
</head>
<body>
    <div id="app-container" class="booking-widget-inner">
        <h2 class="widget-title">Загрузка данных...</h2>
    </div>

    <!-- Модальное окно для ввода данных клиента -->
    <div id="bookingModal" class="widget-modal">
      <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h3>Подтверждение бронирования</h3>
        <p>Вы бронируете: <strong id="modal-unit-name" style="color: #53d8fb;"></strong> на время <strong id="modal-slot-time" style="color: #53d8fb;"></strong></p>
        <input type="text" id="modal-user-name" class="modal-input" placeholder="Ваше ФИО">
        <input type="email" id="modal-user-email" class="modal-input" placeholder="Email">
        <input type="tel" id="modal-user-phone" class="modal-input" placeholder="Телефон">
        <button id="modal-submit-btn" class="modal-submit">Забронировать</button>
      </div>
    </div>

    <script>
        // --- Динамическая установка URL изображений через JS ---
        const baseURL = window.location.origin;
        const dynamicStyles = document.getElementById('widget-dynamic-styles');
        dynamicStyles.innerHTML = `
            body {
                background-image: url('${baseURL}/images/room_bg3.jpg');
            }
            .widget-title::before {
                background-image: url('${baseURL}/images/icon.png');
            }
        `;
        // --- Конец динамической установки стилей ---

        const BASE_API_URL = `${baseURL}/api`;
        const apiKey = "{{ $apiKey }}";
        const departmentId = "{{ $departmentId }}";
        const appContainer = document.getElementById('app-container');
        const bookingModal = document.getElementById('bookingModal');
        let selectedSlotData = {};

        function openModal(unitId, slotId, unitName, time) {
            selectedSlotData = { unitId, slotId, unitName, time };
            document.getElementById('modal-unit-name').textContent = unitName;
            document.getElementById('modal-slot-time').textContent = time;
            document.getElementById('modal-submit-btn').onclick = handleBookingSubmit;
            bookingModal.style.display = 'flex';
        }

        function closeModal() {
            bookingModal.style.display = 'none';
            document.getElementById('modal-user-name').value = '';
            document.getElementById('modal-user-email').value = '';
            document.getElementById('modal-user-phone').value = '';
        }

        window.onclick = function(event) {
            if (event.target == bookingModal) {
                closeModal();
            }
        }

        async function apiFetch(url, options = {}) {
            options.headers = {
                ...options.headers,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-API-Key': apiKey 
            };
            const response = await fetch(url, options);
            if (!response.ok) {
                // --- ИСПРАВЛЕНИЕ: Разделяем обработку ошибок 401 и 403 ---
                if (response.status === 401) {
                    throw new Error('Ошибка: Неверный или отсутствует API-ключ.');
                }
                if (response.status === 403) {
                    // Это сообщение появится, если API-ключ верен, но домен не разрешен в вашей таблице user_domains.
                    throw new Error('Ошибка: Домен (Origin) не разрешен для использования этого API-ключа.');
                }
                // -----------------------------------------------------
                throw new Error('Сетевая ошибка: ' + response.statusText);
            }
            return response;
        }

        async function fetchData() {
            appContainer.innerHTML = '<h2 class="widget-title">Загрузка данных...</h2>';
            const apiUrl = `${BASE_API_URL}/departaments/${departmentId}/units`;
            try {
                const response = await apiFetch(apiUrl);
                const data = await response.json();
                displayUnits(data.data);
            } catch (error) {
                console.error('Fetch error:', error);
                appContainer.innerHTML = `<div class="error">Ошибка загрузки данных: ${error.message}</div>`;
            }
        }
        
        function displayUnits(units) {
            appContainer.innerHTML = '<h2 class="widget-title">Доступные юниты</h2>';
            if (units.length === 0) {
                appContainer.innerHTML += '<p>В этом отделе нет доступных юнитов.</p>';
                return;
            }
            units.forEach(unit => {
                const unitCard = document.createElement('div');
                unitCard.className = 'unit-card';
                unitCard.innerHTML = `
                    <div class="unit-header">
                        <h2>${unit.name}</h2>
                        <span>Длительность: ${unit.duration_minutes} мин</span>
                    </div>
                    <div id="unit-${unit.id}-controls"></div>
                `;
                appContainer.appendChild(unitCard);
                if (Object.keys(unit.slots_by_date).length > 0) {
                    renderUnitControls(unit);
                } else {
                    document.getElementById(`unit-${unit.id}-controls`).innerHTML = '<p class="no-slots">Нет свободных слотов</p>';
                }
            });
        }

        function renderUnitControls(unit) {
            const controlsContainer = document.getElementById(`unit-${unit.id}-controls`);
            const availableDates = Object.keys(unit.slots_by_date);
            const dateSelect = document.createElement('select');
            dateSelect.className = 'date-selector';
            availableDates.forEach(date => {
                const option = document.createElement('option');
                option.value = date;
                option.textContent = new Date(date).toLocaleDateString('ru-RU', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                dateSelect.appendChild(option);
            });
            const timeSlotsContainer = document.createElement('div');
            timeSlotsContainer.className = 'time-slots';
            const updateTimeSlots = (selectedDate) => {
                timeSlotsContainer.innerHTML = '';
                const slotsForDay = unit.slots_by_date[selectedDate] || [];
                slotsForDay.forEach(slot => {
                    const timeBtn = document.createElement('button');
                    timeBtn.className = 'time-slot-btn';
                    const timeText = slot.slot_datetime.split(' ')[1].substring(0, 5); // Исправлено на правильный индекс
                    timeBtn.textContent = timeText;
                    timeBtn.onclick = () => {
                        openModal(unit.id, slot.id, unit.name, timeText);
                    };
                    timeSlotsContainer.appendChild(timeBtn);
                });
            };
            dateSelect.addEventListener('change', (e) => {
                updateTimeSlots(e.target.value);
            });
            controlsContainer.appendChild(dateSelect);
            controlsContainer.appendChild(timeSlotsContainer);
            if (availableDates.length > 0) {
                updateTimeSlots(availableDates[0]); // Исправлено: передаем первую дату
            }
        }

        async function handleBookingSubmit() {
            const name = document.getElementById('modal-user-name').value;
            const email = document.getElementById('modal-user-email').value;
            const phone = document.getElementById('modal-user-phone').value;
            
            if (!name || !email || !phone) {
                alert("Пожалуйста, заполните все поля.");
                return;
            }

            const payload = { 
                unit_id: selectedSlotData.unitId, 
                slot_id: selectedSlotData.slotId, 
                name, email, phone 
            };
            
            document.getElementById('modal-submit-btn').disabled = true;

            try {
                const response = await apiFetch(`${BASE_API_URL}/meetings/store`, {
                    method: 'POST',
                    body: JSON.stringify(payload)
                });
                const data = await response.json();
                
                closeModal();

                if (response.ok) {
                    alert(`Бронирование успешно!\nОбъект: ${selectedSlotData.unitName}\nВремя: ${data.booked_datetime}\nСтатус: ${data.status}`);
                    fetchData();
                } else {
                    alert(`Ошибка бронирования: ${data.message || 'Неизвестная ошибка'}`);
                }
            } catch (error) {
                alert(`Ошибка бронирования: ${error.message}`);
            } finally {
                document.getElementById('modal-submit-btn').disabled = false;
            }
        }

        fetchData();
    </script>
</body>
</html>
