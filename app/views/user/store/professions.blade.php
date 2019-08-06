@extends('user.layout')
	@section('body')
		<div class="container-fluid bg-grey">
	    	<div class="container">
	            <div class="row">
	                <div class="col-lg-12">                
	                    <ol class="breadcrumb">
	                      <li><a href="{{URL::route('user.home')}}">Home</a></li>
	                      <li>Profession List</li>
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
			<div class="no-border">Profession Search Result</div>
			<div class="text-center"><strong><?php echo $profession->ProfessionName;?></strong></div>
		</div>
		<div class="container">
			<div class="row">
				<?php 
					for($i=0; $i<count($addservice); $i++){
				?>
					<div class="col-xs-12 col-md-3 col-sm-6 textAlignLeft">
 						<div class="min-box1 paddingEmpty" >
						 	<div class="col-md-12 profHeaderImage">
						 		<div class="search_restult_company_prof">
						 			<?php 
						 				$imageurl = "";
						 				if($addservice[$i]->ImageUrl !="") {
											$imageurl = $addservice[$i]->ImageUrl;
										}else if($addservice[0]->UserImage){
											$imageurl = $addservice[$i]->UserImage;
										}
						 			?>
						 			<img src="/assets/logos/<?php echo $imageurl?>" alt="" class="profHeaderImageShow">
						 		</div>
						 		<div class="search_result_company_list">
						 		 	<a href="{{ URL::route('user.company.companyprofileview', $addservice[$i]->user_id) }}" class=" profHeaderButton btn btn-primary rt-marg " >Company Profile</a>
						 		</div>
							</div>
							<div class="col-md-12 profHeaderBlue" ></div> 
						 	<div class="col-md-12 profHeaderWhiteBlue" >
						 		<h3 class="profHeaderebsiteUrl" >
							 		<?php
									$companyUserWebsite =$addservice[$i]->UserWebsite;
									if(strtoupper(substr($companyUserWebsite,0,5))=="HTTPS"){
										$companyUserWebsite1 = substr($companyUserWebsite, 8);
										echo '<a href="'.$companyUserWebsite.'" target="_blank" style ="color:white">'.$companyUserWebsite1.'</a>';
									} elseif(strtoupper(substr($companyUserWebsite,0,4))=="HTTP"){
										$companyUserWebsite1 = substr($companyUserWebsite, 7);
										echo '<a href="'.$companyUserWebsite.'" target="_blank" style ="color:white">'.$companyUserWebsite1.'</a>';
									}else{
										echo '<a href="http://'.$companyUserWebsite.'" target="_blank" style ="color:white">'.$companyUserWebsite.'</a>';
									}?>
						 		</h3>
						 	</div> 
						 	<div class="col-md-12 profWhiteBlack"></div>
						 	<div class="col-md-12 profBlack"></div>
						 	<div class="col-md-12 profWhiteBlack"></div>
						 	<div class="col-md-12 profBody" >
						 		<div class="col-md-8 profLeftBody" >
							 		<p  class ="profLeftBodyHeaderFont"><?php //echo  $addservice[$i]->service_title;?></p>
							 		 <span> <?php if($addservice[$i]->UserAddress !="") { echo $addservice[$i]->UserAddress; echo "<br>";}?></span>
						             <span> <?php if($addservice[$i]->UserCity !="")   	{ echo $addservice[$i]->UserCity; echo "<br>";}?></span>
						             <span><?php  if($addservice[$i]->UserCountry !="")  { echo $addservice[$i]->UserCountry; echo "<br>";}?></span>
						             <span><?php  if($addservice[$i]->UserPostCode !="") { echo $addservice[$i]->UserPostCode;}?></span>
						             <br>
									 <br>		        
					        		<span class="emailFontsize">t:</span> <span class="fontSize10"> <?php echo $addservice[$i]->UserPhoneNumber;?></span><br>
					        		<span class="emailFontsize">e:</span> <span class="fontSize10"> <?php echo $addservice[$i]->UserEmail;?></span><br>
					        		<span class="emailFontsize">w:</span> <span class="fontSize10"><?php echo $addservice[$i]->UserWebsite;?></span><br>
					        	</div>
					        	<div class="profRightBody1"> </div>
		      					<div class="profRightBody2"></div>
						 	</div>
 						</div>
 					</div>
				<?php }?>
			</div>
		</div>
		
	@stop
@stop