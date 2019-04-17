<?php

namespace App\Http\Controllers\Client;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\ExportRequest;
use App\Http\Requests\ImportRequest;
use App\Http\Controllers\Controller;
use App\Exports\StoreExport;
use App\Exports\StoreUserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\Store\StoreRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $store;
    protected $user;
    protected $product;

    public function __construct(StoreRepositoryInterface $store, UserRepositoryInterface $user, ProductRepositoryInterface $product)
    {
        $this->store = $store;
        $this->user = $user;
        $this->product = $product;
    }
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = $this->store->getDataStoreUser(Auth::id());
        return view('products.index',['stores' => $stores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = $this->store->getProductStore($id);
        return view('products.show', ['store' => $store]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exportStore(ExportRequest $req)
    {
        $this->store->updateExport($req);
        return redirect()->route('stores.show', $req->store_id)->with('success', 'Xuất hàng thành công!');
    }

    public function export($id)
    {
        $store = $this->store->getProductStore($id);
        return view('products.export', ['store' => $store]);
    }

    public function import($id)
    {
        $store = $this->store->getProductStore($id);
        return view('products.import', ['store' => $store]);
    }

    public function importStore(ImportRequest $req)
    {
        $this->store->updateImport($req);
        return redirect()->route('stores.show', $req->store_id)->with('success', 'Nhập hàng hàng thành công!');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function changeData(Request $req)
    {
        return $this->product->changeData($req);
    }

    public function excelStore($id)
    {
        $checkData = $this->store->find($id);
        if ($checkData->user_id != Auth::id()) {
            return redirect()->back();
        } else {
            return Excel::download(new StoreExport($this->store, $id), 'store_'.$id.'.xlsx');
        }
        
    }

    public function excelStoreUser()
    {
        return Excel::download(new StoreUserExport($this->store), 'user_'.Auth::id().'.xlsx');
    }
}
