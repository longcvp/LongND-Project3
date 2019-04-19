@extends('_layout.layout')
@section('title')
{{ __('layout.import') }}
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
            <h2 style="text-align: center;">{{ __('layout.import') }}</h2>
            <hr>
                <form class="form-horizontal" method="POST" action="{{ route('import.store', $store->id) }}" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                    <div class="form-group">
                        <p style="text-align: center;"><span class="error">* {{ __('auth.required') }}</span></p>
                    </div>
                    <input type="hidden" name="store_id" value="{{ $store->id }}">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" id="name">
                        <label for="name" class="col-md-4 control-label">{{ __('root.storename') }} <span class="error">*</span></label>

                        <div class="col-md-6">
                            <input type="string" class="form-control" name="name" id="name" value="{{ $store->name }}" readonly>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 
                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="type" class="col-md-4 control-label">{{ __('root.type') }} <span class="error">*</span></label>

                        <div class="col-md-6">
                            <select class="selectpicker form-control" name="type" id="type" required>
                                <option selected value="0">{{ __('root.type') }}</option>
                                <option value="1">{{ __('root.type_new') }}</option>
                                <option value="2">{{ __('root.type_old') }}</option>
                            </select>
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('product_name') ? ' has-error' : '' }}" id="product_new">
                        <label for="product_name" class="col-md-4 control-label">{{ __('root.product_name') }} <span class="error">*</span></label>

                        <div class="col-md-6">
                            <input type="string" class="form-control" name="product_name" id="product_name" value="{{ old('product_name') }}">

                            @if ($errors->has('product_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('product_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>                                        
                    <div class="form-group{{ $errors->has('product_id') ? ' has-error' : '' }}" id="product_trans">
                        <label for="product_id" class="col-md-4 control-label">{{ __('root.choose_product') }} <span class="error">*</span></label>

                        <div class="col-md-6">
                            <select class="selectpicker form-control" name="product_id" id="product_id">
                                <option selected value="">{{ __('root.choose_product') }} </option>
                                @if(count($store->products) != 0)
                                @foreach($store->products as $product)
                                <option value="{{ $product->id }}" @if (old('product_id') == $product->id)
                                    selected
                                @endif>{{ $product->name }}</option>
                                @endforeach
                                @endif
                            </select>
                            @if ($errors->has('product_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('product_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 
                    <div class="form-group{{ $errors->has('count_product') ? ' has-error' : '' }}" id="product_count">
                        <label for="count" class="col-md-4 control-label">{{ __('root.count') }} <span class="error">*</span></label>

                        <div class="col-md-6">
                            <input type="number" class="form-control" name="count_product" id="count_product" value="{{ old('count_product') }}" readonly>

                            @if ($errors->has('count_product'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('count_product') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('count') ? ' has-error' : '' }}">
                        <label for="count" class="col-md-4 control-label">{{ __('root.count_import') }} <span class="error">*</span></label>

                        <div class="col-md-6">
                            <input id="count" type="number" min = "0" step="1" class="form-control" name="count" value="{{ old('count') }}" required autofocus>

                            @if ($errors->has('count'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('count') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('root.import') }}
                            </button>
                            <a href="{{ route('stores.show', $store->id) }}" type="button" class="btn btn-info">{{ __('root.back') }}</a>
                        </div>
                    </div>
                 </form>
        </div>
    </section>
</div>
@endsection
@section('js')
<script type="text/javascript">
   
    $(document).ready(function () {
        $('#product_new').hide();
        $('#product_trans').hide();
        $('#product_count').hide();
        $("select[name='type']").on('change',function() {
            var type = $(this).val();
            if (type == 1) {
                $('#product_count').hide();
                $('#product_new').show();
                $('#product_trans').hide();
            } else if (type == 2) {
                $('#product_count').show();
                $('#product_new').hide();
                $('#product_trans').show();
            } else {
                $('#product_new').hide();
                $('#product_trans').hide();
                $('#product_count').hide();                
            }
        });
        $("select[name='product_id']").on('change',function() {
            var product_id = $(this).val();
            if (product_id != 0) {
                $.ajax({
                    type:'POST',
                    headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    dataType   :'JSON',
                    url:'/export/change/user',
                    data:{store_id: {{ $store->id }} ,product_id: product_id},
                    success:function(result){
                        $('#product_count').show();
                        $('#count_product').val(result);
                    }
                }); 
            } 
        });
});
</script>
@endsection