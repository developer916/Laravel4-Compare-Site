@extends('admin.layout')
	@section('body')
		<h3 class="page-title">Add About Us Milestone Management</h3>
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
						<a href="{{URL::route('admin.milestone')}}">Milestone Managmenet</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="{{URL::route('admin.milestone.create')}}">Add About Us Milestone</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								Add Milestone
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
							 <form class="form-horizontal" role="form" method="post" action="{{ URL::route('admin.milestone.store') }}" enctype="multipart/form-data" id="addClientForm">
							 	<div class="form-body">
							 		 @foreach ([
						                'SubTitle' => 'Sub Title',
						                'SubYear'   => 'Year',
						                'SubMonth'   => 'Month',
						                'Title'   => 'Title',
						                'Content'   => 'Content',
						            ] as $key => $value)
							            @if($key === "SubTitle" || $key === "Title" || $key === "Content")
							            <div class="form-group">
	              							<label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
	              							<div class="col-md-7">
	              								 <textarea rows="3" class="form-control" name="{{$key}}" id="{{$key}}" placeholder="{{$value}}" ></textarea>
	              							</div>
	              						</div>
	              						@elseif($key === "SubMonth")
	              						<div class="form-group">
	              							<label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
	              							<div class="col-md-7">
	              								<select name="{{$key}}" id="{{$key}}" class="form-control">
	              									<option value="January">January</option>
	              									<option value="February">February </option>
	              									<option value="March">March</option>
	              									<option value="April">April </option>
	              									<option value="May">May</option>
	              									<option value="June">June </option>
	              									<option value="July">July</option>
	              									<option value="August">August </option>
	              									<option value="September">September </option>
	              									<option value="October">October</option>
	              									<option value="November">November</option>
	              									<option value="December">December</option>
	              								</select>
	              							</div>
	              						</div>
	              						@else
	              						<div class="form-group">
	              							<label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
	              							<div class="col-md-7">
	              								{{ Form::text($key, null, ['class' => 'form-control','placeholder'=>$value]) }}
	              							</div>
	              						</div>
	              						@endif
              						@endforeach
							 	</div>
							 	<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-7 col-md-5">
											<button   class="btn  blue" type="submit" ><i class="fa fa-check-circle-o" style="margin-right:4px"></i>Save</button>
											<a class="btn  green" href="{{URL::route('admin.milestone')}}"><i class="fa fa-repeat" style="margin-right:4px"></i>Cancel</a>
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
		