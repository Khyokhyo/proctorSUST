@extends('layouts.app')

@section('content')
<!-- organizations -->
<section id="office" class="bg-light-gray" style="background-image: url(../img/kiloroad.jpg);
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
                <h2 class="section-heading" style="color:#fff">Campus Organizations</h2>
                <h3 class="section-subheading" style="color:#fff">You can block or unblock any organization</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <?php $j = 2000; $b= 4000;  ?> 

            
        
                <ul class="list-inline social-buttons proctor-list">
                    @if(!empty($orgs))
                    @foreach($orgs as $org)

                    
                        <div class="team-member">
                            <?php $j++; $b++; ?> 
                        
                            <a href="#{{ $j }}" class="notice-link" data-toggle="modal"><img class="img-circle img-responsive" src="img/team/org_icon.png" alt=""></a>
                            <h3 style="color: #fff">{{$org->name}}</h3>
                        </div>

                        <!--view org Modal -->
                        <div class="modal fade" id="{{$j}}" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header" style="padding:35px 50px;">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4><span class="glyphicon glyphicon-list"></span> Organization details</h4>
                                    </div>
                                    <div class="modal-body" style="padding:40px 50px;">
                                        <div class="team-member">
                                        <img style="height:90px; width:90px;" src="img/team/org_icon.png" alt="">
                                            <h1 style="color: #222">{{$org->name}}</h1>
                                            <h4 style="color: #222">Type</h4>
                                            <h5 style="color: #222">{{$org->type}}</h5>
                                            <h4 style="color: #222">Motto</h4>
                                            <h5 style="color: #222">{{$org->motto}}</h5>
                                            <h4 style="color: #222">Status</h4>
                                            @if($org->status==1)
                                            <h5 style="color: #222">Active</h5>
                                            @endif
                                            
                                            <h4 style="color: #222">Date of Formation</h4>
                                            <h5 style="color: #222">{{$org->formation_date}}</h5><br>
                                            @if($org->status==1)
                                            <a href="{{route('blockOrg', $org->id)}}" class="btn btn-danger"><span class="glyphicon glyphicon-ban-circle"></span> Block Organization</a>
                                            @elseif($org->status==2)
                                            <a href="{{route('unblockOrg', $org->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-ok-circle"></span> Unblock Organization</a>
                                            @endif
                                        </div>
                                    </div><br>
                                </div>
                            </div>
                              
                        </div>
                    
                    @endforeach
                    @endif
                    
                </ul>
            </div>
        </div> 
    </div>
</section>

@endsection