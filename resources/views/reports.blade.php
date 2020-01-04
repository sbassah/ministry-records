@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center my-2">
        <div class="col-md-12 ">

            <h3> Reports </h3>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                   <h4> Children by Class </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('reports/by-class')}}" method="Post">
                      @csrf
                        <div class="form-group">
                          <label for="">Select a Class</label>
                          <select name="group" id="group" class="form-control">
                            @foreach ($classes as $key => $value)
                                <option value="{{$key}}"> {{$value}}</option>
                                @endforeach
                        </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Get Report" />
                    </form>
                
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4> Children by Age Group </h4>
                </div>
   
                <div class="card-body">
                    <form action="" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age_start">From</label>
                                <input type="number" name="age_start" class="form-control" />
      
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age_end">To</label>
                                <input type="number" name="age_end" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4 my-4">
                            <input type="submit" name="submit" class="btn btn-primary" value="Get Report" />
                        </div>
                    </div>
                        
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
          
            <div class="card">
                <div class="card-header">
                    <h4> Attendance by Month Report </h4>
                </div>
   
                <div class="card-body">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="age_start">Month</label>
                                                
                                        <select name="month" id="month" class="form-control">
                                            <option> January </option>
                                            <option> February </option>
                                            <option> March </option>
                                            <option> April </option>
                                            <option> May </option>
                                            <option> June </option>
                                            <option> July </option>
                                            <option> August </option>
                                            <option> September </option>
                                            <option> October </option>
                                            <option> November </option>
                                            <option> December </option>
                                        </select>

          
                                  </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="age_end">Year</label>
                                    <select name="group" id="group" class="form-control">
                                        <option> 2020 </option>
                                        <option> 2021 </option>
                                        <option> 2022 </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 my-4">
                                <input type="submit" name="submit" class="btn btn-primary" value="Get Report" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            @if (session()->has('msg'))
            <div class="alert alert-success my-2">
                {{session()->get('msg')}}
            </div> 
            @endif
            <div class="card">
                <div class="card-header">
                    <h4> Attendance by Day Report </h4>
                </div>
   
                <div class="card-body">
                    <form action="" method="get">
                        <input type="week" name="day" class="form-control" />

                        <input type="submit" name="submit" class="btn btn-primary" value="Get Report" />
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
