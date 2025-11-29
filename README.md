### AppointSYS — это веб-CRM-система для управления записями и бронированием, построенная на фреймворке Laravel. 

Предоставляет систему для управления ресурсами, доступными для бронирования, через иерархическую структуру отделов (departments) и подразделений (units), позволяя создавать временные интервалы (time slots) и записывать клиентов (clients) на встречи (meetings). 
Проект задуман как базовый пример архитектуры систем планирования встреч, таких как YCLIENTS или EasyWeek, с акцентом на ключевые архитектурные принципы. 

### Архитектура

Система структурирована вокруг четкой иерархии сущностей, обеспечивающей организованное управление ресурсами и записями. Основной рабочий процесс выглядит так: администратор (User) создает Отделы (Departments), которые содержат Подразделения (Units) (ресурсы, доступные для бронирования). Для каждого Подразделения система может генерировать доступные Слоты (Slots) на основе заранее определенного расписания, которые затем могут быть забронированы Клиентами (Clients) как Встречи (Meetings). 

### Примеры интерфейса

<img width="1000" alt="" src="https://github.com/CoolCoolOne/appointSYS/blob/main/public/images/demo/01.png" />
<br>
<img width="1000" alt="" src="https://github.com/CoolCoolOne/appointSYS/blob/main/public/images/demo/02.png" />
<br>
<img width="1000" alt="" src="https://github.com/CoolCoolOne/appointSYS/blob/main/public/images/demo/03.png" />
<br>
<img width="1000" alt="" src="https://github.com/CoolCoolOne/appointSYS/blob/main/public/images/demo/04.png" />
<br>
<img width="1000" alt="" src="https://github.com/CoolCoolOne/appointSYS/blob/main/public/images/demo/05.png" />
<br>
<img width="1000" alt="" src="https://github.com/CoolCoolOne/appointSYS/blob/main/public/images/demo/06.png" />
<br>
<img width="1000" alt="" src="https://github.com/CoolCoolOne/appointSYS/blob/main/public/images/demo/07.png" />
<br>
<img width="1000" alt="" src="https://github.com/CoolCoolOne/appointSYS/blob/main/public/images/demo/08.png" />
<br>
<img width="1000" alt="" src="https://github.com/CoolCoolOne/appointSYS/blob/main/public/images/demo/09.png" />
<br>
<img width="1000" alt="" src="https://github.com/CoolCoolOne/appointSYS/blob/main/public/images/demo/10.png" />
<br>
<img width="1000" alt="" src="https://github.com/CoolCoolOne/appointSYS/blob/main/public/images/demo/11.png" />
<br>
<img width="1000" alt="" src="https://github.com/CoolCoolOne/appointSYS/blob/main/public/images/demo/12.png" />
<br>

### Упрощенная схема БД

<img width="1569" height="581" alt="dgrm" src="https://github.com/user-attachments/assets/8cf69131-058a-4157-b606-0c014fa0291c" />
