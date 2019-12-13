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
                <div class="card-header">Add a Teacher

                </div>
                <div class="card-body table-responsive">
                 {!! Form::open(['url' => 'users']) !!}
                                @csrf
                                <div class="row">
                                       
                                     <div class="col-md-12">
                                             <div class="form-group">
                                                        {{Form::label('name', 'Full Name')}}
                                                        {{ Form::text('name','', 
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
                                                     {{ Form::email('email','', 
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
                                                     {{Form::password('password',['class'=>'form-control', 'required'])}}
                                                     
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
                                                        {{Form::password('password_confirmation',['class'=>'form-control', 'required'])}}
                                                        
                                                        @error('password_confirmation')
                                                        <span style="color:red">{{ $message }}</span>
                                                     @enderror
                                                </div>
                                        </div>
                                     
                   
                                    </div>
                                    <button type="submit"  class="btn btn-primary">Create New User</button>
                                </div>

                            </form>
                </div>
             
            </div>
        </div>
    </div>
</div>
@endsection
