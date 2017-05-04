@extends('layouts.app')

@section('content')
<!-- Header -->
    <header style="background-image: url(../img/welcome.jpg);
    background-repeat: no-repeat;
    background-attachment: scroll;
    background-position: center center;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
    -o-background-size: cover;">
    
        <div class="container">
            <div class="intro-text">
                <div class="container">
	                <div class="row">
	                    <div class="col-lg-8 col-lg-offset-2">

	                        <div class="team-member">

	                            @if($proc->teacher->gender=='male')
	                                <a href="#proc" class="notice-link" data-toggle="modal"><img class="img-circle" src="img/team/male_icon.jpg" style="height:180px;" alt=""></a>
	                            @elseif($proc->teacher->gender=='female')
	                                <a href="#proc" class="notice-link" data-toggle="modal"><img class="img-circle" src="img/team/female_icon.jpg" style="height:180px;" alt=""></a>
	                            @endif
	                            <h2 style="color:#fff">{{Auth::user()->username}}</h2>
	                            <h4 style="color:#fff">{{$proc->designation}}</h4>
	                            <h4 style="color:#fff">Active from {{$proc->start_date}}</h4>
	                            
	                        </div>

	                    </div>
	                </div>
            	</div>
            </div>
            
        </div>
    </header>

    <!--view proc Modal -->
    <div class="modal fade" id="proc" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="padding:35px 50px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4><span class="glyphicon glyphicon-file"></span> Teacher Details</h4>
                </div>
                <div class="modal-body" style="padding:40px 50px;">
                    <div class="team-member">
                        @if($proc->teacher->gender=='male')
                        <img style="height:90px; width:90px;" src="img/team/male_icon.jpg" alt="">
                        @elseif($proc->teacher->gender=='female')
                        <img style="height:90px; width:90px;" src="img/team/female_icon.jpg" alt="">
                        @endif
                        <h4 class="text-center">{{$proc->teacher->fullname}}</h4>
                        <h4>{{$proc->teacher->post}}</h4>
                        <h4>Dept: {{$proc->teacher->dept->code}}</h4>
                        <h4>Email: {{$proc->teacher->email}}</h4>
                        <h4>Contact no: {{$proc->teacher->contact_no}}</h4>
                    </div>
                </div><br>
            </div>
        </div>
    </div>

@endsection