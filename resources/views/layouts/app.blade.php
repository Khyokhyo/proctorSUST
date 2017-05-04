<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Proctor SUST</title>

    <!-- Bootstrap Core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="/css/agency.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <img src="../img/logo.png" style="height:50px;">

                @if (Auth::guest())
                <a class="navbar-brand page-scroll" href="/">Proctor SUST</a>
                @else
                    @if (Auth::user()->user_type == 0)
                    <a class="navbar-brand page-scroll" href="/adminHome">Proctor SUST</a>
                    @elseif (Auth::user()->user_type == 1)
                    <a class="navbar-brand page-scroll" href="/orgHome">Proctor SUST</a>
                    @elseif (Auth::user()->user_type == 2)
                    <a class="navbar-brand page-scroll" href="/procHome">Proctor SUST</a>
                    @endif
                @endif
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                            <li><a class="page-scroll" href="office">Office</a></li>
                            <li><a class="page-scroll" href="policy">Policy</a></li>
                            <li><a class="page-scroll" href="notice">Notice</a></li>
                            <li><a class="page-scroll" href="login">Sign in</a></li>
                            <!--<li><a class="page-scroll" href="register">Register</a></li>-->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Sign up <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="page-scroll" href="registerProc">Proctor Committee Member</a></li>
                                    <li><a class="page-scroll" href="registerOrg">Organization</a></li>
                                </ul>
                            </li>
                        @else
                            @if (Auth::user()->user_type == 0)
                            <li><a class="page-scroll" href="adminProcList">List</a></li>
                            <li><a class="page-scroll" href="adminCommittee">Committee</a></li>
                            <li><a class="page-scroll" href="adminApproval">Approval</a></li>
                            <li><a class="page-scroll" href="adminPolicy">Policy</a></li>
                            @elseif (Auth::user()->user_type == 1)
                            <li><a class="page-scroll" href="orgNotice">Notice</a></li>
                            <li><a class="page-scroll" href="orgCommittee">Committee</a></li>
                            @elseif (Auth::user()->user_type == 2)
                            
                            <li><a class="page-scroll" href="/procOrganizations">Organizations</a></li>
                            <li><a class="page-scroll" href="/procApprovals">Requests</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Notice <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="page-scroll" href="/procNotice">Notices for you</a></li>
                                    <li><a class="page-scroll" href="/procByNotice">Notices by you</a></li>
                                </ul>
                            </li>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a id="editM" href="#EditPassModal" class="notice-link" id="1" data-toggle="modal">
                                            Change Password
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    @yield('content')

<!-- Edit Password Modal -->
<div class="modal fade" id="EditPassModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Change Your Password</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form class="form-horizontal" role="form" method="GET" action="{{ url('putEditPassword') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('current') ? ' has-error' : '' }}">
                    <label for="current" class="col-md-4 control-label">Current Password</label>

                    <div class="col-md-6">
                        <input id="current" type="password" class="form-control" name="current" required>

                        @if ($errors->has('current'))
                            <span class="help-block">
                                <strong>{{ $errors->first('current') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">New Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
      </div>
      
    </div>
  </div>
  <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; SUST Proctor Office</span>
                </div>
                <div class="col-md-4">
                
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="team">About Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

    <!-- Contact Form JavaScript -->
    <script src="/js/jqBootstrapValidation.js"></script>
    <script src="/js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="/js/agency.min.js"></script>

    <script type="text/javascript">

    $( document ).ready(function() {
        
        console.log();
        if({!! \Session::get('passEditStatus') !!}){
            $("#editM")[0].click();    
        }
        
    });

    </script>

    @if(\Session::get('passEditStatus') == true)
        <?php \Session::set('passEditStatus', false) ?>
    @endif

</body>

</html>
