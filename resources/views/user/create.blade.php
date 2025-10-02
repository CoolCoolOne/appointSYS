@extends('layouts.main')

@section('title')

@section('content')
    <div class="row">
        <div class="col-md-12 offset-md-12">
            <h1 class="mb-5">Запрос регистрации</h1>


            <form enctype="multipart/form-data" action="{{ route('user.store') }}" method="post">

                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email адрес</label>
                    <input name='email' type="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" placeholder="email" value="{{ old('email') }}">

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Ваш логин</label>
                    <input name='name' type="text" class="form-control @error('name') is-invalid @enderror"
                        id="name" placeholder="логин" value="{{ old('name') }}">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Придумайте пароль</label>
                    <input name='password' type="password" class="form-control @error('password') is-invalid @enderror"
                        id="password" placeholder="пароль">

                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Повторите пароль</label>
                    <input name='password_confirmation' type="password" class="form-control" id="password_confirmation"
                        placeholder="пароль повторно">
                </div>

                <div class="mb-3">
                    <label for="adminCode" class="form-label">Пригласительный код (ник Алексея в тг)</label>
                    <input name='adminCode' type="adminCode" class="form-control @error('adminCode') is-invalid @enderror" id="adminCode" 
                    value="{{ old('adminCode') }}" placeholder="код" >


                    @error('adminCode')
                        <div class="invalid-feedback">{{ $message }}</div>
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
