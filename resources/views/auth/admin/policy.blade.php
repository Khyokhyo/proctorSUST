@extends('layouts.app')

@section('content')

<section id="universalPolicy" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Proctorial Policies</h2>
                <h3 class="section-subheading">Policies can be changed by the Proctorial Committee.</h3>
            </div>
        </div>
        <div class="row">
            @if(!empty($policies))
            <?php $k = 10; $j = 1000; ?> 
            @foreach($policies as $policy)
            <div class="col-md-4 text-center">
                <span class="fa-stack fa-4x">
                    <?php $k++; $j++;?>
                        <img class="img-circle img-responsive" src="img/about/1.jpg" alt="">
                </span>
                <h4 class="service-heading">{{$policy->number}}</h4>
                <h5>{{$policy->content}}</h5>
                <a href="#{{ $k }}" class="btn btn-info" id="1" data-toggle="modal">Update</a>
                <a href="#{{ $j }}" class="btn btn-danger" id="1" data-toggle="modal">Delete</a>
                <br><br>
            </div>

            <!-- Update policy Modal -->
            <div class="modal fade" id="{{$k}}" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 style="color:#222"><span class="glyphicon glyphicon-edit"></span> Update Policy</h4>
                        </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <form class="form-horizontal" role="form" method="GET" id="policyUpdateForm" action="{{ url('putAdminPolicy') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                <label for="code" class="col-md-4 control-label" style="color:#222">Number</label>

                                <div class="col-md-6">
                                    <input id="code" type="number" class="form-control" name="code" value="{{$policy->number}}" required>

                                    @if ($errors->has('code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><br>

                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="content" class="col-md-4 control-label" style="color:#222">Content</label>

                                <div class="col-md-6">
                                    {!! Form::textarea('content', $policy->content, [
                                    'class' => 'form-control']
                                       )
                                    !!}

                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><br>

                            <div>
                                <input id="policy_id" type="hidden" class="form-control" name="policy_id" value="{{ $policy->id }}" >
                            </div>
                          
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

            <!-- Delete policy Modal -->
            <div class="modal fade" id="{{ $j }}" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 style="color:#222"><span class="glyphicon glyphicon-trash"></span> Delete Policy</h4>
                        </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <form class="form-horizontal" role="form" method="GET" id="policyUpdateForm" action="{{ url('putAdminPolicy') }}">
                            {{ csrf_field() }}
                            <h5 style="color:#222">Are you sure to delete this policy?</h5><br>
                          
                            <div class="form-group">
                                <div class="col-md-12">
                                    <a  href="{{route('deleteAdminPolicy', $policy->id)}}"  class="btn btn-success" role="button">Yes</a>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>
                  </div>
                  
                </div>
            </div>

            @endforeach
            @endif
            <br>

            
            
        </div> 
        <div class="row">
            {!!$policies->links() !!}
        </div>
    </div>
    
    <div class="row text-center">
        <br><br><br><br><br><br><a href="#addPolicyModal" class="page-scroll btn btn-xl" data-toggle="modal">Add a new policy</a>
    </div>

</section>

<!-- Add policy Modal -->
<div class="modal fade" id="addPolicyModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4><span class="glyphicon glyphicon-file"></span> Add a new policy</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
            <form class="form-horizontal" role="form" method="POST" id="policyUpdateForm" action="{{ url('addAdminPolicy') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                    <label for="code" class="col-md-4 control-label">Number</label>

                    <div class="col-md-6">
                        <input id="code" type="number" class="form-control" name="code" value="" required>

                        @if ($errors->has('code'))
                            <span class="help-block">
                                <strong>{{ $errors->first('code') }}</strong>
                            </span>
                        @endif
                    </div>
                </div><br>

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
                </div><br>
              
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-info">
                            Add Policy
                        </button>
                    </div>
                </div>
                <br>
            </form>
        </div>
      </div>
      
    </div>
</div>
    
@endsection