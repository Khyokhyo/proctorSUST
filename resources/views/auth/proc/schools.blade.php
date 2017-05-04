@extends('layouts.app')

@section('content')
<!-- teachers -->
<section id="teacherList" class="bg-light-gray">
    <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">List of Schools</h2><br><br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                    <?php $flag=1; ?>
                        
                        @foreach($schools as $school)

                        <?php $flag++; ?>
                        @if($flag%2==0)
                        <li>
                        @else
                        <li class="timeline-inverted">
                        @endif
                                <div class="timeline-image">
                                    <ul class="list-inline social-buttons">
                                    <a href="{{route('departments', $school->id)}}" ><img class="img-circle img-responsive" src="/img/about/3.jpg" alt=""></a>
                                    </ul>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h3>{{$school->name}}</h3>

                                    </div>
                                    
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
</section>

@endsection