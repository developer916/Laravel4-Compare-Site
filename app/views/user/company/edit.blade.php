@extends('user.layout')
	@section('custom-styles')
		{{ HTML::style('/assets/assest_view/css/video-js.css') }}
		{{ HTML::style('/assets/assest_view/css/video-js.min.css') }}
		{{ HTML::style('/assets/assest_view/css/datepicker.css')}}
	@stop
	@section('body')
		<div class="container-fluid bg-grey">
	    	<div class="container">
	            <div class="row">
	                <div class="col-lg-12">                
	                    <ol class="breadcrumb">
	                      <li><a href="{{URL::route('user.home')}}">Home</a></li>
	                      <li><a href="{{URL::route('user.company')}}">Company Profile</a></li>
	                    </ol>     
	                </div>                                
	            </div>
	        </div>
	    </div>
	    <!-- company menu section -->
		<div class="row padding-bottom-40 bottom-40 company-background margin-right-0 margin-left-0" >
			<div class="col-md-12" style="margin-top:20px;">
				<div class="container">
				<!-- company profile section -->
					<div class="col-md-2">
						<?php if(($company->UserType == "s") || ($company->UserType == "c" && $company->UserImageType=="1")){?>
							<img src="/assets/logos/<?php echo $userImage->ImageUrl;?>" class="img-responsive">
						<?php }else{?>
							<img src="/assets/logos/<?php echo $company->UserImage;?>" class="img-responsive">
						<?php }?>
					</div>
					<!-- company address section -->
					<div class="col-md-2">
						<h4><strong>Address</strong></h4>
						<p><?php echo $company->UserAddress;?></p>
						<p><?php echo $company->UserCity;?></p>
						<p><?php echo $company->UserCountry;?></p>
						<p><?php echo $company->UserPostCode;?></p>
					</div>
					<!-- company contact detail section -->
					<div class="col-md-4">
						<h4><strong>Contact Details</strong></h4>
						<p>
							<strong>Tel:</strong>
							<a href="tel:<?php echo $company->UserPhoneNumber; ?>"> <?php echo $company->UserPhoneNumber?></a>
						</p>
						<p>
							<strong>Fax:</strong>
							<?php if($company->UserFaxNumber !=""){
										echo $company->UserFaxNumber;
								  }else{
								  	echo "There is no Fax number for this company.";
								  }
							?>
						</p>
						<p>
							<strong>Email:</strong>
							<a href="mailto:<?php echo $company->UserEmail; ?>"> <?php echo $company->UserEmail?></a>
						</p>
						<p>
							<strong>Website:</strong>
							<?php
								$companyUserWebsite =$company->UserWebsite;
								if(strtoupper(substr($companyUserWebsite,0,5))=="HTTPS"){
									$companyUserWebsite1 = substr($companyUserWebsite, 8);
									echo '<a href="'.$companyUserWebsite.'">'.$companyUserWebsite1.'</a>';
								} elseif(strtoupper(substr($companyUserWebsite,0,4))=="HTTP"){
									$companyUserWebsite1 = substr($companyUserWebsite, 7);
									echo '<a href="'.$companyUserWebsite.'">'.$companyUserWebsite1.'</a>';
								}else{
									echo '<a href="http://'.$companyUserWebsite.'">'.$companyUserWebsite.'</a>';
								}?>
						</p>
						<p>
							<?php 
								if($company->UserSocial != ""){?>
									<?php 
										$userFaceBookUrl = $company->UserSocial;
										if(strtoupper(substr($userFaceBookUrl,0,5))=="HTTPS" || strtoupper(substr($userFaceBookUrl,0,4))=="HTTP"){?>
											<a href="<?php echo $company->UserSocial?>" target="_blank" class=" company-facebook "></a>
									<?php }else{
									?>	
										<a href="https://<?php echo $company->UserSocial?>" target="_blank" class=" company-facebook "></a>			
									<?php }
								}
								if($company->UserSocialTwitter != ""){?>
								<?php 
										$userFaceBookUrl = $company->UserSocialTwitter;
										if(strtoupper(substr($userFaceBookUrl,0,5))=="HTTPS" || strtoupper(substr($userFaceBookUrl,0,4))=="HTTP"){?>
											<a href="<?php echo $company->UserSocialTwitter?>" target="_blank" class=" company-twitter"></a>
									<?php }else{
									?>	
										<a href="https://<?php echo $company->UserSocialTwitter?>" target="_blank" class=" company-twitter "></a>			
									<?php }
								}
								if($company->UserSocialLinkedin != ""){?>
									<?php 
											$userFaceBookUrl = $company->UserSocialLinkedin;
											if(strtoupper(substr($userFaceBookUrl,0,5))=="HTTPS" || strtoupper(substr($userFaceBookUrl,0,4))=="HTTP"){?>
												<a href="<?php echo $company->UserSocialLinkedin?>" target="_blank" class=" company-linkein"></a>
										<?php }else{
										?>	
											<a href="https://<?php echo $company->UserSocialLinkedin?>" target="_blank" class=" company-linkein "></a>			
										<?php }
									}
							?>
						</p>
					</div>
					<!-- company Orverall section -->
					<div class="col-md-4">
						<h4 class="text-center"><strong>Overall Rating</strong></h4>
						<div class="row">
							<div class="col-md-5">
								<p>Custom Service:</p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<p>Value For Money:</p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<p>Price:</p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<p>Overall Satisfaction:</p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<p>Reliability:</p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<p><strong>Overall Rating:</strong></p>
							</div>
							<div class="col-md-7">
								<p><strong>Number of reviews:</strong></p>
							</div>
						</div>
					</div>
					<!-- company overall end -->
				</div>
			</div>
		</div>
		<div class="row bottom-40 margin-right-0 margin-left-0" id="companyprofieBody">
			<div class="container">
				<div class= "col-md-12">
					<div class="panel-group bottom-10" id="accordion">
						<!-- Product Detail start -->
							 <div class="panel panel-default">
			                      <div class="panel-heading">
				                     <h4 class="panel-title">
				                         <a class="accordion-toggle selected" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
				                           	Product Detail
				                          </a>
				                     </h4>
			                      </div>
			                      <div id="collapseOne" class="panel-collapse collapse">
				                      <div class="panel-body">
			                      		<div class="row margin-top-20">
			                      			<div class="col-md-12">
				                      			@if ($errors->has())
							                        <?php 
														$errorlist = $errors->all();
														if($errorlist[count($errorlist)-1] == "productdetailError"){
															?>
														<div class="alert alert-danger alert-dismissibl fade in">
														    <button type="button" class="close" data-dismiss="alert">
														        <span aria-hidden="true">&times;</span>
														        <span class="sr-only">Close</span>
														    </button>
														   <?php $ik =1; ?> 
														    <?php foreach ($errors->all() as $error){
															    	if($ik != count($errorlist)){
																		echo  $error;		
																	}
																	$ik++;
														    	}
															?>
														</div>
														<?php }?>
													@endif
													<?php if (isset($alert) && $alert['list'] == "productDetailSuccess") {?>
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
												</div>
											<div class="col-md-12">
			                      				<form action="{{URL::route('user.company.productdetail')}}" method="post" class="form-horizontal">
					                      			<div class="form-group">
					                      				<label class="col-md-3 control-label">Product Name</label>
					                      				<div class="col-md-6">
					                      					<textarea class="form-control" name="productname" id="productname" rows="2"><?php echo $addservice->service_title;?></textarea>
					                      				</div>
					                      			</div>
					                      			<div class="form-group">
					                      				<label class="col-md-3 control-label">Product Description</label>
					                      				<div class="col-md-6">
					                      					<textarea class="form-control" name="productdescription" id="productdescription" rows="9"><?php echo $addservice->service_description;?></textarea>
					                      				</div>
					                      			</div>	
					                      			<input type="hidden" value="<?php echo $productID; ?>" name="productID" id="productID"> 
					                      			<button type="submit" class="btn btn-primary" style="float:right"> 
				                       					<span class="glyphicon glyphicon-ok"></span>Submit
				                       				</button>
		                       					</form>
		                       				</div>
			                      		</div>
				                      </div>
				                  </div>
				             </div>
						<!-- Product Detail End -->
							 <div class="panel panel-default">
			                      <div class="panel-heading">
				                     <h4 class="panel-title">
				                         <a class="accordion-toggle selected" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
				                           	Price & Expiry Date
				                          </a>
				                     </h4>
			                      </div>
			                      <div id="collapseTwo" class="panel-collapse collapse">
				                      <div class="panel-body">
			                      		<div class="row margin-top-20">
			                      			<div class="col-md-12">
				                      			@if ($errors->has())
							                        <?php 
														$errorlist = $errors->all();
														if($errorlist[count($errorlist)-1] == "productpriceError"){
															?>
														<div class="alert alert-danger alert-dismissibl fade in">
														    <button type="button" class="close" data-dismiss="alert">
														        <span aria-hidden="true">&times;</span>
														        <span class="sr-only">Close</span>
														    </button>
														   <?php $ik =1; ?> 
														    <?php foreach ($errors->all() as $error){
															    	if($ik != count($errorlist)){
																		echo  $error;		
																	}
																	$ik++;
														    	}
															?>
														</div>
														<?php }?>
													@endif
													<?php if (isset($alert) && $alert['list'] == "productPriceSuccess") {?>
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
												</div>
			                      			<div class="col-md-12">
			                      				<form action="{{URL::route('user.company.productprice')}}" method="post" class="form-horizontal">
			                      					<input type="hidden" value="<?php echo $productID; ?>" name="productID" id="productID"> 
					                      			<?php 
					                      				if($addservice->specialoffer == "1"){
					                      			?>
					                      				<div class="form-group">
						                      				<label class="col-md-3 control-label">Was Price:</label>
						                      				<div class="col-md-6">
						                      					<input type="text"  name="wasprice" id="wasprice" class="form-control" value="<?php echo $addservice->was_price?>">
						                      				</div>
						                      			</div>
					                      				<div class="form-group">
				                      						<label class="col-md-3 control-label">Now Price:</label>
				                      						<div class="col-md-6">
				                      							<input type="text"  name="nowprice" id="nowprice" class="form-control" value="<?php echo $addservice->now_price;?>">
				                      						</div>
				                      					</div>
				                      					<div class="form-group">
				                      						<label class="col-md-3 control-label">Expiry Date:</label>
				                      						<div class="col-md-6">
				                      							<input type="text"  name="pickupDate" id="pickupDate" class="form-control" value="<?php echo $addservice->expiry_date;?>">
				                      						</div>
				                      					</div>
					                      			<?php }else{?>
					                      				<div class="form-group">
				                      						<label class="col-md-3 control-label">Price:</label>
				                      						<div class="col-md-6">
				                      							<input type="text"  name="nowprice" id="nowprice" class="form-control" value="<?php echo $addservice->now_price;?>">
				                      						</div>
				                      					</div>
					                      			<?php }?>
					                      			<button type="submit" class="btn btn-primary" style="float:right"> 
				                       					<span class="glyphicon glyphicon-ok"></span>Submit
				                       				</button>
				                      			</form>
				                      		</div>
			                      		</div>
			                      	</div>
			                      </div>
			                 </div>
						<!-- Price Edit start -->
						<!-- Image Edit start -->
							<div class="panel panel-default">
			                      <div class="panel-heading">
				                     <h4 class="panel-title">
				                         <a class="accordion-toggle selected" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
				                           	Product Image
				                          </a>
				                     </h4>
			                      </div>
			                      <div id="collapseThree" class="panel-collapse collapse">
				                      <div class="panel-body">
			                      		<div class="row margin-top-20">
			                      			<div class="col-md-12">
				                      			@if ($errors->has())
							                        <?php 
														$errorlist = $errors->all();
														if($errorlist[count($errorlist)-1] == "productimageError"){
															?>
														<div class="alert alert-danger alert-dismissibl fade in">
														    <button type="button" class="close" data-dismiss="alert">
														        <span aria-hidden="true">&times;</span>
														        <span class="sr-only">Close</span>
														    </button>
														   <?php $ik =1; ?> 
														    <?php foreach ($errors->all() as $error){
															    	if($ik != count($errorlist)){
																		echo  $error;		
																	}
																	$ik++;
														    	}
															?>
														</div>
														<?php }?>
													@endif
													<?php if (isset($alert) && $alert['list'] == "productimageSuccess") {?>
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
												</div>
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-3">
															<?php 
																if($addservice->image1 == "") {
																	$imageUrl = "no-image.jpg";
																}else{
																	$imageUrl =$addservice->image1; 
																}
															?>
															<img src="/assets/logos/<?php echo $imageUrl;?>" class="img-responsive height180" id="imageFileUpload1" >
															<input type="button" class="btn btn-primary margin-top-20" value="change" onclick="onChangeForm1()">
															<form action="{{URL::route('user.company.productimage')}}" method="post" enctype='multipart/form-data' id="formImageSelectUpload1" class="margin-top-20" style="display:none">
																<input type="hidden" value="<?php echo $productID; ?>" name="productID" id="productID">
																<input type="hidden" value="1" name="imageCount" id="imageCount">
																<input type="file" name="imagefile" id="imagefile">
																<input type="button" class="btn btn-primary margin-top-20" value="Upload" onclick="onFormSubmit(1)">
															</form>
														</div>
														<div class="col-md-3">
															<?php 
																if($addservice->image2 == "") {
																	$imageUrl = "no-image.jpg";
																}else{
																	$imageUrl =$addservice->image2; 
																}
															?>
															<img src="/assets/logos/<?php echo $imageUrl;?>" class="img-responsive height180" id="imageFileUpload2" >
															<input type="button" class="btn btn-primary margin-top-20" value="change" onclick="onChangeForm2()">
															<form action="{{URL::route('user.company.productimage')}}" method="post" enctype='multipart/form-data' id="formImageSelectUpload2" class="margin-top-20" style="display:none">
																<input type="hidden" value="<?php echo $productID; ?>" name="productID" id="productID">
																<input type="hidden" value="2" name="imageCount" id="imageCount">
																<input type="file" name="imagefile" id="imagefile">
																<input type="button" class="btn btn-primary margin-top-20" value="Upload" onclick="onFormSubmit(2)">
															</form>
														</div>
														<div class="col-md-3">
															<?php 
																if($addservice->image3 == "") {
																	$imageUrl = "no-image.jpg";
																}else{
																	$imageUrl =$addservice->image3; 
																}
															?>
															<img src="/assets/logos/<?php echo $imageUrl;?>" class="img-responsive height180" id="imageFileUpload3" >
															<input type="button" class="btn btn-primary margin-top-20" value="change" onclick="onChangeForm3()">
															<form action="{{URL::route('user.company.productimage')}}" method="post" enctype='multipart/form-data' id="formImageSelectUpload3" class="margin-top-20" style="display:none">
																<input type="hidden" value="<?php echo $productID; ?>" name="productID" id="productID">
																<input type="hidden" value="3" name="imageCount" id="imageCount">
																<input type="file" name="imagefile" id="imagefile">
																<input type="button" class="btn btn-primary margin-top-20" value="Upload" onclick="onFormSubmit(3)">
															</form>
														</div>
														<div class="col-md-3">
															<?php 
																if($addservice->image4 == "") {
																	$imageUrl = "no-image.jpg";
																}else{
																	$imageUrl =$addservice->image4; 
																}
															?>
															<img src="/assets/logos/<?php echo $imageUrl;?>" class="img-responsive height180" id="imageFileUpload4">
															<input type="button" class="btn btn-primary margin-top-20" value="change" onclick="onChangeForm4()">
															<form action="{{URL::route('user.company.productimage')}}" method="post" enctype='multipart/form-data' id="formImageSelectUpload4" class="margin-top-20" style="display:none">
																<input type="hidden" value="<?php echo $productID; ?>" name="productID" id="productID">
																<input type="hidden" value="4" name="imageCount" id="imageCount">
																<input type="file" name="imagefile" id="imagefile">
																<input type="button" class="btn btn-primary margin-top-20" value="Upload" onclick="onFormSubmit(4)">
															</form>
														</div>
													</div>	
												</div>
											</div>
										</div>
									</div>
								</div>
						<!-- Image Edit End -->
					</div>
				</div>
			</div>
		</div>
		
	@stop
	@section('custom-scripts')
		{{ HTML::script('/assets/assest_view/js/video.js') }}
		{{ HTML::script('/assets/assest_view/js/video.min.js') }}
		{{ HTML::script('/assets/assest_view/js/spin.js') }}
		{{ HTML::script('/assets/assest_view/js/jquery.form.js')}}
		{{ HTML::script('/assets/assest_view/js/bootstrap-datepicker.js')}}
		{{ HTML::script('/assets/assest_admin/js/bootbox.js')}}
		<script type="text/javascript">
			$(document).ready(function(){
				App.initFancybox();
				//image Upload start//
					$('input#image').change( function(){
						var fileObj = $(this).parent('div.row');
						var id = $(this).parent('div.row').find('input#count').val();
						var base_url = window.location.origin;
						var postUrl = base_url + '/company/companyproductimage';
						var service_id=$("#services").val();
						if(service_id == "") { $("#alertServies").show(); return;}
						fileObj.find('input#service_id').val(service_id);
						
				        var html =  "<form id='file_upload_form' method='post' action='" + postUrl + "' enctype='multipart/form-data'></form>";
				        fileObj.wrap(html);
				        fileObj.parent('form#file_upload_form').ajaxForm({
				        	success: function(data) {
					        	if(data !=""){
				        		var cnt = fileObj.closest("form#file_upload_form").contents();
				                    fileObj.closest("form#file_upload_form").replaceWith(cnt);
	    			        		fileObj.parent('div.col-md-3').append(data);
	    			        		fileObj.hide();
					        	}
				        	}
					   	 }).submit();
					});
				//image upload end//
			});
			
			function deleteImage(obj){
				fileObj = $(obj).parents('div.row').eq(0);
				var base_url = window.location.origin;
				var postUrl = base_url + '/company/productdelete';
				$(obj).parent('form').ajaxForm({
						success: function(){
							fileObj.parents('div.col-md-3').eq(0).find('div#imageUplodDivRow').eq(0).css("display","block");
							fileObj.parents('div.col-md-3').eq(0).find('div#imageUplodDivRow').eq(0).find('input#image').eq(0).val("");
							fileObj.remove();	
						}
				}).submit();
			}	
			$(function() {
				$( "#pickupDate" ).datepicker( {format: 'dd/mm/yyyy'});
			});
			function onChangeForm1(){
				$("#formImageSelectUpload1").toggle();
			}
			function onChangeForm2(){
				$("#formImageSelectUpload2").toggle();
			}
			function onChangeForm3(){
				$("#formImageSelectUpload3").toggle();
			}
			function onChangeForm4(){
				$("#formImageSelectUpload4").toggle();
			}
			function onFormSubmit(id){
				$("#formImageSelectUpload"+id).ajaxSubmit({
					success: function(data) {
						if(data.result == "success"){
							if(data.imagelist != ""){
								var imagecount = data.imagelist;	
							}else{
								var imagecount = "no-image.jpg";
							}
							var count = data.count;
							$("img#imageFileUpload"+count).attr("src","/assets/logos/"+imagecount);
							$("#formImageSelectUpload"+count).hide();
						}else if(data.result == "error"){
							bootbox.alert("Please select correct image!");								
						}
					}
				});
			}
		</script>
@stop