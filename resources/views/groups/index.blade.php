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
                <div class="card-header"><h3>Manage Groups</h3>
                    <div class="card-tools">
                        <a type="button" class="btn btn-primary" href="/groups/create">
                         <i class="fas fa-user"> New Group</i>
                        </a>
                    </div>

                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $k =0; ?>
                        @foreach ($groups as $group)
                        <tr>
                            <td>{{$k +=1}}</td>
                            <td>{{$group->name}} </td>
                            <td>
                       
                                {!! link_to_route('groups.edit', 'Edit', $group->id,  ['class' => 'btn btn-info btn-sm']) !!}                               
                                {{ Form::open([ 'method'  => 'delete', 'route' => [ 'groups.destroy', $group->id ],'style' => 'float:right' ]) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger',  
                                'onclick' => 'return confirm("Are you sure you want to delete this record?")']) }}
                            {{ Form::close() }}
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
