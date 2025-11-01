AppointSYS is a web-based Appointment and Booking CRM built with the Laravel framework. It provides a system for managing bookable resources through a hierarchical structure of departments and units, allowing for the creation of time slots and the booking of meetings by clients.

The project is designed as a foundational example of appointment scheduling systems like YCLIENTS or EasyWeek, focusing on the core architectural principles.

## Architecture

The system is structured around a clear entity hierarchy, enabling organized management of resources and appointments. The core flow is: an administrator (`User`) creates `Departments`, which contain `Units` (bookable resources). For each `Unit`, the system can generate available `Slots` based on a predefined schedule, which can then be booked as `Meetings` by `Clients`.

### Some ui example

<img width="1569" height="581" alt="dgrm" src="https://github.com/user-attachments/assets/af156e0e-cb20-46dd-8135-c357630ea70a" />
<br>
### Database Schema
<img width="1569" height="581" alt="dgrm" src="https://github.com/user-attachments/assets/8cf69131-058a-4157-b606-0c014fa0291c" />
