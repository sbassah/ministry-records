@extends('layouts.master')

@section('content')
<div class="container">
                @if (session()->has('msg'))
                <div class="alert alert-success my-2">
                    {{session()->get('msg')}}
                </div> 
                @endif
                
    <div class="row justify-content-center my-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Add a Child </h3>

                </div>
                <div class="card-body table-responsive">
                 {!! Form::open(['url' => 'children', 'files'=>'true']) !!}
                                @csrf
                                <div class="row">
                                     <div class="col-md-6">
                                             <div class="form-group">
                                                     
                                                        {{Form::label('first_name', 'First Name')}}
                                                        {{ Form::text('first_name','', ['class'=>'form-control', 'required'])}}
                                                   
                                                      @error('first_name')
                                                         <span style="color:red">{{ $message }}</span>
                                                      @enderror
                                             </div>
                                     </div>
                                     <div class="col-md-6">
                                             <div class="form-group">
                                                        {{Form::label('last_name', 'Last Name')}}
                                                        {{ Form::text('last_name','', ['class'=>'form-control', 'required'])}}
                                                   
                                                      @error('last_name')
                                                      <span style="color:red">{{ $message }}</span>
                                                   @enderror
                                             </div>
                                     </div>
                                </div>
                     
                                <div class="row">
                                     <div class="col-md-6">
                                             <div class="form-group">
                                                     {{Form::label('gender', 'Gender')}}
                                                     {{Form::select('gender', [''=>'Select a Gender', 'Male'=>'Male', 'Female'=>'Female'], '', ['class'=>'form-control', 'required'])}}
                                         
                                                     @error('gender')
                                                     <span style="color:red">{{ $message }}</span>
                                                  @enderror
                                             </div>
                                     </div>
                                     <div class="col-md-6">
                                             <div class="form-group">
                                                     {{Form::label('date_of_birth', 'Date of Birth')}}
                                                      {{ Form::date('date_of_birth','', ['class'=>'form-control', 'required'])}}
                                                      

                                                      @error('date_of_birth')
                                                      <span style="color:red">{{ $message }}</span>
                                                   @enderror
                                             </div>
                                     </div>
                                </div>
                     
                             
                                <div class="row">
                                     <div class="col-md-6">
                                             <div class="form-group">
                                                     
                                                     {{Form::label('church_class', 'Class in Church')}}
                                                     {{Form::select('church_class',$church_class , '', ['class'=>'form-control', 'required'])}}
                                                     
                                                     @error('church_class')
                                                     <span style="color:red">{{ $message }}</span>
                                                  @enderror
                                             </div>
                                     </div>
                                  

                                     <div class="col-md-6">
                                                <div class="form-group">
                                                        {{Form::label('name_of_school', 'Name of School')}}
                                                       {{ Form::text('name_of_school','', ['class'=>'form-control'])}}
                                                   
                                                         @error('name_of_school')
                                                         <span style="color:red">{{ $message }}</span>
                                                      @enderror
                                                </div>
                                        </div>

                                </div>

                                <div class="row">
                                             
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                              
                                                                {{Form::label('school_class', 'Class in School')}}
                                                                {{Form::select('school_class',$school_class , '', ['class'=>'form-control', 'required'])}}
                                                
                                                                @error('school_class')
                                                                <span style="color:red">{{ $message }}</span>
                                                             @enderror
                                                        </div>
                                                </div>

                                                <div class="col-md-6">
                                                                <div class="form-group">
                                                                        {{Form::label('photo', 'Upload Picture')}}
                                                                        {{Form::file('photo', ['class'=>'form-control'])}}
                                                                
                                                                         @error('photo')
                                                                         <span style="color:red">{{ $message }}</span>
                                                                      @enderror
                                                                </div>
                                                        </div>
                                </div>

                                <div class="row">
                                                <div class="col-md-12">
                                                                <div class="form-group">
                                                                        <label for="address">Residential Location</label>
                                                                        <textarea name="address" id="address" 
                                                                        cols="30" placeholder="Enter Residential Location"  
                                                                        rows="5" class="form-control"></textarea>
                                                                        @error('address')
                                                                        <span style="color:red">{{ $message }}</span>
                                                                     @enderror
                                                                </div>
                                                        </div>
                                </div>

                                <button type="submit"  class="btn btn-primary">Create Child</button>

                               
                            </form>
                </div>
             
            </div>
        </div>
    </div>
</div>
@endsection
