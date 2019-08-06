@extends('admin.layout')
	@section('body')
		<h3 class="page-title">Add User Management</h3>
			<!-- page layout -->
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="{{URL::route('admin.dashboard')}}">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<i class="fa fa-pencil"></i>
						<a href="{{URL::route('admin.user')}}">Profession</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="{{URL::route('admin.user.create')}}">Add User</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								Add User
							</div>
						</div>
							<div class="portlet-body form">
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
							<form  class="form-horizontal" id="addCategoryFiledForm" method="POST" action="{{URL::route('admin.user.store')}}" enctype="multipart/form-data">
								<div class="form-body">
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
							                'AboutImageUrl' => 'Logo',
							            ] as $key => $value)	
							            
							         	   @if ($key === 'UserProfession')
							         	   		  <div class="form-group" id="professionList">
						              				 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
						              				  <div class="col-md-6">
								              	 		  {{ Form::select($key 
									                           , $profession->lists('ProfessionName', 'id')
									                           , null
									                           , array('class' => 'form-control','multiple'=>'multiple','name'=>'profession_id[]')) }}
										              	 </div>
											        </div>	
													
												@elseif($key === 'UserType')
												  <div class="form-group">
						              				 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
						              				  <div class="col-md-6">
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
							              				 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
							              				  <div class="col-md-6">
																{{ Form::email($key, null, ['class' => 'form-control','placeholder'=>$value]) }}
														  </div>
													 </div>
												
												 @elseif($key==='UserWebsite')
							                    	<div class="form-group" id="websites">
							              				 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
							              				  <div class="col-md-6">
							                      			  {{ Form::text($key, null, ['class' => 'form-control','placeholder'=>$value]) }}
							                      		 </div>
							                      	</div>
						                      	 @elseif($key==='UserSocial')
						                    	<div class="form-group" id="socials">
						              				 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
						              				  <div class="col-md-6">
						                      			  {{ Form::text($key, null, ['class' => 'form-control','placeholder'=>$value]) }}
						                      		 </div>
						                      	</div>
						                      	@elseif($key==='UserSocialTwitter')
						                    	<div class="form-group" id="socialTwi">
						              				 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
						              				  <div class="col-md-6">
						                      			  {{ Form::text($key, null, ['class' => 'form-control','placeholder'=>$value]) }}
						                      		 </div>
						                      	</div>
						                      	@elseif($key==='UserSocialLinkedin')
						                    	<div class="form-group" id="socialLink">
						              				 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
						              				  <div class="col-md-6">
						                      			  {{ Form::text($key, null, ['class' => 'form-control','placeholder'=>$value]) }}
						                      		 </div>
						                      	</div>
							                    @elseif($key==='UserName' ||$key==='UserAddress' ||$key==='UserCity' ||$key==='UserCountry' ||$key==='UserPostCode' || $key==='UserPhoneNumber' || $key==='UserFaxNumber' )
							                    	<div class="form-group">
							              				 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
							              				  <div class="col-md-6">
							                      			  {{ Form::text($key, null, ['class' => 'form-control','placeholder'=>$value]) }}
							                      		 </div>
							                      	</div>
							                      @elseif($key==='DefaultLogo')
							                      	<div class="form-group">
							              				 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
							              				  <div class="col-md-1">
							                      			<input type="checkbox" class="form-control" value='1' name="defaultCheck" id="defaultCheck" >
							                      		  </div>
							                      		  <div class="col-md-5" id="userImageLogo" style="display:none">
							                      		  	{{ Form::select('userimage' 
										                           , $userimage->lists('ImageUserName', 'id')
										                           , null
										                           , array('class' => 'form-control')) }}
							                      		  </div>
							                      	</div>  	
							                      @else
													<div class="form-group" id="logoImage">
							              				 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
							              				  <div class="col-md-6">
																 {{ Form::file($key, ['class' => 'form-control']) }}
														</div>
													</div>
							                    @endif
									
						              		
						           @endforeach	
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-7 col-md-5">
											<button   class="btn  blue" type="submit" ><i class="fa fa-check-circle-o" style="margin-right:4px"></i>Save</button>
											<a class="btn  green" href="{{URL::route('admin.user')}}"><i class="fa fa-repeat" style="margin-right:4px"></i>Cancel</a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	@stop
	@section('custom-scripts')
		 {{ HTML::script('/assets/assest_admin/js/jquery.uniform.min.js') }}
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
