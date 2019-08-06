@extends('user.layout')
	@section('custom-styles')
		{{ HTML::style('/assets/assest_view/css/star-rating.css') }}
		{{ HTML::style('/assets/assest_view/css/forestresponsive.css') }}
	@stop
	@section('body')
		<div class="container-fluid bg-grey">
	    	<div class="container">
	            <div class="row">
	                <div class="col-lg-12">                
	                    <ol class="breadcrumb">
	                      <li><a href="{{URL::route('user.home')}}">Home</a></li>
	                      <li>Product Detail</li>
	                    </ol>     
	                </div>                                
	            </div>
	        </div>
	    </div>
	   <div class="container-fluid bottom-20">
    	  <div class="container">                               
            <div class="row">            
				<?php if($addservice->image1 != "" || $addservice->image2 != "" || $addservice->image3 != "" || $addservice->image4 != "" ){
						$list = array();
						$ik= 0;
						$reallist = array();
						for($i=0; $i<4; $i++){
							$urlimage = "image".($i+1);
							$list[$i] =$addservice->$urlimage;
							if($addservice->$urlimage != ""){
								$reallist[$ik] =$addservice->$urlimage; 
								$ik = $ik+1;
							}	
						} 
						
						$countimage = ($ik);
						for($i=0; $i<4; $i++){
							$urlimage = "image".($i+1);
							if($addservice->$urlimage == ""){
								$random = rand(0,$countimage-1);										
								$list[$i] =$reallist[$random]; 
							}
						}
						 
					?>
            	<div class="col-lg-8 right-border">

					<div class="row bottom-20">
                       
                           
                            <div class="col-lg-12 sidebar-title">
		                    	 <h4 >Product Images</h4>
		                    </div>
                        
                        <div id="carousel-clients" class="col-lg-12 carousel slide">
                            
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                           	 	<?php 
                            		for($i=0; $i<4; $i++){
                            	?>
                                <div class="item <?php if($i==0){?> active <?php }?>">
                                    <a href="/assets/logos/<?php echo $list[$i]?>" rel="prettyPhoto[post-gal]" ><img src="/assets/logos/<?php echo $list[$i]?>" class="img-responsive productimageclass"></a>
                                </div>
                                 <?php } ?>
                            </div>
                            
                            <!-- Indicators -->
                            <div class="post-carousel">
                                <ol class="carousel-indicators">
                                <li data-target="#carousel-clients" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-clients" data-slide-to="1"></li>
                                <li data-target="#carousel-clients" data-slide-to="2"></li>
                                <li data-target="#carousel-clients" data-slide-to="3"></li>
                                </ol>
                            </div>
        				</div>
                    </div>
                    
                </div>
                <div class="col-lg-4 bottom-20">
	                 <div class="row">
	                 	<div class="col-lg-12 sidebar-title">
	                    	<h4>Product Details</h4>
	                    </div>
	
	                 	<div class="col-lg-12 blog-categories bottom-20">
	                 		<div class="row">
	                 			<div class= "col-md-12 col-sm-4 col-xs-12">
	                 				<p><strong>Product Name:</strong></p>
	                 			</div>
	                 			<div class= "col-md-12 col-sm-8 col-xs-12">
	                 				<p><?php echo $addservice->service_title;?></p>
	                 			</div>
	                 		</div>
	                 		<div class="row">
	                 			<div class= "col-md-12 col-sm-4 col-xs-12">
	                 				<p><strong>Product Detail:</strong></p>
	                 			</div>
	                 			<div class= "col-md-12 col-sm-8 col-xs-12">
	                 				<p><?php echo $addservice->service_description;?></p>
	                 			</div>
	                 		</div>
	                    </div>
	
	                 	<div class="col-lg-12 sidebar-title">
	                    	<h4>Price</h4>
	                    </div>
						
						<div class="col-lg-12 blog-categories bottom-20">
							<?php if($addservice->specialoffer == "1") {?>
		                 		<div class="row">
		                 			<div class= "col-lg-4 col-md-6 col-sm-6 col-xs-6">
		                 				<p>Was:</p>
		                 			</div>
		                 			<div class= "col-lg-4 col-md-6 col-sm-6 col-xs-6">
		                 				<p><?php echo $addservice->was_price;?></p>
		                 			</div>
		                 		</div>
		                 		<div class="row">
		                 			<div class= "col-lg-4 col-md-6 col-sm-6 col-xs-6">
		                 				<p>Now:</p>
		                 			</div>
		                 			<div class= "col-lg-4 col-md-6 col-sm-6 col-xs-6">
		                 				<p><?php echo $addservice->now_price;?></p>
		                 			</div>
		                 		</div>
		                 		<div class="row">
		                 			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
		                 				<p>Expiry Date:</p>
		                 			</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
										<p><?php echo $addservice->expiry_date;?></p>
		                 			</div>
										                 			
		                 		</div>
	                 		<?php }else{?>
	                 			<div class="row">
		                 			<div class= "col-lg-4 col-md-6 col-sm-6 col-xs-6">
		                 				<p>Price:</p>
		                 			</div>
		                 			<div class= "col-lg-4 col-md-6 col-sm-6 col-xs-6">
		                 				<p><?php echo $addservice->now_price;?></p>
		                 			</div>
		                 		</div>
	                 		<?php }?>
	                    </div>
	                  
	                    <?php if(($addservice->specialoffer == "1") && ($addservice->voucherenable == "1")) {?>
		                 	<div class="col-lg-12 tags bottom-20">
		                 		 <a href=" {{ URL::route('user.vourcher', $productID) }} " class="btn btn-flippy" role="button">Voucher</a>
		                    </div>                    
	                    <?php }?>
	                    
	                 </div>
               </div>
<!--End Sidebar-->   
    			<?php }else{?>
    				<div class="col-lg-12 bottom-20">
	                 <div class="row">
	                 	<div class="col-lg-12 sidebar-title">
	                    	<h4>Project Details</h4>
	                    </div>
	
	                 	<div class="col-lg-12 blog-categories bottom-20">
	                 		<div class="row">
	                 			<div class= "col-md-4 col-sm-4 col-xs-5 col-lg-4">
	                 				<p><strong>Product Name:</strong></p>
	                 			</div>
	                 			<div class= "col-md-8 col-sm-8 col-xs-7 col-lg-8">
	                 				<p><?php echo $addservice->service_title;?></p>
	                 			</div>
	                 		</div>
	                 		<div class="row">
	                 			<div class= "col-md-4 col-sm-4 col-xs-5 col-lg-4">
	                 				<p><strong>Product Detail:</strong></p>
	                 			</div>
	                 			<div class= "col-md-8 col-sm-8 col-xs-7 col-lg-8">
	                 				<p><?php echo $addservice->service_description;?></p>
	                 			</div>
	                 		</div>
	                    </div>
	
	                 	<div class="col-lg-12 sidebar-title">
	                    	<h4>Project Tags</h4>
	                    </div>
						
						<div class="col-lg-12 blog-categories bottom-20">
							<?php if($addservice->specialoffer == "1") {?>
		                 		<div class="row">
		                 			<div class= "col-lg-3 col-md-4 col-sm-4 col-xs-6">
		                 				<p>Was:</p>
		                 			</div>
		                 			<div class= "col-lg-9 col-md-8 col-sm-8 col-xs-6">
		                 				<p><?php echo $addservice->was_price;?></p>
		                 			</div>
		                 		</div>
		                 		<div class="row">
		                 			<div class= "col-lg-3 col-md-4 col-sm-4 col-xs-6">
		                 				<p>Now:</p>
		                 			</div>
		                 			<div class= "col-lg-9 col-md-8 col-sm-8 col-xs-6">
		                 				<p><?php echo $addservice->now_price;?></p>
		                 			</div>
		                 		</div>
		                 		<div class="row">
		                 			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
		                 				<p>Expiry Date:</p>
		                 			</div>
									<div class="col-lg-9 col-md-8 col-sm-8 col-xs-6">
										<p><?php echo $addservice->expiry_date;?></p>
		                 			</div>
										                 			
		                 		</div>
	                 		<?php }else{?>
	                 			<div class="row">
		                 			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
		                 				<p>Price:</p>
		                 			</div>
		                 			<div class="col-lg-9 col-md-8 col-sm-8 col-xs-6">
		                 				<p><?php echo $addservice->now_price;?></p>
		                 			</div>
		                 		</div>
	                 		<?php }?>
	                    </div>
	                    <?php if(($addservice->specialoffer == "1") && ($addservice->voucherenable == "1")) {?>
		                 	<div class="col-lg-12 tags bottom-20">
		                 		 <a href=" {{ URL::route('user.vourcher', $productID) }} " class="btn btn-flippy" role="button">Voucher</a>
		                    </div>                    
	                    <?php }?>
	                    
	                 </div>
               </div>
    			<?php }?>
           </div>
           <div class="col-md-12">
           			<?php if (isset($alert) && $alert['list'] == "reviewSuccess" && $alert['type'] =="success") {
							?>
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
           <div class="row">
           		<?php  
           			 $sessionUserID = Session::get('user_id');
           			 $countRate = count($rateuser); 
           		?>
          		 <div class="col-lg-12 sidebar-title">
          		 <?php if(!isset($sessionUserID) && $sessionUserID == "") {?>
                    <h4>Reviews</h4>
                  <?php }else if($countRate >0){ ?>
                  		 <h4>Reviews</h4>
                  <?php }else{?>
                  <h4>Rating & Reviews</h4>
                  <?php }?>
                 </div>
                 <?php
               
                 if(!isset($sessionUserID) && $sessionUserID == "") {
                 $countRate =count($rate);
                 if(isset($rate)) {
                 		  for($i=0; $i<$countRate;$i++) {
							if($i%2==0){?>
								<div class="row margin-top-20">
                 		  	<?php }?>
					                 <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
						                 <blockquote class="hero box-shadow">
										  <p><?php echo $rate[$i]->review;?></p>
										  <small>
										  		<span><?php echo $rate[$i]->UserName;?></span>
										  		<span style="float:right">
										  		 <input id="input-<?php echo $i?>" class="rating" data-readonly="true"  type="number" value="<?php echo $rate[$i]->rate;?>">
										  		</span>
										  </small>
										</blockquote>
									</div>
							<?php if($i%2==1 || $i==($countRate-1)){?>
								</div>
				<?php }}}}else if(($countRate >0 )&& isset($sessionUserID)) {?>
					<div class="col-md-12">
						<?php 
							if($rateuser[0]->Confirm == "1"){?>
								 <div class="row margin-top-20">
								 	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
						                 <blockquote class="hero box-shadow">
										  <p><?php echo $rateuser[0]->review;?></p>
										 
										</blockquote>
									</div>
								 </div>
						<?php }else{?>	
							<h4> <strong> You have made a review for this product. Please wait for admin to confirm.</strong></h4>
						<?php }?>
					</div>
					
				<?php }else{?>
					<div class="col-md-12">
						<div class="col-md-12" style="padding:10px;   background-color: #e5eaf1; border-bottom:1px #002873 solid">
							<h3><i class="fa fa-comments"></i>  Add your review</h3>
						</div>
						<div class="col-md-12" style="padding:10px;   background-color: #e5eaf1;">
						<?php if (isset($alert) && $alert['list'] == "reviewSuccess" && $alert['type'] =="danger") {
							?>
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
									if($errorlist[count($errorlist)-1] == "reviewError"){
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
						</div>
						<div class="col-md-12" style="padding:20px; background-color:#e5eaf1">
						
						 <form action="{{URL::route('user.store.addreview')}}" method="post" class="form-horizontal">
						 	<input type="hidden" value="<?php echo $productID;?>" name="productID" id="productID">
						 	<input type="hidden" value="<?php echo $addservice->service_id;?>" name="serviceID" id="serviceID">
						 	<input type="hidden" value="<?php echo $addservice->user_id;?>" name="userID" id="userID">
							<div class="row">
								<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12" id="addReviewStar">
									<div class="row">
										<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 customServiceTitle" >
								     		<p class="fontrist"><strong>Custom Service</strong></p>
								     	</div>
								     	<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 customeServiceRate" >
								     		<input id="input-1" class="rating" data-min="0" data-max="5" data-step="0.5" name="input-1">	
								     	</div>
								    </div>
								    <div class="row">
										<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 customServiceTitle" >
								     		<p class="fontrist"><strong>Value For Money</strong></p>
								     	</div>
								     	<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 customeServiceRate" >
								     		<input id="input-2" class="rating" data-min="0" data-max="5" data-step="0.5" name="input-2">	
								     	</div>
								    </div> 	
								    <div class="row">
										<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 customServiceTitle" >
								     		<p class="fontrist"><strong>Price</strong></p>
								     	</div>
								     	<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 customeServiceRate" >
								     		<input id="input-3" class="rating" data-min="0" data-max="5" data-step="0.5" name="input-3">	
								     	</div>
								    </div> 	
								    <div class="row">
										<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 customServiceTitle" >
								     		<p class="fontrist"><strong>Overall Satisfaction</strong></p>
								     	</div>
								     		<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 customeServiceRate" >
								     		<input id="input-4" class="rating" data-min="0" data-max="5" data-step="0.5" name="input-4">	
								     	</div>
								    </div> 	
								    <div class="row">
										<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 customServiceTitle" >
								     		<p class="fontrist"><strong>Reliability</strong></p>
								     	</div>
								     		<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 customeServiceRate" >
								     		<input id="input-5" class="rating" data-min="0" data-max="5" data-step="0.5" name="input-5">	
								     	</div>
								    </div> 	 	
								</div>
								<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 margin-top-20">
									<textarea rows="10" name="review" id="review" class="form-control"></textarea>
									<button type="submit"  class="btn btn-primary margin-top-20"  style="float:right;"><i class="fa fa-comments"></i>Submit</button>
								</div>
							</div>
							</form>
						</div>
					</div>
				<?php }?>
	      </div>
        </div>
     </div>
      
    
	@stop
	@section('custom-scripts')
	  {{ HTML::script('/assets/assest_view/js/star-rating-search.js') }}
	  <script type="text/javascript">
	  <?php for($i=0; $i<$countRate;$i++) {?>
	  $('#input-<?php echo $i;?>').rating({
		    min: 0,
		    max: 100,
		    step: 1,
		    size: 'lg'
		 });
		<?php }?>
	  </script>
	@stop
@stop	    