<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sofra</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->

  <link rel="stylesheet" href="{{asset('adminlte/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
            @if (app()->getLocale() == 'ar')

            <link rel="stylesheet" href="{{ asset('dashboard/css/font-awesome-rtl.min.css') }}">

            <link rel="stylesheet" href="{{ asset('dashboard/css/AdminLTE-rtl.min.css') }}">

            <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">

            <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap-rtl.min.css') }}">

            <link rel="stylesheet" href="{{ asset('dashboard/css/rtl.css') }}">

            <style>

                body, h1, h2, h3, h4, h5, h6 {

                    font-family: 'Cairo', sans-serif !important;

                }

            </style>
  @else

<link rel="stylesheet" href="{{asset('adminlte/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  
        @endif
<link rel="stylesheet" href="{{asset('adminlte/css/skins/_all-skins.min.css')}}">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css" rel="stylesheet">


    

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
@guest
<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>ofra</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>S</b>ofra</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->

 
    </nav>
  </header>
  @endguest
              @auth
  <header class="main-header">
    <!-- Logo -->
    <a href="home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>ofra</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>S</b>ofra</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
                    <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">

              @lang('lang.languages')   

            </a>

            <div class="dropdown-menu">

              <ul style="list-style-type: none; margin:2px" class="text-center ">

              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

              <li style=" padding-bottom:10px" > 

                <a  rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                       {{ $properties['native'] }} 

               </a> 

             </li> 

            @endforeach

          </ul>

            </div>

          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{auth()->user()->name}} </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                <p>
                  {{auth()->user()->name}} - {{auth()->user()->roles()->pluck('name')->implode(' ') }}
                  <small>Member since Nov. 2017</small>
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
             
                <div class="pull-right">
                  <div >
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                </div>
              </li>
              
            </ul>
          </li>
         
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth()->user()->name}} </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li class="">
          <a href="/orders">
            <i class="fa fa-dashboard"></i> <span>@lang('lang.Orders')</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
      </li>

       <li class="">
          <a href="/offers">
            <i class="fa fa-dashboard"></i> <span>@lang('lang.Offers')</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            
          </a>

      </li>
      <li class="">
          <a href="/clients">
            <i class="fa fa-dashboard"></i> <span>@lang('lang.Clients')</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>
      </li>
      <li class="">
          <a href="/resturants">
            <i class="fa fa-dashboard"></i> <span>@lang('lang.Restaurant')</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
      </li>
        <li class="">
          <a href="/products">
            <i class="fa fa-message"></i> <span>@lang('lang.Products')</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
      </li>
      @role('admin')
      <li class="">
          <a href="/users">
            <i class="fa fa-message"></i> <span>@lang('lang.users')</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
      </li>
      <li class="">
          <a href="/roles">
            <i class="fa fa-message"></i> <span>@lang('lang.roles')</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
      </li>
      <li class="">
          <a href="/permissions">
            <i class="fa fa-message"></i> <span>@lang('lang.permissions')</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
      </li>
      @endrole
  </ul>
  
     
    </section>
    <!-- /.sidebar -->
  </aside>
@endauth
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">      
        <h1>  
             @yield('page_title')  
        </h1>
        <small> 
            @yield('small_title')
        </small>   
        <ol class="breadcrumb">

            <li class="active">
                  @yield('page_title') 
            </li>
        </ol>
    </section>
     @if(Session::has('flash_message'))
            <div class="container">      
                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
                </div>
            </div>
        @endif 

        <div class="row">
            <div class="col-md-8 col-md-offset-2">              
                @include ('errors.list') {{-- Including error file --}}
            </div>
        </div>

    @yield('content')
    
  </div>
  <!-- /.content-wrapper -->
<br>
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('adminlte/plugins/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src=" {{asset('adminlte/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('adminlte/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/plugins/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/js/demo.js')}}"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>