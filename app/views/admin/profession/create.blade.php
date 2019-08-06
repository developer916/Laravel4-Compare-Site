@extends('admin.layout')
	@section('body')
		<h3 class="page-title">Add Profession Management</h3>
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
						<a href="{{URL::route('admin.profession')}}">Profession</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="{{URL::route('admin.profession.create')}}">Add Profession</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								Add Profession
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
							<form  class="form-horizontal" id="addCategoryFiledForm" method="POST" action="{{URL::route('admin.profession.store')}}">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Profession Name</label>
										<div class="col-md-6">
											<input type="text" class="form-control " placeholder="Profession Name" id="professionName" name="professionName" value="">
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-7 col-md-5">
											<button   class="btn  blue" type="submit" ><i class="fa fa-check-circle-o" style="margin-right:4px"></i>Save</button>
											<a class="btn  green" href="{{URL::route('admin.profession')}}"><i class="fa fa-repeat" style="margin-right:4px"></i>Cancel</a>
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