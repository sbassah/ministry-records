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
                <div class="card-header"><h3>Manage Teachers</h3>
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
                       
                                {!! link_to_route('teachers.edit', 'Edit', $teacher->id,  ['class' => 'btn btn-info btn-sm']) !!}                               
                                {{ Form::open([ 'method'  => 'delete', 'route' => [ 'teachers.destroy', $teacher->id ],'style' => 'float:right' ]) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger',  
                                'onclick' => 'return confirm("Are you sure you want to delete this record?")']) }}
                            {{ Form::close() }}
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
