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
						<a href="{{URL::route('admin.faq')}}">Faq</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="{{URL::route('admin.faq.create')}}">Add Faq</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								Add FAQ
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
							<form  class="form-horizontal" id="addClientForm" method="POST" action="{{URL::route('admin.faq.store')}}">
								<div class="form-body">
									<div class= "form-group">
										<label for="inputEmail1" class="col-md-3 control-label">Question</label>
										<div class="col-md-7">
					                         <textarea rows="2" class="form-control" name="subName" id="subName" placeholder="Sub Title" style="height:150px"></textarea>
					                         <input type="hidden" id="subTitle" name="subTitle">
					                    </div>
					                 </div>
					                 <div class= "form-group">
										<label for="inputEmail1" class="col-md-3 control-label">Answer</label>
										<div class="col-md-7">
					                         <textarea rows="5" class="form-control" name="subBody" id="subBody" placeholder="Sub Title" style="height:150px"></textarea>
					                         <input type="hidden" id="subContent" name="subContent">
					                    </div>
					                 </div>
					                 
					                 
					             </div>
					             <div class="form-actions">
									<div class="row">
										<div class="col-md-offset-7 col-md-5">
											<button   class="btn  blue" type="button"  onclick="onSubmitClient()"><i class="fa fa-check-circle-o" style="margin-right:4px"></i>Save</button>
											<a class="btn  green" href="{{URL::route('admin.faq')}}"><i class="fa fa-repeat" style="margin-right:4px"></i>Cancel</a>
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
			    selector: "#subBody",
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
				var subTitle =$("#subName").val();
				var subContent =tinymce.get('subBody').getContent();
				if(subTitle == "" ) {alert("Please insert name."); return;}
				if(subContent == "" || subContent == "<p></p>") {alert("Please insert body."); return;}
				$("#subTitle").val(subTitle);
				$("#subContent").val(subContent);
				$("#addClientForm").submit();
			}
		</script>
	@stop
@stop
