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
                <div class="card-header">Manage Guardians
                    <div class="card-tools">
                        <a type="button" class="btn btn-primary" href="/guardians/create">
                         <i class="fas fa-user"> New Guardian</i>
                        </a>
                    </div>

                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Phone Number</th>
                          <th>Is a Member</th>
                          <th>Photo</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($guardians as $guardian)
                        <tr>
                            <td>{{$guardian->id}}</td>
                            <td>{{$guardian->salutation}} {{$guardian->first_name}} {{$guardian->last_name}}</td>
                            <td>{{$guardian->phone_no}}</td>
                            <td>{{$guardian->is_member == 1? 'Yes' : 'No'}}</td>
                            <td> <img src="{{url('/uploads/guardians').'/'.$guardian->photo}}" 
                              class="img-circle elevation-2" height="50px" />
                              
                            </td>
                            <td>
                              <a href="{{url('/guardians/'.$guardian->id.'/edit')}}">
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
                  {{ $guardians->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
