@extends('layouts.app')

@section('content')

<section id="adminCommittee" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Change Requests</h2>
                
            </div>
        </div>
        <div class="row">
            @if(!empty($advisors))

            @foreach($advisors as $advisor)
            <div class="col-md-4 text-center">
                <span class="fa-stack fa-4x">
                    
                        <img class="img-circle img-responsive" src="img/about/1.jpg" alt="">
                </span>
                <h4 class="service-heading">{{$advisor->number}}</h4>
                <h5>{{$advisor->content}}</h5>
                <a href="#{{ $k }}" class="btn btn-info" id="1" data-toggle="modal">Approve</a>
                <a href="#{{ $j }}" class="btn btn-danger" id="1" data-toggle="modal">Deny</a>
                <br><br>
            </div>


            @endforeach
            @endif
            
        </div> 
        <div class="row">
            @if(!empty($committee))
            <?php $k = 10; $j = 1000; ?> 
            @foreach($committee as $com)
            <div class="col-md-4 text-center">
                <span class="fa-stack fa-4x">
                    
                        <img class="img-circle img-responsive" src="img/about/1.jpg" alt="">
                </span>
                <h4 class="service-heading">{{$com->number}}</h4>
                <h5>{{$com->content}}</h5>
                <a href="#{{ $k }}" class="btn btn-info" id="1" data-toggle="modal">Approve</a>
                <a href="#{{ $j }}" class="btn btn-danger" id="1" data-toggle="modal">Deny</a>
                <br><br>
            </div>


            @endforeach
            @endif
            
        </div>
    </div>

</section>

    
@endsection