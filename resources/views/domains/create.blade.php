@extends('layouts.main')

@section('title')

@section('content')
    <div class="row">
        <div class="col-md-12 offset-md-12">
            <h1 class="mb-5 p-2" style="background-color: rgb(32, 32, 40);">Добавление домена в список разрешённых</h1>


            <form  action="{{ route('domains.store') }}" method="post" style="background-color: rgb(32, 32, 40);" class="p-2">

                @csrf


                <div class="mb-3">
                    <label for="domain_url" class="form-label">URL-адрес (полный, с http/https)</label>
                    <input name='domain_url' type="domain_url" class="form-control @error('domain_url') is-invalid @enderror"
                        id="domain_url" placeholder="" value="{{ old('domain_url') }}">

                    @error('domain_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Примечание [необяз.]</label>
                    <input name='note' type="note" class="form-control @error('domain_url') is-invalid @enderror"
                        id="note" placeholder="" value="{{ old('note') }}">

                    @error('note')
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



