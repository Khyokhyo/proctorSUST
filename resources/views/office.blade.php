@extends('layouts.app')

@section('content')

<section id="office" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" style="color:#fff">Office of the Proctor</h2>
                <h3 class="section-subheading" style="color:#fff">Office of the Proctor comprises of the Proctorial Body</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <?php $j = 1000; ?>
        
                <ul class="list-inline social-buttons proctor-list">
                    @foreach($procs as $proc)

                    
                        <div class="team-member">
                            <?php $j++; ?> 

                            @if($proc->teacher->gender=='male')
                                <a href="#{{ $j }}" class="notice-link" data-toggle="modal"><img class="img-circle" src="img/team/male_icon.jpg" style="height:180px;" alt=""></a>
                            @elseif($proc->teacher->gender=='female')
                                <a href="#{{ $j }}" class="notice-link" data-toggle="modal"><img class="img-circle" src="img/team/female_icon.jpg" style="height:180px;" alt=""></a>
                            @endif
                            <h4 style="color:#fff">{{$proc->teacher->fullname}}</h4>
                            <p style="color:#fff">{{$proc->designation}}</p>
                            
                        </div>

                        <!--view proc Modal -->
                        <div class="modal fade" id="{{$j}}" role="dialog">
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
                                            <h4>{{$proc->teacher->fullname}}</h4>
                                            <h4>{{$proc->teacher->post}}</h4>
                                            <h4>Dept: {{$proc->teacher->dept->code}}</h4>
                                            <h4>Email: {{$proc->teacher->email}}</h4>
                                            <h4>Contact no: {{$proc->teacher->contact_no}}</h4>
                                        </div>
                                    </div><br>
                                </div>
                            </div>
                              
                        </div>
                    
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <?php $i = 2000; ?>
        
                <ul class="list-inline social-buttons proctor-list">
                    @foreach($assProcs as $assProc)

                    
                        <div class="team-member">
                            <?php $i++; ?> 

                            @if($assProc->teacher->gender=='male')
                                <a href="#{{ $i }}" class="notice-link" data-toggle="modal"><img class="img-circle" src="img/team/male_icon.jpg" style="height:180px;" alt=""></a>
                            @elseif($assProc->teacher->gender=='female')
                                <a href="#{{ $i }}" class="notice-link" data-toggle="modal"><img class="img-circle" src="img/team/female_icon.jpg" style="height:180px;" alt=""></a>
                            @endif
                            <h4 style="color:#fff">{{$assProc->teacher->fullname}}</h4>
                            <p style="color:#fff">{{$assProc->designation}}</p>
                            
                        </div>

                        <!--view assProc Modal -->
                        <div class="modal fade" id="{{$i}}" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header" style="padding:35px 50px;">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4><span class="glyphicon glyphicon-file"></span> Teacher Details</h4>
                                    </div>
                                    <div class="modal-body" style="padding:40px 50px;">
                                        <div class="team-member">
                                            @if($assProc->teacher->gender=='male')
                                            <img style="height:90px; width:90px;" src="img/team/male_icon.jpg" alt="">
                                            @elseif($assProc->teacher->gender=='female')
                                            <img style="height:90px; width:90px;" src="img/team/female_icon.jpg" alt="">
                                            @endif
                                            <h4>{{$assProc->teacher->fullname}}</h4>
                                            <h4>{{$assProc->teacher->post}}</h4>
                                            <h4>Dept: {{$assProc->teacher->dept->code}}</h4>
                                            <h4>Email: {{$assProc->teacher->email}}</h4>
                                            <h4>Contact no: {{$assProc->teacher->contact_no}}</h4>
                                        </div>
                                    </div><br>
                                </div>
                            </div>
                              
                        </div>
                    
                    @endforeach
                </ul>
            </div>
        </div> 

    </div>
</section>
    
@endsection