@extends('layouts.app')

@section('content')

<section id="notice-public" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">{{$notice->subject}}</h2><br><br><br>
            </div>
        </div>
        <div class="row">
            <div class="intro-text">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <div class="row">
                                    <div class="intro-text">
                                    <div class="team-member">
                                        
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection