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
                <div class="card-header"><h3> Manage Users </h3>
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
                              {!! link_to_route('users.edit', 'Edit', $user->id,  ['class' => 'btn btn-info btn-sm']) !!}                               
                                {{ Form::open([ 'method'  => 'delete', 'route' => [ 'users.destroy', $user->id ],'style' => 'float:right' ]) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger',  
                                'onclick' => 'return confirm("Are you sure you want to delete this user?")']) }}
                            {{ Form::close() }}
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
