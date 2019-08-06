<?php namespace User;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator, DB, Mail;
use User as UserModel, Profession as ProfessionModel, Cms as CmsModel, 
	Faq as FaqModel, DoClient as DoClientModel,Memberdetail as MemberdetailModel,
	Milestone as MilestoneModel,UserImage as UserImageModel;

class AuthController extends \BaseController {
	public function doLogin() {
		$email = Input::get('userName');
		$password = Input::get('userPassword');
		$user = UserModel::whereRaw('UserName = ? and UserPassword = md5(?) and UserStatus = ?', array($email, $password,'Active'))->get();
		if (count($user) != 0) {
			Session::set('user_id', $user[0]->id);
			return Redirect::route('user.company');
		} else {
			$alert['msg'] = 'Email & Password is incorrect';
			$alert['type'] = 'danger';
			return Redirect::route('user.home')->with('alert', $alert);
		}
	}
	public function doLogout(){
		  Session::forget('user_id');
        return Redirect::route('user.home');
	}
	public function register(){
		$param['pageNo'] = 6;
		$param['userimage'] = UserImageModel::all();
		$param['professionlist'] = ProfessionModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		$param['profession'] =  ProfessionModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		return View::make('user.store.register')->with($param);
	}
	public function contact(){
		$param['pageNo']=5;
		$param['professionlist'] = ProfessionModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		return View::make('user.store.contact')->with($param);
	}
	public function about(){
		$param['pageNo']=1;
		$param['professionlist'] = ProfessionModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		$param['milestone'] =MilestoneModel::whereRaw(true)->orderBy('SubYear', 'desc')->orderBy('SubMonth', 'desc')->get();
		$param['cms'] = CmsModel::whereRaw(true)->orderBy('AboutOrder', 'asc')->get();
		return View::make('user.store.about')->with($param);
	}
	public function faqs(){
		$param['pageNo']=4;
		$param['professionlist'] = ProfessionModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		$param['faqs'] = FaqModel::all();
		return View::make('user.store.faq')->with($param);
	}
	public function specialoffer(){
		$param['pageNo']=3;
		$param['professionlist'] = ProfessionModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		$param['profession']=ProfessionModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		$sortby = Input::get('sortby');
		$param['sortbyvalue'] =Input::get('sortby');
		if($sortby ==""){
			$param['addservice'] = DB::table('addservice')
									->select(DB::raw('nc_addservice.id as addserviceID, nc_addservice.service_title, nc_addservice.service_description,nc_addservice.image1 as image1,nc_addservice.image2 as image2,
													  nc_addservice.was_price, nc_addservice.now_price, nc_addservice.specialoffer,nc_addservice.image3 as image3,nc_addservice.image4 as image4,nc_addservice.user_id,
												      nc_member.UserName, nc_member.UserCity, nc_member.UserCity,nc_member.UserStatus, nc_service.ServiceName'))->where('specialoffer', '=', '1')
												      ->orderBy(DB::raw('RAND()'))
												      ->leftJoin('member', 'user_id', '=', 'member.id')
												      ->leftJoin('service', 'service_id', '=', 'service.id')
												      ->where('member.UserStatus', '=', 'Active')
													  ->paginate(30);
		}else{
			$param['addservice'] = DB::table('addservice')
									->select(DB::raw('nc_addservice.id as addserviceID, nc_addservice.service_title, nc_addservice.service_description,nc_addservice.image1 as image1,nc_addservice.image2 as image2,
													  nc_addservice.was_price, nc_addservice.now_price, nc_addservice.specialoffer,nc_addservice.image3 as image3,nc_addservice.image4 as image4,nc_addservice.user_id,
												      nc_member.UserName, nc_member.UserCity, nc_member.UserCity, nc_service.ServiceName'))->where('specialoffer', '=', '1')
												      ->orderBy(DB::raw('RAND()'))
												      ->leftJoin('member', 'user_id', '=', 'member.id')
												      ->leftJoin('service', 'service_id', '=', 'service.id')
												      ->where('member.UserStatus', '=', 'Active')
												      ->where ('service.profession_id', '=', $sortby)
												      ->paginate(30);
			$param['addservice'] ->appends(array('sortby' => $sortby));
		}
		return View::make('user.store.specialoffer')->with($param);
	}
	public function service(){
		$param['pageNo']=2;
		$param['professionlist'] = ProfessionModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		$param['service'] = DoClientModel::whereRaw(true)->orderBy('DoOrder', 'asc')->get();
		return View::make('user.store.service')->with($param);
	}
	
	public function contactTo(){
		$rules = ['inputName'  => 'required',
				  'inputEmail' => 'required|email',
				  'inputSubject' => 'required',
				  'inputMessage' => 'required',
		];
		$inputName= Input::get('inputName');
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::back()
			->withErrors($validator)
			->withInput();
		}else{
			 $data = array(
			 		'inputName' =>Input::get('inputName'),
			 		'inputEmail' =>Input::get('inputEmail'),
			 		'inputSubject' =>Input::get('inputSubject'),
			 		'inputMessage' =>Input::get('inputMessage'),
			 		);
			 	 Mail::send('emails.contactsend', $data, function($message){
			 	 	 $message->from('comparejersey1@gmail.com', 'Contact');
					 $message->to( 'admin@compare.je', 'Admin')->subject('contact');
				});
		 	 	$alert['msg'] = 'Invalid username and password';
		 	 	$alert['type'] = 'danger';
		 	return Redirect::route('user.auth.contact')->with('alert', $alert);
		}
	}
	public function registerstore(){
		$usertype =Input::get('radiouser');
		$defaultCheck = Input::get('defaultCheck');
		if($usertype == "c"){
			if($defaultCheck == "1"){
				$rules = ['UserName'  => 'required',
				'profession_id'  => 'required',
				'UserAddress' => 'required',
				'UserCity' => 'required',
				'UserCountry' => 'required',
				'UserPostCode' => 'required',
				'UserPhoneNumber' => 'required',
				//'UserFaxNumber' => 'required',
				'UserEmail' => 'required|email|unique:member',
				//'UserWebsite' => 'required',
				'userimage' => 'required',
				];
			}else{
				$rules = ['UserName'  => 'required',
				'profession_id'  => 'required',
				'UserAddress' => 'required',
				'UserCity' => 'required',
				'UserCountry' => 'required',
				'UserPostCode' => 'required',
				'UserPhoneNumber' => 'required',
				//'UserFaxNumber' => 'required',
				'UserEmail' => 'required|email|unique:member',
				//'UserWebsite' => 'required',
				'AboutImageUrl' => 'required',
				];
			}
		}else if($usertype == "s"){
			$rules = ['UserName'  => 'required',
			'UserAddress' => 'required',
			'UserCity' => 'required',
			'UserCountry' => 'required',
			'UserPostCode' => 'required',
			'UserPhoneNumber' => 'required',
			//'UserFaxNumber' => 'required',
			'UserEmail' => 'required|email|unique:member',
			'userimage' => 'required',
			];
		}
		
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::back()
			->withErrors($validator)
			->withInput();
		}else{
			$check_service =0;
				
			$username = Input::get('UserName');
			$user_find = UserModel::whereRaw('UserName = ?', array($username))->get();
			if (Input::has('user_id')) {
				$id = Input::get('user_id');
				$user = UserModel::find($id);
			}else{
				$user = new UserModel;
				if(count($user_find)!=0){
					$alert['msg'] = 'User has been exist';
					$alert['type'] = 'danger';
					$check_service =1;
				}
			}
			$professions_id = "";
			$ik=1;
			if($usertype == "c"){
				$countProfession = count(Input::get('profession_id'));
				foreach (Input::get('profession_id') as $item) {
					if($countProfession == $ik) {
						$professions_id .= $item ;
					}else{
						$professions_id .= $item .",";
					}
					$ik++;
				}
			}
			if($check_service =="0"){
				if (Input::hasFile('AboutImageUrl')) {
					$filename = str_random(24).".".Input::file('AboutImageUrl')->getClientOriginalExtension();
					Input::file('AboutImageUrl')->move(ABS_LOGO_PATH, $filename);
					$userImageList = $filename;
				}
				$userStatus =  Input::get('UserStatus');
				if($userStatus == ""){
					$userStatus = "InActive";
				}elseif($userStatus == "1"){
					$userStatus = "Active";
				}
					
				if($usertype=="s"){
					$user->UserName = Input::get('UserName');
					$user->UserProfession ="";
					$user->UserEmail = Input::get('UserEmail');
					$user->UserImage =Input::get('userimage');
					$user->UserPhoneNumber = Input::get('UserPhoneNumber');
					$user->UserFaxNumber = Input::get('UserFaxNumber');
					$user->UserAddress = Input::get('UserAddress');
					$user->UserCity = Input::get('UserCity');
					$user->UserCountry = Input::get('UserCountry');
					$user->UserPostCode = Input::get('UserPostCode');
					$user->UserType = $usertype;
					$user->UserStatus =$userStatus;
					$user->UserSocial= "";
					$user->UserSocialTwitter= "";
					$user->UserSocialLinkedin= "";
					$user->UserWebsite ="";
					$user->UserChange = "";
					$user->UserImageType = 1;
					$user->save();
					$insertedId = $user->id;
					$memberDetail = new MemberdetailModel;
					$memberDetail->member_id = $insertedId;
					$memberDetail->aboutus = "";
					$memberDetail->qualification = "";
					$memberDetail->accredited ="";
					$memberDetail->video_url="";
					$memberDetail->image_url="";
					$memberDetail->save();
					
				}else if($usertype=="c"){
					$user->UserName = Input::get('UserName');
					$user->UserProfession =$professions_id;
					$user->UserEmail = Input::get('UserEmail');
					if($defaultCheck == "1") {
						$user->UserImage =Input::get('userimage');
					}else{
						$user->UserImage = $userImageList;
					}
					$user->UserPhoneNumber = Input::get('UserPhoneNumber');
					$user->UserFaxNumber = Input::get('UserFaxNumber');
					$user->UserAddress = Input::get('UserAddress');
					$user->UserCity = Input::get('UserCity');
					$user->UserCountry = Input::get('UserCountry');
					$user->UserPostCode = Input::get('UserPostCode');
					$user->UserType = $usertype;
					$user->UserStatus = $userStatus;
					$user->UserSocial= Input::get('UserSocial');
					$user->UserSocialTwitter = Input::get('UserSocialTwitter');
					$user->UserSocialLinkedin = Input::get('UserSocialLinkedin');
					$user->UserWebsite =Input::get('UserWebsite');
					$user->UserChange = "";
					if($defaultCheck == "1") {
						$user->UserImageType = $defaultCheck;
					}else{
						$user->UserImageType = 0;
					}
					$user->save();
					$insertedId = $user->id;
					$memberDetail = new MemberdetailModel;
					$memberDetail->member_id = $insertedId;
					$memberDetail->aboutus = "";
					$memberDetail->qualification = "";
					$memberDetail->accredited ="";
					$memberDetail->video_url="";
					$memberDetail->image_url="";
					$memberDetail->save();
					
				}
				$UserName = Input::get('UserName');
				$userEmail = Input::get('UserEmail');
				$data = array(
						'username' =>$UserName,
						'email'    =>$userEmail
							
				);
				Mail::send('emails.register', $data, function($message) {
					$message->from("comparejersey1@gmail.com", 'Register');
					$message->to("admin@compare.je", 'Admin')->subject('Register');
				});
				$alert['msg'] = 'User has been saved successfully';
				$alert['type'] = 'success';
			}
		}
		return Redirect::route('user.auth.register')->with('alert', $alert);
	}
	
}