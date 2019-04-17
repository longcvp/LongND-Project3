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
               <h2 class="text-center">{{ __('layout.product_manage').$store->name }}</h2>
               <hr>
               <a href="{{ route('stores.import', $store->id) }}" type="button" class="btn btn-primary"><span class="fa fa-edit"></span> {{ __('root.import') }}</a>
               <a href="{{ route('stores.export', $store->id) }}" type="button" class="btn btn-danger"><span class="fa fa-edit"></span> {{ __('root.export') }}</a>
               <hr>
               <a href="{{ route('excel.export', $store->id) }}" type="button" class="btn btn-danger"><span class="fa fa-download"></span> {{ __('root.excel') }}</a>
               <hr>
               @if(count($store->products) != 0)
               <table id="table1" class="table table-hover table-striped">
                   <thead>
                       <tr>
                           <th>{{ __('root.stt') }}</th>
                           <th>{{ __('root.product_name') }}</th>
                           <th>{{ __('root.count') }}</th>
                       </tr>
                   </thead>
                   @foreach($store->products as $key => $product)
                   <tbody>
                       <tr>
                           <td>{{ $key+1 }}</td>
                           <td>{{ $product->name }}</td>
                           <td>{{ $product->pivot->count }}</td>
                       </tr>
                   </tbody>
                   @endforeach
               </table>
               @else
               <p>Không có thông tin kho</p>
               @endif
        </div>
    </section>
</div>
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
@endsection
@section('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<script type="text/javascript">
  $(document).ready( function () {
    $('#table1').DataTable();
} );
</script>
@endsection
