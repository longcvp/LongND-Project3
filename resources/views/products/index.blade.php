@extends('_layout.layout')
@section('title')
{{ __('layout.product_title') }}
@endsection
@section('content')
<div class="conten-wrapper">
    <section class="content container-fluid">
        @if (session('success'))
        <div class="alert alert-success">
              <p>{{ session('success') }}</p>
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
              <p>{{ session('error') }}</p>
        </div>
        @endif
        <div class="container">
                <h2 class="text-center">{{ __('layout.product_title') }}</h2>
               <hr>
               <a href="{{ route('excel.stores') }}" type="button" class="btn btn-warning">{{ __('root.excel') }}</a>
               <hr>
               @if(count($stores) != 0)
               <table id="table1" class="table table-hover table-striped">
                   <thead>
                       <tr>
                           <th>{{ __('root.stt') }}</th>
                           <th>{{ __('root.storename') }}</th>
                           <th>{{ __('root.store_product') }}</th>
                           <th>{{ __('root.store_information') }}</th>
                       </tr>
                   </thead>
                   @foreach($stores as $key => $store)
                   <tbody>
                       <tr>
                           <td>{{ $key+1 }}</td>
                           <td>{{ $store->name }}</td>
                           <td>
                                @foreach($store->products as $k => $product)
                                    {!! 'Product '.($k+1).': '.$product->name.'<br>' !!}
                                @endforeach
                           </td>
                           <td><a href="{{ route('stores.show', $store->id) }}" type="button" class="btn btn-danger"><span class="fa fa-book"></span> {{ __('root.store_information') }}</a></td>
                       </tr>
                   </tbody>
                   @endforeach
               </table>
                {{ $stores->links() }}
               @else
               <p>Không có thông tin kho</p>
               @endif
        </div>
    </section>
</div>
@endsection