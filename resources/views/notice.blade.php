@extends('layouts.app')

@section('content')

<section id="notice-public" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" style="color:#fff">Notices</h2>
                <h3 class="section-subheading" style="color:#fff">Public Notices of Proctor Office</h3>
            </div>
        </div>
        <div class="row">
            <?php $j = 1000; ?> 
            @foreach($notices as $notice)

            <div class="col-md-4 col-sm-6">
                <div class="notice-public-member">    
                    <div class="notice-public-caption">
                        <ul class="list-inline social-buttons">

                    @if(!empty($notice->attachment))
                    <div class="row">
                        <div class="col-md-2 col-md-offset-4">
                            <a href="/{{$notice->attachment->link}}" ><img src="img/portfolio/notice.gif" class="img-responsive" alt=""></a>
                        </div>
                        
                        <div class="col-md-2 col-md-offset-0">
                            <a href="/{{$notice->attachment->link}}" download="{{$notice->attachment->link}}"><img src="img/portfolio/download.png" class="img-responsive" alt=""></a>
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
                        <a href="#{{$j}}" class="notice-link" data-toggle="modal"><h4>{{$notice->subject}}</h4></a>
                        <p class="text-muted">{{$notice->dop}}</p>
                        <p class="text-muted" style="width: 350px;white-space: nowrap;text-align: center;overflow: hidden;text-overflow: ellipsis;">{{$notice->content}}</p>
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
                            <h3 style="color: #222">{{$notice->subject}}</h3>
                            <p style="color: #222">{{$notice->dop}}</p>
                            <p style="color: #222">{{$notice->content}}</p>
                            @if(!empty($notice->attachment))
                            <a href="/{{$notice->attachment->link}}"  class="btn btn-info btn-xs btn-archive"  style="margin-right: 3px;color: white; text-decoration:none;" >View attachment</a>
                            <a  class="btn btn-info btn-xs btn-archive"  style="margin-right: 3px;color: white; text-decoration:none;" href="/{{$notice->attachment->link}}" download="{{$notice->attachment->name}}">Download attachment</a>
                            
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
            {!!$notices->links() !!}
        </div>
        
    </div>
</section>
    
@endsection