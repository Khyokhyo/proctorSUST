@extends('layouts.app')

@section('content')
<!-- Header -->
<header>
        <div class="intro-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <!-- Project Details Go Here -->

                        <h1>{{ $org->name }}</h1>

                        <h3>Type</h3>
                        <h5>{{ $org->type }}</h5>
                        <h3>Motto</h3>
                        <h5>{{ $org->motto }}</h5>

                        <h3>Status</h3>
                        @if ($org->status==0)
                            <h5>Inactive</h5>
                        @elseif ($org->status==1)
                            <h5>Active</h5>
                        @elseif ($org->status==2)
                            <h5>Blocked</h5>
                        @else
                            <h5>Unknown</h5>
                        @endif
                        
                        <h3>Formation date</h3>
                        <h5>{{ $org->formation_date }}</h5><br><br>
                        <a href="#EditOrgModal" class="page-scroll btn btn-xl" data-toggle="modal">Update Profile</a>

                    </div>
                </div>
            </div>
        </div>
</header>


<!-- Update profile org Modal -->
<div class="modal fade" id="EditOrgModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-edit"></span> Update your profile</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form class="form-horizontal" role="form" method="GET" id="orgUpdateForm" action="{{ url('putOrgHome') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{Auth::user()->username}}" required>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Organization Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $org->name }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Organization Type</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="type" value="{{ $org->type }}">

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br>

                        <div class="form-group{{ $errors->has('motto') ? ' has-error' : '' }}">
                            <label for="motto" class="col-md-4 control-label">Organization Motto</label>

                            <div class="col-md-6">
                                <textarea id="motto" type="text" class="form-control" name="motto" value="" form="orgUpdateForm">{{ $org->motto }}</textarea>

                                @if ($errors->has('motto'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('motto') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="formation_date" class="col-md-4 control-label">Formation Date</label>

                            <div class="col-md-6">
                                <input id="formation_date" type="date" class="form-control" name="formation_date" value="{{ $org->formation_date }}" required>

                                @if ($errors->has('formation_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('formation_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br>
                        

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-info">
                                    Update
                                </button>
                            </div>
                        </div>
                        <br>
                    </form>
        </div>
      </div>
      
    </div>
  </div> 

 
@endsection