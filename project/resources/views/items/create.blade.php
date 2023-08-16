@extends('layouts.app')
@section('content')
<div>
    <div class="text-xl-center font-bold">Пожалуйста заполните поля для создания нового компонента</div>
    <div class="container mt-18">
        <div class="row">
            <div class="col-md-6">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger mt-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail">Введите название</label>
                        <input name="name" type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Введите ключ</label>
                        <input name="key" type="text" class="form-control" id="key" required>
                    </div>
                    <button type="submit" class="btn btn-primary bg-green mt-2">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
