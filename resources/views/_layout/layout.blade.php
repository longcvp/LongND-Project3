<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" id = "csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Store Management')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- jquery ui -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
          @yield('css')
    <style type="text/css">
        .img-head {
            width:32px; 
            height:32px; 
            position: absolute; 
            top: 10px; 
            left: 10px; 
            border-radius:50%;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    @guest 
    @elseif(Auth::user()->reset_password == RESET_PASS && url()->current() !=  route('password.show', Auth::id()) )
    <script>
        alert('{{ __('layout.reset') }}');
        window.location = "{{ route('password.show', Auth::id()) }}";
    </script>
    @endguest    
</head>
<body>
    <div id="topheader">
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <div class="navbar-header">
                   @guest
                   @elseif(Auth::user()->is_root == ROOT)
                  <a class="navbar-brand" href="{{ route('admin.index') }}">{{ __('layout.manage_store')}}</a>
                  @else
                  <a class="navbar-brand" href="{{ route('users.index') }}">{{ __('layout.manage_store')}}</a>
                  @endguest
                </div>
                @guest           
                @elseif(Auth::user()->is_root == ROOT)
                <ul class="nav navbar-nav">
                  <li><a href="{{ route('admin.index') }}">{{ __('layout.manage_user_store')}}</a></li>
                  <li><a href="{{ route('stores.index') }}">{{ __('layout.manage_list_store')}}</a></li>
                </ul>
                @else
                <ul class="nav navbar-nav">
                  <li><a href="{{ route('users.index') }}">{{ __('layout.product_title')}}</a></li>
                </ul>                          
                @endguest
                <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown navbar-nav">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ __('layout.choose_language') }} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('lang', ['lang' => 'vi']) }}">VI</a>
                                </li>
                                <li>
                                    <a href="{{ route('lang', ['lang' => 'en' ]) }}">EN</a>
                                </li>
                            </ul>
                        </li>
                        @guest
                        <li class="dropdown navbar-nav">
                            <a class="dropdown-toggle" href="{{ route('login.index') }}"><span class="glyphicon glyphicon-log-in"></span> {{ __('auth.login') }}</a>
                        </li>             
                        @else
                        <li class="dropdown navbar-nav">
                            <a href="{{ route('admin.index') }}" class="dropdown-toggle" data-toggle="dropdown" style="position: relative; padding-left:50px;">
                                {{ __('layout.welcome', ['name' => (Auth::user()->name == '') ? 'Name' : Auth::user()->name]) }}
                            </a>    
                        </li>
                        <li class="dropdown navbar-nav">
                            <a href="{{ route('logout') }}" ><span class="glyphicon glyphicon-log-out"></span> {{ __('auth.logout') }}</a>
                        </li>
                        @endguest

                  
                </ul>
              </div>
            </nav>
        </div>
	<div class="container">
		<div class="row">
				    <!-- /.content-wrapper -->
	    	@yield('content')		

		</div>
	</div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select-js').select2();
        });
    </script>
    @yield('js')
</body>
</html>