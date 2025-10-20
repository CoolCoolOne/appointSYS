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
                    <label for="name" class="form-label">Дни недели</label>
                    <input name='name' type="name" class="form-control @error('name') is-invalid @enderror"
                        id="name" placeholder="Не более 100 символов" value="{{ old('name') }}">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="days[]" class="form-label">Дни недели</label>
                    <select name="days[]" multiple class="form-control">
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
