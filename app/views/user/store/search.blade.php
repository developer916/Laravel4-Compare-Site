@extends('user.layout')
	@section('body')
		<div class="container-fluid bg-grey">
	    	<div class="container">
	            <div class="row">
	                <div class="col-lg-12">                
	                    <ol class="breadcrumb">
	                      <li><a href="{{URL::route('user.home')}}">Home</a></li>
	                      <li>Search Result</li>
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
			<div class="no-border">SEARCH RESULTS PAGE</div>
		</div>
		<div class="bottom-40"></div>
		<div class="row padding-bottom-20 padding-top-20 bottom-40  margin-right-0 margin-left-0">
			<div class="container">
				<div class="row">
					<div class="col-md-9 ">
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
                                                <?php echo substr($addservice[$i]->service_description,0,350);?>
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
                                   <input type="hidden" name= "profession" value="<?php echo Session::get('profession');?>">
                                   <input type="hidden" name= "service" value="<?php echo Session::get('service');?>">
                                   <input type="hidden" name= "city" value="<?php echo Session::get('city');?>">
							</div>
						 <?php }}}else{?>
						 	<h2 class="text-center">NO RECORDS FOUND</h2>
						 <?php }?>
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="pull-left">{{ $addservice->links()}}</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
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
			</div>
		</div>
	@stop
@stop