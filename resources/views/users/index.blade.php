@extends('layouts.master')

@section('content')
<div class="container">
        @if (session()->has('msg'))
        <div class="alert alert-success my-2">
            {{session()->get('msg')}}
        </div> 
        @endif
    <div class="row justify-content-center my-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Manage Users
                    <div class="card-tools">
                        <a type="button" class="btn btn-primary" href="/users/create">
                         <i class="fas fa-user"> New User</i>
                        </a>
                    </div>

                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email Address</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                          
                            <td>
                              <a href="{{url('/users/'.$user->id.'/edit')}}">
                                  <i class="fa fa-edit blue"></i>
                                </a>
                                 <a href="#">
                                  <i class="fa fa-trash red"></i>
                                </a>
                            </td>
                          </tr>
                        @endforeach
                     
                      </tbody>
                    </table>
                  </div>
                  {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
