@extends('layouts.main')

@section('title')

@section('content')
    <div class="row">
        <div class="col-md-12 offset-md-12">
            <h1 class="mb-5">Обновление пароля</h1>


            <form action="{{ route('password.update')}}" method="post">

                @csrf

                <input type="hidden" name="token" value="{{$token}}">

                <div class="mb-3">
                    <label for="email" class="form-label">Email адрес</label>
                    <input name='email' type="email" class="form-control @error('email') is-invalid @enderror" 
                    id="email" placeholder="email" value="{{old('email')}}">

                    @error('email')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Придумайте новый пароль</label>
                    <input name='password' type="password" class="form-control @error('password') is-invalid @enderror" 
                    id="password" placeholder="пароль" >

                    @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Повторите новый пароль</label>
                    <input name='password_confirmation' type="password" class="form-control" id="password_confirmation"
                        placeholder="пароль повторно">
                </div>

                <div class="mt-5 text-center">
                    <button type="submit" class="btn  btn-light">
                        Обновить пароль!
                    </button>
                </div>


            </form>
        </div>
    </div>

@endsection
