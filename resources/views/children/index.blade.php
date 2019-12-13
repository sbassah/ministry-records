@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center my-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Manage Children </h3>
                    <div class="card-tools">
                        <a type="button" class="btn btn-primary" href="/children/create">
                         <i class="fas fa-user"> New Child</i>
                        </a>
                    </div>

                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Gender</th>
                          <th>Date of Birth (Age)</th>
                          <th>Church Class</th>
                          <th>Photo</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($children as $child)
                        <tr>
                            <td>{{$child->id}}</td>
                            <td>{{$child->first_name}} {{$child->last_name}}</td>
                            <td>{{$child->gender}}</td>
                            
                           
                            <td>{{$child->date_of_birth}}</td>
                            <td>{{$church_class[$child->church_class_id]}}</td>
                            <td> <img src="{{url('/uploads/children').'/'.$child->photo}}"
                              class="img-circle elevation-2" height="50px" />
                              
                            </td>
                            <td>
                                
                                 {{--  {!! Form::open(['route' => ['children.destroy', $child->id], 'method' => 'DELETE']) !!}  --}}
                                 {!! link_to_route('children.edit', 'Edit', $child->id,  ['class' => 'btn btn-info btn-sm']) !!}
                                 {!! link_to_route('children.destroy', 'Delete', $child->id,  ['class' => 'btn btn-danger btn-sm', 'method' => 'DELETE','onclick' => 'confirm("Are you sure you want to delete the product")']) !!}
{{--                                  
                                 {{Form::button('Delete', [ 'type'=> 'submit', 'class'=>'btn btn-danger btn-sm','onclick' => 'confirm("Are you sure you want to delete the product")'])}}
                            
                               
                                {!! Form::close() !!}    --}}
                    
                            </td>
                          </tr>
                        @endforeach
                     
                      </tbody>
                    </table>
                  </div>
                  <div class="float-right">
                      {{ $children->links() }}
                  </div>
                
            </div>
        </div>
    </div>
</div>

@endsection
