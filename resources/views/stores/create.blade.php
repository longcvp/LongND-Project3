@extends('_layout.layout')
@section('title')
{{ __('root.create_store') }}
@endsection
@section('content')
    <div class="conten-wrapper">
        <section class="content container-fluid">
            <div class="container">
                <h2>{{ __('root.create_store') }}</h2>
                <form class="form-horizontal" method="POST" action="{{ route('stores.store') }}" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <p style="text-align: center;"><span class="error">* {{ __('auth.required') }}</span></p>
                    </div>
                    <div class="form-group{{ $errors->has('storename') ? ' has-error' : '' }}">
                        <label for="storename" class="col-md-4 control-label">{{ __('root.storename') }} <span class="error">*</span></label>

                        <div class="col-md-6">
                            <input id="storename" type="text" class="form-control" name="storename" value="{{ old('storename') }}" required autofocus>

                            @if ($errors->has('storename'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('storename') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 
                    <div class="form-group{{ $errors->has('manager') ? ' has-error' : '' }}">
                        <label for="manager" class="col-md-4 control-label">{{ __('root.manage_store') }} <span class="error">*</span></label>

                        <div class="col-md-6">
                            <select class="selectpicker form-control" name="manager" id="manager" required>
                                <option selected value="">Select</option>
                                @foreach($users as $user)
                                <option  value="{{ $user->id }}" @if (old('manager') == $user->id )
                                    selected 
                                @endif>{{ $user->name == '' ? $user->email : $user->name }}</option>
                                @endforeach
                            </select>                            
                            @if ($errors->has('manager'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('manager') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>                                 
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('root.create') }}
                            </button>
                            <a href="{{ route("stores.index") }}" type="button" class="btn btn-info">{{ __('root.back') }}</a>
                        </div>

                    </div>
                 </form>
            </div>
        </section>  
    </div>
@endsection
@section('css')
<style type="text/css">
    h2 {
        text-align: center;
    }
    .error {
        color: red;
    }
</style>
@endsection
