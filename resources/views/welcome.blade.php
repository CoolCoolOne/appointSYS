@extends('layouts.main')

@section('title')

@section('content')
    <div class="album py-5 ">
        <div class="container">

            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="bd-placeholder-img card-img-top" src="{{ asset('images/calendar1.jpg') }}" alt="calendar">
                        <div class="card-body bg-dark">
                            <p class="card-text ">Такие сервисы называют Appointment или booking CRM</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="bd-placeholder-img card-img-top" src="{{ asset('images/calendar2.jpg') }}" alt="calendar">
                        <div class="card-body bg-dark">
                            <p class="card-text ">Используются для аренды помещений (отели, мероприятия), записи к спецалистам (парикмахер, врач)
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="bd-placeholder-img card-img-top" src="{{ asset('images/calendar3.jpg') }}" alt="calendar">
                        <div class="card-body bg-dark">
                            <p class="card-text ">Примеры: EasyWeek (BookNow), YCLIENTS, Dikidi. </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="bd-placeholder-img card-img-top" src="{{ asset('images/calendar2.jpg') }}" alt="calendar">
                        <div class="card-body bg-dark">
                            <p class="card-text ">Это не коммерческий проект, у меня нет сроков и тз формирую я сам. Поэтому тут будет ряд упрощений, таких как отсутствие системы RBAC, отсутствие асинхронности которую можно было бы сделать с использованием livewire, отстутствие параметра capasity ресурсов и тд.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="bd-placeholder-img card-img-top" src="{{ asset('images/calendar3.jpg') }}" alt="calendar">
                        <div class="card-body bg-dark">
                            <p class="card-text ">Хотелось бы сделать тут собственно crm + api + виджет</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="bd-placeholder-img card-img-top" src="{{ asset('images/calendar1.jpg') }}" alt="calendar">
                        <div class="card-body bg-dark">
                            <p class="card-text ">Упрощения будут касаться несущественных для целостного понимания архитектуры деталей. В дальнейшем система может быть доработана, может стать более гибкой, но основной принцип подобных crm будет реализован.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
