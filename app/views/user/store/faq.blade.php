@extends('user.layout')
	@section('body')
		<div class="container-fluid bg-grey">
	    	<div class="container">
	            <div class="row">
	                <div class="col-lg-12">                
	                    <ol class="breadcrumb">
	                      <li><a href="{{URL::route('user.home')}}">Home</a></li>
	                      <li><a href="{{URL::route('user.auth.faqs')}}">Faqs</a></li>
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
			<div class="no-border">FAQS</div>
		</div>
    	<div class="container">
    		<div class="col-md-9">
    			<div class="col-lg-12">                
    				<div class="title underline bottom-20">
                        <span class="glyphicon glyphicon-align-justify"></span>Faqs
                    </div>
                     <div class="panel-group bottom-10" id="accordion">
                     	<?php 
                     		$countFaqs = count($faqs);
                     		if(isset($faqs)){
                     	?>
                     	<?php for($i=0; $i<$countFaqs; $i++){?>
		                    <div class="panel panel-default">
			                      <div class="panel-heading">
				                       <h4 class="panel-title">
				                          <a class="accordion-toggle <?php if($i==0) {echo "selected";}?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i?>">
				                            <?php echo stripslashes($faqs[$i]['Question']);?>
				                          </a>
				                        </h4>
			                      </div>
		                      <div id="collapse<?php echo $i;?>" class="panel-collapse collapse <?php if($i==0) {echo "in";}?>">
			                        <div class="panel-body">
			                            <?php echo stripslashes($faqs[$i]['Answer']);?>
			                        </div>
		                      </div>
		                    </div>
		                  <?php } }?>  
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