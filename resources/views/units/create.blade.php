@extends('layouts.main')

@section('title')

@section('content')
    <div class="row">
        <div class="col-md-12 offset-md-12">
            <h1 class="mb-5">Создание юнита <br> в отделе:<br><span>{{ $departament_name }}</span></h1>


            <form action="{{ route('units.store', ['departament' => $departament_id]) }}" method="post">

                @csrf


                <div class="mb-3">
                    <label for="name" class="form-label">Имя</label>
                    <input name='name' type="name" class="form-control @error('name') is-invalid @enderror"
                        id="name" placeholder="Не более 100 символов" value="{{ old('name') }}">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="days[]" class="form-label">Дни недели</label>
                    <select name="days[]" multiple class="form-control @error('days[]') is-invalid @enderror"
                        value="{{ old('days[]') }}">
                        <option value="Mon">
                            Понедельник
                        </option>
                        <option value="Tue">
                            Вторник
                        </option>
                        <option value="Wed">
                            Среда
                        </option>
                        <option value="Thu">
                            Четверг
                        </option>
                        <option value="Fri">
                            Пятница
                        </option>
                        <option value="Sat">
                            Суббота
                        </option>
                        <option value="Sun">
                            Воскресенье
                        </option>
                    </select>
                    @error('days[]')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-around">
                    <div class="mb-3">
                        <label for="start_time">Время начала</label>
                        <br>
                        <input type="time" id="start_time" name="start_time" value="{{ old('start_time') }}">

                        @error('start_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="end_time">Время завершения</label>
                        <br>
                        <input type="time" id="end_time" name="end_time" value="{{ old('end_time') }}">

                        @error('end_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="duration_minutes" class="form-label">Продолжительность</label>
                    <select name="duration_minutes" class="form-control @error('duration_minutes') is-invalid @enderror"
                        value="{{ old('duration_minutes') }}">
                        <option value="10">
                            10 минут
                        </option>
                        <option value="15">
                            15 минут
                        </option>
                        <option value="20">
                            20 минут
                        </option>
                        <option value="30">
                            30 минут
                        </option>
                        <option value="40">
                            40 минут
                        </option>
                        <option value="60">
                            1 час
                        </option>
                    </select>
                    @error('duration_minutes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-5 text-center">
                    <button type="submit" class="btn  btn-light">
                        Опубликовать
                    </button>
                </div>



            </form>
        </div>
    </div>
@endsection
