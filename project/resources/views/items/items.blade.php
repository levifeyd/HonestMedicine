<div class="text-xl-center font-bold mt-3">Список компонентов</div>
<a href="{{route('create')}}" class="btn btn-primary">Создать новый компонент</a>
@foreach($items as $item)
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <h6 class="card-header">Название : {{ $item->name }}</h6>
                                <h6 class="card-body">Ключ: {{ $item->key }}</h6>
                                <div class="card-body">
                                    <a href="{{route('show', $item->id)}}" class="btn btn-primary">Редактировать компонент</a>
                                        <form action="{{route('delete', $item->id)}}" method="post" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn bg-danger text-white">Удалить компонент</button>
                                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
