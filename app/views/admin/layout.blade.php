@extends('main')
	@section('title')
		ADMIN|HOME
	@stop
	
	@section('styles')
		{{HTML::style('//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all')}}
		{{ HTML::style('/assets/assest_admin/css/font-awesome.min.css') }}
		{{ HTML::style('/assets/assest_admin/css/simple-line-icons.min.css') }}
		{{ HTML::style('/assets/assest_admin/css/bootstrap.min.css') }}
		{{ HTML::style('/assets/assest_admin/css/uniform.default.css') }}
		{{ HTML::style('/assets/assest_admin/css/bootstrap-switch.min.css') }}
		{{ HTML::style('/assets/assest_admin/css/bootstrap-wysihtml5.css') }}
		{{ HTML::style('/assets/assest_admin/css/jquery.fancybox.css') }}
		{{ HTML::style('/assets/assest_admin/css/jquery.fileupload.css') }}
		{{ HTML::style('/assets/assest_admin/css/jquery.fileupload-ui.css') }}
		{{ HTML::style('/assets/assest_admin/css/blueimp-gallery.min.css') }}
		{{ HTML::style('/assets/assest_admin/css/inbox.css') }}
		{{ HTML::style('/assets/assest_admin/css/daterangepicker-bs3.css') }}
		{{ HTML::style('/assets/assest_admin/css/fullcalendar.min.css') }}
		{{ HTML::style('/assets/assest_admin/css/jqvmap.css') }}
		{{ HTML::style('/assets/assest_admin/css/tasks.css') }}
		{{ HTML::style('/assets/assest_admin/css/forestChange.css') }}
		{{ HTML::style('/assets/assest_admin/css/select2.css') }}
		{{ HTML::style('/assets/assest_admin/css/components.css') }}
		{{ HTML::style('/assets/assest_admin/css/plugins.css') }}
		{{ HTML::style('/assets/assest_admin/css/layout.css') }}
		{{ HTML::style('/assets/assest_admin/css/default.css') }}
		{{ HTML::style('/assets/assest_admin/css/custom.css') }}
		{{ HTML::style('/assets/assest_admin/css/dataTables.bootstrap.css') }}
	@stop		
	@section('content')
<body class="page-boxed page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-sidebar-closed-hide-logo">
<!------------------------------------------- Header start  ---------------------------->
	<div class="page-header navbar navbar-fixed-top">
		<!-- BEGIN HEADER INNER -->
		<div class="page-header-inner">
			<!-- BEGIN PAGE TOP -->
			
				<div class = " page-logo" >
					<a href="overview.php" style="width:100%;" >
						<img src="/assets/assest_admin/images/asm-logo.png" alt="logo" class="logo-default" style="width:100%!important; margin:0px; height: 68px">
					</a>
					
				</div>
					<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
					</a>
			
			<div class="page-top">
				<!-- BEGIN HEADER SEARCH BOX -->
			
				<!-- BEGIN TOP NAVIGATION MENU -->
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
						<!-- BEGIN NOTIFICATION DROPDOWN -->
						
						<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
						<li class="dropdown dropdown-user">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<img alt="" class="img-circle" src="/assets/assest_admin/img/User_Avatar-512.png"/>
								
							<span class="username username-hide-on-mobile loginTopColor">
								Account
							 </span>
							<i class="fa fa-angle-down loginTopColor"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-default loginTopColor">
								<li>
									<a href="{{URL::route('admin.profile')}}" class="loginTopColor">
									<i class="icon-user"></i> My Profile </a>
								</li>
								
								<li>
									<a href="{{URL::route('admin.auth.logout')}}" class="loginTopColor">
									<i class="icon-key"></i> Log Out </a>
								</li>
							</ul>
						</li>
						<!-- END USER LOGIN DROPDOWN -->
					</ul>
				</div>
				<!-- END TOP NAVIGATION MENU -->
			</div>
			<!-- END PAGE TOP -->
		</div>
		<!-- END HEADER INNER -->
	</div>
