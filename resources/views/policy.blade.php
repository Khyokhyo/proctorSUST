@extends('layouts.app')

@section('content')

<section id="about" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Proctorial Policies</h2>
                <h3 class="section-subheading">Policies can be changed by the Proctorial Body</h3>
            </div>
        </div>
        <?php $loopCounter=0;?>
        <div class="row">
            <div class="col-lg-12">
                <ul class="timeline">
                @foreach($policies as $policy)
                @if($loopCounter%2==0)
                    <li>
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="img/about/p.jpg" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h1>{{ $policy->number}}</h1>

                            </div>
                            <div class="timeline-body">
                                <p>{{$policy->content}}</p>
                            </div>
                        </div>
                    </li>
                @else
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="img/about/q.jpg" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h1>{{ $policy->number}}</h1>

                            </div>
                            <div class="timeline-body">
                                <p>{{$policy->content}}</p>
                            </div>
                        </div>
                    </li>
                @endif
                    <?php $loopCounter++; ?>
                @endforeach 
                    
                </ul>
            </div>
        </div>
    </div>
</section>
    
@endsection