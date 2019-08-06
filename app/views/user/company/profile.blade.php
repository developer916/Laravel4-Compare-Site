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
	                      <li>Company Profile</li>
	                    </ol>     
	                </div>                                
	            </div>
	        </div>
	    </div>
	    <div class="row padding-bottom-40 bottom-40 company-background margin-right-0 margin-left-0" >
			<div class="col-md-12" style="margin-top:20px;">
				<div class="container">
				<!-- company profile section -->
				
					<div class="col-md-2 ">
						<?php if(($company->UserType == "s") || ($company->UserType == "c" && $company->UserImageType=="1")){?>
							<img src="/assets/logos/<?php echo $userImage->ImageUrl;?>" class="img-responsive" style="width: 100%">
						<?php }else{?>
							<img src="/assets/logos/<?php echo $company->UserImage;?>" class="img-responsive" style="width: 100%">
						<?php }?>
					</div>
					<div class="col-md-2 ">
						<h4><strong>Address</strong></h4>
						<p><?php echo $company->UserAddress;?></p>
						<p><?php echo $company->UserCity;?></p>
						<p><?php echo $company->UserCountry;?></p>
						<p><?php echo $company->UserPostCode;?></p>
					</div>
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
				</div>
			</div>	
		</div>
		<!--Featured Articles End-->
	    <div class="container padding-top" >              
	         <div class="row bottom-20">
	             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="companyprofieBody">
	                 <div class="title underline bottom-20">
	                      <span class="glyphicon glyphicon-align-justify"></span>Company Info
	                  </div>
	                   <!--Collaps Start-->
	                    <div class="panel-group bottom-10" id="accordion">
	                    	<div class="panel panel-default">
	                      		<div class="panel-heading">
	                        			<h4 class="panel-title">
	                          				<a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
	                            				About Us
	                          				</a>
	                        			</h4>
	                      		</div>
	                     		<div id="collapseOne" class="panel-collapse collapse">
	                        		<div class="panel-body">
	                            		<?php echo stripslashes($memberDetail[0]->aboutus);?>
	                        		</div>
	                      		</div>
	                    	</div>
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
		                            		<p><?php echo stripslashes($memberDetail[0]->qualification);?></p>
		                        		</div>
		                      	  </div>
		                    </div>
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
		                            		<p><?php echo stripslashes($memberDetail[0]->accredited);?></p>
		                        		</div>
		                      	  </div>
		                    </div>
	                    </div>
	                    <!--Collaps End-->
	                </div>
	                
	                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	                    <div class="title underline bottom-20">
	                        <span class="glyphicon glyphicon-edit"></span>What Our Customers Say
	                    </div>
	                    
	                    <div id="carousel-example-generic" class="carousel slide">
	                    	<?php 
	                    		$countelistnumber = count($ourclient);
						    	if($countelistnumber !=0 && isset($ourclient)){?>
	                    	<div class="carousel-inner">
						    <!-- Wrapper for slides -->
						    <?php 
						    	
						    	$arraylist = array();
						    	
						    	for($i=0; $i<3; $i++){
						    		$arraylist[$i] = rand(0, $countelistnumber-1);
						    ?>
						    
                            
	                            <div class="item <?php if($i==0) {?> active<?php }?>">
	                               <div class="testimonials ">
	                                   <span class="fa fa-quote-left"></span>
	                                      <?php echo $ourclient[$arraylist[$i]]->review;?>
	                                    <span class="fa fa-quote-right"></span>
	                                </div>
	                                  <span class="arrow_box"></span>
	                                    <div class="client-pic">
	                                    	<?php if($ourclient[$arraylist[$i]]->UserImageType == "1") {?>
	                                    		<img src="/assets/logos/<?php echo $ourclient[$arraylist[$i]]->ImageUrl?>" width="50" height="50">
	                                    	<?php }else{?>
	                                    		<img src="/assets/logos/<?php echo $ourclient[$arraylist[$i]]->UserImage?>" width="50" height="50">
											<?php }?>
	                                    </div>
	                                    <div class="client"> 
	                                    	<?php echo $ourclient[$arraylist[$i]]->UserName;?>
	                                    </div>
	                            </div>
	                            <?php }?>
	                              <!-- second slider -->  
	                            </div>
	                        
	                            <!-- Controls -->
	                            <!-- Indicators -->
	                            <ol class="carousel-indicators">
		                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
	                            </ol>
	                       <?php }?>
	                </div>
	            </div>
	          </div>
	    </div>	
	    
	    <div class="row margin-left-0 margin-right-0">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sep"></div>
            <div class="">
                <div class="title text-center"><i class="fa fa-picture-o"></i> 	Photo's & Video</div>
             </div>
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sep-sm bottom-10"></div>
        </div>   
        <?php
        	$countCompanyImage =count($companyImage);
        	if($countCompanyImage != 0){
        ?>
        <div class="row padding-bottom-40 bottom-40 padding-top-40 company-background margin-right-0 margin-left-0" >
      	  <?php 
	        	$companylistnumber = array();
	        	if($countCompanyImage == 4){
					for($ik=0; $ik<$countCompanyImage; $ik++){
						$companylistnumber[$ik] = $ik;
					}
				}else{
		       		$companylistnumber = array();
		       		$companyremainnumber = 4-$countCompanyImage;
		       		for($ik=0; $ik<$countCompanyImage; $ik++){
						$companylistnumber[$ik] = $ik;
					}
					for($ii=0; $ii<$companyremainnumber; $ii++){
						$companylistnumber[$countCompanyImage+$ii] =rand(0,$countCompanyImage-1);
					}
				}
			?>
			<?php if( $memberDetail[0]->image_url !=="") {?>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-6 companytop70" id="galleryCompanyList">
						<a class="thumbnail fancybox-button zoomer" data-rel="fancybox-button" href="/assets/logos/<?php echo $companyImage[$companylistnumber[0]]->imageUrl;?>"> 
							<span class="overlay-zoom2">
							<img src="/assets/logos/<?php echo $companyImage[$companylistnumber[0]]->imageUrl;?>" class="img-responsive2">
							<div class="zoom-icon"></div>
							</span>
						</a>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6 companytop70"  id="galleryCompanyList">
						<a class="thumbnail fancybox-button zoomer" data-rel="fancybox-button" href="/assets/logos/<?php echo $companyImage[$companylistnumber[1]]->imageUrl;?>"> 
							<span class="overlay-zoom2">
							<img src="/assets/logos/<?php echo $companyImage[$companylistnumber[1]]->imageUrl;?>" class="img-responsive2">
							<div class="zoom-icon"></div>
							</span>
						</a>
					</div>
				</div>
			</div>
			<?php if($memberDetail[0]->video_url != "" && $memberDetail[0]->image_url !=="") {?>
			<div class="col-md-4" id="profileVideo">
				<video id="example_video_1" class="video-js vjs-default-skin " controls preload="none"  height="264" width="100%"
		                poster="/assets/logos/<?php echo $memberDetail[0]->image_url; ?>"
                 		data-setup="{}" style="width:100%;">
                 		<source src="/assets/logos/<?php echo $memberDetail[0]->video_url; ?>" 
                 		type='video/mp4' ></source>
                 		<track kind="captions" src="assets/assest_view/css/captions.vtt" srclang="en" label="English" ></track>
                </video>
			</div>
			<?php }else{?>
			<div class="col-md-4" id="profileVideo">
				<a class="thumbnail fancybox-button zoomer " data-rel="fancybox-button" href="/assets/logos/<?php echo $memberDetail[0]->image_url;?>" style="margin-bottom:0px" > 
					<span class="overlay-zoom2">
					<img src="/assets/logos/<?php echo $memberDetail[0]->image_url;?>" class="img-responsive2 video-js vjs-default-skin" id="example_video_1"  style="height:264px; width:100%;">
					<div class="zoom-icon"></div>
					</span>
				</a>
			</div>
			<?php }?>			
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-6  col-sm-6 col-xs-6 companytop70" id="galleryCompanyList">
						<a class="thumbnail fancybox-button zoomer" data-rel="fancybox-button" href="/assets/logos/<?php echo $companyImage[$companylistnumber[2]]->imageUrl;?>"> 
							<span class="overlay-zoom2">
							<img src="/assets/logos/<?php echo $companyImage[$companylistnumber[2]]->imageUrl;?>" class="img-responsive2">
							<div class="zoom-icon"></div>
							</span>
						</a>
					</div>
					<div class="col-md-6  col-sm-6 col-xs-6 companytop70" id="galleryCompanyList">
						<a class="thumbnail fancybox-button zoomer" data-rel="fancybox-button" href="/assets/logos/<?php echo $companyImage[$companylistnumber[3]]->imageUrl;?>"> 
							<span class="overlay-zoom2">
							<img src="/assets/logos/<?php echo $companyImage[$companylistnumber[3]]->imageUrl;?>" class="img-responsive2">
							<div class="zoom-icon"></div>
							</span>
						</a>
					</div>
				</div>
			</div>
        
        <?php }else{?>
        	<div class="col-md-6">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-6 margin-top-20" id="galleryCompanyList">
						<a class="thumbnail fancybox-button zoomer" data-rel="fancybox-button" href="/assets/logos/<?php echo $companyImage[$companylistnumber[0]]->imageUrl;?>"> 
							<span class="overlay-zoom2">
							<img src="/assets/logos/<?php echo $companyImage[$companylistnumber[0]]->imageUrl;?>" class="img-responsive3">
							<div class="zoom-icon"></div>
							</span>
						</a>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6 margin-top-20"  id="galleryCompanyList">
						<a class="thumbnail fancybox-button zoomer" data-rel="fancybox-button" href="/assets/logos/<?php echo $companyImage[$companylistnumber[1]]->imageUrl;?>"> 
							<span class="overlay-zoom2">
							<img src="/assets/logos/<?php echo $companyImage[$companylistnumber[1]]->imageUrl;?>" class="img-responsive3">
							<div class="zoom-icon"></div>
							</span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-6  col-sm-6 col-xs-6 margin-top-20" id="galleryCompanyList">
						<a class="thumbnail fancybox-button zoomer" data-rel="fancybox-button" href="/assets/logos/<?php echo $companyImage[$companylistnumber[2]]->imageUrl;?>"> 
							<span class="overlay-zoom2">
							<img src="/assets/logos/<?php echo $companyImage[$companylistnumber[2]]->imageUrl;?>" class="img-responsive3">
							<div class="zoom-icon"></div>
							</span>
						</a>
					</div>
					<div class="col-md-6  col-sm-6 col-xs-6 margin-top-20" id="galleryCompanyList">
						<a class="thumbnail fancybox-button zoomer" data-rel="fancybox-button" href="/assets/logos/<?php echo $companyImage[$companylistnumber[3]]->imageUrl;?>"> 
							<span class="overlay-zoom2">
							<img src="/assets/logos/<?php echo $companyImage[$companylistnumber[3]]->imageUrl;?>" class="img-responsive3">
							<div class="zoom-icon"></div>
							</span>
						</a>
					</div>
				</div>
			</div>
        	
        <?php }?>
        </div>
        <?php }?>
        <div class="row margin-left-0 margin-right-0">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sep"></div>
            <div class="">
                <div class="title text-center"><span class="glyphicon glyphicon-align-justify"></span> Our Services</div>
             </div>
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sep-sm bottom-10"></div>
        </div>   
       <!--  <div class="row padding-bottom-10 padding-top-10 bottom-40 company-background margin-right-0 margin-left-0">
			<div class="container">
				<h4>Our Services</h4>
			</div>
		</div> -->
		<div class="row padding-bottom-20 padding-top-20 bottom-40  margin-right-0 margin-left-0">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="row bottom-20">
						  <?php for($i=0; $i<count($addservice); $i++){?>
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 bottom-10">
								<div class="flippy-featured-container">   
                                        <div class="flippy-featured-back">
                                            <div class="flippy-featured-title-back"><span class="glyphicon glyphicon-star-empty"></span><?php echo $addservice[$i]->service_title?></div> 
                                            <div class="flippy-featured-description">
                                                <?php echo substr($addservice[$i]->service_description,0,350);?>
                                            </div>
                                            <div class="flippy flippy-featured-readmore">
                                                <ul>
                                                    <li><a href="{{URL::route('user.store.product', $addservice[$i]->addserviceID)}}"><span class="glyphicon glyphicon-check flippy-object"></span>More Info Page</a></li> &nbsp; &nbsp;
                                                    <li>
	                                                    <form  method="post" action="{{URL::route('user.store.search_result')}}">
	                                                    	<input type="hidden" name="profession" id="profession" value="<?php echo Session::get('profession');?>">
	                                                    	<input type="hidden" name="service" id="service" value="<?php echo Session::get('service');?>">
	                                                    	<input type="hidden" name="city" id="city" value="<?php echo Session::get('city');?>">
	                                                    	<button type="submit" class="profileclass" style="background-color:#1fb4da;"><span class="glyphicon glyphicon-ok-circle flippy-object"></span>Search Result</button>
	                                                    </form>
                                                    </li>
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
	@stop
	@section('custom-scripts')
		{{ HTML::script('/assets/assest_view/js/video.js') }}
		{{ HTML::script('/assets/assest_view/js/video.min.js') }}
		{{ HTML::script('/assets/assest_view/js/spin.js') }}
		{{ HTML::script('/assets/assest_view/js/jquery.form.js')}}
		{{ HTML::script('/assets/assest_view/js/bootstrap-datepicker.js')}}
		{{ HTML::script('/assets/assest_view/js/star-rating-search.js') }}
		<script type="text/javascript">
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
			 
			$(document).ready(function(){
				App.initFancybox();
			});
			function onchangeReturn(){
				window.history.back();
			}
			
		</script>
		
	@stop
@stop
	