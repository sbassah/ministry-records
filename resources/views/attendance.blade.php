@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center my-2">

        <div class="col-md-8">
            @if (session()->has('msg'))
            <div class="alert alert-success my-2">
                {{session()->get('msg')}}
            </div> 
            @endif
            <div class="card">
                <div class="card-header">
                    <h3> Record Attendance</h3>
                </div>
   
                <div class="card-body">
                 <form action="{{url('attendance')}}" method="post">
                     @csrf
                        <div class="card-body">
                          <div class="form-group">
                            <label for="sunday_date">Sunday Date</label>
                            <input type="date" name="sunday_date" class="form-control" />
                          </div>
                          <div class="form-group">
                            <label for="group">Select Group</label>
                            <select class="form-control" name="group">
                                @foreach ($classes as $key => $value)
                                <option value="{{$key}}"> {{$value}}</option>
                                @endforeach
                                <option value="0">Teachers</option>
                            </select> 
                          </div>
                          <div class="form-group">
                            <label for="girls">Girls/Female</label>
                            <input type="number" name="girls" class="form-control" />
                          </div>
                          <div class="form-group">
                            <label for="boys">Boys/Male</label>
                            <input type="number" name="boys" class="form-control" />
                          </div>
                          <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea name="comment" class="form-control">
                            </textarea>
                          </div>
                        </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Record</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
