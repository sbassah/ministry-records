@extends('layouts.master')

@section('content')
<div class="container">
                @if (session()->has('msg'))
                <div class="alert alert-success my-2">
                    {{session()->get('msg')}}
                </div> 
                @endif
                
    <div class="row my-2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Edit User Account </h3>

                </div>
                <div class="card-body table-responsive">
                    {!! Form::open(['url' => ['users' , $user->id], 'method' => 'put']) !!}
                    @csrf
                                <div class="row">
                                       
                                     <div class="col-md-12">
                                             <div class="form-group">
                                                        {{Form::label('name', 'Full Name')}}
                                                        {{ Form::text('name',$user->name, 
                                                        ['class'=>'form-control', 'placeholder' =>'Enter Full Name', 'required'])}}
                                                   
                                                      @error('name')
                                                      <span style="color:red">{{ $message }}</span>
                                                   @enderror
                                             </div>
                                     </div>
                                </div>
                     
                                <div class="row">
                                     
                                     <div class="col-md-12">
                                             <div class="form-group">
                                                     
                                                    {{Form::label('email', 'Email Address')}}
                                                     {{ Form::email('email', $user->email, 
                                                     ['class'=>'form-control', 'placeholder' =>'Enter Email Address'])}}
                                                
                                                      @error('email')
                                                      <span style="color:red">{{ $message }}</span>
                                                   @enderror
                                             </div>
                                     </div>
                                </div>
                     
                             
                                <div class="row">
                                     <div class="col-md-12">
                                             <div class="form-group">
                                                     {{Form::label('password', 'Password')}}
                                                     {{Form::password('password',['class'=>'form-control'])}}
                                                     
                                                     @error('password')
                                                     <span style="color:red">{{ $message }}</span>
                                                  @enderror
                                             </div>
                                     </div>
                                  
                
                                 </div>
                                 <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group">
                                                        {{Form::label('password_confirmation', 'Confirm Password')}}
                                                        {{Form::password('password_confirmation',['class'=>'form-control'])}}
                                                        
                                                        @error('password_confirmation')
                                                        <span style="color:red">{{ $message }}</span>
                                                     @enderror
                                                </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                    {{Form::label('type', 'Type')}}
                                                    {{Form::select('type', [''=>'Select User Type', 'teacher'=>'Teacher', 'admin'=>'Administrator'],
                                                     $user->type ? $user->type : '', ['class'=>'form-control', 'required'])}}
                                                    @error('type')
                                                    <span style="color:red">{{ $message }}</span>
                                                 @enderror
                                            
                   
                                    </div>
                                    <button type="submit"  class="btn btn-primary">Update User</button>
                                </div>

                            </form>
                </div>
             
            </div>
        </div>
    </div>
</div>
@endsection
