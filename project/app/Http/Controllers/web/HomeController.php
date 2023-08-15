<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Repositories\ItemRepository;
use App\Services\ItemService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private ItemService $itemService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->itemService = (new ItemService(new ItemRepository()));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('home', ['items'=>$this->itemService->showAll()]);
    }
    public function show($id) {
        return view('items.show', ['item'=>$this->itemService->show($id)]);
    }

    public function update($id, ItemRequest $request) {
        $this->itemService->update($request, $id);
        return redirect('/')->with('status','Компонент отредактирован!');
    }

    public function create() {
        return view('items.create');
    }

    public function store(ItemRequest $request) {
        $this->itemService->store($request);
        return redirect('/')->with('status','Компонент добавлен!');
    }

    public function delete($id) {
        $this->itemService->delete($id);
        return redirect('/')->with('status','Компонент удален!');
    }
}
