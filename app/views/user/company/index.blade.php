@extends('user.layout')
	@section('custom-styles')
		{{ HTML::style('/assets/assest_view/css/video-js.css') }}
		{{ HTML::style('/assets/assest_view/css/video-js.min.css') }}
		{{ HTML::style('/assets/assest_view/css/datepicker.css')}}
		{{ HTML::style('/assets/assest_view/css/star-rating.css') }}
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
				<?php if($company->UserType == "c"){?>
					<div class="col-md-2">
					<?php if(($company->UserType == "s") || ($company->UserType == "c" && $company->UserImageType=="1")){?>
						<img src="/assets/logos/<?php echo $userImage->ImageUrl;?>" class="img-responsive" style="width:100%">
					<?php }else{?>
						<img src="/assets/logos/<?php echo $company->UserImage;?>" class="img-responsive" style="width:100%">
					<?php }?>
					<?php if($company->UserType == "c") {?>
						<a href="javascript:void(0)" onclick ="onEditImage()">Edit</a>
							<?php if (isset($alert) && $alert['list'] == "profileImageSuccess") {?>
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
							 @if ($errors->has())
		                        <?php 
									$errorlist = $errors->all();
									if($errorlist[count($errorlist)-1] == "profileImageError"){
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
							
						<div class="row  margin-top-20" style="display:none" id="EditImageForm">
						<form  class="form-horizontal" id="addCategoryFiledForm" method="POST" action="{{URL::route('user.company.userimagestore')}}" enctype="multipart/form-data">
							   @foreach (['ProfileImage' => 'Logo',
							            ] as $key => $value)	
							   @if($key =="ProfileImage")         
								<div class="col-md-12 display-inline-block">
									 {{ Form::file($key, ['class' => 'form-control company-background']) }}
								</div>
							  @endif
						      @endforeach	
							  
								<div class="col-md-12 margin-top-20">
									<button type="submit" class="btn btn-primary ">
										<span class="glyphicon glyphicon-ok"></span>Change
									</button>
								</div>
							</form>
						</div>
					<?php }?>
					</div>
					<!-- company address section -->
					<div class="col-md-2 ">
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
						<?php if($company->UserType == "c"){?>
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
						<?php }?>
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
					<?php 
						$countRate = count($rate);
						if($countRate != 0){
								$averageRate = "";
								$customeservice = 0;
								$money=0;
								$price=0;
								$overall=0;
								$reliable =0;
								
								for ($i=0; $i<count($rate);$i++){
									$customeservice = $customeservice+ $rate[$i]->Work;
									$money = $money + $rate[$i]->Accuracy;	
									$price = $price + $rate[$i]->Price;
									$overall = $overall + $rate[$i]->Professionalism;
									$reliable = $reliable + $rate[$i]->Reliability;
									$averageRate = $averageRate + $rate[$i]->rate;
								}
								$customeservice  = round(($customeservice/$countRate),1);
								$money =round(($money/$countRate),1);
								$price =round(($price/$countRate),1) ;
								$overall =round(($overall/$countRate),1) ;
								$reliable = round(($reliable/$countRate),1);
								$averageRate = round(($averageRate/$countRate),1);
						}
					?>
					<!-- company Orverall section -->
					<div class="col-md-4" id="overallRating">
						<h4 class="text-center"><strong>Overall Rating</strong></h4>
						<div class="row" >
							<div class="col-md-6 col-sm-6 overallRatingDivTitle">
								<p class="overallTitle">Custom Service:</p>
							</div>
							<div class="col-md-6 col-sm-6 overallRatingDivValue">
								 <input id="rating-input1" class="rating" data-readonly="true"  type="number" value="<?php if($countRate != 0){ echo $customeservice;}?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6 overallRatingDivTitle">
								<p class="overallTitle">Value For Money:</p>
							</div>
							<div class="col-md-6 col-sm-6 overallRatingDivValue">
								 <input id="rating-input2" class="rating" data-readonly="true"  type="number" value="<?php if($countRate != 0){ echo $money; }?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6 overallRatingDivTitle">
								<p class="overallTitle">Price:</p>
							</div>
							<div class="col-md-6 col-sm-6 overallRatingDivValue">
								 <input id="rating-input3" class="rating" data-readonly="true"  type="number" value="<?php if($countRate != 0){ echo $price;}?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6 overallRatingDivTitle">
								<p class="overallTitle">Overall Satisfaction:</p>
							</div>
							<div class="col-md-6 col-sm-6 overallRatingDivValue">
								 <input id="rating-input4" class="rating" data-readonly="true"  type="number" value="<?php if($countRate != 0){ echo $overall;}?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6 overallRatingDivTitle">
								<p class="overallTitle">Reliability:</p>
							</div>
							<div class="col-md-6 col-sm-6 overallRatingDivValue">
								 <input id="rating-input5" class="rating" data-readonly="true"  type="number" value="<?php if($countRate != 0){ echo $reliable; }?>">
							</div>
						</div>
						<div class="row margin-top-20">
							<div class="col-md-6 col-sm-6 overallRatingDivTitle" >
								<p class="overallTitle">Overall Rating: <?php if($countRate != 0){ echo $averageRate."%";}else{echo "0%";}?></p>
							</div>
							<div class="col-md-6 col-sm-6 overallRatingDivValue">
								<p class="overallTitle">Number of reviews: <?php if($countRate != 0){ echo $countRate; } else {echo "0";}?></p>
							</div>
						</div>
					</div>
					<!-- company overall end -->
					<?php }else if($company->UserType == "s"){?>
						<div class="col-md-3 ">
							<img src="/assets/logos/<?php echo $userImage->ImageUrl;?>" class="img-responsive" style="width:100%">
						</div>
						<div class="col-md-3 ">
							<h4><strong>Address</strong></h4>
							<p><?php echo $company->UserAddress;?></p>
							<p><?php echo $company->UserCity;?></p>
							<p><?php echo $company->UserCountry;?></p>
							<p><?php echo $company->UserPostCode;?></p>
						</div>
						<div class="col-md-6 ">
							<h4><strong>Contact Details</strong></h4>
							<p>
								<strong>Tel:</strong>
								<?php echo $company->UserPhoneNumber;?>
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
						</div>
					<?php }?>
				</div>
			</div>
		</div>
		<!-- company menu section end -->
		<!-- company Detail start -->
		<div class="row bottom-40 margin-right-0 margin-left-0" id="companyprofieBody">
			<div class="container">
				<div class= "col-md-12">
					<div class="panel-group bottom-10" id="accordion">
					<!-- about us section -->
					<?php if($company->UserType == "c"){?>
	                    <div class="panel panel-default">
		                      <div class="panel-heading">
			                        <h4 class="panel-title">
			                         <a class="accordion-toggle selected" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			                           	About Us
			                          </a>
			                        </h4>
		                      </div>
		                      <div id="collapseOne" class="panel-collapse collapse">
			                        <div class="panel-body">
			                        @if ($errors->has())
				                        <?php 
											$errorlist = $errors->all();
											if($errorlist[count($errorlist)-1] == "aboutError"){
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
										<?php if (isset($alert) && $alert['list'] == "aboutSuccess") {?>
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
			                            <div class="col-md-6 col-md-offset-3"><?php echo stripslashes($memberDetail[0]->aboutus);?></div>
			                            <div class="col-md-12">
			                            	<div class="panel-body">
			                            		<div class= "form-group">
			                            			<a href="javascript:void(0)" onclick ="onEditAboutUs()" class="btn btn-primary" style="float:right">Change</a>
			                            		</div>
			                            	</div>
			                            </div>
			                            <div class="col-md-6 col-md-offset-3" id="EditAboutDiv" style="display:none">
			                            	<div class="panel-body">
				                            	<form method="post" action = "{{URL::route('user.company.useraboutus')}}" id="addAboutUsForm">
				                            		<div class= "col-md-11">
					                            		<div  class ="form-group">
					                            			<textarea  rows="12" class="form-control" name="aboutus" id="aboutus" style="hieght:300px"><?php echo stripslashes($memberDetail[0]->aboutus);?></textarea>
					                            			<input type="hidden" value="" name="aboutuslist" id="aboutuslist">
					                            		</div>
				                            		</div>
				                            		<div class= "col-md-1">
					                            		<div  class ="form-group">
					                            			<button type="button" class="btn btn-primary" onclick="onAboutUsSubmit()"><span class="glyphicon glyphicon-ok"></span>Edit</button>
					                            		</div>
				                            		</div>
				                            	</form>
			                            	</div>
			                            </div>
			                        </div>
		                      </div>
	                    </div>
	                    <!-- about us section end-->
	                    <!-- qualification held start -->
	                     <div class="panel panel-default">
		                      <div class="panel-heading">
			                        <h4 class="panel-title">
			                         <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
			                           	Qualifications Held
			                          </a>
			                        </h4>
		                      </div>
		                       <div id="collapseTwo" class="panel-collapse collapse">
		                        <div class="panel-body">
										 @if ($errors->has())
				                        <?php 
											$errorlist = $errors->all();
											if($errorlist[count($errorlist)-1] == "qualificationError"){
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
										<?php if (isset($alert) && $alert['list'] == "qualificationSuccess") {?>
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
		                             <p><?php echo stripslashes($memberDetail[0]->qualification);?></p>
		                             <div class="col-md-12">
		                            	<div class="panel-body">
		                            		<div class= "form-group">
		                            			<a href="javascript:void(0)" onclick ="onEditQualification()" class="btn btn-primary" style="float:right">Change</a>
		                            		</div>
		                            	</div>
		                            </div>
		                            <div class="col-md-12" id="EditQualificationsDiv" style="display:none">
		                            	<div class="panel-body">
			                            	<form method="post" action = "{{URL::route('user.company.userqualification')}}">
			                            		<div class= "col-md-11">
				                            		<div  class ="form-group">
				                            			<textarea rows="5" class="form-control" name="qualificationContent" id="qualificationContent"><?php echo stripslashes($memberDetail[0]->qualification);?></textarea>
				                            		</div>
			                            		</div>
			                            		<div class= "col-md-1">
				                            		<div  class ="form-group">
				                            			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>Edit</button>
				                            		</div>
			                            		</div>
			                            	</form>
		                            	</div>
		                            </div>
		                        </div>
		                      </div>
		                  </div>
		               <!-- qualification held end -->
		               <!-- Accredited Bodies start -->
		                  <div class="panel panel-default">
		                      <div class="panel-heading">
			                        <h4 class="panel-title">
			                         <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
			                           Accredited Bodies
			                          </a>
			                        </h4>
		                      </div>
		                       <div id="collapseThree" class="panel-collapse collapse">
		                       		<div class="panel-body">
		                       			 @if ($errors->has())
				                        <?php 
											$errorlist = $errors->all();
											if($errorlist[count($errorlist)-1] == "acceditedError"){
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
										<?php if (isset($alert) && $alert['list'] == "AccreditedSucccess") {?>
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
		                       			 <p><?php echo stripslashes($memberDetail[0]->accredited);?></p>
		                       			 <div class="col-md-12">
			                            	<div class="panel-body">
			                            		<div class= "form-group">
			                            			<a href="javascript:void(0)" onclick ="onEditAccredited()" class="btn btn-primary" style="float:right">Change</a>
			                            		</div>
			                            	</div>
			                            </div>
			                            <div class="col-md-12" id="EditAccreditedDiv" style="display:none">
			                            	<div class="panel-body">
				                            	<form method="post" action = "{{URL::route('user.company.useraccredited')}}">
				                            		<div class= "col-md-11">
					                            		<div  class ="form-group">
					                            			<textarea rows="5" class="form-control" name="AccreditedContent" id="AccreditedContent"><?php echo stripslashes($memberDetail[0]->accredited);?></textarea>
					                            		</div>
				                            		</div>
				                            		<div class= "col-md-1">
					                            		<div  class ="form-group">
					                            			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>Edit</button>
					                            		</div>
				                            		</div>
				                            	</form>
			                            	</div>
			                            </div>
		                       		</div>
		                       </div>
		                  </div>
		               <!-- Accredited Bodies end -->
		               <!-- Video management start -->
		               	  <div class="panel panel-default">
		                      <div class="panel-heading">
			                        <h4 class="panel-title">
			                         <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
			                           Video Upload
			                          </a>
			                        </h4>
		                      </div>
		                       <div id="collapseFour" class="panel-collapse collapse">
		                       		<div class="panel-body">
		                       			 <div class="col-md-12">
			                            	<div class="panel-body">
			                            		<div class= "form-group">
			                            			<a href="javascript:void(0)" onclick ="onEditVideoUpload()" class="btn btn-primary" style="float:right; margin-left:10px;">Video Upload</a>
			                            			<a href="javascript:void(0)" onclick ="onShowVideoUpload()" class="btn btn-success" style="float:right; margin-left:10px;">Video Show</a>
			                            			<?php 
			                            				if (($memberDetail[0]->video_url !="") || ($memberDetail[0]->image_url !="")){
			                            			?>
			                            				<form action="{{URL::route('user.company.uservideodelete')}}" method="post">
			                            					<input type="submit" class="btn btn-danger" value="Video Delete" style="float:right">
			                            				</form>
			                            			<?php }?>
			                            		</div>
			                            	</div>
			                            </div>
			                            <!-- Video upload show part start-->
			                            	<div id="uploadVideoCheck" style="display:none" class="margin-top-20">
			                            		<div class="container">
					                 				<div class="row">
					                 					<div class="col-md-3">
					                 						<?php 
					                 							if($memberDetail[0]->image_url != "") {
					                 						?>
					                 							<div class="panel-body">
					                 								<img src="assets/logos/<?php echo $memberDetail[0]->image_url;?>" class="img-responsive" style="width:100%;">
					                 							</div>
					                 						<?php }?>
					                 						<div class="panel-body">
						                 						 @if ($errors->has())
											                        <?php 
																		$errorlist = $errors->all();
																		if($errorlist[count($errorlist)-1] == "videoImageError"){
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
																	<?php if (isset($alert) && $alert['list'] == "videoImageSuccess") {?>
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
						                 						<form class="form-horizontal" id="addCategoryFiledForm" method="POST" action="{{URL::route('user.company.uservideoimage')}}" enctype="multipart/form-data">
																	<div class="form-group">
																		<label class="control-label">Video Image Upload</label>
																		 <input class="form-control display-inline-block" name="VideoImage" type="file" >
																	</div>
																	<div class="form-group">
																		<button type="submit" class="btn btn-primary ">
																			<span class="glyphicon glyphicon-ok"></span>Video Image Change
																		</button>
																	</div>
																</form>
						                 					</div>
					                 					</div>
					                 					<div class="col-md-6 changeVideoSize">
					                 						<div class="panel-body">
					                 							 @if ($errors->has())
											                        <?php 
																		$errorlist = $errors->all();
																		if($errorlist[count($errorlist)-1] == "VideoFileError"){
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
																	<?php if (isset($alert) && $alert['list'] == "videoFileSuccess") {?>
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
																<?php if($memberDetail[0]->video_url != ""){?>
																	<video id="example_video_1" class="video-js vjs-default-skin bottom-40"
		                 												controls preload="none"  height="264" width="500"
				                 										poster="/assets/logos/<?php echo $memberDetail[0]->image_url; ?>"
				                 										data-setup="{}" style="width:100%;">
				                 										<source src="/assets/logos/<?php echo $memberDetail[0]->video_url; ?>"
				                 										type='video/mp4' ></source>
				                 										<track kind="captions" src="assets/assest_view/css/captions.vtt" srclang="en"
				                 												label="English" ></track>
				                 									</video>
																<?php }?>
					                 							<form class="form-horizontal" method="post" action= "{{URL::route('user.company.uservideofile')}}"  enctype="multipart/form-data">
					                 								<div class="row">
						                 								<div class="col-md-6">
							                 								<div class="form-group margin-right-0 margin-left-0">
							                 									<label class="control-label">Video File Upload</label>
																				 <input class="form-control" name="videoFile" type="file"  id="videoFile">
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="form-group margin-right-0 margin-left-0">
																				<button type="submit" class="btn btn-primary margin-top-25">
																					<span class="glyphicon glyphicon-ok"></span>Video File Change
																				</button>
																			</div>
																		</div>
																	</div>
					                 							</form>
					                 						</div>
					                 					</div>
					                 				</div>
					                 			</div>	
			                            	</div>
			                            <!-- Video upload show part end-->
			                            <!-- video show part start  -->
			                            <?php if($memberDetail[0]->video_url != "" && $memberDetail[0]->image_url !=""){?>
			                            	<div id="ShowVideo" class="margin-top-20" style = "display:none;">
			                            		<div class="container">
			                            			<div class="col-md-6 changeVideoSize">
		                            					<video id="example_video_1" class="video-js vjs-default-skin bottom-40"
                 												controls preload="none"  height="264" width="500"
		                 										poster="/assets/logos/<?php echo $memberDetail[0]->image_url; ?>"
	                 										data-setup="{}" style="width:100%;">
	                 										<source src="/assets/logos/<?php echo $memberDetail[0]->video_url; ?>"
	                 										type='video/mp4' ></source>
	                 										<track kind="captions" src="assets/assest_view/css/captions.vtt" srclang="en"
	                 												label="English" ></track>
	                 									</video>
			                            			</div>
			                            		</div>
			                            	</div>
			                            <?php }?>
			                            <!-- video show part end -->
		                       		</div>
		                       </div>
		                  </div>
		               <!-- Video management end -->
		               <!-- Image upload management start -->
		               	  <div class="panel panel-default">
		                      <div class="panel-heading">
			                        <h4 class="panel-title">
			                         <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
			                           Image Upload
			                          </a>
			                        </h4>
		                      </div>
		                       <div id="collapseFive" class="panel-collapse collapse">
		                       		<div class="panel-body">
		                       			<div class="col-md-12">
		                       				<div class="panel-body">
		                       					<?php if(count($companyImage) <4){?>
				                       				<a href="javascript:void(0)" onclick ="OnEditImageUpload()" class="btn btn-primary" style="float:right; margin-left:10px;">Image Upload</a>
				                       			<?php }?>
					                            	<a href="javascript:void(0)" onclick ="onShowImageUpload()" class="btn btn-success" style="float:right; margin-left:10px;">Image Gallery</a>
				                            </div>
			                            </div>
			                            <div id="ImageGallery" class="margin-top-20">
			                            	<div class="row">
			                            		<?php if (isset($alert) && $alert['list'] == "CompanyImageDeleteSuccess") {?>
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
												<?php 
													for($i=0; $i<count($companyImage); $i++){
												?>			
												<div class="col-md-3 col-sm-6 margin-bottom-20" id="galleryList">
													
														<input type="hidden" class="gallery-close-button"
															id="galleryID"
															value="<?php echo $companyImage[$i]->id ?>"> <a
															class="thumbnail fancybox-button zoomer"
															data-rel="fancybox-button"
															href="/assets/logos/<?php echo $companyImage[$i]->imageUrl?>"> <span
															class="overlay-zoom1"> <img alt=""
																src="/assets/logos/<?php echo $companyImage[$i]->imageUrl?>"
																class="img-responsive1">
																<div class="zoom-icon"></div>
														</span>
														</a>
														<div align="right">
															<form action= "{{URL::route('user.company.companyImageDelete')}}" method="post">
																<input type="hidden" name = "image_id" value="<?php echo $companyImage[$i]->id;?>">
 																<input type="submit" class="btn btn-danger"  value="Delete">
															</form>
															
														</div>
													</div>                            	
												<?php }?>
				                            </div>
			                            </div>
			                            <div id="ImageUpload" class=" margin-top-20 col-md-3" style="display:none">
			                            	@if ($errors->has())
						                        <?php 
													$errorlist = $errors->all();
													if($errorlist[count($errorlist)-1] == "CompanyImageError"){
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
												<?php if (isset($alert) && $alert['list'] == "CompanyImageSuccess") {?>
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
			                            	<form action="{{URL::route('user.company.companyImageUpload')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
			                            		<div class="panel-body">
			                            			<div class="form-group">
			                            				<label class="control-label">Image Upload</label>
			                            				 <input class="form-control display-inline-block" name="CompanyImage" type="file" >
			                            			</div>
			                            			<div class="form-group">
			                            				<div class="form-group margin-right-0 margin-left-0">
															<button type="submit" class="btn btn-primary margin-top-25">
																<span class="glyphicon glyphicon-ok"></span>Image Upload
															</button>
														</div>
			                            			</div>
			                            		</div>
			                            	</form>
			                            </div>
		                       		</div>
		                       	</div>
		                     </div>
		                   <?php }?>
		               <!-- Image upload management end -->
		               <!-- Edit address & contact detail start -->
		               	  <div class="panel panel-default">
		               		  <div class="panel-heading">
			                        <h4 class="panel-title">
			                         <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
			                           Edit Address / Contact Details
			                          </a>
			                        </h4>
		                      </div>
		                       <div id="collapseSix" class="panel-collapse collapse">
		                       		<div class="panel-body">
		                       			<div class="col-md-12">
		                       				@if ($errors->has())
						                        <?php 
													$errorlist = $errors->all();
													if($errorlist[count($errorlist)-1] == "CompanyProfileError"){
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
												<?php if (isset($alert) && $alert['list'] == "CompanyProfileSuccess") {?>
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
		                       				<form action= "{{URL::route('user.company.companyeditprofile')}}" method = "post" class="form-horizontal">
		                       					  @foreach ([
		                       					  			    'UserPhoneNumber' => 'Phone Number',
												                'UserFaxNumber' => 'Fax Number',
												                'UserEmail' => 'Email Address',
												                'UserAddress' => 'Address',
												                'UserCity' => 'City/Parish',
												                'UserCountry' => 'Country',
												                'UserPostCode' => 'Post Code',
												                'UserWebsite' => 'Website Address',
												                'UserSocial' => 'Social Facebook Address', 
												                'UserSocialTwitter' => 'Social Twitter Address',
												                'UserSocialLinkedin' => 'Online Booking Url',
												            ] as $key => $value)
												           @if (($company->UserType =="s") )
												           		@if ($key !== 'UserWebsite' && $key !== 'UserSocial' && $key !== 'UserSocialTwitter' && $key !=='UserSocialLinkedin')
							                       					<div class="form-group">
							                       						 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
							                       						 <div class="col-md-8">
							                       						 	  {{ Form::text($key,  $company->{$key}, ['class' => 'form-control','placeholder'=>$value]) }}
							                       						 </div>
							                       					</div>
					                       				  		@endif
					                       				  	 @elseif($company->UserType  =="c")
					                       				  	 	<div class="form-group">
							                       						 <label class="col-md-3 control-label">{{ Form::label($key, $value) }}</label>
							                       						 <div class="col-md-8">
							                       						 	  {{ Form::text($key,  $company->{$key}, ['class' => 'form-control','placeholder'=>$value]) }}
							                       						 </div>
							                       					</div>
					                       				     @endif
			                       					@endforeach
			                       					<div class="form-group margin-top-20">
			                       						<button type="submit" class="btn btn-primary" style="float:right">
			                       							<span class="glyphicon glyphicon-ok"></span>
			                       								Edit
			                       						</button>
			                       					</div>
		                       				</form>
		                       			</div>
		                       		</div>
		                       	</div>
		                     </div>
		               <!-- Edit address & contact detail end -->
		               <!-- Add services/Professions start -->
		               <?php if($company->UserType == "c") {?>
		                  <div class="panel panel-default">
		               		  <div class="panel-heading">
			                        <h4 class="panel-title">
			                         <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">
			                          	Add Services / Professions
			                          </a>
			                        </h4>
		                      </div>
		                       <div id="collapseSeven" class="panel-collapse collapse">
		                       		<div class="panel-body">
		                       			@if ($errors->has())
						                        <?php 
													$errorlist = $errors->all();
													if($errorlist[count($errorlist)-1] == "addserviceError"){
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
												<?php if (isset($alert) && $alert['list'] == "addserviceSuccess") {?>
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
		                       			<form action="{{URL::route('user.company.addService')}}" method="post" class="form-horizontal" enctype='multipart/form-data' id="prodcutinformationform">
		                       				<div class="col-md-12">
		                       					<div class="row">
			                       					<div class="col-md-5">
				                       					<div class="form-group margin-right-0 margin-left-0">
				                       						<label class="control-label">Select Professions</label>
				                       						<select class="form-control" id="professions" name="professions">
				                       							<option value = "">Select Professions</option>
				                       							<?php 
				                       								for($i=0; $i<count($professions); $i++)
				                       								{
				                       							?>
				                       									<option value="<?php echo $professions[$i]->id?>"><?php echo $professions[$i]->ProfessionName;?></option>
				                       							<?php }?>
								                           </select>
								                           
				                       					</div>
				                       				</div>
				                       				<div class="col-md-2">
				                       				<div id="spin" style ="display:none;"></div>
				                       				</div>
				                       				<div class="col-md-5">
				                       					<div class="form-group margin-right-0 margin-left-0">
				                       						<label class="control-label">Select Services</label>
				                       						<select class="form-control" id="services" name="services">
				                       							<option value="">Select Service</option>
				                       						</select>
				                       					</div>
				                       				</div>
				                       				
			                       				</div>
		                       				</div>
		                       				<div class="row margin-top-20">
		                       					<div class="col-md-12">
		                       						<h4 class="padding-bottom-10" style="border-bottom:1px solid #1fb4da; color:#1fb4da"><strong>Product Detail</strong></h4>
		                       					</div>
		                       				</div>
		                       				<div class="row margin-top-20">
		                       					<div class="col-md-6">
		                       						<div class="form-group margin-left-0 margin-right-0">
		                       							<label class="control-label">Product Name</label>
		                       							<textarea class="form-control" name="productname" id="productname" rows="1"></textarea>
		                       						</div>
		                       						<div class="form-group margin-left-0 margin-right-0">
		                       							<label class="control-label">Product Description</label>
		                       							<textarea class="form-control" name="productdescription" id="productdescription" rows="9"></textarea>
		                       						</div>
		                       					</div>
		                       					<div class="col-md-6">
		                       						<div class="form-group margin-left-0 margin-right-0 margin-top-20">
		                       							<label class="control-label col-md-5">Do you want special offer?</label>
		                       							<div class="col-md-2">
		                       								<input type="checkbox" name="specialOffer" id="specialOffer" value="1" class="form-control " onchange="onChangePrice()">
		                       							</div>
		                       						</div>
		                       						<div class="form-group margin-left-0 margin-right-0" id="voucherDiv" style = "display:none">
		                       							<label class="control-label col-md-5">Do you want voucher?</label>
		                       							<div class="col-md-2">
		                       								<input type="checkbox" name="specialOfferVoucher" value="1" class="form-control ">
		                       							</div>
		                       						</div>
		                       						<div class="form-group margin-left-0 margin-right-0" id="wasPriceDiv" style="display:none">
														<label class="control-label">Was Price:</label>
														<input type="text" value="" name="wasprice" id="wasprice" class="form-control">		                       							
		                       						</div>
		                       						<div class="form-group margin-left-0 margin-right-0">
														<label class="control-label">Now Price:</label>
														<input type="text" value="" name="nowprice" id="nowprice" class="form-control">		                       							
		                       						</div>
		                       						<div class="form-group margin-left-0 margin-right-0" id="expiryDate" style="display:none">
														<label class="control-label">Expiry Date:</label>
														<input type="text"	id="pickupDate" class="form-control" name="pickupDate">		                       							
		                       						</div>
		                       						
		                       					</div>
		                       				</div>
		                       				<button type="submit" class="btn btn-primary" style="float:right"> 
		                       					<span class="glyphicon glyphicon-ok"></span>Submit
		                       				</button>
		                       			</form>
		                       		</div>
		                       </div>
		                  </div>
		                  <?php }?>
						<!-- Add services/Professions end -->
                    </div>
				</div>
			</div>
		</div>
		<?php if($company->UserType == "c") {?>
		<div class="row padding-bottom-10 padding-top-10 bottom-40 company-background margin-right-0 margin-left-0">
			<div class="container">
				<h4>Our Services</h4>
			</div>
		</div>
		<div class="row padding-bottom-20 padding-top-20 bottom-40  margin-right-0 margin-left-0">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="row bottom-20">
						<?php if (isset($alert) && $alert['list'] == "prodcutdelete") {?>
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
						  <?php for($i=0; $i<count($addservice); $i++){?>
							<div class=" col-sm-6 col-md-3 bottom-10 col-xs-12 bottom-60 ">
								<div class="flippy-featured-container">   
                                        <div class="flippy-featured-back">
                                            <div class="flippy-featured-title-back"><span class="glyphicon glyphicon-star-empty"></span><?php echo $addservice[$i]->service_title?></div> 
                                            <div class="flippy-featured-description">
                                                <?php echo substr($addservice[$i]->service_description,0,350);?>
                                            </div>
                                            <div class="flippy flippy-featured-readmore">
                                                <ul>
                                                    <li><a href="{{URL::route('user.company.edit',$addservice[$i]->addserviceID)}}"><span class="glyphicon glyphicon-check flippy-object"></span>Edit</a></li> &nbsp; &nbsp;
                                                    <li><a href="{{URL::route('user.company.addservicedelete',$addservice[$i]->addserviceID)}}"><span class="glyphicon glyphicon-ok-circle flippy-object"></span>Delete</a></li>
                                                </ul>
                                            </div>                       
                                        </div>
                                        
                                        <div class="flippy-featured-front">
                                        	<div class="companyUserNameDiv col-md-12"><h4 class="font-uppercase"><?php echo $addservice[$i]->UserName;?></h4></div>
                                        	<div class="companyServiceTitleDiv col-md-12"><h4 class="font-uppercase"><?php echo $addservice[$i]->service_title;?></h4></div>
                                            <div class="priceShowDiv">
                                            <?php if($addservice[$i]->specialoffer == "1") {?>
                                            
                                            	<div class="priceShow" >
                                            		<p class="serviceBoxWasPrice">
							   							WAS <?php echo $addservice[$i]->was_price;?>				
							   						</p>
                                            	</div>
                                            	<div class="priceShow" id="NowPrice">
                                            		<p class="serviceBoxWasPrice">
							   							NOW <?php echo $addservice[$i]->now_price;?>				
							   						</p>
                                            	</div>
                                            	
                                            	<?php }else{?>
	                                            	<div class="priceShow" >
	                                            		<p class="serviceBoxWasPrice">
								   							PRICE <?php echo $addservice[$i]->now_price;?>				
								   						</p>
	                                            	</div>
                                            	<?php }?>
							   					
							   				</div>
							   				
                                            <div class="flippy-featured-image overflow">
                                            	<div class="col-md-12">
                                            		<h3 class="serviceBoxServiceBackground"><?php echo $addservice[$i]->ServiceName;?></h3>
                                            		<?php 
                                            			if($addservice[$i]->image1 != "") {
                                            				$url =$addservice[$i]->image1;
                                            			}else if($addservice[$i]->image2 != "") {
																$url =$addservice[$i]->image2;
															}			
														else if($addservice[$i]->image3 != "") {
																$url =$addservice[$i]->image3;
															}
														else if($addservice[$i]->image4 !=""){	
															$url =$addservice[$i]->image4;
                                            			}else{
                                            				$url="no-image.jpg";
                                            			}
                                            		?>
                                            		<img src="/assets/logos/<?php echo $url;?>" class="img-responsive" style="min-width:100%; height:175px;">
                                            	</div>
                                            </div>   
                                        </div>
                                     </div>
							</div>
						 <?php }?>
						 
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="pull-left">{{ $addservice->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	<?php }?>
	@stop
	@section('custom-scripts')
		{{ HTML::script('/assets/assest_view/js/video.js') }}
		{{ HTML::script('/assets/assest_view/js/video.min.js') }}
		{{ HTML::script('/assets/assest_view/js/spin.js') }}
		{{ HTML::script('/assets/assest_view/js/jquery.form.js')}}
		{{ HTML::script('/assets/assest_view/js/bootstrap-datepicker.js')}}
		{{ HTML::script('/assets/assest_admin/js/tinymce/js/tinymce/tinymce.min.js') }}
		{{ HTML::script('/assets/assest_view/js/star-rating-search.js') }}
		<script type="text/javascript">
			$(document).ready(function(){
				App.initFancybox();
				
				$("select#professions").on('change', function (){
					$("#spin").css('display','block');
						var opts = {
						  lines: 7, // The number of lines to draw
						  length: 6, // The length of each line
						  width: 5, // The line thickness
						  radius: 8, // The radius of the inner circle
						  corners: 1, // Corner roundness (0..1)
						  rotate: 90, // The rotation offset
						  direction: 1, // 1: clockwise, -1: counterclockwise
						  color: '#000', // #rgb or #rrggbb or array of colors
						  speed: 0.7, // Rounds per second
						  trail: 60, // Afterglow percentage
						  shadow: false, // Whether to render a shadow
						  hwaccel: false, // Whether to use hardware acceleration
						  className: 'spinner', // The CSS class to assign to the spinner
						  zIndex: 2e9, // The z-index (defaults to 2000000000)
						  top: 'auto', // Top position relative to parent in px
						  left: 'auto' // Left position relative to parent in px
						};
						var target = document.getElementById('spin');
						var spinner = new Spinner(opts).spin(target);
						var professionID = $(this).val();
						var $post = {};
						var base_url = window.location.origin;
			         	$post.professionID = professionID;
			         	
					  $.ajax ({
							url: base_url + '/company/companygetservice',
				            type: 'POST',
				            data: $post,
				            cache: false,
				            dataType : "json",
				            success: function (data) {
				            	$("#spin").css('display','none');
					           if(data.result =="success"){
					        	   $("#services").find("option").remove();
					        	   $("#services").append('<option value="">Select Service</option>');
					        	   if(data.services.length>0){
										for(var i=0; i<data.services.length; i++){
											$("#services").append('<option value="'+data.services[i]['id']+'">'+data.services[i]['ServiceName']+'</option>');
										}
						        	}
						        }else{
						        	  $("#services").find("option").remove();
						        	   $("#services").append('<option value="">Select Service</option>');		
							     }
				            }
					  });
				});

				
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
				
			});
			$(function() {
				$( "#pickupDate" ).datepicker({format: 'dd/mm/yyyy'});
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
			function onEditImage(){
				$("#EditImageForm").toggle();
			}
			function onEditAboutUs(){
				$("#EditAboutDiv").toggle();
			}
			function onEditQualification(){
				$("#EditQualificationsDiv").toggle();
			}
			function onEditAccredited(){
				$("#EditAccreditedDiv").toggle();
			}
			function onEditVideoUpload(){
				$("#uploadVideoCheck").show();
				$("#ShowVideo").hide();
			}
			function onShowVideoUpload(){
				$("#uploadVideoCheck").hide();
				$("#ShowVideo").show();
			}
			function OnEditImageUpload(){
				$("#ImageGallery").hide();
				$("#ImageUpload").show();
			}
			function onShowImageUpload(){
				$("#ImageUpload").hide();
				$("#ImageGallery").show();
			}
			function onChangePrice(){
				if($('#specialOffer:checked').length != 0){
					$("#wasPriceDiv").show();
					$("#expiryDate").show();
					$("#voucherDiv").show();
				}else{
					$("#wasPriceDiv").hide();
					$("#expiryDate").hide();
					$("#voucherDiv").hide();
				}
			}
			tinymce.init({
			    selector: "textarea#aboutus",
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
			    ],
			    height : "500"
			});
			function onAboutUsSubmit(){
				var subContent =tinymce.get('aboutus').getContent();
				if(subContent == "" || subContent == "<p></p>") {alert("Please insert about us body."); return;}
				$("#aboutuslist").val(subContent);
				$("#addAboutUsForm").submit();
			}
			$('#rating-input1').rating({
			    min: 0,
			    max: 100,
			    step: 1,
			    size: 'lg'
			 });
			$('#rating-input2').rating({
			    min: 0,
			    max: 100,
			    step: 1,
			    size: 'lg'
			 });
			$('#rating-input3').rating({
			    min: 0,
			    max: 100,
			    step: 1,
			    size: 'lg'
			 });
			$('#rating-input4').rating({
			    min: 0,
			    max: 100,
			    step: 1,
			    size: 'lg'
			 });
			$('#rating-input5').rating({
			    min: 0,
			    max: 100,
			    step: 1,
			    size: 'lg'
			 });
			 _V_.options.flash.swf = "/assets/assest_view/js/video-js.swf";
		</script>
	@stop
@stop