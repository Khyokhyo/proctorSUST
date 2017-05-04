@extends('layouts.app')

@section('content')

<section id="approval" class="bg-light-gray" style="background-image: url(../img/office2.jpg);
    background-repeat: no-repeat;
    background-attachment: scroll;
    background-position: center center;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
    -o-background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" style="color:#fff">{{$org->name}}</h2>
                <h3 class="section-subheading" style="color:#fff">Approve or deny the requests for committee members of {{$org->name}}</h3>
            </div>
        </div>

        <div class="organization-account">
            <div class="row">
                <div class="col-sm-3">
                    <h2 class="section-heading" style="color: #fff">Advisor Requests</h2>
                </div>
                <div class="col-sm-9">
                    @if(!empty($approveAdvisors))
                        <ul class="list-inline social-buttons proctor-list">
                            @foreach($approveAdvisors as $approveAdvisor)
                            
                                <div class="col-md-4 text-center">
                                    <span class="fa-stack fa-4x">
                                            @if($approveAdvisor->teacher->gender=='male')
                                            <img class="img-circle img-responsive" src="/img/team/male_icon.jpg" alt="">
                                            @elseif($approveAdvisor->teacher->gender=='female')
                                            <img class="img-circle img-responsive" src="/img/team/female_icon.jpg" alt="">
                                            @endif
                                            
                                    </span>
                                    <h5 style="color: #fff">{{$approveAdvisor->teacher->fullname}}</h5>
                                    <p style="color: #fff">{{$approveAdvisor->teacher->post}}</p>
                                    <p style="color: #fff">{{$approveAdvisor->teacher->dept->code}}</p>
                                    <a href="{{route('approveAdvisor', $approveAdvisor->id)}}" class="btn btn-info">Approve</a>
                                    <a href="{{route('denyAdvisor', $approveAdvisor->id)}}" class="btn btn-danger" id="1" data-toggle="modal">Deny</a><br><br>
                                </div>

                            @endforeach 
                        </ul>                
                    @endif
                </div>
            </div>
            
        </div>

        <hr>
        
        <div class="organization-request">
            <div class="row">
                <div class="col-sm-3">
                    <h2 class="section-heading" style="color: #fff">Committe Member Requests</h2>
                    
                </div>

                <div class="col-sm-9">
                    @if(!empty($approveComs))
                        <ul class="list-inline social-buttons proctor-list">
                            @foreach($approveComs as $approveCom)
                                <div class="col-md-4 text-center">
                                    <span class="fa-stack fa-4x">
                                    @if($approveCom->student->gender=='male')
                                    <img class="img-circle img-responsive" src="/img/team/male_icon.jpg" alt="">
                                    @elseif($approveCom->student->gender=='female')
                                    <img class="img-circle img-responsive" src="/img/team/female_icon.jpg" alt="">
                                    @endif
                                    </span>
                                    <h5 style="color: #fff">{{$approveCom->designation}}</h5>
                                    <p style="color: #fff">{{$approveCom->student->fullname}}</p>
                                    <p style="color: #fff">{{$approveCom->student->reg_no}}</p>
                                    <p style="color: #fff">{{$approveCom->student->dept->code}}</p>
                                    <a href="{{route('approveOrgCom', $approveCom->id)}}" class="btn btn-info">Approve</a>
                                    <a href="{{route('denyOrgCom', $approveCom->id)}}" class="btn btn-danger" id="1" data-toggle="modal">Deny</a><br><br>
                                </div>    
                            @endforeach
                        </ul>              
                    @endif
                </div>
            </div>
        </div>
</section>
@endsection
