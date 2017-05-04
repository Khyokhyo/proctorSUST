@extends('layouts.app')

@section('content')

<section id="office" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" style="color:#fff">Approve Committee Members</h2>
                <h3 class="section-subheading" style="color:#fff">Approve or deny new accounts of committee members</h3>
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

                            @if(!empty($proc->start_date))
                            <h6 style="color:#fff">Active from</h6>
                            <h6 style="color:#fff">{{$proc->start_date}}</h6>
                              
                              @if(!empty($proc->end_date))
                              <h6 style="color:#fff">to</h6>
                              <h6 style="color:#fff">{{$proc->end_date}}</h6>
                              @endif

                            @elseif($proc->status==0)
                            <h6 style="color:#fff">Inactive</h6>
                            @elseif($proc->status==1)
                            <h6 style="color:#fff">Active</h6>
                            @elseif($proc->status==6)
                            <h6 style="color:#fff">Retired</h6>
                            @endif
                            
                        </div>

                        <!--view proc Modal -->
                        <div class="modal fade" id="{{$i}}" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="padding:35px 50px;">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4><span class="glyphicon glyphicon-user"></span> Approve Committee Members</h4>
                                </div>
                                <div class="modal-body" style="padding:40px 50px;">
                                  <form class="form-horizontal" role="form" method="GET" id="adminApprovalForm" action="{{ url('putAdminApproval') }}">
                                                {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                         <label for="start_date" class="col-md-4 control-label">Start Date</label>

                                        <div class="col-md-6">
                                             <input id="start_date" type="date" class="form-control" name="start_date" value="{{ date('Y-m-d') }}" required>

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
                                            <div class="col-md-8 col-md-offset-4">
                                                <button type="submit" class="btn btn-success">
                                                     Approve
                                                </button>
                                                <a  href="{{route('deleteAdminApproval', $proc->id)}}"  class="btn btn-danger" role="button">Deny</a>
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