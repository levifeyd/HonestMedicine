@extends('layouts.app')
@section('content')
<div>
    <div class="text-xl-center font-bold"> Редактирование компонента "{{$item->name}}"</div>
    <div class="container mt-lg-4">
        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="{{route('update', $item->id)}}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail">Отредактируйте название или ключ</label>
                        <input name="name" type="text" class="form-control mt-2" id="name" value="{{$item->name}}" >
                        <input name="key" type="text" class="form-control mt-2" id="key" value="{{$item->key}}" required maxlength="25">
                    </div>
                    <button type="submit" class="btn mt-2 bg-success text-white">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
<div>
@endsection
