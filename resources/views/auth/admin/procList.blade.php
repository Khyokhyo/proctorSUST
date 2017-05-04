@extends('layouts.app')

@section('content')

<section id="approval" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" style="color:#fff">Previous Committee Members</h2>
                <h3 class="section-subheading" style="color:#fff">List of the members of previous committees</h3>
            </div>
        </div>

        <div class="organization-account">
            <div class="row">
                <div class="col-sm-3">
                    <h2 class="section-heading" style="color: #fff">Proctors</h2>
                </div>
                <div class="col-sm-9">
                    @if(!empty($procs))

                    @foreach($procs as $proc)

                        <div class="col-md-2 col-sm-6">
                            <div class="team-member">

                                <ul class="list-inline social-buttons">

                                @if($proc->teacher->gender=='male')
                                <img class="img-circle img-responsive" src="img/team/male_icon.jpg" alt="">
                                @elseif($proc->teacher->gender=='female')
                                <img class="img-circle img-responsive" src="img/team/female_icon.jpg" alt="">
                                @endif
                                </ul>
                                <h5 style="color: #fff">{{$proc->teacher->fullname}}</h5>
                                <h6 style="color: #fff">{{$proc->start_date}}</h6>
                                <h6 style="color: #fff">to</h6>
                                <h6 style="color: #fff">{{$proc->end_date}}</h6>
                                
                            </div>
                        </div>
                    
                    @endforeach

                    @endif

                    <div class="col-sm-12">
                        <div class="text-center">
                            {!!$procs->links() !!}
                        </div>
                    </div>

                </div>
            </div>
            
        </div>

        <hr>
        
        <div class="organization-request">
            <div class="row">
                <div class="col-sm-3">
                    <h2 class="section-heading" style="color: #fff">Assistant Proctors</h2>
                    
                </div>

                <div class="col-sm-9">
                    @if(!empty($assProcs))

                    @foreach($assProcs as $assProc)

                    <div class="col-md-2 col-sm-6">
                        <div class="team-member">

                            <ul class="list-inline social-buttons">

                            @if($assProc->teacher->gender=='male')
                            <img class="img-circle img-responsive" src="img/team/male_icon.jpg" alt="">
                            @elseif($assProc->teacher->gender=='female')
                            <img class="img-circle img-responsive" src="img/team/female_icon.jpg" alt="">
                            @endif
                            </ul>
                            <h5 style="color: #fff">{{$assProc->teacher->fullname}}</h5>
                            <h6 style="color: #fff">{{$assProc->start_date}}</h6>
                            <h6 style="color: #fff">to</h6>
                            <h6 style="color: #fff">{{$assProc->end_date}}</h6>
                        </div>
                    </div>
                
                    @endforeach
                    @endif
                    <div class="col-sm-12">
                        <div class="text-center">
                            {!!$assProcs->links() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
