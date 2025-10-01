@extends('layouts.main')

@section('title')

@section('content')
    <div class="row">
        <div class="col-md-12 offset-md-12">
            <h1 class="mb-5">Восстановление пароля</h1>


            <form action="{{ route('password.email') }}" method="post">

                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email адрес</label>
                    <input name='email' type="email" 
                    class="form-control @error('email') is-invalid @enderror"
                    id="email" 
                    placeholder="email"
                    value="{{old('email')}}">

                    @error('email')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>



                <div class="mt-5 text-center">
                    <button type="submit" class="btn  btn-light">
                        Отправить!
                    </button>
                </div>



            </form>
        </div>
    </div>
@endsection
