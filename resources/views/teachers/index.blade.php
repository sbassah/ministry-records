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
                <div class="card-header">Manage Teachers
                    <div class="card-tools">
                        <a type="button" class="btn btn-primary" href="/teachers/create">
                         <i class="fas fa-user"> New Teacher</i>
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
                          <th>Email Address</th>
                          <th>Class In Charge</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{$teacher->id}}</td>
                            <td>{{$teacher->first_name}} {{$teacher->last_name}}</td>
                            <td>{{$teacher->phone_no}}</td>
                            <td>{{$teacher->email}}</td>
                            <td>{{$church_class[$teacher->class_assigned_id]}}</td>
                          
                            <td>
                              <a href="{{url('/teachers/'.$teacher->id.'/edit')}}">
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
                  {{ $teachers->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