<!------------------------------------------- Header end  ---------------------------->
	<div class="clearfix"></div>
	<div class="page-container">
		<div class="page-sidebar-wrapper">
			<div class="page-sidebar navbar-collapse collapse">
				<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				   <?php if (!isset($pageNo)) { $pageNo = 0; } ?>
					<li class="start <?php if($pageNo == 1) {echo ' active';}?>">
						<a href="{{ URL::route('admin.dashboard') }}">
						<i class="fa fa-tachometer"></i>
						<span class="title">Dashboard</span>
						<span class="selected"></span>
						</a>
					</li>
					<li class="start <?php if($pageNo == 6) {echo ' active';}?>">
						<a href="{{ URL::route('admin.profession')}}">
						<i class="fa fa-pencil"></i>
						<span class="title">Proffessions Management</span>
						<span class="selected"></span>
						</a>
					</li>
					<li class="start <?php if($pageNo == 3) {echo ' active';}?>">
						<a href="{{ URL::route('admin.service') }}">
						<i class="icon-tag"></i>
						<span class="title">Service Management</span>
						<span class="selected"></span>
						</a>
					</li>
					<li class="start <?php if($pageNo == 12) {echo ' active';}?>">
						<a href="{{ URL::route('admin.image') }}">
						<i class="fa fa-image"></i>
						<span class="title">User Image Management</span>
						<span class="selected"></span>
						</a>
					</li>
					<li class="start <?php if($pageNo == 4) {echo ' active';}?>">
						<a href="{{ URL::route('admin.user') }}">
						<i class="fa fa-users"></i>
						<span class="title">User Management</span>
						<span class="selected"></span>
						</a>
					</li>
					<li class="start <?php if($pageNo == 10) {echo ' active';}?>">
						<a href="{{ URL::route('admin.cms') }}">
						<i class="fa  fa-laptop"></i>
						<span class="title">About Us Management</span>
						<span class="selected"></span>
						</a>
					</li>
					<li class="start <?php if($pageNo == 11) {echo ' active';}?>">
						<a href="{{ URL::route('admin.milestone') }}">
						<i class="fa fa-university"></i>
						<span class="title">About Us Milestone</span>
						<span class="selected"></span>
						</a>
					</li>
					<li class="start <?php if($pageNo == 7) {echo ' active';}?>">
						<a href="{{ URL::route('admin.client') }}">
						<i class="fa  fa-user"></i>
						<span class="title">What Our Clients Say</span>
						<span class="selected"></span>
						</a>
					</li>
					<li class="start <?php if($pageNo == 5) {echo ' active';}?>">
						<a href="{{ URL::route('admin.do') }}">
						<i class="fa fa-windows"></i>
						<span class="title">What We Do(Service)</span>
						<span class="selected"></span>
						</a>
					</li>
					
					<li class="start <?php if($pageNo == 8) {echo ' active';}?>">
						<a href="{{ URL::route('admin.faq') }}">
						<i class="fa  fa-th-list"></i>
						<span class="title">FAQ Management</span>
						<span class="selected"></span>
						</a>
					</li>
					<!--  <li class="start <?php if($pageNo == 2) {echo ' active';}?>">
						<a href="{{ URL::route('admin.contact') }}">
						<i class="fa  fa-comment"></i>
						<span class="title">View Contact</span>
						<span class="selected"></span>
						</a>
					</li>-->
					<li class="start <?php if($pageNo == 9) {echo ' active';}?>">
						<a href="{{ URL::route('admin.rate') }}">
						<i class="icon-folder"></i>
						<span class="title">Confirm Rate</span>
						<span class="selected"></span>
						</a>
					</li>
					<li class="start <?php if($pageNo == 15) {echo ' active';}?>">
						<a href="{{ URL::route('admin.anlaytics') }}">
						<i class="fa fa-keyboard-o"></i>
						<span class="title">Analytics</span>
						<span class="selected"></span>
						</a>
					</li>
					
					
				</ul>
			</div>
		</div>
		<div class = "page-content-wrapper">
			<div class="page-content">
				@yield('body')
			</div>
		</div>
	</div>
<!------------------------------------------- body start  ---------------------------->
	
</body>
	@stop
	@section ('scripts')
 		 {{ HTML::script('/assets/assest_admin/js/jquery.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/jquery-migrate.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/jquery-ui-1.10.3.custom.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/bootstrap-hover-dropdown.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/bootstrap.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/jquery.slimscroll.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/jquery.blockui.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/jquery.uniform.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/bootstrap-switch.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/jquery.pulsate.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/moment.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/daterangepicker.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/jquery.easypiechart.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/jquery.sparkline.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/jquery.validate.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/jquery.backstretch.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/select2.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/metronic.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/layout.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/layout2/layout.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/layout2/demo.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/index.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/tasks.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/jquery.dataTables.min.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/dataTables.bootstrap.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/professions.js') }}
 		 {{ HTML::script('/assets/assest_admin/js/bootbox.js') }}
 		  {{ HTML::script('/assets/assest_admin/js/tinymce/js/tinymce/tinymce.min.js') }}
	 		<script type="text/javascript">
		 		jQuery(document).ready(function() {    
				   Metronic.init(); // init metronic core componets
				   Layout.init(); // init layout
				   Demo.init(); // init demo features 
				});
		 	</script>
 	@stop
 	
@stop