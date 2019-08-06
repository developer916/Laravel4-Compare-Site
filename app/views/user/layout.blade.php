@extends('main')	
	@section('title')
		Compare Jersey - Promoting Local Services
	@stop
	
	@section('styles')
		
		{{ HTML::style('/assets/assest_view/dist/css/bootstrap.css') }}
		{{ HTML::style('/assets/assest_view/dist/css/bootstrap.min.css') }}
		{{ HTML::style('/assets/assest_view/css/default.css') }}
		{{ HTML::style('/assets/assest_view/css/blue.css') }}
		{{ HTML::style('/assets/assest_view/css/animations.css') }}
		{{ HTML::style('/assets/assest_view/css/prettyPhoto.css') }}
		{{ HTML::style('/assets/assest_view/css/fraction/fractionslider.css') }}
		{{ HTML::style('/assets/assest_view/font-awesome/css/font-awesome.css') }}
		{{HTML::style('//fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700itali')}}
		{{HTML::style('//fonts.googleapis.com/css?family=Oxygen:400,700,300')}}
		<noscript>
			{{ HTML::style('/assets/assest_view/css/nojs.css') }}
		</noscript>
		{{ HTML::style('/assets/assest_view/css/jquery.fancybox.css') }}
		{{ HTML::style('/assets/assest_view/css/forestchange.css') }}
		{{ HTML::style('/assets/assest_view/css/forestresponsive.css') }}
		{{ HTML::style('/assets/assest_view/css/typeahead.css') }}
	@stop
	@section('content')
		 <body>
		 	<div class="container bg-white">
		 	 	<div class="row header">
		 	 		<div class="col-lg-9 col-md-7 col-sm-5 col-xs-12 logo flippy">
		                <ul>
		                    <li>
		                        <a href="{{URL::route('user.home')}}">
		                            <span class="logo-image-text"><img src="/assets/assest_view/images/Compare-Jersey.png"  style="width:100%; height:63px"></span>
		                        </a>
		                    </li>
		                </ul>       
		           </div>
		           <div class="col-lg-3 col-md-5 col-sm-7 col-xs-12">
		                <div class="login flippy">
		                  <ul>
		                   <?php if (Session::has('user_id')) {?>
		                   	<li><a href="{{URL::route('user.auth.doLogout')}}"><span class="glyphicon glyphicon-lock flippy-object"></span>Log out</a></li> | 
							<li><a href="https://www.sitelock.com/verify.php?site=compare.je" ><img alt="website security" title="SiteLock" src="//shield.sitelock.com/shield/compare.je" style="width:60px;" target="_blank"/></a></li>
		                   <?php }else{?>
		                    <li><a data-toggle="modal" href="#loginModal"><span class="glyphicon glyphicon-user flippy-object"></span>Sign in</a></li> | 
		                    <li <?php if($pageNo == 6) {?> class="active" <?php } ?>><a href="{{URL::route('user.auth.register')}}"><span class="glyphicon glyphicon-lock flippy-object"></span>Register now!</a></li> | 
							<li><a href="https://www.sitelock.com/verify.php?site=compare.je" ><img alt="website security" title="SiteLock" src="//shield.sitelock.com/shield/compare.je" style="width:60px;" target="_blank"/></a></li>
		                   <?php }?>
		                  </ul>
		                </div>
		                
		                <form class="navbar-form" role="search"  method="post" action="{{URL::route('user.store.search_result')}}" id="addSearchResultForm">
			                <div class="input-group">
			                    <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
			                    <div class="input-group-btn">
			                        <button class="btn btn-flippy" type="submit"><span class="fa fa-search"></span></button>
			                    </div>
			                </div>
		                </form>
		            </div>
		 	 	</div>	
		 	</div>
	 	    <div class="container-fluid bg-blue">
		    	<div class="container">
		            <div class="row">
		                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                
		                      <nav class="navbar navbar-default" role="navigation">
		                      <!-- Brand and toggle get grouped for better mobile display -->
		                      <div class="navbar-header">
		                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		                          <span class="sr-only">Toggle navigation</span>
		                          <span class="icon-bar"></span>
		                          <span class="icon-bar"></span>
		                          <span class="icon-bar"></span>
		                        </button>
		                        	<?php if(!isset($pageNo)){ $pageNo = 0; } ?>
		                            <ul class="nav navbar-nav flippy">
		                                <li <?php if($pageNo == 0) {?> class="active" <?php } ?>><a href="{{URL::route('user.home')}}"><span class="glyphicon glyphicon-home flippy-object"></span>Home</a></li>
		                            </ul>
		                      </div>
		                    
		                      <!-- Collect the nav links, forms, and other content for toggling -->
		                      <div class="collapse navbar-collapse navbar-ex1-collapse">
		                        <ul class="nav navbar-nav flippy">
		                       	   <li <?php if($pageNo == 1) {?> class="active" <?php } ?>> <a href="{{URL::route('user.auth.about')}}"><span class="glyphicon glyphicon-bookmark flippy-object"></span>About</a></li>
		                           <li <?php if($pageNo == 2) {?> class="active" <?php } ?>><a href="{{URL::route('user.auth.service')}}"><span class="glyphicon glyphicon-ok-sign flippy-object"></span>Services</a></li>
		                           <li <?php if($pageNo == 3) {?> class="active" <?php } ?>><a href="{{URL::route('user.auth.specialoffer')}}"><span class="glyphicon glyphicon-briefcase flippy-object"></span>Special Offers</a></li>
		                           <li <?php if($pageNo == 4) {?> class="active" <?php } ?>><a href="{{URL::route('user.auth.faqs')}}"><span class="glyphicon glyphicon-edit flippy-object"></span>FAQS</a></li>
		                           <li <?php if($pageNo == 5) {?> class="active" <?php } ?>><a href="{{URL::route('user.auth.contact')}}"><span class="glyphicon glyphicon-earphone flippy-object"></span>Contact</a></li>
		                           <?php if (Session::has('user_id')) {?>                          
		                           <li <?php if($pageNo == 9) {?> class="active" <?php } ?>><a href="{{URL::route('user.company')}}"><span class="glyphicon glyphicon-user flippy-object"></span>Company Profile</a></li>
		                           <?php }?>
		                        </ul>
		                      </div><!-- /.navbar-collapse -->
		                    </nav>
		                </div>
		            </div>
		        </div>
		    </div>
		    	
		  	  @yield('body')
		  	<!-- footer 1 -->
		  	<?php 
		  	$countProfessionList = count($professionlist);
		  	if(isset($professionlist) && $countProfessionList>0){
					  		
				if($countProfessionList<=3){
					$pagiNation =1;
				}else{
					$listnumber= $countProfessionList%3;
			  		$pagiNation = ($countProfessionList-$listnumber)/3;
			  		if(($countProfessionList%3)>0){
			  			$pagiNation = $pagiNation+1;
			  		}
		  		}
		  			?>
		  	<div class="container-fluid bg-light-grey">
		    	<div class="container">
		            <div class="row padding-top">
		            	
		            	<div class="col-lg-9 col-md-9">
		            	<?php if(isset($professionlist)){?>
			            	<div class="flippy footer-titles">
			                      <ul>
			                       	 <li class="colorblack" style="padding:10px;"><span class="glyphicon glyphicon-comment flippy-object colorblack"></span> Available Professions</li>
			                      </ul>  
		                    </div> 
		                   <?php if($pagiNation >0 &&  ($countProfessionList>=1) ){ ?>
		                  <div class="col-lg-4 col-md-4">
		                  	<div class="check-list">
			                  	 <ul>
			                  	 	<?php for($i=0; $i<$pagiNation; $i++){?>
				                  	 	<li><a href="{{ URL::route('user.store.professions' , $professionlist[$i]->id) }}"> <?php echo $professionlist[$i]->ProfessionName;?></a></li>
			                  	 	<?php }?>
			                  	 </ul>
		                  	 </div>
		                  </div>
		                  <?php } 
		                  if($pagiNation >0 &&  ($countProfessionList>=2) ){                 
		                  ?>
		                  <div class="col-lg-4 col-md-4">
		                  	<div class="check-list">
			                  	 <ul>
			                  	 	<?php for($i=$pagiNation; $i<$pagiNation*2; $i++){?>
				                  	 	<li><a href="{{ URL::route('user.store.professions' , $professionlist[$i]->id) }}"> <?php echo $professionlist[$i]->ProfessionName;?></a></li>
			                  	 	<?php }?>
			                  	 </ul>
		                  	 </div>
		                  </div>
		                  <?php }
		                  if($pagiNation >0 &&  ($countProfessionList>=3) ){
		                  ?>
		                  <div class="col-lg-4 col-md-4">
		                  	<div class="check-list">
			                  	 <ul>
			                  	 	<?php for($i=$pagiNation*2; $i<$countProfessionList; $i++){?>
				                  	 	<li><a href="{{ URL::route('user.store.professions' , $professionlist[$i]->id) }}"> <?php echo $professionlist[$i]->ProfessionName;?></a></li>
			                  	 	<?php }?>
			                  	 </ul>
		                  	 </div>
		                  </div>
		                   <?php }?>
		                    <?php }?>
	                  </div>
	                
	                  <!-- Social Button start-->
	                 <div class="col-lg-3 bottom-20">
	               		<div class="flippy footer-titles">
	                      <ul>
	                        <li class="colorblack"><span class="glyphicon glyphicon-thumbs-up flippy-object colorblack"></span>Socialize</li>
	                      </ul>  
	                    </div>
	                    <div class="footer-icons bottom-20">
	                     	<ul>
		                    	 <li><a title="" data-toggle="tooltip" href="https://www.facebook.com/CompareJersey" data-original-title="Facebook" target="_blank"><span class="fa fa-facebook"></span></a></li>
	                        	 <li><a title="" data-toggle="tooltip" href="https://twitter.com/comparejersey" data-original-title="Twitter"  target="_blank"><span class="fa fa-twitter"></span></a></li>
	                        	 <li><a title="" data-toggle="tooltip" href="#" data-original-title="Linkedin" target="_blank"><span class="fa fa-linkedin"></span></a></li>
                        	</ul>
	                    </div>
	                 </div>
	                 <!-- social button end -->
	            </div>
	         </div>
		    </div>
		  <?php }?>
		    <!-- footer 2 -->
		    <div class="container-fluid bg-grey">
		    	<div class="container">
		            <div class="row">
		                <div class="text-left col-lg-8 col-md-8 col-sm-12 col-xs-12 footer">
		                  Copyright @ 2005 - 2015 Compare Jersey All Rights Reserved
		                </div> 
		                 <div class="text-right col-lg-4 col-md-4 col-sm-12 col-xs-12 footer">
							<a href="{{ URL::route('user.store.privacy') }}">Privacy Policy</a>
		                </div> 
		            </div>
		        </div>    
		    </div> 
		   <a href="#" class="back-to-top" style="display: none;"><span class="fa fa-chevron-up"></span></a>
		<!-- Login Module Start -->		 	
		 	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
				      <div class="modal-content">
					        <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					          <h4 class="modal-title"><span class="glyphicon glyphicon-user flippy-object"></span>Sign In</h4>
					        </div>
				      		 <form role="form" action="{{ URL::route('user.auth.doLogin')}}"   method="POST">
						        <div class="modal-body">
						              <div class="form-group">
						                <label for="exampleInputEmail1">User Name</label>
						                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="User Name" name="userName">
						              </div>
						              <div class="form-group">
						                <label for="exampleInputPassword1">Password</label>
						                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="userPassword">
						              </div>
						  
						        </div>
						        <div class="modal-footer">
						          <button type="submit" class="btn btn-flippy"><span class="glyphicon glyphicon-ok flippy-object"></span>Login</button>
						          <button type="button" class="btn" data-dismiss="modal"><span class="glyphicon glyphicon-remove flippy-object"></span>Close</button>
						        </div>
				           </form>
				      </div><!-- /.modal-content -->
			    </div><!-- /.modal-dialog -->
			  </div>
			<!-- Login Module End -->
		 </body>
	@stop
	@section ('scripts')
 		 {{ HTML::script('/assets/assest_view/assets/js/jquery.js') }}
 		 {{ HTML::script('//code.jquery.com/jquery-migrate-1.2.0.js')}}
 		 {{ HTML::script('/assets/assest_view/dist/js/bootstrap.min.js') }}
 		 {{ HTML::script('/assets/assest_view/js/custome.js') }}
 		 {{ HTML::script('/assets/assest_view/js/fraction/jquery.fractionslider.js') }}
 		 {{ HTML::script('/assets/assest_view/js/jquery.flippy.js') }}
 		 {{ HTML::script('/assets/assest_view/js/jquery.mixitup.min.js') }}
 		 {{ HTML::script('/assets/assest_view/js/jquery.tabSlideOut.v1.3.js') }}
 		 {{ HTML::script('/assets/assest_view/js/jquery.style-switcher.js') }}
 		 {{ HTML::script('/assets/assest_view/js/jquery.prettyPhoto.js') }}
 		 {{ HTML::script('/assets/assest_view//js/app.js') }}
 		 {{ HTML::script('/assets/assest_view/js/jquery.fancybox.js') }}
 		 {{ HTML::script('/assets/assest_view/js/typeahead.min.js') }}
 		 <script type="text/javascript">
 			jQuery(document).ready(function() {
 	 			var skills =[];
 		 		<?php
 		 		 $i = 0;
 		 		    foreach ($professionlist as $skill) {?>
 		 		     skills[<?php echo $i++;?>] = "<?php echo $skill->ProfessionName;?>";
 		 		<?php } ?>
 		 		$("input#srch-term").typeahead({
	 		 		  name: 'srch-term',
	 		 		  local: skills
	 		 	});
 			});    
 			
 		 </script>
 		 <script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-61587325-1', 'auto');
		  ga('send', 'pageview');
		
		</script>
 	@stop
@stop