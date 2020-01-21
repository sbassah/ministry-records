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
              <div class="card-body p-2">
                <div class="row">
                  <div class="col-md-3">
                    <form action="{{url('filter-children')}}" method="post">
                      @csrf
                      <div class="form-group">
                        <label for="">Select Class</label>
                        <select name="class_filter" id="class_filter"class="form-control">
                          <option value="0">All </option>
                          <option value="1"> Class One </option>
                          <option value="2"> Class Two </option>
                          <option value="3"> Teens </option>
                        </select>
                      </div>
                      <input type="submit" class="btn btn-primary float-left" value="Filter" />
                </form>
              </div>
              <div class="col-md-8 offset-md-1">
                <form action="{{url('search-children')}}" method="post">
                  @csrf
                  <div class="row">
                    <div class="col-md-4 float-right my-4">
                     <strong style="float: right;"> Search Child: </strong>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="search" name="first_name" id="" class="form-control"
                         placeholder="" aria-describedby="helpId">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="last">Last Name</label>
                        <input type="search" name="last_name" id="" class="form-control"
                         placeholder="" aria-describedby="helpId">
                      </div>
                    </div>
  
                  </div>
                  <input type="submit" class="btn btn-primary float-right" value="Search" />

                </form>
              
              </div>
            </div>
          </div>
        </div>
            <div class="card">
                <div class="card-header"><h3>Manage Children </h3>
                    <div class="float-left">
                    
                      
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
                        <?php $k =0; ?>
                        @foreach ($children as $child)
                        <tr>
                            <td>{{$k +=1}}</td>
                            <td>{{ucfirst($child->first_name)}} {{ucfirst($child->last_name)}}</td>
                            <td>{{ucfirst($child->gender)}}</td>
                            
                           
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
