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
                <h2 class="section-heading" style="color:#fff">Request Approval</h2>
                <h3 class="section-subheading" style="color:#fff">Approve or deny the requests of campus organizations</h3>
            </div>
        </div>

        <div class="organization-account">
            <div class="row">
                <div class="col-sm-3">
                    <h2 class="section-heading" style="color: #fff">New Organization Accounts</h2>
                </div>
                <div class="col-sm-9">
                    <?php $j=100; $k=1000; ?>
                    @if(!empty($orgs))
                        <ul class="list-inline social-buttons proctor-list">
                            @foreach($orgs as $org)
                            
                                <div class="team-member">

                                    <?php $j++; ?>
                                    <a href="#{{ $j }}" class="notice-link" id="1" data-toggle="modal">
                                        <img class="img-circle img-responsive" src="img/team/org_icon.png" alt="">
                                    </a>
                                
                                    <h3 style="color: #fff">{{$org->name}}</h3>
                                </div>

                                <div class="modal fade" id="{{$j}}" role="dialog">
                                    <div class="modal-dialog">
                                    
                                      <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header" style="padding:35px 50px;">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4><span class="glyphicon glyphicon-list"></span> Organization Details</h4>
                                            </div>
                                            <div class="modal-body" style="padding:40px 50px;">
                                                <div class="organization-member">
                                                <img style="height:90px; width:90px;" src="img/team/org_icon.png" alt="">
                                                    <h1 style="color: #222">{{$org->name}}</h1>
                                                    <h4 style="color: #222">Type</h4>
                                                    <h5 style="color: #222">{{$org->type}}</h5>
                                                    <h4 style="color: #222">Motto</h4>
                                                    <h5 style="color: #222">{{$org->motto}}</h5>
                                                    <h4 style="color: #222">Status</h4>
                                                    @if($org->status==0)
                                                    <h5 style="color: #222">Inactive</h5>
                                                    @endif
                                                    
                                                    <h4 style="color: #222">Date of Formation</h4>
                                                    <h5 style="color: #222">{{$org->formation_date}}</h5><br>
                                                    <a href="{{route('approveOrg', $org->id)}}" class="btn btn-success" role="button">Approve</a>
                                                    <a href="{{route('denyOrg', $org->id)}}" class="btn btn-danger" role="button">Deny </a>
                                                </div>
                                            </div><br>
                                        </div>
                                    </div>
                                      
                                </div>

                            @endforeach 
                        </ul>                
                    @endif
                </div>
            </div>
            <!-- org details modal -->
            
        </div>

        <hr>
        
        <div class="organization-request">
            <div class="row">
                <div class="col-sm-3">
                    <h2 class="section-heading" style="color: #fff">Organization Committee</h2>
                    
                </div>

                <div class="col-sm-9">
                    @if(!empty($changeRequests))
                        <ul class="list-inline social-buttons proctor-list">
                            @foreach($changeRequests as $changeRequest)
                                <div class="team-member">
                                    <a href="{{route('approveAll', $changeRequest->org_id)}}">
                                        <img class="img-circle img-responsive" src="img/team/org_icon.png" alt="">
                                    </a>
                                    <h3 style="color: #fff">{{$changeRequest->organization->name}}</h3>
                                 </div>
                            @endforeach
                        </ul>              
                    @endif
                </div>
            </div>
        </div>
</section>
@endsection
