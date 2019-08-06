@extends('admin.layout')
	@section('custom-styles')
		<style>
			.borderNone {
				border:none!important;
			}
		</style>
		
	@stop
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
								Set User Password
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
							<form  class="form-horizontal" id="addCategoryFiledForm" method="POST" action="{{URL::route('admin.user.set')}}">
								<input type="hidden" name="user_id" value="{{$user->id}}">
								<div class="form-body">
						             @foreach ([
							                'UserName' => 'User Name',
							                'UserType' => 'User Type',
							                'UserEmail' => 'Email Address',
							                'UserAddress' => 'Address',
							                'UserCity' => 'City/Parish',
							                'UserCountry' => 'Country',
							                'UserPostCode' => 'Post Code',
							                'UserPhoneNumber' => 'Phone Number',
							                'UserFaxNumber' => 'Fax Number',
							                'UserPassword' =>'Password',
							            ] as $key => $value)
							            		@if($key === 'UserEmail')
													<div class="form-group">
							              				 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
							              				  <div class="col-md-6">
																<p class="form-control borderNone">{{ $user->UserEmail}}</p>
														  </div>
													 </div>
												@elseif($key ==='UserType')
													<div class="form-group">
							              				 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
							              				  <div class="col-md-6">
							              				  	<p class="form-control borderNone"> 
							              				  			<?php if($user->UserType == "c") {echo "Company User";} else{ echo "Single User";}?>
							              				  	</p>
							              				  </div>
							              			</div>
							                    @elseif($key==='UserName')
							                    	<div class="form-group">
							              				 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
							              				  <div class="col-md-6">
							                      			{{ Form::text($key, $user->UserName, ['class' => 'form-control','placeholder'=>$value]) }}
							                      		 </div>
							                      	</div>
							                     @elseif($key==='UserPassword')
							                      	<div class="form-group">
							              				 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
							              				  <div class="col-md-6">
							                      			{{ Form::text($key, null, ['class' => 'form-control','placeholder'=>$value]) }}
							                      		 </div>
							                      	</div>
							                     @else 
							                     	<div class="form-group">
							              				 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
							              				  <div class="col-md-6">
							                      			<p class="form-control borderNone"> {{ $user->{$key} }}</p>
							                      		 </div>
							                      	</div>
							                    @endif	
							                    
							           @endforeach
							        </div>
							        <div class="form-actions">
										<div class="row">
											<div class="col-md-offset-7 col-md-5">
												<button   class="btn  blue" type="submit" ><i class="fa fa-check-circle-o" style="margin-right:4px"></i>Update</button>
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
	@stop