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
                        <h3>Edit Guardian Information</h3>
                </div>
                <div class="row">
                                <div class="col-md-6">
                                        
                                        <h4 style="
                                        text-align: center;
                                        vertical-align: middle;
                                        margin: 50px;
                                    "
                                    >  {{$guardian->first_name}} {{$guardian->last_name }}</h4>
                                      
                                </div>
                                <div class="col-md-6">
                                                <img src="{{url('/uploads/guardians').'/'.$guardian->photo}}" 
                                                width="150px" class="img-circle elevation-2" />
                                </div> 
                </div>
                <div class="card-body">
                 {!! Form::open(['url' => ['guardians', $guardian->id], 'files'=>'true', 'method'=> 'put']) !!}
                                @csrf
                                <div class="row">
                                        <div class="col-md-2">
                                                <div class="form-group">
                                                        
                                                           {{Form::label('salutation', 'Salutation')}}
                                                           {{Form::select('salutation', $salutations, $guardian ? $guardian->salutation : '', ['class'=>'form-control', 'required'])}}

                                                         @error('salutation')
                                                            <span style="color:red">{{ $message }}</span>
                                                         @enderror
                                                </div>
                                        </div>

                                     <div class="col-md-4">
                                             <div class="form-group">
                                                     
                                                        {{Form::label('first_name', 'First Name')}}
                                                        {{ Form::text('first_name', $guardian ? $guardian->first_name : '', ['class'=>'form-control', 'required'])}}
                                                   
                                                      @error('first_name')
                                                         <span style="color:red">{{ $message }}</span>
                                                      @enderror
                                             </div>
                                     </div>
                                     <div class="col-md-6">
                                             <div class="form-group">
                                                        {{Form::label('last_name', 'Last Name')}}
                                                        {{ Form::text('last_name', $guardian ? $guardian->last_name : '', 
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
                                                     {{ Form::text('phone_no', $guardian ? $guardian->phone_no : '', 
                                                     ['class'=>'form-control', 'placeholder' =>'Enter Phone Number', 'required'])}}
                                                
                                                     @error('phone_no')
                                                     <span style="color:red">{{ $message }}</span>
                                                  @enderror
                                             </div>
                                     </div>
                                     <div class="col-md-6">
                                            <div class="form-group">
                                                    {{Form::label('is_member', 'Is He/She a member?')}}
                                                    {{Form::select('is_member',['1'=> 'Yes', '0' =>'No'] ,  $guardian ? $guardian->is_member : '', ['class'=>'form-control', 'required'])}}
                                                    
                                                    @error('is_member')
                                                    <span style="color:red">{{ $message }}</span>
                                                 @enderror
                                            </div>
                                    </div>
                                </div>
                     
                             
                                <div class="row">
                                  
                                  
                                     <div class="col-md-6">
                                            <div class="form-group">
                                                    {{Form::label('photo', 'Upload Picture')}}
                                                    {{Form::file('photo', ['class'=>'form-control'])}}
                                            
                                                     @error('photo')
                                                     <span style="color:red">{{ $message }}</span>
                                                  @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                                    {{Form::label('comment', 'Other Comment')}}
                                                    {{Form::textarea('comment',  $guardian ? $guardian->other_comment : '', ['class'=>'form-control'])}}
                                                     @error('comment')
                                                     <span style="color:red">{{ $message }}</span>
                                                  @enderror
                                        </div>
                                    </div>

                                </div>

                            
                                <button type="submit" {{$guardian ? '' : 'disabled'}}  class="btn btn-primary">Update Information</button>

                               
                            </form>
                </div>
             
            </div>
        </div>
        <div class="col-md-4">
                        <div class="card">
                                <div class="card-header"><h3>Children </h3></div>
                                <div class="card-body table-responsive">
                                        <table class="table table-hover">
                                                <thead>
                                                        <tr>
                                                        <th>Name</th>
                                                        <th> </th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        
                                                @foreach($child_guardians[0]->children as $child)
                                                <tr> 
                                                       
                                                        <td>    <a href="{{url('/children/'.$child->id.'/edit')}}">
                                                                        {{$child->first_name}} {{$child->last_name}}
                                                                </a><br/>
                                                        </td>
                                                        <td> 
                                                                        {{$child->pivot->relationship}}

                                                        </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                        </table>
                               
                                </div>
                        </div>     
                </div>
    </div>

    
</div>
@endsection
