@extends('layouts.main')

@section('title')

@section('styles')
    <style>
        .img-fixed-height-card {
            height: 250px;
            object-fit: cover;
            object-position: center;
        }

        .carousel-inner .carousel-item img {
            width: 100%;
        }
    </style>
@endsection

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
                        <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @for ($i = 1; $i <= 11; $i++)
                                    <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                                        @php
                                            $imageName = str_pad($i, 2, '0', STR_PAD_LEFT);
                                            $imagePath = asset('images/demo/' . $imageName . '.png');
                                        @endphp
                                        <img src="{{ $imagePath }}" class="d-block w-100 img-fixed-height-card"
                                            alt="Demo image {{ $imageName }}">
                                    </div>
                                @endfor
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>

                        </div>

                        <div class="card-body bg-dark">
                            <p class="card-text ">Примеры картинки!</p>
                        </div>
                    </div>
                </div>
                {{-- КОНЕЦ БЛОКА С ГАЛЕРЕЕЙ --}}

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="bd-placeholder-img card-img-top" src="{{ asset('images/calendar2.jpg') }}"
                            alt="calendar">
                        <div class="card-body bg-dark">
                            <p class="card-text ">Используются для аренды помещений (отели, мероприятия), записи к
                                спецалистам (парикмахер, врач)
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="bd-placeholder-img card-img-top" src="{{ asset('images/calendar3.jpg') }}"
                            alt="calendar">
                        <div class="card-body bg-dark">
                            <p class="card-text ">Примеры: EasyWeek (BookNow), YCLIENTS, Dikidi. </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="bd-placeholder-img card-img-top" src="{{ asset('images/calendar2.jpg') }}"
                            alt="calendar">
                        <div class="card-body bg-dark">
                            <p class="card-text ">Это не коммерческий проект, у меня нет сроков и тз формирую я сам. Поэтому
                                тут будет ряд упрощений, таких как отсутствие системы RBAC, отсутствие асинхронности которую
                                можно было бы сделать с использованием livewire, отстутствие параметра capasity ресурсов и
                                тд.
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="bd-placeholder-img card-img-top" src="{{ asset('images/calendar1.jpg') }}"
                            alt="calendar">
                        <div class="card-body bg-dark">
                            <p class="card-text ">Упрощения будут касаться несущественных для целостного понимания
                                архитектуры деталей. В дальнейшем система может быть доработана, может стать более гибкой,
                                но основной принцип подобных crm будет реализован.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
