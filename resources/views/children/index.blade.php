@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center my-2">
  
        <div class="col-md-12">
          @if (session()->has('msg'))
          <div class="alert alert-success my-2">
              {{session()->get('msg')}}
          </div> 
          @endif
            <div class="card">
                <div class="card-header"><h3>Manage Children </h3>
                    <div class="float-left">
                      <form action="{{url('filter_children')}}" method="post">
                        @csrf
                      <select onchange="callUrl()" name="class_filter" id="class_filter"class="form-control">
                        <option value="0">All </option>
                        <option value="1"> Class One </option>
                        <option value="2"> Class Two </option>
                        <option value="3"> Teens </option>
                      </select>
                      <input type="submit" class="btn btn-primary float-left" value="Filter" />
                    </form>
                    </div>
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
                                 {!! link_to_route('children.edit', 'Edit', $child->id,  ['class' => 'btn btn-info btn-sm']) !!}                               
                                {{ Form::open([ 'method'  => 'delete', 'route' => [ 'children.destroy', $child->id ],'style' => 'float:right' ]) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger',  'onclick' => 'return confirm("Are you sure you want to delete this record?")']) }}
                            {{ Form::close() }}
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
