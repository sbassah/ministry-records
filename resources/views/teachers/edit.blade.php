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
                <div class="card-header"><h3>Edit  Teacher</h3>

                </div>
                <div class="row">
                        <div class="col-md-6">


                                <h4 style="
                                        text-align: center;
                                        vertical-align: middle;
                                        margin: 50px;
                                    "
                                    > {{$teacher->first_name}} {{$teacher->last_name }}</h4>
                                
                        </div>
                        <div class="col-md-6">
                                        <img src="{{url('/uploads/teachers').'/'.$teacher->photo}}" width="150px" 
                                        class="img-circle elevation-2"/>
                        </div> 
                </div>
                <div class="card-body table-responsive">
                 {!! Form::open(['url' => ['teachers' , $teacher->id], 'files'=>'true', 'method' => 'put']) !!}
                                @csrf
                                <div class="row">
                                        <div class="col-md-2">
                                                <div class="form-group">
                                                        
                                                           {{Form::label('salutation', 'Salutation')}}
                                                           {{Form::select('salutation', $salutations,
                                                            $teacher ? $teacher->salutation : '', ['class'=>'form-control', 'required'])}}
                                         
                                                         @error('salutation')
                                                            <span style="color:red">{{ $message }}</span>
                                                         @enderror
                                                </div>
                                        </div>

                                     <div class="col-md-4">
                                             <div class="form-group">
                                                     
                                                        {{Form::label('first_name', 'First Name')}}
                                                        {{ Form::text('first_name', $teacher ? $teacher->first_name : '', ['class'=>'form-control', 'required'])}}
                                                   
                                                      @error('first_name')
                                                         <span style="color:red">{{ $message }}</span>
                                                      @enderror
                                             </div>
                                     </div>
                                     <div class="col-md-6">
                                             <div class="form-group">
                                                        {{Form::label('last_name', 'Last Name')}}
                                                        {{ Form::text('last_name', $teacher ? $teacher->last_name : '', 
                                                        ['class'=>'form-control', 'placeholder' =>'Enter Last Name', 'required'])}}
                                                   
                                                      @error('last_name')
                                                      <span style="color:red">{{ $message }}</span>
                                                   @enderror
                                             </div>
                                     </div>
                                </div>
                     
                                <div class="row">
                                     <div class="col-md-6">
                                             <div class="form-group">
                                                     {{Form::label('phone_no', 'Phone Numer')}}
                                                     {{ Form::text('phone_no',$teacher ? $teacher->phone_no : '', 
                                                     ['class'=>'form-control', 'placeholder' =>'Enter Phone Number', 'required'])}}
                                                
                                                     @error('phone_no')
                                                     <span style="color:red">{{ $message }}</span>
                                                  @enderror
                                             </div>
                                     </div>
                                     <div class="col-md-6">
                                             <div class="form-group">
                                                     
                                                    {{Form::label('email', 'Email Address')}}
                                                     {{ Form::email('email',$teacher ? $teacher->email : '', 
                                                     ['class'=>'form-control', 'placeholder' =>'Enter Email Address'])}}
                                                
                                                      @error('email')
                                                      <span style="color:red">{{ $message }}</span>
                                                   @enderror
                                             </div>
                                     </div>
                                </div>
                     
                             
                                <div class="row">
                                     <div class="col-md-6">
                                             <div class="form-group">
                                                     {{Form::label('class_assigned', 'Class In Charge Of')}}
                                                     {{Form::select('class_assigned',$church_class , $teacher ? $teacher->class_assigned_id : '', ['class'=>'form-control', 'required'])}}
                                                     
                                                     @error('class_assigned')
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

                            
                                <button type="submit"  class="btn btn-primary">Update Record</button>

                               
                            </form>
                </div>
             
            </div>
        </div>
    </div>
</div>
@endsection
