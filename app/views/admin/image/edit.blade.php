@extends('admin.layout')
	@section('body')
		<h3 class="page-title">Add User Image Management</h3>
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
						<a href="{{URL::route('admin.image')}}">User Image</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="{{URL::route('admin.image.create')}}">Add User Image</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								Add User Image
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
							 <form class="form-horizontal" role="form" method="post" action="{{ URL::route('admin.image.store') }}" enctype="multipart/form-data" id="addClientForm">
							 	<div class="form-body">
							 		<input type="hidden" id="image_id"	name="image_id" value="{{$userImage->id}}">
							 		 @foreach ([
						                'ImageUserName' => 'User Image Name',
						                'ImageUrl'   => 'User Image',
						            ] as $key => $value)
						            		@if($key==='ImageUserName')
						            			<div class="form-group">
			              							<label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
			              							<div class="col-md-7">
              											{{ Form::text($key, $userImage->ImageUserName, ['class' => 'form-control','placeholder'=>$value]) }}
              										</div>
              									</div>
              								@elseif($key==='ImageUrl')
              									<div class="form-group">
			              							<label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
			              							<div class="col-md-7">
              								 			{{ Form::file($key, ['class' => 'form-control']) }}
              								 			<div class="col-md-6">
								                            <img src="{{ HTTP_LOGO_PATH.$userImage->ImageUrl }}" style="width:100%"/>
								                        </div>
              								 		</div>
              									</div>
              								@endif
              						@endforeach
							 	</div>
							 	<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-7 col-md-5">
											<button   class="btn  blue" type="submit" ><i class="fa fa-check-circle-o" style="margin-right:4px"></i>Update</button>
											<a class="btn  green" href="{{URL::route('admin.image')}}"><i class="fa fa-repeat" style="margin-right:4px"></i>Cancel</a>
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
		