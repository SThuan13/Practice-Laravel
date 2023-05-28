@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    @can('isAdmin')
                        {{ __('Admin!') }}
                    @endcan

                    
                    @can('isSuperAdmin')
                        {{ __('Super Admin!') }}
                    @endcan
                </div>

            </div>
        </div>
        
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex d-flex justify-content-between">
                    <h3>
                        {{ __('User list') }}
                    </h3>
                    @can('isSuperAdmin')
                        <a href="{{ url('/admin/user/create') }}" class="btn btn-primary">Create</a>
                    @endcan
                </div>
                
                <div class="card-body">
                    <table class="table mx-5">
                        <thead >
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr >
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="">
                                        <a class="btn btn btn-info mx-2" href="{{ url('/admin/user/detail/' . $user->id) }}">View</a>
                                        @can('isSuperAdmin')
                                            <a class="btn btn-warning mx-2" href="{{ url('/admin/user/update/' . $user->id ) }}">Edit</a>
                                        
                                            <form method="POST" action="{{ url('/admin/user/delete/' . $user->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button class="btn btn-danger mx-2" type="submit" class="btn btn-danger btn-sm" title="Delete User" > Delete</button>
                                            </form>
                                        @endcan
                                        
                                    </td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
