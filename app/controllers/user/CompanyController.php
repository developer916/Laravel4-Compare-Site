<?php namespace User;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator, DB, Mail,File, Request,Response;
use User as UserModel,UserImage as UserImageModel, Memberdetail as MemberdetailModel,
	Image as ImageModel,Profession as ProfessionsModel, Service as ServiceModel,
	AddImage as AddImageModel, Addservice as AddserviceModel, Vourcher as VourcherModel, Rate as RateModel;
class CompanyController extends \BaseController {
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('user_id')) {
				return Redirect::route('user.home');
			}
		});
	}
	public function index(){
		//Session::forget('about');
		$param['pageNo'] = 9;
		
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		$company = UserModel::find(Session::get('user_id'));
		$memberDetail = MemberdetailModel::whereRaw('member_id = ?', array(Session::get('user_id')))->get();
		$param['company'] = $company;
		$param['professionlist'] = ProfessionsModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		$param['professions'] = ProfessionsModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		$param['services'] = ServiceModel::whereRaw(true)->orderby('ServiceName','asc')->get();
		//$param['addservice'] = AddserviceModel::paginate(1);
		$prefix = DB::getTablePrefix();
		$param['addservice'] = DB::table('addservice')
									->select(DB::raw('nc_addservice.id as addserviceID, nc_addservice.service_title, nc_addservice.service_description,nc_addservice.image1 as image1,nc_addservice.image2 as image2,
													  nc_addservice.was_price, nc_addservice.now_price, nc_addservice.specialoffer,nc_addservice.image3 as image3,nc_addservice.image4 as image4,
												      nc_member.UserName, nc_member.UserCity, nc_member.UserCity, nc_member.UserStatus, nc_service.ServiceName'))->where('user_id', '=', Session::get('user_id'))
									->leftJoin('member', 'user_id', '=', 'member.id')
									->leftJoin('service', 'service_id', '=', 'service.id')
									->where('member.UserStatus', '=', 'Active')
		 							->paginate(12);
		$param['companyImage'] = ImageModel::whereRaw('addservice_id = ?', array(Session::get('user_id')))->get();
		$param['memberDetail'] =$memberDetail; 
		$param['rate'] = RateModel::whereRaw('receive_id =?',array(Session::get('user_id')))->get();
		if(($company->UserType == "s") || ($company->UserType == "c" && $company->UserImageType=="1")){
			$userImage = UserImageModel::find($company->UserImage);
			$param['userImage'] =$userImage; 
		}
		return View::make('user.company.index')->with($param);
	}
	public function userimagestore(){
		$rules = array('ProfileImage'  => 'required|image|max:1024');
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			$valid =$validator->errors();
			$valid->add('profileImageError', 'profileImageError');
			return Redirect::back()->withErrors($valid)->withInput();
		}else{
			if (Input::hasFile('ProfileImage')) {
				$filename = str_random(24).".".Input::file('ProfileImage')->getClientOriginalExtension();
				Input::file('ProfileImage')->move(ABS_LOGO_PATH, $filename);
				$userImageList = $filename;
			}
			$user =  UserModel::find(Session::get('user_id'));
			$user->UserImage = $userImageList;
			$user->UserImageType = "";
			$user->save();
			$alert['msg'] = 'Profile image has been saved successfully';
			$alert['type'] = 'success';
			$alert['list'] = 'profileImageSuccess';
		}
		return Redirect::route('user.company')->with('alert', $alert);
	}
// user about us page content//	
	public function useraboutus(){
		$rules = array('aboutus'  => 'required');
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			$valid =$validator->errors();
			$valid->add('aboutError', 'aboutError');
			return Redirect::back()->withErrors($valid)->withInput();
		}else{
			Session::forget('about');
			$userfind =  MemberdetailModel::whereRaw('member_id = ?', array(Session::get('user_id')))->get();
			$user =MemberdetailModel::find($userfind[0]->id) ;
			$user->aboutus = Input::get('aboutus');
			$user->save();
			$alert['msg'] = 'About us has been saved successfully';
			$alert['type'] = 'success';
			$alert['list'] = 'aboutSuccess';
		}
		return Redirect::route('user.company')->with('alert', $alert);
	}
	//user about us page qualification start//
	public function userqualification(){
		$rules = array('qualificationContent'  => 'required');
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			$valid =$validator->errors();
			$valid->add('qualificationError', 'qualificationError');
			return Redirect::back()->withErrors($valid)->withInput();
		}else{
			$userfind =  MemberdetailModel::whereRaw('member_id = ?', array(Session::get('user_id')))->get();
			$user =MemberdetailModel::find($userfind[0]->id) ;
			$user->qualification = Input::get('qualificationContent');
			$user->save();
			$alert['msg'] = 'Qualifications Held has been saved successfully';
			$alert['type'] = 'success';
			$alert['list'] = "qualificationSuccess";
		}
		return Redirect::route('user.company')->with('alert', $alert);
	}
	
	//user about us page accredited start//
	public function useraccredited(){
		$rules = array('AccreditedContent'  => 'required');
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			$valid =$validator->errors();
			$valid->add('qualificationError', 'acceditedError');
			return Redirect::back()->withErrors($valid)->withInput();
		}else{
			$userfind =  MemberdetailModel::whereRaw('member_id = ?', array(Session::get('user_id')))->get();
			$user =MemberdetailModel::find($userfind[0]->id) ;
			$user->accredited = Input::get('AccreditedContent');
			$user->save();
			$alert['msg'] = 'Accredited Bodies has been saved successfully';
			$alert['type'] = 'success';
			$alert['list'] = "AccreditedSucccess";
		}
		return Redirect::route('user.company')->with('alert', $alert);
	}
	//user video image upload//
	public function uservideoimage(){
		$rules = array('VideoImage'  => 'required|image|max:1024');
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			$valid =$validator->errors();
			$valid->add('videoImageError', 'videoImageError');
			return Redirect::back()->withErrors($valid)->withInput();
		}else{
			Session::forget('about');
			if (Input::hasFile('VideoImage')) {
				$filename = str_random(24).".".Input::file('VideoImage')->getClientOriginalExtension();
				Input::file('VideoImage')->move(ABS_LOGO_PATH, $filename);
				$userImageList = $filename;
			}
			$userfind =  MemberdetailModel::whereRaw('member_id = ?', array(Session::get('user_id')))->get();
			$user =MemberdetailModel::find($userfind[0]->id) ;
			$user->image_url = $userImageList;
			$user->save();
			$alert['msg'] = 'Video image has been saved successfully';
			$alert['type'] = 'success';
			$alert['list'] = "videoImageSuccess";
		}
		return Redirect::route('user.company')->with('alert', $alert);
	}
	//video file upload//
	public function uservideofile(){
		$rules = array('videoFile'  => 'required|mimes:mp4,webm,ogv');
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			$valid =$validator->errors();
			$valid->add('VideoFile', 'VideoFileError');
			return Redirect::back()->withErrors($valid)->withInput();
		}else{
			if (Input::hasFile('videoFile')) {
				$filename = str_random(24).".".Input::file('videoFile')->getClientOriginalExtension();
				Input::file('videoFile')->move(ABS_LOGO_PATH, $filename);
				$userImageList = $filename;
				
			}
			$userfind =  MemberdetailModel::whereRaw('member_id = ?', array(Session::get('user_id')))->get();
			$user =MemberdetailModel::find($userfind[0]->id) ;
			$user->video_url = $userImageList;
			$user->save();
			$alert['msg'] = 'Video image has been saved successfully';
			$alert['type'] = 'success';
			$alert['list'] = "videoFileSuccess";
		}
		return Redirect::route('user.company')->with('alert', $alert);
	}
	// video file delete//
	public function uservideodelete(){
		$userfind =  MemberdetailModel::whereRaw('member_id = ?', array(Session::get('user_id')))->get();
		$user =MemberdetailModel::find($userfind[0]->id) ;
		$user->video_url = "";
		$user->image_url = "";
		$user->save();
		$alert['msg'] = 'Video  has been deleted successfully';
		$alert['type'] = 'success';
		$alert['list'] = "videoDeleteSuccess";
		return Redirect::route('user.company')->with('alert', $alert);
	}
	//company image upload//
	public function companyImageUpload(){
		$rules = array('CompanyImage'  => 'required');
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			$valid =$validator->errors();
			$valid->add('CompanyImageError', 'CompanyImageError');
			return Redirect::back()->withErrors($valid)->withInput();
		}else{
			if (Input::hasFile('CompanyImage')) {
				$filename = str_random(24).".".Input::file('CompanyImage')->getClientOriginalExtension();
				Input::file('CompanyImage')->move(ABS_LOGO_PATH, $filename);
				$userImageList = $filename;
			}
			if (Input::has('image_id')) {
				$id = Input::get('image_id');
				$image = ImageModel::find($id);
			}else{
				$image = new ImageModel;
			}
			$image->addservice_id = Session::get('user_id');
			$image->imageUrl = $userImageList;
			$image->save();
			$alert['msg'] = 'Company Image has been saved successfully';
			$alert['type'] = 'success';
			$alert['list'] = "CompanyImageSuccess";
		}
		return Redirect::route('user.company')->with('alert', $alert);
	}
	//company image delete///
	function companyImageDelete(){
		$ID = Input::get('image_id');
		try {
			ImageModel::find($ID)->delete();
		
			$alert['msg'] = 'Company image has been deleted successfully';
			$alert['type'] = 'success';
			$alert['list'] = 'CompanyImageDeleteSuccess';
		} catch(\Exception $ex) {
			$alert['msg'] = 'Company image has been already used';
			$alert['type'] = 'danger';
		}
		return Redirect::route('user.company')->with('alert', $alert);
	}
	//company  profile edit//
	function companyeditprofile(){
		$company = UserModel::find(Session::get('user_id'));
		if($company->UserType == "c"){
			$rules = [
						'UserAddress' => 'required',
						'UserCity' => 'required',
						'UserCountry' => 'required',
						'UserPostCode' => 'required',
						'UserPhoneNumber' => 'required',
						'UserEmail' => 'required|email',
						'UserWebsite' => 'required',
				];
		}elseif($company->UserType == "s"){
			$rules = [
					'UserAddress' => 'required',
					'UserCity' => 'required',
					'UserCountry' => 'required',
					'UserPostCode' => 'required',
					'UserPhoneNumber' => 'required',
					'UserEmail' => 'required|email',
					];
		}
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			$valid =$validator->errors();
			$valid->add('CompanyProfileError', 'CompanyProfileError');
			return Redirect::back()
			->withErrors($valid)
			->withInput();
			
		}else{
			$company->UserPhoneNumber = Input::get('UserPhoneNumber');
			$company->UserFaxNumber = Input::get('UserFaxNumber');
			$company->UserEmail = Input::get('UserEmail');
			$company->UserAddress = Input::get('UserAddress');
			$company->UserCity = Input::get('UserCity');
			$company->UserCountry = Input::get('UserCountry');
			$company->UserPostCode = Input::get('UserPostCode');
			if($company->UserType == "c"){
				$company->UserWebsite = Input::get('UserWebsite');
				$company->UserSocial = Input::get('UserSocial');
				$company->UserSocialTwitter = Input::get('UserSocialTwitter');
				$company->UserSocialLinkedin = Input::get('UserSocialLinkedin');
			}
			$company->save();
			$alert['msg'] = 'User has been saved successfully';
			$alert['type'] = 'success';
			$alert['list'] = 'CompanyProfileSuccess';
		}
		return Redirect::route('user.company')->with('alert', $alert);
	}
	public function companygetservice(){
		if(Request::ajax()){
			$professionID = Input::get('professionID');
			$servicesList = ServiceModel::whereRaw('profession_id = ?', array($professionID))->orderby('ServiceName','asc')->get();
			$data = array('result' => 'success', 'services' =>$servicesList);
			return Response::json($data);
		}
	}
	public function companyproductimage(){
		if(Request::ajax()){
			if (Input::hasFile('image')) {
				$filename = str_random(24).".".Input::file('image')->getClientOriginalExtension();
				Input::file('image')->move(ABS_LOGO_PATH, $filename);
				$userImageList = $filename;
				$image = new AddImageModel;
				$image ->service_id = Input::get('service_id');
				$image->user_id =Session::get('user_id');
				$image->imageUrl = $userImageList;
				$image->save();
				$last_insert_id = $image->id;
				$data= "";
				$data ='<div class="row" style="margin-left:15px; margin-right:15px;">
						<a class="thumbnail fancybox-button zoomer" data-rel="fancybox-button" href="/assets/logos/"'.$userImageList.'"> 
						<span class="overlay-zoom1">';
				$data .= '<img src="/assets/logos/'.$userImageList.'" class ="img-responsive1">';
				$data .= '<div class="zoom-icon"></div></span></a>';
				$data .='<div align="right">
							<form action="'. "http://" . $_SERVER['SERVER_NAME']."/company/productdelete".'" method="post" enctype="multipart/form-data">
								<input type="hidden" name="image_id" value="'.$last_insert_id.'">
 								<input type="button" class="btn btn-danger" value="Delete" onclick="deleteImage(this)" id="productDelete" name="productDelete">
							</form>
						</div>
					</div>';
				
				
				$data .= "";
			} else{
				$data="";
			}
			return Response::json($data);
		}
	}
	public function productdelete(){
		if(Request::ajax()){
			$imageID = Input::get('image_id');
			AddImageModel::find($imageID)->delete();
			$data =array('result' => 'success');
			return Response::json($data);
		}
	}
	public function getSerivce(){
		if(Request::ajax()){
			$serviceID = Input::get('serviceID');
			$addservices = 	AddserviceModel::whereRaw('service_id=?', array($serviceID))->get();
			if(count($addservices) >0){
				$data=array('result' =>'exist');
			}else{
				$data=array('result' =>'success');
			}
			return Response::json($data);
		}
	}
	///product image /////
	public function productimage(){
		if(Request::ajax()){
			$rules = [
					'imagefile' => 'required|image|max:1024',
			];
			$validator = Validator::make(Input::all(), $rules);
			if ($validator->fails()) {
				$data = array('result' =>'error');
			}else{
				$id = Input::get('productID');
				$imageCount= Input::get('imageCount');	
				if (Input::hasFile('imagefile')) {
						$filename = str_random(24).".".Input::file('imagefile')->getClientOriginalExtension();
						Input::file('imagefile')->move(ABS_LOGO_PATH, $filename);
						$userImageList = $filename;
				}else{
					$userImageList = "";
				}
				$imagecountlist = "image".$imageCount;
				$addservice =AddserviceModel::find($id); 
				$addservice->$imagecountlist = $userImageList;
				$addservice->save();
				$data = array('result' =>'success' , 'imagelist' => $userImageList, 'count' => $imageCount);
			}
		  return Response::json($data);
		}
	}
	///add service///
	public function addService(){
		$rules = [
					'professions' => 'required',
					'services' => 'required',
					'productname' => 'required',
					'productdescription' => 'required',
					'nowprice' => 'required',
					];
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			$valid =$validator->errors();
			$valid->add('addserviceError', 'addserviceError');
			return Redirect::back()
			->withErrors($valid)
			->withInput();
		}else{
			if (Input::has('service_id')) {
				$id = Input::get('service_id');
				$product = AddserviceModel::find($id);
			}else{
				$product = new AddserviceModel;
			}
			$serviceID = Input::get('services');
			$specialoffer =Input::get('specialOffer');
			$specialofferVoucher = Input::get('specialOfferVoucher');
			$product->user_id = Session::get('user_id');
			$product->profession_id = Input::get('professions');
			$product->service_id = Input::get('services');
			$product->service_title = Input::get('productname');
			$product->service_description = Input::get('productdescription');
			$product->now_price = Input::get('nowprice');
			
			if($specialoffer ==1){
				$product->specialoffer = "1";
				$product->was_price = Input::get('wasprice');
				$product->expiry_date = Input::get('pickupDate');
				if($specialofferVoucher == "1"){
					$product->voucherenable= $specialofferVoucher;
				}else{
					$product->voucherenable= "";
				}
			}else{
				$product->specialoffer = "";
				$product->was_price = "";
				$product->expiry_date = "";
				$product->voucherenable= "";
			}
			$product->image1 = "";
			$product->image2 = "";
			$product->image3 = "";
			$product->image4 = "";
			
			$product->save();
			$product_id = $product->id;
			if($specialoffer == 1){
				$vourcher = new VourcherModel;
				$vourcher->product_id = $product_id;
				$vourcher->service_id = $serviceID;
				$vourcher->save();
			}
			$alert['msg'] = 'Product has been saved successfully';
			$alert['type'] = 'success';
			$alert['list'] = 'addserviceSuccess';
		}
		return Redirect::route('user.company')->with('alert', $alert);
	}
	
	public function addservicedelete($id){
		
		try {
			AddImageModel::whereRaw('addservice_id = ?', array($id))->delete();
			AddserviceModel::find($id)->delete();
			$alert['msg'] = 'Product has been deleted successfully';
			$alert['type'] = 'success';
			$alert['list'] = 'prodcutdelete';
		} catch(\Exception $ex) {
			$alert['msg'] = 'This Product has been already used';
			$alert['type'] = 'danger';
			$alert['list'] = 'prodcutdelete';
		}
		return Redirect::route('user.company')->with('alert', $alert);
	}
  public function edit($id){
  		$param['pageNo'] = 9;
  		if ($alert = Session::get('alert')) {
  			$param['alert'] = $alert;
  		}
  		$param['professionlist'] = ProfessionsModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
  		$company = UserModel::find(Session::get('user_id'));
  		if(($company->UserType == "s") || ($company->UserType == "c" && $company->UserImageType=="1")){
  			$userImage = UserImageModel::find($company->UserImage);
  			$param['userImage'] =$userImage;
  		}
  		$param['company'] = $company;
  		$param['addservice'] = AddserviceModel::find($id);
  		$param['productID'] = $id;
  	return View::make('user.company.edit')->with($param);
  }
  public function productdetail(){
		  	$rules = [
					  	'productname' => 'required',
					  	'productdescription' => 'required',
		  	];
  			$validator = Validator::make(Input::all(), $rules);
			  	if ($validator->fails()) {
			  		$valid =$validator->errors();
			  		$valid->add('productdetailError', 'productdetailError');
			  		return Redirect::back()
			  		->withErrors($valid)
			  		->withInput();
			  	}else{
			  		
			  		if(Input::has('productID')){
			  			$id= Input::get('productID');
			  			$addservice = AddserviceModel::find($id);
			  			$addservice->service_title = Input::get('productname');
			  			$addservice->service_description = Input::get('productdescription');
			  			$addservice->save();
			  			
			  			$alert['msg'] = 'Product detail  has been updated successfully';
			  			$alert['type'] = 'success';
			  			$alert['list'] = 'productDetailSuccess';
			  		}
		 	}
		 	return Redirect::back()->with('alert', $alert);
  }
  public function productprice(){
  		$id = Input::get('productID');
  		$addservice = AddserviceModel::find($id);
  		if($addservice->specialoffer == "1"){
  			$rules = [
		  			'wasprice' => 'required',
		  			'nowprice' => 'required',
		  			'pickupDate' => 'required',
  			];
  		}else{
  			$rules = [
	  			'nowprice' => 'required',
  			];
  		}
  		$validator = Validator::make(Input::all(), $rules);
  		if ($validator->fails()) {
  			$valid =$validator->errors();
  			$valid->add('productpriceError', 'productpriceError');
  			return Redirect::back()
  			->withErrors($valid)
  			->withInput();
  		}else{
  			if($addservice->specialoffer == "1"){
  				$addservice->was_price = Input::get('wasprice');
  				$addservice->expiry_date = Input::get('pickupDate');
  			}
  			$addservice->now_price = Input::get('nowprice');
  			;
  			$addservice->save();
  			
  			$alert['msg'] = 'Product Price  has been updated successfully';
  			$alert['type'] = 'success';
  			$alert['list'] = 'productPriceSuccess';
  		}
  		return Redirect::back()->with('alert', $alert);
  }
  		
}