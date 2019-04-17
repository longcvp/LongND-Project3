@extends('_layout.layout')
@section('title')
{{ __('layout.manage_user_store') }}
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
               <h2 class="text-center">{{ __('layout.manage_user_store') }}</h2>
               <hr>
               <a href="{{ route('admin.create') }}" type="button" class="btn btn-primary">{{ __('root.create_title') }}</a>
               <hr>
               <a href="{{ route('admin.excelUser') }}" type="button" class="btn btn-danger">{{ __('root.excel') }}</a>
               <hr>
                <form action="{{ route('admin.reset') }}" method="POST">
                @csrf
                    <input type='submit' class="btn btn-danger" value="{{ __('root.reset') }}">
               @if(count($users) != 0)
               <table id="table1" class="table table-hover table-striped">
                   <thead>
                       <tr>
                           <th>{{ __('root.select') }}</th>
                           <th>{{ __('root.stt') }}</th>
                           <th>{{ __('root.name') }}</th>
                           <th>{{ __('root.username') }}</th>
                           <th>{{ __('root.email') }}</th>
                           <th>{{ __('root.store_table') }}</th>
                       </tr>
                   </thead>
                   @foreach($users as $key => $user)
                   <tbody>
                       <tr>
                           <td><input type="checkbox" name="checked[]" value="{{ $user->id }}"></form></td>
                           <td>{{ $key+1 }}</td>
                           <td>{{ $user->name }}</td>
                           <td>{{ $user->username }}</td>
                           <td>{{ $user->email }}</td>
                           <td>
                                @foreach($user->stores as $k => $store)
                                    {!! 'Kho '.($k+1).': '.$store->name.'<br>' !!}
                                @endforeach
                           </td>
                       </tr>
                   </tbody>
                   @endforeach
               </table>
                {{ $users->links() }}
               @else
               <p>Không có thông tin nhân viên</p>
               @endif
        </div>
    </section>
</div>
@endsection