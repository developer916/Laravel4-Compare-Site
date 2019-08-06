@extends('user.layout')
	@section('body')
		<div class="container-fluid bg-grey">
	    	<div class="container">
	            <div class="row">
	                <div class="col-lg-12">                
	                    <ol class="breadcrumb">
	                      <li><a href="{{URL::route('user.home')}}">Home</a></li>
	                      <li><a href="{{URL::route('user.auth.about')}}">About Us</a></li>
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
			<div class="no-border">About Us</div>
		</div>
    	<div class="container">
    		<div class="col-md-9">
    			<div class="col-lg-12">                
    				<h3 class="underline">About Us</h3>
    				<?php 
    					if(isset($cms)){
    					for($i=0; $i<count($cms); $i++){
							?>
							<div class="row bottom-40">
						<?php if($cms[$i]['AboutImageUrl'] == ""){
							echo '<div class="col-lg-12">';
							echo "<h2>".stripslashes($cms[$i]['AboutTitle'])."</h2>";
							echo stripslashes($cms[$i]['AboutContent']);
							echo '</div>';
						 }else{if($i%2== 0){?>
    							<div class="col-lg-4 col-md-4">
    								<div class="thumbnail">
    									<img src="assets/logos/<?php echo $cms[$i]['AboutImageUrl']?>" class="img-responsive" alt="About Image">
    								</div>
    							</div>
    							<div class="col-lg-8 col-md-8">
    								<?php 
	    								echo "<h2>".stripslashes($cms[$i]['AboutTitle'])."</h2>";
	    								echo stripslashes($cms[$i]['AboutContent']);
    								?>
    							</div>
    					<?php 	}else{ ?>
    							<div class="col-lg-8 col-md-8">
    								<?php 
	    								echo "<h2>".stripslashes($cms[$i]['AboutTitle'])."</h2>";
	    								echo stripslashes($cms[$i]['AboutContent']);
    								?>
    								
    							</div>
    							<div class="col-lg-4 col-md-4">
    								<div class="thumbnail">
    									<img src="assets/logos/<?php echo $cms[$i]['AboutImageUrl']?>" class="img-responsive" alt="About Image">
    								</div>
    							</div>
    					<?php	}?>
    						</div>
    					<?php }}
    				?>
    				
    				 <div class="row bottom-20">
		                <div class="col-lg-12">                
		    				<h3 class="underline">Our Milestones</h3>
		                </div>
		            </div>
		             <div class="row bottom-20">
		                <div class="col-lg-12">                
		    				<ul class="cbp_tmtimeline">
		    				<?php  
		    					for($i=0; $i<count($milestone); $i++){?>
		    						<li class="animate-slideup invisible">
										<time class="cbp_tmtime" datetime="2013-05-10">
											<span><?php echo $milestone[$i]['SubTitle'];?></span>
											<span><?php echo $milestone[$i]['SubMonth']." ".$milestone[$i]['SubYear']; ?></span>
										</time>
										<div class="cbp_tmicon 
											<?php 
												if($i%4==0){echo "fa fa-star";}
												elseif($i%4==1){echo "fa fa-globe";}
												elseif($i%4==2){echo "fa fa-mobile";}
												elseif($i%4==3){echo "fa fa-check";}
											?>
											 flippy-object"></div>
										<div class="cbp_tmlabel">
											<h4><?php echo stripslashes ($milestone[$i]['Title']);?></h4>
											<p><?php echo stripslashes ($milestone[$i]['Content']);?></p>
										</div>
									</li>
		    				<?php }}
		    				?>
		    				</ul>
		    			</div>
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
@stop