@extends('user.layout')
	@section('body')
		<div class="container-fluid bg-grey">
	    	<div class="container">
	            <div class="row">
	                <div class="col-lg-12">                
	                    <ol class="breadcrumb">
	                      <li><a href="{{URL::route('user.home')}}">Home</a></li>
	                      <li><a href="{{URL::route('user.auth.specialoffer')}}">Special Offers</a></li>
	                    </ol>     
	                </div>                                
	            </div>
	        </div>
	    </div>
	    <div class="row marginDefaultSet">
    		<img src="/assets/assest_view/images/banner-services.jpg" class="img-responsive" style="width:100%">
    	</div>
    	<div class="bottom-40"></div>
    	<div class="container page-title">
			<div class="no-border">SPECIAL OFFERS PAGE</div>
		</div>
		<div class="container">
    		<div class="col-md-9 bottom-20">
    			<div class="col-lg-12">                
    				<h3 class="underline">Special Offers</h3>
    				<div class="col-md-12">
						<div class="row">
							<p style="line-height:30px;">Our special Offers Page includes last minute late deals on a daily basis. Every Company registered with us can add Special
							   Offers at any time so be sure to Bookmark this page and check back regularly to check any new offers.
							   We will also be posting offers on our <a href="https://www.facebook.com/CompareJersey">Facebook</a> and <a href="https://www.twitter.com/comparejersey">Twitter</a> pages in the near future.
							   Please like or follow us for more details.
							</p>
						</div>
					</div>
    			</div>
    			<div class="row margin-top-30">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						{{ $addservice->links() }}
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-top-20">
						
							<form action ="{{URL::route('user.auth.specialoffer')}}" method="post" id="addfiledForm">
								<div class="from-group">
									<label class="control-label col-md-4 col-sm-4">Sort By:</label>
									<div class="col-md-8 col-sm-8">
										<select name="sortby" class="form-control" id="sortby" onchange="onchangeForm()">
											<option value="">All</option>
											<?php 
												for($i=0; $i<count($profession); $i++){
													if($sortbyvalue == $profession[$i]->id) {?>
															<option value="<?php echo $profession[$i]->id;?>" selected>
																<?php echo $profession[$i]->ProfessionName?>
															</option>
													<?php }else{?>
															<option value="<?php echo $profession[$i]->id;?>">
																<?php echo $profession[$i]->ProfessionName?>
															</option>
													<?php }?>
											<?php }
											?>
										</select>
									</div>
								</div>
							</form>
						
					</div>
				</div>
    			<div class="row margin-top-20" >
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		    			<div class="row bottom-20">
						  <?php
						  	if(isset($addservice)){ 
							if(count($addservice) == 0){
								echo "<h2 class='text-center'>NO RECORDS FOUND</h2>";
							}else{
						  	for($i=0; $i<count($addservice); $i++){?>
									<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 bottom-60">
										<div class="flippy-featured-container">   
		                                        <div class="flippy-featured-back">
		                                            <div class="flippy-featured-title-back"><span class="glyphicon glyphicon-star-empty"></span><?php echo $addservice[$i]->service_title?></div> 
		                                            <div class="flippy-featured-description">
		                                                <?php echo substr($addservice[$i]->service_description,0,400);?>
		                                            </div>
		                                            <div class="flippy flippy-featured-readmore">
		                                                <ul>
		                                                    <li><a href="{{URL::route('user.store.product',$addservice[$i]->addserviceID)}}"><span class="glyphicon glyphicon-check flippy-object"></span>More Info Page</a></li> &nbsp; &nbsp;
		                                                    <li><a href="{{URL::route('user.company.companyprofileview',$addservice[$i]->user_id)}}"><span class="glyphicon glyphicon-ok-circle flippy-object"></span>Company Profile Page</a></li>
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
								 <?php }}}else{?>
						 	<h2 class="text-center">NO RECORDS FOUND</h2>
						 <?php }?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						{{ $addservice->links() }}
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-top-20">
						
							<form action ="{{URL::route('user.auth.specialoffer')}}" method="post" id="addfiledForm">
								<div class="from-group">
									<label class="control-label col-md-4 col-sm-4">Sort By:</label>
									<div class="col-md-8 col-sm-8">
										<select name="sortby" class="form-control" id="sortby" onchange="onchangeForm()">
											<option value="">All</option>
											<?php 
												for($i=0; $i<count($profession); $i++){
													if($sortbyvalue == $profession[$i]->id) {?>
															<option value="<?php echo $profession[$i]->id;?>" selected>
																<?php echo $profession[$i]->ProfessionName?>
															</option>
													<?php }else{?>
															<option value="<?php echo $profession[$i]->id;?>">
																<?php echo $profession[$i]->ProfessionName?>
															</option>
													<?php }?>
											<?php }
											?>
										</select>
									</div>
								</div>
							</form>
						
					</div>
				</div>
    		</div>
    		<div class="col-md-3">
    		    <div class="row bottom-20">
                    <div class="col-md-12">
                        <h4 style="font-weight: 600; text-align: center" class="margin-bottom-20">{{text_head}}</h4>
                        <p>1 - Login to your account</p>
                        <p>2 - Browse to the service of your choice</p>
                        <p>3 - Click on the More Info tab</p>
                        <p>4 - Scroll down to find the Rate & Review options</p>
                        <p>5 - Leave a Rating & Review</p>
                    </div>
                </div>
    			<img class="img-responsive bottom-10" src="assets/assest_view/images/Add.jpg" style="width:100%">
    			<img class="img-responsive bottom-10" src="assets/assest_view/images/facebook.jpg" style="width:100%">
				<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FCompareJersey&amp;width&amp;height=590&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=true&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:590px; width:100%;" allowTransparency="true"></iframe>
				<div class="bottom-20"></div>
				<div class="row bottom-20">
					<div class="col-md-12">
						<h3 class="underline bottom-40">Contact Us</h3>
							<div class="contact-info"><span class="glyphicon glyphicon-map-marker"></span>Address</div>St Helier Jersey Channel Islands
		                	<div class="contact-info padding-top"><span class="glyphicon glyphicon-envelope"></span> E-mail</div>admin@compare.je
		                    <div class="contact-info padding-top"><span class="glyphicon glyphicon-globe"></span> Website</div>www.compare.je
		                    <div class="contact-info padding-top"><span class="glyphicon glyphicon-time"></span> Working Hours</div>9AM - 6PM , Monday - Saturday
					</div>
				</div>
			</div>
    	</div>
	@stop
	@section('custom-scripts')
		<script type="text/javascript">
			function onchangeForm(){
				$("#addfiledForm").submit();
			}
		</script>
	@stop
@stop