@extends('layouts.app')

@section('content')

<section id="approval" class="bg-light-gray">
    <div class="container">
        <div class="organization-account">
            <div class="row">
                <div class="col-sm-3">
                    <h2 class="section-heading" style="color: #fff">Committee Advisors</h2>
                </div>
                <div class="col-sm-9">
                    <?php $j = 2000; ?> 

                    @foreach($advisors as $advisor)

                        <div class="col-md-2 col-sm-6">
                            <div class="team-member">

                                <ul class="list-inline social-buttons">

                                <?php $j++; ?> 
                                @if($advisor->teacher->gender=='male')
                                <a href="#{{ $j }}" class="notice-link" data-toggle="modal"><img class="img-circle img-responsive" src="img/team/male_icon.jpg" alt=""></a>
                                @elseif($advisor->teacher->gender=='female')
                                <a href="#{{ $j }}" class="notice-link" data-toggle="modal"><img class="img-circle img-responsive" src="img/team/female_icon.jpg" alt=""></a>
                                @endif
                                </ul>
                                <h4 style="color:#fff">{{$advisor->teacher->fullname}}</h4>
                                
                            </div>
                        </div>

                        
                         <div class="modal fade" id="{{$j}}" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header" style="padding:35px 50px;">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4><span class="glyphicon glyphicon-user"></span>  {{$advisor->teacher->fullname}}</h4>
                                    </div>
                                    <div class="modal-body" style="padding:40px 50px;">
                                        <div class="team-member">
                                        <div class="col-md-4">
                                            @if($advisor->teacher->gender=='male')
                                            <img class="img-circle img-responsive" src="img/team/male_icon.jpg" alt="">
                                            @elseif($advisor->teacher->gender=='female')
                                            <img class="img-circle img-responsive" src="img/team/female_icon.jpg" alt="">
                                            @endif
                                        </div>
                                            <h5>{{$advisor->teacher->post}}</h5>
                                            <h5>Dept: {{$advisor->teacher->dept->code}}</h5>
                                            <h5>Email: {{$advisor->teacher->email}}</h5>
                                            <h5>Contact no: {{$advisor->teacher->contact_no}}</h5><br>
                                            <div class="col-md-4 col-md-offset-6">
                                            <a href="{{route('removeAdvisor', $advisor->id)}}" class="btn btn-danger"><i class="fa fa-times"></i><span> </span>Remove Advisor</a>
                                        </div>
                                        
                                        </div>
                                    </div><br>
                                </div>
                            </div>
                              
                        </div>
                    
                    @endforeach
                    <div class="col-sm-12">
                        <div class="text-center">
                            <a href="#AddAdvisorModal" class="page-scroll btn btn-xl" data-toggle="modal">Add Advisor</a>
                        </div>
                    </div>

                </div>
            </div>
            
            <!-- Add Advisor Modal -->
            <div class="modal fade" id="AddAdvisorModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4><span class="glyphicon glyphicon-user"></span> Add Advisor</h4>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('addAdvisor') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('reg_no') ? ' has-error' : '' }}">
                            <label for="reg_no" class="col-md-4 control-label">Teacher Name</label>

                            <div class="col-md-6">
                                <select id="teacher_name" type="text" class="form-control" name="teacher_name" value="{{ old('teacher_name') }}" required>
                                
                                    @foreach($teachers as $teacher)
                                    <option value="{{$teacher->fullname}}">{{$teacher->fullname}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('teacher_name'))
                                    <span class="help-buser">
                                        <strong>{{ $errors->first('teacher_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br>

                        

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                        <br>
                    </form>

                    </div>
                  </div>
                  
                </div>
            </div>
            
        </div>

        <hr>
        
        <div class="organization-request">
            <div class="row">
                <div class="col-sm-3">
                    <h2 class="section-heading" style="color: #fff">Committee Members</h2>
                    
                </div>

                <div class="col-sm-9">
                    <?php $k=4000; ?>
                    @foreach($orgComs as $orgCom)

                    <div class="col-md-2 col-sm-6">
                        <div class="team-member">

                            <ul class="list-inline social-buttons">

                            <?php $k++; ?> 
                            @if($orgCom->student->gender=='male')
                            <a href="#{{ $k }}" class="notice-link" data-toggle="modal"><img class="img-circle img-responsive" src="img/team/male_icon.jpg" alt=""></a>
                            @elseif($orgCom->student->gender=='female')
                            <a href="#{{ $k }}" class="notice-link" data-toggle="modal"><img class="img-circle img-responsive" src="img/team/female_icon.jpg" alt=""></a>
                            @endif
                            </ul>
                            <h4 style="color:#fff">{{$orgCom->student->fullname}}</h4>
                            <p style="color:#fff">{{$orgCom->designation}}</p>
                            
                        </div>
                    </div>


                    <div class="modal fade" id="{{$k}}" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header" style="padding:35px 50px;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4><span class="glyphicon glyphicon-user"></span>  {{$orgCom->student->fullname}}</h4>
                                </div>
                                <div class="modal-body" style="padding:40px 50px;">
                                    <div class="team-member">
                                    <div class="col-md-4">
                                        @if($orgCom->student->gender=='male')
                                        <img class="img-circle img-responsive" src="img/team/male_icon.jpg" alt="">
                                        @elseif($orgCom->student->gender=='female')
                                        <img class="img-circle img-responsive" src="img/team/female_icon.jpg" alt="">
                                        @endif
                                    </div>

                                        <h5>Dept: {{$orgCom->student->dept->code}}</h5>
                                        <h5>Session: {{$orgCom->student->session}}</h5>
                                        <h5>Registration no: {{$orgCom->student->reg_no}}</h5>
                                        <h5>Email: {{$orgCom->student->email}}</h5>
                                        <h5>Contact no: {{$orgCom->student->contact_no}}</h5><br>
                                        <div class="col-md-4 col-md-offset-6">
                                        <a href="{{route('removeMember', $orgCom->id)}}" class="btn btn-danger"><i class="fa fa-times"></i><span> </span>Remove Member</a>
                                    </div>
                                    
                                    </div>
                                </div><br>
                            </div>
                        </div>
                          
                    </div>
                
                @endforeach
                    <div class="col-sm-12">
                        <div class="text-center">
                            <a href="#AddOrgComModal" class="page-scroll btn btn-xl" data-toggle="modal">Add New Member</a>
                        </div>
                    </div>

                </div>
            </div>
            
            <!-- Add Org Com Modal -->
            <div class="modal fade" id="AddOrgComModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4><span class="glyphicon glyphicon-user"></span> Add Committee Member</h4>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">

                          <form class="form-horizontal" role="form" method="POST" action="{{ url('addOrgCom') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('reg_no') ? ' has-error' : '' }}">
                                        <label for="reg_no" class="col-md-4 control-label">Registration Number</label>

                                        <div class="col-md-6">
                                            <input id="reg_no" type="text" class="form-control" name="reg_no" value="{{ old('reg_no') }}" required>

                                            @if ($errors->has('reg_no'))
                                                <span class="help-buser">
                                                    <strong>{{ $errors->first('reg_no') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div><br>

                                    <div class="form-group{{ $errors->has('designation') ? ' has-error' : '' }}">
                                        <label for="designation" class="col-md-4 control-label">Designation</label>

                                        <div class="col-md-6">
                                            <input id="designation" type="text" class="form-control" name="designation" value="{{ old('designation') }}" required>

                                            @if ($errors->has('designation'))
                                                <span class="help-buser">
                                                    <strong>{{ $errors->first('designation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div><br>

                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                    <br>
                                </form>

                    </div>
                  </div>
                  
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
