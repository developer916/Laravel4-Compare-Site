@extends('admin.layout')
	@section('body')
		<h3 class="page-title">Add About Us Management</h3>
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
						<a href="{{URL::route('admin.cms')}}">About Us</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="{{URL::route('admin.cms.create')}}">Edit About us</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								Add About Us
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
							 <form class="form-horizontal" role="form" method="post" action="{{ URL::route('admin.cms.store') }}" enctype="multipart/form-data" id="addClientForm">
							 <input type="hidden" name="about_id" value="{{ $cms->id }}">
							 	<div class="form-body">
								 	 @foreach ([
								                'AboutTitle' => 'Sub Title',
								               	'AboutContent'=> 'Sub Content',
								                'AboutOrder'  => 'Select Order',
								                'AboutImageUrl' => 'Sub Image',
								            ] as $key => $value)
										<div class="form-group">
	              								  <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
	              								  <div class="col-md-7">
								                     @if($key==='AboutTitle')
								                    	 <textarea rows="2" class="form-control" name="subName" id="subName" placeholder="Sub Name" style="height:150px">  {{ $cms->{$key} }}</textarea>
								                    	 <input type="hidden" id="subTitle" name="subTitle" value="{{ $cms->{$key} }}">
								                   	 @elseif($key==='AboutContent')
								                   	 	<textarea rows="5" class="form-control" name="subBody" id="subBody" placeholder="Sub Body" style="height:150px">{{ $cms->{$key} }}</textarea>
								                   	 	<input type="hidden" id="subContent" name="subContent" value="{{ $cms->{$key} }}">
								                   	 @elseif($key === 'AboutOrder')
								                   	 	{{ Form::select('order', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11,12,13,14,15], $cms->{$key}-1 , ['class' => 'form-control']) }}	
								                   	 @else
								                   	 	 {{ Form::file($key, ['class' => 'form-control']) }}
								                   	 	 <div class="col-md-12">
								                            <img src="{{ HTTP_LOGO_PATH.$cms->AboutImageUrl }}" style="width:100%"/>
								                        </div>
	                    							@endif
	              								  </div>
	              							</div>
								           @endforeach 
								    </div>
								   <div class="form-actions">
										<div class="row">
											<div class="col-md-offset-7 col-md-5">
												<button   class="btn  blue" type="button"  onclick="onSubmitClient()"><i class="fa fa-check-circle-o" style="margin-right:4px"></i>Update</button>
											<a class="btn  green" href="{{URL::route('admin.cms')}}"><i class="fa fa-repeat" style="margin-right:4px"></i>Cancel</a>
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
	<script type="text/javascript">
			tinymce.init({
			    selector: "textarea#subBody",
			    theme: "modern",
			    plugins: [
			        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
			        "searchreplace wordcount visualblocks visualchars code fullscreen",
			        "insertdatetime media nonbreaking save table contextmenu directionality",
			        "emoticons template paste textcolor colorpicker textpattern"
			    ],
			    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			    toolbar2: "print preview media | forecolor backcolor emoticons",
			    image_advtab: true,
			    templates: [
			        {title: 'Test template 1', content: 'Test 1'},
			        {title: 'Test template 2', content: 'Test 2'}
			    ]
			});
			function onSubmitClient(){
				var subTitle =$('#subName').val();
				var subContent =tinymce.get('subBody').getContent();
				if(subTitle == "") {alert("Please insert name."); return;}
				if(subContent == "" || subContent == "<p></p>") {alert("Please insert body."); return;}
				$("#subTitle").val(subTitle);
				$("#subContent").val(subContent);
				$("#addClientForm").submit();
			}
		</script>
	@stop
	@stop