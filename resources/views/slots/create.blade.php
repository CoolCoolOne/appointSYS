@extends('layouts.main')

@section('title')

@section('content')
    <div class="row">
        <div class="col-md-12 offset-md-12">
            <h1 style="background-color: rgb(32, 32, 40);" class="mb-5 p-2">Добавление дат активности<br> для юнита:
                <span>{{ $unit_name }}</span></h1>

            <form action="{{ route('slots.store') }}" method="post"
                style="background-color: rgb(32, 32, 40);" class="p-2">

                @csrf

                <input type="hidden" name="unit_id" value="{{ $unit_id }}">

                <div class="d-flex justify-content-around">
                    <div class="mb-3">
                        <label for="start_date">Дата начала</label>
                        <br>
                        <input type="date" id="start_date" name="start_date" value="{{ $currentDate }}">

                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="end_date">Дата завершения</label>
                        <br>
                        <input type="date" id="end_date" name="end_date" value="{{ $plusDate }}">

                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-2 me-5">*По умолчанию период активности - неделя</div>

                <div class="mt-5 text-center">
                    <button type="submit" class="btn  btn-light">
                        Добавить
                    </button>
                </div>



            </form>
        </div>
    </div>
@endsection
