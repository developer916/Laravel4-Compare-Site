@extends('main')	
	@section('title')
		Compare.je
	@stop
	
	@section('styles')
			
		{{ HTML::style('/assets/assest_view/dist/css/bootstrap.css') }}
		{{ HTML::style('/assets/assest_view/dist/css/bootstrap.min.css') }}
		{{ HTML::style('/assets/assest_view/css/default.css') }}
		{{ HTML::style('/assets/assest_view/css/blue.css') }}
		{{ HTML::style('/assets/assest_view/css/animations.css') }}
		{{ HTML::style('/assets/assest_view/css/prettyPhoto.css') }}
		{{ HTML::style('/assets/assest_view/css/fraction/fractionslider.css') }}
		{{ HTML::style('/assets/assest_view/font-awesome/css/font-awesome.css') }}
		{{HTML::style('//fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700itali')}}
		{{HTML::style('//fonts.googleapis.com/css?family=Oxygen:400,700,300')}}
		<noscript>
			{{ HTML::style('/assets/assest_view/css/nojs.css') }}
		</noscript>
		{{ HTML::style('/assets/assest_view/css/jquery.fancybox.css') }}
		{{ HTML::style('/assets/assest_view/css/forestchange.css') }}
		{{ HTML::style('/assets/assest_view/css/forestresponsive.css') }}
	@stop
	@section('content')
		 <body style="background:white; min-height:100%;">
		 	<div class="container">
		 		<div class="row">
			 		<div class="col-md-12">
			 			<div class="row">
				 			<div class="col-md-4 col-md-offset-4 text-center">
				 				<a href="javascript:void(0)" onclick="onPrint()">
				 					Print &nbsp; &nbsp; <img src="/assets/assest_view/img/Fotolia_Printer_Button_XS.jpg" style="width:50px; height:auto">
				 				</a>
				 			</div>
			 			</div>
			 		</div>
			 		
			 		<div class="col-md-12" style="border:5px solid black;">
			 			<div class="row">
			 				<div class="col-md-12">
			 					<div class="row">
				 					<div class="col-md-4 col-md-offset-4 text-center">
					 					<h4> Vourcher I.D - <?php echo $vourcher[0]->id?></h4>	
					 				</div>
			 					</div>
			 				</div>
			 				<div class="col-md-12 margin-top-20" >
			 					<div class="row">
			 							<div class="col-md-5 col-sm-5 col-xs-12 margin-top-20">
			 								<img src="/assets/assest_view/images/asm-logo.png" style="width:100%">
			 							</div>
			 							<div class="col-md-6 col-sm-5 col-xs-12">
			 								<img src="/assets/assest_view/images/Untitled.gif" style="width:100%">
			 							</div>
			 					</div>
			 				</div>
			 				<div class="col-md-12">
			 					<div class="col-md-12" style="border-bottom:5px solid  black;">
			 							<h4 style="color:#1fb4da">FREE VOUCHER</h4>
			 					</div>
			 				</div>
			 				
			 				<div class="col-md-12 margin-top-20">
			 					<div class="row">
			 						<div class="col-md-5 col-sm-5 col-xs-5 width100" >
			 							<p  class="contol-label"><strong>Product Name:</strong></p>
			 							<p  class="contol-label"><?php echo $vourcher[0]->service_title;?></p>
			 						</div>
			 						<div class="col-md-5 col-sm-5  col-xs-5 width100">
			 							<p  class="contol-label"><strong>Company Name:</strong></p>
			 							<p  class="contol-label"><?php echo $vourcher[0]->UserName;?></p>
			 						</div>
			 						<div class="col-md-2 col-sm-2  col-xs-2 width100">
			 							<p  class="contol-label"><strong>Price:</strong></p>
			 							<p  class="contol-label"><?php echo $vourcher[0]->now_price;?></p>
			 						</div>
			 					</div>
			 					<div class="row margin-top-20">
			 						<div class="col-md-12">
			 							<p  class="contol-label"><strong>Product Description:</strong></p>
			 							<p  class="contol-label"><?php echo $vourcher[0]->service_description;?></p>
			 						</div>
			 					</div>
			 				</div>
			 				<div class="row bottom-40"></div>
			 				<div class="row">
			 					<div class="col-md-12 text-center">
			 						<h4 style="color:#1fb4da">Fine Print:</h4>
			 					</div>
			 					<div class="col-md-12">
			 						<div class="col-md-2">
			 							<p  class="contol-label"><strong>Expires:</strong></p>
			 							<p  class="contol-label"><?php echo $vourcher[0]->expiry_date;?></p>
			 						</div>
			 						<div class="col-md-10">
			 							<p class="control-label">
			 								This voucher can only be used once and cannot be exchanged for cash and no change will be given. Compare Jersey are neither responsible nor liable for any services offered by a third party. Please quote Compare Jersey when making a booking, quoting the voucher I.D  
			 							</p>
			 						</div>
			 					</div>
			 				</div>
			 			</div>
			 		</div>
			 		<div class="bottom-40"></div>
				</div>		 	
		 	</div>
		 </body>
	@stop
	@section ('scripts')
 		 {{ HTML::script('/assets/assest_view/assets/js/jquery.js') }}
 		 {{ HTML::script('//code.jquery.com/jquery-migrate-1.2.0.js')}}
 		 {{ HTML::script('/assets/assest_view/dist/js/bootstrap.min.js') }}
 		 {{ HTML::script('/assets/assest_view/js/custome.js') }}
 		 {{ HTML::script('/assets/assest_view/js/fraction/jquery.fractionslider.js') }}
 		 {{ HTML::script('/assets/assest_view/js/jquery.flippy.js') }}
 		 {{ HTML::script('/assets/assest_view/js/jquery.mixitup.min.js') }}
 		 {{ HTML::script('/assets/assest_view/js/jquery.tabSlideOut.v1.3.js') }}
 		 {{ HTML::script('/assets/assest_view/js/jquery.style-switcher.js') }}
 		 {{ HTML::script('/assets/assest_view/js/jquery.prettyPhoto.js') }}
 		 {{ HTML::script('/assets/assest_view//js/app.js') }}
 		 {{ HTML::script('/assets/assest_view/js/jquery.fancybox.js') }}
 	@stop
 	@section ('custom-scripts')
 		<script type="text/javascript">
				function onPrint(){
					window.print();
				}
		</script>
 		
 	@stop
@stop