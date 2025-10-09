@extends('layouts.main')

@section('title')

@section('content')
    <div class="row">
        <div class="col-md-12 offset-md-12">
            <h1 class="mb-5">Создание юнита <span>{{$departament_id}}</span></h1>


            <form  action="{{ route('units.store') }}" method="post">

                @csrf


                <div class="mb-3">
                    <label for="name" class="form-label">Название</label>
                    <input name='name' type="name" class="form-control @error('name') is-invalid @enderror"
                        id="name" placeholder="Не более 100 символов" value="{{ old('name') }}">

                    @error('name')
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



