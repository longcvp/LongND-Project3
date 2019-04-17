@extends('_layout.layout')
@section('title')
{{ __('auth.reset') }}
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h2>{{ __('auth.reset') }}</h2>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('auth.reset') }}</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('password.request', Auth::user()->id) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <p style="text-align: center;"><span class="error">* {{ __('auth.required') }}</span></p>
                        </div>
                        <input type="hidden" name="id" value="{{ Auth::id() }}">
                        @if(Auth::user()->is_root == ROOT)
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ __('auth.email') }} <span class="error">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">{{ __('auth.name') }} <span class="error">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                            <label for="old_password" class="col-md-4 control-label">{{ __('auth.old_password') }} <span class="error">*</span></label>

                            <div class="col-md-6">
                                <input id="old_password" type="password" class="form-control" name="old_password">

                                @if ($errors->has('old_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ __('auth.new_password') }} <span class="error">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                            <label for="confirm_password" class="col-md-4 control-label">{{ __('auth.re_password') }} <span class="error">*</span></label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="confirm_password">

                                @if ($errors->has('confirm_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                   {{ __('auth.change') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<style type="text/css">
    .error {
        color: red;
    }
    h2 {
        text-align: center;
    }
</style>
@endsection
