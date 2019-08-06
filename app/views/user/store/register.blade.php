@extends('user.layout')
	@section('body')
		<div class="container-fluid bg-grey">
	    	<div class="container">
	            <div class="row">
	                <div class="col-lg-12">                
	                    <ol class="breadcrumb">
	                      <li><a href="{{URL::route('user.home')}}">Home</a></li>
	                      <li><a href="{{URL::route('user.auth.register')}}">Register</a></li>
	                    </ol>     
	                </div>                                
	            </div>
	        </div>
	    </div>
	    <div class="row marginDefaultSet">
    		<img src="assets/assest_view/images/banner-services.jpg" class="img-responsive" style="width:100%">
    	</div>
		<div class="bottom-40"></div>
		<div class="container page-title">
			<div class="no-border">REGISTER</div>
		</div>
		<div class="container ">
			<div class= "col-md-9">
				<div class="col-md-12">
					<h3 class="underline">Create Account</h3>
					 @if ($errors->has())
						<div class="alert alert-danger alert-dismissibl fade in">
						    <button type="button" class="close" data-dismiss="alert">
						        <span aria-hidden="true">&times;</span>
						        <span class="sr-only">Close</span>
						    </button>
						    @foreach ($errors->all() as $error)
								{{ $error }}		
							@endforeach
						</div>
						@endif
						 <?php if (isset($alert)) { ?>
					        <div class="alert alert-<?php echo $alert['type'];?> alert-dismissibl fade in">
					            <button type="button" class="close" data-dismiss="alert">
					                <span aria-hidden="true">&times;</span>
					                <span class="sr-only">Close</span>
					            </button>
					            <p>
					                <?php echo $alert['msg'];?>
					            </p>
					        </div>
					        <?php } ?>
					<form  class="form-horizontal" id="addCategoryFiledForm" method="POST" action="{{URL::route('user.auth.registerstore')}}" enctype="multipart/form-data">
						   @foreach ([
					                'UserName' => 'User Name',
					                'UserType' => 'User Type',
					                'UserProfession' => 'Professions',
					                'UserAddress' => 'Address',
					                'UserCity' => 'City/Parish',
					                'UserCountry' => 'Country',
					                'UserPostCode' => 'Post Code',
					                'UserPhoneNumber' => 'Phone Number',
					                'UserFaxNumber' => 'Fax Number',
					                'UserEmail' => 'Email Address',
					                'UserWebsite' => 'Website Address',
					                'UserSocial' => 'Social Facebook Address', 
					                'UserSocialTwitter' => 'Social Twitter Address',
					                'UserSocialLinkedin' => 'Online Booking Url',
					                'DefaultLogo' =>'Do you want default logo?',
					                'AboutImageUrl' => 'Logo/Default Image',
					            ] as $key => $value)	
					             @if ($key === 'UserProfession')
				         	   		  <div class="form-group" id="professionList">
			              				 <label class="col-md-4 control-label">{{ Form::label($key, $value) }}</label>
			              				  <div class="col-md-8">
					              	 		  {{ Form::select($key 
						                           , $profession->lists('ProfessionName', 'id')
						                           , null
						                           , array('class' => 'form-control','multiple'=>'multiple','name'=>'profession_id[]')) }}
							              	 </div>
								        </div>	
										
									@elseif($key === 'UserType')
									  <div class="form-group">
			              				 <label class="col-md-4 control-label">{{ Form::label($key, $value) }}</label>
			              				  <div class="col-md-8">
												<div class="radio-list">
													<label class="radio-inline">
														<input type="radio" name="radiouser" id="optionsRadios1" value="s"  onchange ="singleUserChange()"> Single User
													</label>
													<label class="radio-inline">
														<input type="radio" name="radiouser" id="optionsRadios2" value="c"  onchange ="companyUserChange()" checked>Company User 
													</label>
												</div>
											</div>
										</div>
									@elseif($key === 'UserEmail')
										<div class="form-group">
				              				 <label class="col-md-4 control-label">{{ Form::label($key, $value) }}</label>
				              				  <div class="col-md-8">
													{{ Form::email($key, null, ['class' => 'form-control','placeholder'=>$value]) }}
											  </div>
										 </div>
									
									 @elseif($key==='UserWebsite')
				                    	<div class="form-group" id="websites">
				              				 <label class="col-md-4 control-label">{{ Form::label($key, $value) }}</label>
				              				  <div class="col-md-8">
				                      			  {{ Form::text($key, null, ['class' => 'form-control','placeholder'=>$value]) }}
				                      		 </div>
				                      	</div>
			                      	 @elseif($key==='UserSocial')
			                    	<div class="form-group" id="socials">
			              				 <label class="col-md-4 control-label">{{ Form::label($key, $value) }}</label>
			              				  <div class="col-md-8">
			                      			  {{ Form::text($key, null, ['class' => 'form-control','placeholder'=>$value]) }}
			                      		 </div>
			                      	</div>
			                      	@elseif($key==='UserSocialTwitter')
			                    	<div class="form-group" id="socialTwi">
			              				 <label class="col-md-4 control-label">{{ Form::label($key, $value) }}</label>
			              				  <div class="col-md-8">
			                      			  {{ Form::text($key, null, ['class' => 'form-control','placeholder'=>$value]) }}
			                      		 </div>
			                      	</div>
			                      	@elseif($key==='UserSocialLinkedin')
			                    	<div class="form-group" id="socialLink">
			              				 <label class="col-md-4 control-label">{{ Form::label($key, $value) }}</label>
			              				  <div class="col-md-8">
			                      			  {{ Form::text($key, null, ['class' => 'form-control','placeholder'=>$value]) }}
			                      		 </div>
			                      	</div>
				                    @elseif($key==='UserName' ||$key==='UserAddress' ||$key==='UserCountry' ||$key==='UserPostCode' || $key==='UserPhoneNumber' || $key==='UserFaxNumber' )
				                    	<div class="form-group">
				              				 <label class="col-md-4 control-label">{{ Form::label($key, $value) }}</label>
				              				  <div class="col-md-8">
				                      			  {{ Form::text($key, null, ['class' => 'form-control','placeholder'=>$value]) }}
				                      		 </div>
				                      	</div>
				                      @elseif($key==='UserCity' )
				                      	<div class="form-group">
				                      		<label class="col-md-4 control-label">{{ Form::label($key, $value) }}</label>
				                      		 <div class="col-md-8">
				                      		 	<select name="UserCity" class="form-control" id="UserCity">
				                      		 		   <option value="St Helier">St Helier</option>
												       <option value="Grouville">Grouville</option>
												       <option value="St Brelades">St Brelades</option>
												       <option value="St Clements">St Clements</option>
												       <option value="St Johns">St Johns</option>
												       <option value="St Lawrence">St Lawrence</option>
												       <option value="St Martins">St Martins</option>
												       <option value="St Mary's">St Mary's</option>
												       <option value="St Ouen">St Ouen</option>
												       <option value="St Peters">St Peters</option>
												       <option value="St Saviour">St Saviour</option>
												       <option value="Trinity"> Trinity</option>
									                   <option value="Other"> Other</option>
				                      		 	
				                      		 	</select>
				                      		 </div>
				                      	</div>
				                      @elseif($key==='DefaultLogo')
				                      	<div class="form-group">
				              				 <label class="col-md-4 control-label">{{ Form::label($key, $value) }}</label>
				              				  <div class="col-md-1">
				                      			<input type="checkbox" class="form-control" value='1' name="defaultCheck" id="defaultCheck" >
				                      		  </div>
				                      		  <div class="col-md-7" id="userImageLogo" style="display:none">
				                      		  	{{ Form::select('userimage' 
							                           , $userimage->lists('ImageUserName', 'id')
							                           , null
							                           , array('class' => 'form-control')) }}
				                      		  </div>
				                      	</div>
				                      @else
										<div class="form-group"  id="logoImage">
				              				 <label class="col-md-4 control-label">{{ Form::label($key, $value) }}</label>
				              				  <div class="col-md-8">
													 {{ Form::file($key, ['class' => 'form-control']) }}
											 </div>
										</div>
				                    @endif
			           @endforeach	
			           			
			           		<div class="form-group top-40 floatRight margin-right-0">
			           			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>Register</button>
			           		</div>
					</form>
				</div>
					
			</div>
			<div class="col-md-3">
				<img class="img-responsive bottom-10" src="assets/assest_view/images/Add.jpg" style="width:100%">
    			<img class="img-responsive bottom-10" src="assets/assest_view/images/facebook.jpg" style="width:100%">
				<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FCompareJersey&amp;width&amp;height=590&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=true&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:590px; width:100%;" allowTransparency="true"></iframe>
				<div class="bottom-20"></div>
				<div class="row bottom-20">
					<div class="col-md-12">
						<h3 class="underline bottom-40">Contact Us</h3>
							<div class="contact-info"><span class="glyphicon glyphicon-map-marker"></span>Address</div>St Helier Jersey Channel Islands
		                	<div class="contact-info padding-top"><span class="glyphicon glyphicon-envelope"></span> E-mail</div>admin@compare.je
		                    <div class="contact-info padding-top"><span class="glyphicon glyphicon-globe"></span> Website</div>www.compare.je
		                    <div class="contact-info padding-top"><span class="glyphicon glyphicon-time"></span> Working Hours</div>9AM - 6PM , Monday - Saturday
					</div>
				</div>
			</div>
		</div>
	@stop
	@section('custom-scripts')
		 <script type="text/javascript">
			function singleUserChange(){
				$("#professionList").hide();
				$("#websites").hide();
				$("#socials").hide();
				$("#socialLink").hide();
				$("#socialTwi").hide();
				$("#defaultCheck").attr('checked','checked');
				$("#userImageLogo").show();
				$("#logoImage").hide();
				
			}
			function companyUserChange(){
				$("#professionList").show();
				$("#websites").show();
				$("#socials").show();	
				$("#socialLink").show();
				$("#socialTwi").show();
				$("#defaultCheck").attr('checked',false);
				$("#userImageLogo").hide();
				$("#logoImage").show();
			}
			$("#defaultCheck").on("click",function(){
				if($('#defaultCheck:checked').length != 0){
					if($("input[name='radiouser']:checked").val() == "c"){
						$("#userImageLogo").show();
						$("#logoImage").hide();
					}
				}
				else{
					if($("input[name='radiouser']:checked").val() == "c"){
						$("#userImageLogo").hide();
						$("#logoImage").show();
					}
				}
			});
		 </script>
	@stop
@stop