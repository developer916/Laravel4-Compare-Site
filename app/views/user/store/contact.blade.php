@extends('user.layout')
	@section('custom-styles')
		<style>
			#map-canvas{
				width:100%;
				height:400px;
			}
		</style>
		
	@stop
	@section('body')
	<div class="container-fluid bg-grey">
    	<div class="container">
            <div class="row">
                <div class="col-lg-12">                
                    <ol class="breadcrumb">
                      <li><a href="{{URL::route('user.home')}}">Home</a></li>
                      <li><a href="{{URL::route('user.auth.contact')}}">Contact Us</a></li>
                    </ol>     
                </div>                                
            </div>
        </div>
    </div>
	  <div class="container-fluid bottom-20 map">
            <div class="row">
            	<div id="map-canvas">
                	
                </div>
            </div>    
   	 </div>
   	   <div class="container">   
            <div class="row bottom-10">
            	<div class="col-lg-12">
                	<h1 class="underline">Contact Us</h1>
                </div>
            </div>  
            
            <div class="row bottom-10">
            	<div class="col-lg-8">
                	<p>
                		At Compare.je we are committed to providing you with the best customer service possible.</p>
                	 <p>   
                	    If you require, we will assist you with everything from setting up your Company Profile page, listing your Services and amending any information on your account at your request.</p>
					<p> 
						At Compare.je we appreciate your feedback to enable us to improve our service to you.</p>
					<p> 	
						TO REQUEST NEW PROFESSIONS OR SERVICES PLEASE USE THIS CONTACT FORM.
                	</p>
                    
                    <div class="post-title">
                       <h4><span class="fa fa-pencil fa-flip-horizontal"></span>Write to us</h4>
                    </div>
                  	<?php if (isset($alert)) { ?>
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
                    <form name="contactform" method="post" action="{{URL::route('user.auth.contactTo')}}" class="bottom-20" role="form">
                        <div class="form-group">
                                <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                                <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                                <input type="text" class="form-control" id="inputSubject" name="inputSubject" placeholder="Subject Message" required>
                        </div>
                        <div class="form-group">
                                <textarea class="form-control" rows="4" id="inputMessage" name="inputMessage" placeholder="Your message..." required></textarea>
                        </div>
                        <div class="form-group">
                                <button type="submit" class="btn btn-flippy">Send Message</button>
								<button type="reset" class="btn">Reset</button>
                        </div>
                    </form> 
                </div>
                
            	<div class="col-lg-4">
                	<div class="contact-info"><span class="glyphicon glyphicon-map-marker"></span>Address</div>St Helier Jersey Channel Islands
                	<div class="contact-info padding-top"><span class="glyphicon glyphicon-envelope"></span> E-mail</div>admin@compare.je
                    <div class="contact-info padding-top"><span class="glyphicon glyphicon-globe"></span> Website</div>www.compare.je
                    <div class="contact-info padding-top"><span class="glyphicon glyphicon-time"></span> Working Hours</div>9AM - 6PM , Monday - Saturday

                </div>                
            </div>                          
            
   </div> 
	@stop
	@section('custom-scripts')
		 {{ HTML::script('//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&sensor=false') }}
		 <script type="text/javascript">
		 $(document).ready(function(){
			 initialize();
			});
		 	function initialize() {
			  var mapOptions = {
			    zoom: 14,
			    center: new google.maps.LatLng(49.186822,-2.1065682),
				mapTypeId: google.maps.MapTypeId.ROADMAP
				
			  };
				map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
				myLatlng = new google.maps.LatLng( 49.186822,-2.1065682);
				marker_origin = new google.maps.Marker({
					position: myLatlng,
					draggable:false,
					map: map	      
					});
				var infowindow = new google.maps.InfoWindow({
					  content:"Compare Jersey!"
					  });

					infowindow.open(map,marker_origin);
									
			 }
		 </script>
		 
	@stop
@stop