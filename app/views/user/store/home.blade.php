@extends('user.layout')
	
	@section('body')
	<div class="row  margin-left-0  margin-right-0 " style="position:relative;">
	 <div class="container mainSearchDiv">
	    <div class="row margin-left-0  margin-right-0 " >
	      <div class="col-md-11">
		        <div class="pull-left asm-free-search">
			          <div class="free-search">
			          	
				            <form id="search_submit" name="search_submit" method="post" action="{{URL::route('user.store.search_result')}}">
				              <h2>Search for free <span style="font-size:12px; letter-spacing:3px; line-height:0px;">--------------------------------------------------</span></h2>
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
					              <div class="form-group">
					                <label for="exampleInputEmail1">Choose a Profession </label>
					                 <select   id="profession" class="form-control" name="profession" onchange="onChangeProfessions()">
					                 	<option value="">Choose a Profession</option>
					                 	<?php 
					                 		if(isset($professions)){
					                 		for($i=0; $i<count($professions); $i++){
					                 	?>
					                 		<option value="<?php echo $professions[$i]->id; ?>"><?php echo $professions[$i]->ProfessionName; ?></option>
					                 	<?php }}?>
									</select>
					              </div>
					              <div class="form-group">
					                <label for="exampleInputPassword1">Choose a Services</label>
					                 <select   id="service"  name="service" class="form-control" onchange="onChangeServices()" >
					                 	<option value="">Choose a Services</option>
					                 	<?php
					                 		if(isset($services)){ 
					                 		for($i=0; $i<count($services); $i++){
					                 	?>
					                 		<option value="<?php echo $services[$i]->id; ?>"><?php echo $services[$i]->ServiceName; ?></option>
					                 	<?php }}?>
									 </select>
					              </div> 
					               <div class="form-group">
						                <label for="exampleInputPassword1">Choose a Parish</label>
						                <select   id="city"  name="city" class="form-control" >
						                	<option value="">Choose a Parish</option>
						                	<?php
						                		if(isset($city)){ 
						                		for($i=0; $i<count($city); $i++){
						                	?>
						                		<option value="<?php echo $city[$i]->UserCity;?>"><?php echo $city[$i]->UserCity;?></option>
						                	<?php }}?>
										</select>
						           </div> 
				               <input type="submit" class="btn btn-lg btn-primary" value="search"  style="float: right">
				             
				            </form>
			          </div>
		        </div>
		        <div class="pull-right how-it-works">
			        <div class="hiw-content">
				          <h3 style="margin-bottom:0px; padding-bottom:15px;margin-top:-5px">How Does it work</h3>
				          <div class="hiw"><span>1</span>  Choose a Profession from the Search Box</div>
				          <div class="hiw"><span>2</span>  Choose a Service</div>
				          <div class="hiw"><span>3</span>  Click the Search button</div>
				          <div class="hiw"><span>4</span>  Choose a Service that suits you</div>
				          <p>Browse Company Profile pages, also Service Prices,	Descriptions & Images<br/>
				          	Information is updated on a daily basis
			        </div>
		        </div>
	     	 </div>
	    </div>
	  </div>
	 </div>
	<!-- slider start -->
       <div class="row" id="fade" style="position:relative;">
	 	  <img src="assets/assest_view/img/image1.jpg" style="width:100%;height:100%;">
	      <img src="assets/assest_view/img/image2.jpg" style="width:100%;height:100%;">
	      <img src="assets/assest_view/img/image3.jpg" style="width:100%;height:100%;">
	      <img src="assets/assest_view/img/image4.jpg" style="width:100%;height:100%;">
	      <img src="assets/assest_view/img/image5.jpg" style="width:100%;height:100%;">
	      <img src="assets/assest_view/img/image6.jpg" style="width:100%;height:100%;">
	      <img src="assets/assest_view/img/image7.jpg" style="width:100%;height:100%;">
	 </div>
	 <div class="container-fluid bg-light-grey padding-top-20">
    	<div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <div class="row bottom-20">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <h1 class="text-center fonty">RANDOM OFFERS</h1>
                       </div>
                    </div>
                </div>
              </div>
              <?php
              	$countList = count($addservice);
              	if(isset($addservice) && $countList>0){?>
              <div class="row">
					<?php 
						
						$rand = 0;
						for($i=0; $i<4; $i++){
							$rand = rand(0, $countList-1);
							
					?>    
					 	<div class=" col-sm-6 col-md-3 bottom-10 col-xs-12 bottom-60 ">
								<div class="flippy-featured-container">   
                                        <div class="flippy-featured-back">
                                            <div class="flippy-featured-title-back"><span class="glyphicon glyphicon-star-empty"></span><?php echo $addservice[$rand]->service_title?></div> 
                                            <div class="flippy-featured-description">
                                                <?php echo substr($addservice[$rand]->service_description,0,350);?>
                                            </div>
                                            <div class="flippy flippy-featured-readmore">
                                                <ul>
                                                     <li><a href="{{URL::route('user.store.product', $addservice[$rand]->id)}}"><span class="glyphicon glyphicon-check flippy-object"></span>More Info Page</a></li> &nbsp; &nbsp;
                                                    <li><a href="{{URL::route('user.company.companyprofileview',$addservice[$rand]->user_id)}}"><span class="glyphicon glyphicon-ok-circle flippy-object"></span>Company Profile Page</a></li>
                                                </ul>
                                            </div>                       
                                        </div>
                                        
                                        <div class="flippy-featured-front">
                                        	<div class="companyUserNameDiv col-md-12"><h4 class="font-uppercase"><?php echo $addservice[$rand]->UserName;?></h4></div>
                                        	<div class="companyServiceTitleDiv col-md-12"><h4 class="font-uppercase"><?php echo $addservice[$rand]->service_title;?></h4></div>
                                            <div class="priceShowDiv">
                                            <?php if($addservice[$rand]->specialoffer == "1") {?>
                                            
                                            	<div class="priceShow" >
                                            		<p class="serviceBoxWasPrice">
							   							WAS <?php echo $addservice[$rand]->was_price;?>				
							   						</p>
                                            	</div>
                                            	<div class="priceShow" id="NowPrice">
                                            		<p class="serviceBoxWasPrice">
							   							NOW <?php echo $addservice[$rand]->now_price;?>				
							   						</p>
                                            	</div>
                                            	
                                            	<?php }?>
							   				</div>
                                            <div class="flippy-featured-image overflow">
                                            	<div class="col-md-12">
                                            		<h3 class="serviceBoxServiceBackground"><?php echo $addservice[$rand]->ServiceName;?></h3>
                                            		<?php 
                                            			if($addservice[$rand]->image1 != "") {
                                            				$url =$addservice[$rand]->image1;
                                            			}else if($addservice[$rand]->image2 != "") {
																$url =$addservice[$rand]->image2;
															}			
														else if($addservice[$rand]->image3 != "") {
																$url =$addservice[$rand]->image3;
															}
														else if($addservice[$rand]->image4 !=""){	
															$url =$addservice[$rand]->image4;
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
              <?php }?>
          </div>
        </div>
         <!-- How to register start --> 
	 <div class="container-fluid bg-blue-trans">
    	<div class="container">
            <div class="row">
                <div class="col-lg-12">
                   <div class="jumbotron animate-slideup invisible">
                          <div class="container ">
                            <h2 class="text-center how-to-register bottom-20">HOW TO REGISTER</h2>
                           	<p>To Register with Compare.je, follow these 3 simple steps.</p>
					        <p>1 - Visit our Registration Page</p>
					        <p>2 - Fill in the Registration Form</p>
					        <p>3 - Click the Register Button</p>
					        <p>Admin will receive your Registration Form and after examination will activate your account. A Password will be emailed to you that will allow you to login to your account.</p>
					        <p>After login you will be directed to your Company Profile Page where you can update your profile with relevant information for your company, you may also add Services, and have control over Description, Images, &amp; Price.</p>
					        <p>Alternatively we can set it all up for you, 
								For more information use our Contact page to get in touch
					        </p>
                            <p class="padding-top pull-right"><a href = "{{URL::route('user.auth.register')}}" type="button" class="btn btn-white btn-lg">Register</a></p>
                            
                          </div>
                        
                        </div>
                    </div>
                
                </div>
            </div>
        </div> 
        <!-- how to register end -->
         <!-- our service and what client say start  -->
          <div class="container padding-top">              
            <div class="row bottom-20">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="companyprofieBody">
                    <div class="title underline bottom-20">
                        <span class="glyphicon glyphicon-align-justify"></span>Our Services
                    </div>
                    <?php if(isset($cms)){?>
                    <div class="panel-group bottom-10" id="accordion">
                    	<?php 
                    		for($i=0; $i<count($cms); $i++){?>
                    			 <div class="panel panel-default">
				                      <div class="panel-heading">
				                        <h4 class="panel-title">
				                          <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i?>">
				                            <?php echo $cms[$i]->AboutTitle?>
				                          </a>
				                        </h4>
				                      </div>
				                       <div id="collapse<?php echo $i;?>" class="panel-collapse collapse ">
					                        <div class="panel-body">
					                            <p><?php echo $cms[$i]->AboutContent?></p>
					                        </div>
					                  </div>
				                 </div>
                    	<?php }
                    	?>
                    </div>
                    <?php }?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="title underline bottom-20">
                        <span class="glyphicon glyphicon-edit"></span>What Our Clients Say
                    </div>
                    <?php 
                    $list = count($client);
                    if(isset($client) && $list>0){?>
                    <div id="carousel-example-generic" class="carousel slide">
                    	 <div class="carousel-inner">
                     	<?php 
                     		
    	                 	for($i=0; $i<$list; $i++){?>
                                <div class="item <?php if($i==0){?> active <?php }?>">
                                    <div class="testimonials ">
                                        <span class="fa fa-quote-left"></span>
                                        <?php echo $client[$i]->Content;?>
                                        <span class="fa fa-quote-right"></span>
                                    </div>
                                  	<span class="arrow_box"></span>
                                	<div class="client-pic">
                                		<?php 
                                		if($client[$i]->ImageUrl != ""){
                                			$image =$client[$i]->ImageUrl;
                                		}else{
                                			$image =$client[$i]->UserImage; 
                                		}
                                			 
                                		?>
                                			<img src="/assets/logos/<?php echo $image;?>" width="50" height="50">
                                			
                                	</div>
                                    <div class="client"><?php echo $client[$i]->UserName;?></div>
                                </div>
                                  					
							<?php }
 	                    	?>
 	                    </div>
 	                    	<ol class="carousel-indicators">
 	                    	<?php for($i=0; $i<$list; $i++){?>
                            	<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i;?>" <?php if($i==0){ ?> class="active <?php }?>"></li>
                            <?php }?>
                            </ol>
                    </div>
                    <?php }?>
                </div>
            </div>
        <!-- our service and what client say end-->
       
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sep"></div>
                <div class="">
                   <div class="title text-center"><span class="glyphicon glyphicon-heart"></span>Our Clients</div>
                </div>
                 <?php
        		$ourclientNumber = count($ourclient);
       			  if(isset($ourclient) && $ourclientNumber>0){?>
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sep-sm bottom-10"></div>
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             
                <div id="carousel-clients" class="carousel slide">
                   <div class="carousel-inner">
                   		<?php 
                   			
                   			for($i=0; $i<2; $i++){?>
								<div class="item <?php if($i==0) {?> active<?php }?>">
									<div class="row">
									<?php for($j=0; $j<6; $j++){
											$random = rand(0,$ourclientNumber-1);	
												?>
											<div class="col-lg-2 text-center tip">
		                                            <a class="" title="" data-toggle="tooltip" href="{{URL::route('user.company.companyprofileview', $ourclient[$random]->id)}}" data-original-title="<?php echo $ourclient[$random]->UserName?>">
		                                            	<?php
				                                            	if($ourclient[$random]->ImageUrl != ""){
				                                            		$image =$ourclient[$random]->ImageUrl;
				                                            	}else{
				                                            		$image =$ourclient[$random]->UserImage;
				                                            	}
		                                            	?>
		                                               <img src="/assets/logos/<?php echo $image;?>" class="ourclientdiv">
		                                            </a>
		                                        </div>			
										<?php }?>
									</div>
								</div>
						<?php	}
                   		?>
                  	</div>
                  	<ol class="carousel-indicators">
                       <li data-target="#carousel-clients" data-slide-to="0" class="active"></li>
                      <li data-target="#carousel-clients" data-slide-to="1"></li>
                   </ol>
                </div>
             </div>
              <?php }?>
        </div>
        	
       	  </div>
        <!-- Our Clients End -->
         <?php 
       		if(isset($alert)){
		 ?>
	      	 <div class="modal fade in" id="homeLogin" tabindex="-1" role="dialog" aria-labelledby="homeLoginLabel" aria-hidden="true" style="display:block">
			    <div class="modal-dialog">
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="homeLoginClose()">&times;</button>
				          <h4 class="modal-title"><span class="glyphicon glyphicon-user flippy-object"></span>Sign In Failed</h4>
				        </div>
				        <div class="modal-body">
				        	<div class="alert alert-danger alert-dismissibl fade in">
							    <p>
							        <?php echo $alert['msg'];?>
							    </p>
							</div>
				        </div>
					   <div class="modal-footer">
				          <button type="button" class="btn" data-dismiss="modal" onclick="homeLoginClose()"><span class="glyphicon glyphicon-remove flippy-object"></span>Close</button>
				        </div>
				      </div><!-- /.modal-content -->
			    </div><!-- /.modal-dialog -->
			  </div>
       <?php 	}
       ?>
	@stop
	@section('custom-scripts')
	 {{ HTML::script('/assets/assest_view/js/cycle-plugin.js') }}
	 <script type="text/javascript">
		 $(document).ready(function() {
				$('#fade').cycle();
		 });
	 	function homeLoginClose(){
		 	$("#homeLogin").hide();
		 }
		 function onChangeProfessions(){
			 var professionID = $("#profession").val();
			 $post = {};
			 
			 $post.professionID =professionID;
		 	var base_url = window.location.origin;
		 	 
		 	 $.ajax ({
					url: base_url + '/homegetservice',
		            type: 'POST',
		            data: $post,
		            cache: false,
		            dataType : "json",
		            success: function (data) {
		            	if(data.result =="success"){
				        	   $("#service").find("option").remove();
				        	   $("#service").append('<option value="">Choose a Service</option>');
				        	   if(data.services.length>0){
									for(var i=0; i<data.services.length; i++){
										$("#service").append('<option value="'+data.services[i]['id']+'">'+data.services[i]['ServiceName']+'</option>');
									}
					        	}
					        	$("#city").find("option").remove();
					        	 $("#city").append('<option value="">Choose City</option>');
					        	 if(data.city.length>0){
										for(var i=0; i<data.city.length; i++){
											$("#city").append('<option value="'+data.city[i]['UserCity']+'">'+data.city[i]['UserCity']+'</option>');
										}
						        	}
					        }
		            }
		 	 });
		}
		function onChangeServices(){
			var serviceID =$("#service").val();
 			$post = {};
			 $post.serviceID =serviceID;
		 	var base_url = window.location.origin;
		 	 $.ajax ({
					url: base_url + '/homegetcity',
		            type: 'POST',
		            data: $post,
		            cache: false,
		            dataType : "json",
		            success: function (data) {
		            	if(data.result =="success"){
					        	$("#city").find("option").remove();
					        	 $("#city").append('<option value="">Choose City</option>');
					        	 if(data.city.length>0){
										for(var i=0; i<data.city.length; i++){
											$("#city").append('<option value="'+data.city[i]['UserCity']+'">'+data.city[i]['UserCity']+'</option>');
										}
						        	}
					        }
		            }
		 	 });
		}
	 </script>
	@stop
@stop