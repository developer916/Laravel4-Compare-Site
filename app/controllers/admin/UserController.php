<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator,File,Mail;
use User as UserModel, Profession as ProfessionModel, UserImage as UserImageModel, Memberdetail as MemberdetailModel;
class UserController extends \BaseController {
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
	public function index() {
		$param['user'] = UserModel::get();
		$param['pageNo'] = 4;
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		return View::make('admin.user.index')->with($param);
	}
	public function create(){
		$param['pageNo'] = 4;
		$param['userimage'] = UserImageModel::all();
		$param['profession'] = ProfessionModel::all();
		return View::make('admin.user.create')->with($param);
	}
	public function store(){
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
				'UserFaxNumber' => 'required',
				'UserEmail' => 'required|email|unique:member',
				'UserWebsite' => 'required',
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
				'UserFaxNumber' => 'required',
				'UserEmail' => 'required|email|unique:member',
				'UserWebsite' => 'required',
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
			'UserFaxNumber' => 'required',
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
		return Redirect::route('admin.user')->with('alert', $alert);
	}
	
	public function edit($id){
		$param['pageNo'] = 4;
		$param['user'] = UserModel::find($id);
		return View::make('admin.user.edit')->with($param);
	}
	
	public function set(){
		$rules = ['UserName'  => 'required',
				   'UserPassword' => 'required',
				];
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::back()
			->withErrors($validator)
			->withInput();
		}else{
			$user_id = Input::get('user_id');
			$UserName = Input::get('UserName');
			$UserPassword = Input::get('UserPassword');
			
			$user = UserModel::find($user_id);
			$userEmail = $user->UserEmail;
			$user->UserName = $UserName;
			$user->UserPassword = md5($UserPassword);
			$user->UserChange = $UserPassword;
			$user->UserStatus='Active';
			$user->save();
			
			$data = array(
					'username' =>$UserName,
					'password' =>$UserPassword,
					'email'    =>$userEmail
					
					);
			Mail::send('emails.setpassword', $data, function($message) use ($userEmail){
				$message->from('comparejersey1@gmail.com', 'Admin');
				$message->to($userEmail, 'User')->subject('Admin');
			});
			$alert['msg'] = 'User has been updated successfully';
			$alert['type'] = 'success';
			
		}
		return Redirect::route('admin.user')->with('alert', $alert);
	}
	public function status(){
		$user_id = Input::get('user_id');
		$UserSendStatus = Input::get('status');
		if($UserSendStatus == "0") {
			$UserStatus="Active";
		}elseif($UserSendStatus == "1"){
			$UserStatus="InActive";
		}
		$user = UserModel::find($user_id);
		$user->UserStatus = $UserStatus;
		$user->save();
		$alert['msg'] = 'User Status has been changed successfully';
		$alert['type'] = 'success';
		return Redirect::route('admin.user')->with('alert', $alert);
	}
	public function delete($id){
		try {
			UserModel::find($id)->delete();
			 
			$alert['msg'] = 'User has been deleted successfully';
			$alert['type'] = 'success';
		} catch(\Exception $ex) {
			$alert['msg'] = 'User has been already used';
			$alert['type'] = 'danger';
		}
		return Redirect::route('admin.user')->with('alert', $alert);
	}
}