@extends('layouts.app')

@section('content')

<section id="office" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" style="color:#fff">Current Committee</h2>
                <h3 class="section-subheading" style="color:#fff">Current Committee comprises of the current Proctorial Body</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                @if(!empty($procs))
                <?php $i=1000; ?>
        
                <ul class="list-inline social-buttons proctor-list">
                    @foreach($procs as $proc)

                    
                        <div class="team-member">
                            <?php $i++; ?>

                            @if($proc->teacher->gender=='male')
                            <a href="#{{$i}}" class="notice-link" id="1" data-toggle="modal">
                            <img class="img-circle" style="height:180px;" src="img/team/male_icon.jpg" alt=""></a>
                            @elseif($proc->teacher->gender=='female')
                            <a href="#{{$i}}" class="notice-link" id="1" data-toggle="modal">
                            <img class="img-circle" style="height:180px;" src="img/team/female_icon.jpg" alt=""></a>
                            @endif
                            <h5 style="color:#fff">{{$proc->teacher->fullname}}</h5>
                            <h6 style="color:#fff">{{$proc->designation}}</h6>
                            
                            @if($proc->status==0)
                            <h6 style="color:#fff">Inactive</h6>
                            @elseif($proc->status==1)
                            <h6 style="color:#fff">Active</h6>
                            @elseif($proc->status==6)
                            <h6 style="color:#fff">Retired</h6>
                            @endif

                            @if(!empty($proc->start_date))
                            <h6 style="color:#fff">{{$proc->start_date}} to </h6>
                              @if(empty($proc->end_date))
                              <h6 style="color:#fff">present</h6>
                              @else
                              <h6 style="color:#fff">{{$proc->end_date}}</h6>
                              @endif
                            @endif
                            
                        </div>

                        <!--view proc Modal -->
                        <div class="modal fade" id="{{$i}}" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="padding:35px 50px;">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4><span class="glyphicon glyphicon-user"></span> Update Proctor</h4>
                                </div>
                                <div class="modal-body" style="padding:40px 50px;">
                                  <form class="form-horizontal" role="form" method="GET" id="adminApprovalForm" action="{{ url('putAdminCommittee') }}">
                                                {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                         <label for="start_date" class="col-md-4 control-label">Start Date</label>

                                        <div class="col-md-6">
                                             <input id="start_date" type="date" class="form-control" name="start_date" value="{{ $proc->start_date }}" required>

                                            @if ($errors->has('start_date'))
                                             <span class="help-block">
                                                 <strong>{{ $errors->first('start_date') }}</strong>
                                             </span>
                                            @endif
                                        </div>
                                     </div><br>
                                     <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                         <label for="end_date" class="col-md-4 control-label">End Date</label>

                                        <div class="col-md-6">
                                             <input id="end_date" type="date" class="form-control" name="end_date" value="{{ $proc->end_date }}" >

                                            @if ($errors->has('end_date'))
                                             <span class="help-block">
                                                 <strong>{{ $errors->first('end_date') }}</strong>
                                             </span>
                                            @endif
                                        </div>
                                        <div>
                                          <input id="proc_userId" type="hidden" class="form-control" name="proc_userId" value="{{ $proc->user_id }}" >
                                        </div>
                                     </div><br>
                                        <div class="form-group">
                                            <div class="col-md-12">
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
                    
                    @endforeach

                </ul>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                @if(!empty($assProcs))
                <?php $j=2000; ?>
        
                <ul class="list-inline social-buttons proctor-list">
                    @foreach($assProcs as $assProc)

                    
                        <div class="team-member">
                            <?php $j++; ?> 

                            @if($assProc->teacher->gender=='male')
                            <a href="#{{$j}}" class="notice-link" id="1" data-toggle="modal">
                            <img class="img-circle" style="height:180px;" src="img/team/male_icon.jpg" alt=""></a>
                            @elseif($assProc->teacher->gender=='female')
                            <a href="#{{$j}}" class="notice-link" id="1" data-toggle="modal">
                            <img class="img-circle" style="height:180px;" src="img/team/female_icon.jpg" alt=""></a>
                            @endif
                            <h5 style="color:#fff">{{$assProc->teacher->fullname}}</h5>
                            <h6 style="color:#fff">{{$assProc->designation}}</h6>
                            
                            @if($assProc->status==0)
                            <h6 style="color:#fff">Inactive</h6>
                            @elseif($assProc->status==1)
                            <h6 style="color:#fff">Active</h6>
                            @elseif($assProc->status==6)
                            <h6 style="color:#fff">Retired</h6>
                            @endif

                            @if(!empty($assProc->start_date))
                            <h6 style="color:#fff">{{$assProc->start_date}} to </h6>
                              @if(empty($assProc->end_date))
                              <h6 style="color:#fff">present</h6>
                              @else
                              <h6 style="color:#fff">{{$assProc->end_date}}</h6>
                              @endif
                            @endif
                            
                        </div>

                        <!--view assProc Modal -->
                        <div class="modal fade" id="{{$j}}" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="padding:35px 50px;">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4><span class="glyphicon glyphicon-user"></span> Update Assistant Proctor</h4>
                                </div>
                                <div class="modal-body" style="padding:40px 50px;">
                                  <form class="form-horizontal" role="form" method="GET" id="adminApprovalForm" action="{{ url('putAdminCommittee') }}">
                                                {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                         <label for="start_date" class="col-md-4 control-label">Start Date</label>

                                        <div class="col-md-6">
                                             <input id="start_date" type="date" class="form-control" name="start_date" value="{{ $assProc->start_date }}" required>

                                            @if ($errors->has('start_date'))
                                             <span class="help-block">
                                                 <strong>{{ $errors->first('start_date') }}</strong>
                                             </span>
                                            @endif
                                        </div>
                                     </div><br>
                                     <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                         <label for="end_date" class="col-md-4 control-label">End Date</label>

                                        <div class="col-md-6">
                                             <input id="end_date" type="date" class="form-control" name="end_date" value="{{ $assProc->end_date }}" >

                                            @if ($errors->has('end_date'))
                                             <span class="help-block">
                                                 <strong>{{ $errors->first('end_date') }}</strong>
                                             </span>
                                            @endif
                                        </div>
                                        <div>
                                          <input id="proc_userId" type="hidden" class="form-control" name="proc_userId" value="{{ $assProc->user_id }}" >
                                        </div>
                                     </div><br>
                                        <div class="form-group">
                                            <div class="col-md-12">
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
                    
                    @endforeach
                </ul>
                @endif
            </div>
        </div> 

    </div>
</section>
    
@endsection