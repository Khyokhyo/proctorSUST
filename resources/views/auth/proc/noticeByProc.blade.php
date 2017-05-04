@extends('layouts.app')

@section('content')

<section id="notice-public" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" style="color:#fff">Notices By You</h2><br><br><br>
            </div>
        </div>
        <div class="row col-lg-12">
            <a href="#addNoticeModal" class="page-scroll btn btn-xl" data-toggle="modal">Compose a new notice</a>
            
            @if($id->designation == "Proctor")
            <a href="approveNotice" class="page-scroll btn btn-xl">Approve notices</a>
            @endif
        </div>
        <div class="row">
            <?php $j = 1000; ?> 
            @foreach($upDeleteNotices as $upDeleteNotice)

            <div class="col-md-4 col-sm-6">
                <div class="notice-public-member">    
                    <div class="notice-public-caption">
                        <ul class="list-inline social-buttons">

                    @if(!empty($upDeleteNotice->attachment))
                    <div class="row">
                        <div class="col-md-2 col-md-offset-4">
                            <a href="/{{$upDeleteNotice->attachment->link}}" ><img src="img/portfolio/notice.gif" class="img-responsive" alt=""></a>
                        </div>
                        
                        <div class="col-md-2 col-md-offset-0">
                            <a href="/{{$upDeleteNotice->attachment->link}}" download="{{$upDeleteNotice->attachment->link}}"><img src="img/portfolio/download.png" class="img-responsive" alt=""></a>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-2 col-md-offset-4">
                            <img src="img/portfolio/blank.png" class="img-responsive" alt="">
                        </div>
                        
                        <div class="col-md-2 col-md-offset-0">
                            <img src="img/portfolio/blank.png" class="img-responsive" alt="">
                        </div>
                    </div>
                    @endif
                    
                    </ul>
                        <a href="#{{$j}}" class="notice-link" data-toggle="modal"><h4>{{$upDeleteNotice->subject}}</h4></a>
                        <p class="text-muted">{{$upDeleteNotice->dop}}</p>
                        <p class="text-muted" style="width: 350px;white-space: nowrap;text-align: center;overflow: hidden;text-overflow: ellipsis;">{{$upDeleteNotice->content}}</p>
                    </div>
                    
                </div>
            </div>

            <!--view notices Modal -->
            <div class="modal fade" id="{{$j}}" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                        <div class="modal-content">
                         <div class="modal-header" style="padding:35px 50px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4><span class="glyphicon glyphicon-file"></span> Notice Details</h4>
                         </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <div class="team-member">
                            <h3 style="color: #222">{{$upDeleteNotice->subject}}</h3>
                            <h5 style="color: #222">{{$upDeleteNotice->dop}}</h5>
                            <p style="color: #222">{{$upDeleteNotice->content}}</p>
                            @if(!empty($upDeleteNotice->attachment))
                            <a href="/{{$upDeleteNotice->attachment->link}}"  class="btn btn-info btn-xs btn-archive"  style="margin-right: 3px;color: white; text-decoration:none;" >View attachment</a>
                            <a  class="btn btn-info btn-xs btn-archive"  style="margin-right: 3px;color: white; text-decoration:none;" href="/{{$upDeleteNotice->attachment->link}}" download="{{$upDeleteNotice->attachment->name}}">Download attachment</a>
                            @endif
                        </div>
                    </div><br>
                    </div>
                    </div>
                      
                </div>
        <?php $j++; ?> 
        @endforeach
        </div>
        <div class="col-lg-12 text-center">
            {!!$upDeleteNotices->links() !!}
        </div>
    </div>
</section>

<!-- Add notice Modal -->
<div class="modal fade" id="addNoticeModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4><span class="glyphicon glyphicon-file"></span> Compose A New Notice</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
            <div class="row"  >
            {!!Form::open(array('route' => ['test'] , 'method' => 'POST', 'class' => 'form-horizontal', 'files' => true)) !!}
                <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                    <label for="subject" class="col-md-4 control-label">Subject</label>

                    <div class="col-md-6">
                        <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}" required>

                        @if ($errors->has('subject'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    <label for="category" class="col-md-4 control-label">Category</label>

                    <div class="col-md-6">
                        
                        <select id="category" type="text" class="form-control" name="category" value="{{ old('category') }}" required>
                            <option value="public">Public</option>
                            <option value="member">Proctor Committee Members</option>
                            <option value="org">Organizations</option>
                            <option value="custom">Customized</option>
                        </select>

                        @if ($errors->has('category'))
                            <span class="help-block">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                

                <div class="form-group{{ $errors->has('selected') ? ' has-error' : '' }}">
                    <label for="selected" class="col-md-4 control-label">Select Customized Recepients</label>
                    <div class="col-md-6">
                        <p>(For Customized Category Only)</p>
                        
                        Committee Members<br><br>
                        
                        <?php $i = 0; ?> 
                        @if(!empty($procs))
                        @foreach($procs as $proc)
                        <?php $i++; ?> 
                        <input id="proc{{ $i }}" type="checkbox" name="procs[]" value="{{ $proc->user_id }}"> 
                        {{ $proc->teacher->fullname }}
                        
                        @endforeach
                        @endif
                        
                        <br><br>Organizations<br><br>
                        
                        <?php $j = 50; ?> 
                        @if(!empty($orgs))
                        @foreach($orgs as $org)
                        <?php $j++; ?> 
                        <input id="org{{ $j }}" type="checkbox" name="orgs[]" value="{{ $org->user_id }}"> {{ $org->name }}
                        @endforeach
                        @endif

                        @if ($errors->has('selected'))
                            <span class="help-block">
                                <strong>{{ $errors->first('selected') }}</strong>
                            </span>
                        @endif

                    </div>
                </div>
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    <label for="content" class="col-md-4 control-label">Content</label>

                    <div class="col-md-6">
                        {!! Form::textarea('content', null, [
                        'class' => 'form-control', 
                        ]
                        )
                        !!}

                        @if ($errors->has('content'))
                            <span class="help-block">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('dop') ? ' has-error' : '' }}">
                    <label for="dop" class="col-md-4 control-label">Date of Publishing</label>

                    <div class="col-md-6">
                        <input id="dop" type="date" class="form-control" name="dop" value="{{Date('Y-m-d')}}" required>

                        @if ($errors->has('dop'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dop') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                    <label for="subject" class="col-md-4 control-label">Attach file</label>

                    <div class="col-md-6">
                        {!! Form::file('myfile') !!}

                        @if ($errors->has('subject'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            
            <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-info">
                            Post
                        </button>
                    </div>
                </div>
            <!-- </form> -->
            {!! Form::close() !!}
            </div>
        </div>
      </div>
      
    </div>
</div>
    
@endsection