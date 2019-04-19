<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Http\Controllers\Controller;
use App\Exports\StoreDataExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\Store\StoreRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $store;
    protected $user;

    public function __construct(StoreRepositoryInterface $store, UserRepositoryInterface $user)
    {
        $this->store = $store;
        $this->user = $user;
    }

    public function index()
    {
        $stores = $this->store->getDataStore();
        return view('stores.index', ['stores' => $stores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->user->getDataUser();
        return view('stores.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->store->createStore($request);
        return redirect()->route('stores.index')
                            ->with('success', 'Thêm kho thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = $this->user->getDataUser();
        $store = $this->store->find($id);
        return view('stores.edit', ['users' => $users, 'store' => $store]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        $this->store->editStore($request);
        return redirect()->route('stores.index')
                         ->with('success', 'Thêm kho thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function excelStore()
    {
        return Excel::download(new StoreDataExport($this->store), 'store.xlsx');
    }
}
