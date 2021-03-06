@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center my-2">

        <div class="col-md-6">
            @if (session()->has('msg'))
            <div class="alert alert-success my-2">
                {{session()->get('msg')}}
            </div> 
        
            @endif
            @if ($errors->any())
                                
            <div class="alert alert-danger">
                <ul>
                     @foreach ($errors->all() as $error)
                         <li> {{$error}}  </li>
                     @endforeach
                </ul>
            </div>

            @endif
            <div class="card">
                <div class="card-header">
                    <h3> New Group</h3>
                </div>
   
                <div class="card-body">
                 <form action="{{url('groups')}}" method="post">
                     @csrf
                        <div class="card-body">
                        
                          <div class="form-group">
                            <label for="group_name">Group Name </label>
                            <input type="text" name="group_name" class="form-control" required/>
                          </div>
                          <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea name="comment" class="form-control">
                            </textarea>
                          </div>
                        </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Create Group</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
