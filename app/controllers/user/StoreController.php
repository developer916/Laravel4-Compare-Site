<?php namespace User;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator, DB, Mail,File, Request,Response;
use User as UserModel,UserImage as UserImageModel, Memberdetail as MemberdetailModel,
	Image as ImageModel,Profession as ProfessionsModel, Service as ServiceModel, Rate as RateModel,
	AddImage as AddImageModel, Addservice as AddserviceModel, Cms as CmsModel, Client as ClientModel;

class StoreController extends \BaseController {
	public  function home(){
		$param['pageNo'] = 0;
		$param['professionlist'] = ProfessionsModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		$originalDate = date("d/m/Y");
		$sql_select = "delete FROM nc_addservice WHERE STR_TO_DATE(expiry_date,'%d/%m/%Y') < STR_TO_DATE('$originalDate','%d/%m/%Y')  AND specialoffer ='1' AND expiry_date !='' and  voucherenable='1'";
		
		//DB::delete($sql_select);
		//DB::table('addservice')->where(STR_TO_DATE(expiry_date,'%d/%m/%Y'), '<',  STR_TO_DATE('$originalDate','%d/%m/%Y'))->where('specialoffer', '=', '1')->delete();
		//AddserviceModel::whereRaw('STR_TO_DATE(expiry_date,"%d/%m/%Y") < ? and specialoffer = 1', array(STR_TO_DATE("$originalDate","%d/%m/%Y")))->delete();
		DB::select($sql_select);
		$sql_List = "select t1.* from 
							( select * from nc_addservice) as t1 
							left join nc_member as t2 on t1.user_id=t2.id
							where t2.UserStatus='InActive'";
		$DBList = DB::select($sql_List);
		for($i=0; $i<count($DBList); $i++){
			$sql_deletelist = "delete from nc_addservice where id='".$DBList[$i]->id."'";
			$dbdeleteList = DB::select($sql_deletelist);			
		}
		$prefix = DB::getTablePrefix();
		$param['professions'] = ProfessionsModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		$param['services'] =  ServiceModel:: whereRaw(true)->orderby('ServiceName','asc')->get();
		$param['availableProfession'] =ProfessionsModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		
		$sql_select = "SELECT t1.*, t2.ServiceName, t3.ProfessionName , t4.UserName,t4.UserStatus FROM 
						(SELECT * FROM nc_addservice WHERE specialoffer= '1') AS t1
						LEFT JOIN nc_service AS t2
						ON t1.service_id = t2.id
						LEFT JOIN nc_profession AS t3
						ON t1.profession_id = t3.id
						LEFT JOIN nc_member AS t4
						ON t1.user_id = t4.id
						where t4.UserStatus='Active'";
		$param['addservice'] = DB::select($sql_select);
		$param['addsevice1'] = DB::table('addservice')
								->select(DB::raw('nc_addservice.id'))->where('specialoffer','=','1')->get();
		
		$param['cms'] = CmsModel::whereRaw(true)->orderBy('AboutOrder', 'asc')->get();
		$sql_select = "SELECT t1.* ,t2.UserName, t2.UserImage, t2.UserImageType, t3.ImageUrl FROM 
							(SELECT * FROM nc_client ) AS t1
							LEFT JOIN nc_member AS t2
							ON t1.Title = t2.id
							LEFT JOIN nc_userimage AS t3
							ON t2.UserImage = t3.id";
		$param['client'] = DB::select($sql_select);
		
		$param['ourclient'] = DB::select("SELECT t1.*,t2.ImageUrl FROM 
											(SELECT * FROM nc_member WHERE UserStatus = 'Active' and  UserType='c') AS t1
											LEFT JOIN nc_userimage AS t2
											ON t1.UserImage =t2.id"); 
		$sql = "SELECT t2.UserCity,t2.UserStatus
			FROM 
			(SELECT * FROM 
			".$prefix."addservice ) AS t1
			LEFT JOIN ".$prefix."member AS t2
			ON t1.user_id= t2.id
			where t2.UserStatus='Active'
			GROUP BY UserCity";
		$param['city'] =  DB::select($sql);
		
		return View::make('user.store.home')->with($param);
	}
	public function homegetservice(){
		if(Request::ajax()){
			$professionID = Input::get('professionID');
			$prefix = DB::getTablePrefix();
			if($professionID != "") {
				$servicesList = ServiceModel::whereRaw('profession_id = ?', array($professionID))->orderby('ServiceName','asc')->get();
				$sql = "SELECT t2.UserCity
							FROM 
							(SELECT * FROM 
							".$prefix."addservice where profession_id = '".$professionID."') AS t1
							LEFT JOIN ".$prefix."member AS t2
							ON t1.user_id= t2.id
							GROUP BY UserCity";
				$city  =  DB::select($sql);
			}else{
				$servicesList = ServiceModel:: whereRaw(true)->orderby('ServiceName','asc')->get();
				$sql = "SELECT t2.UserCity
						FROM
						(SELECT * FROM
						".$prefix."addservice ) AS t1
						LEFT JOIN ".$prefix."member AS t2
						ON t1.user_id= t2.id
						GROUP BY UserCity";
				$city  =  DB::select($sql);
			}
			$data = array('result' => 'success', 'services' =>$servicesList, 'city' => $city);
			return Response::json($data);
		}
	}
	public function homegetcity(){
		if(Request::ajax()){
			$prefix = DB::getTablePrefix();
			$serviceID = Input::get('serviceID');
			$sql = "SELECT t2.UserCity
							FROM
							(SELECT * FROM
							".$prefix."addservice where service_id = '".$serviceID."') AS t1
							LEFT JOIN ".$prefix."member AS t2
							ON t1.user_id= t2.id
							GROUP BY UserCity";
			$city  =  DB::select($sql);
			$data = array('result' => 'success',  'city' => $city);
			return Response::json($data);
		}
	}
	public function search_result(){
		if((Input::get('srch-term') !="")){
			$professionSearch = Input::get('srch-term');
			$listcheck = ProfessionsModel::whereRaw('ProfessionName =?',array($professionSearch))->get();
			$profession = $listcheck[0]['id'];
			$service    = "";
			$city		= "";
			
		}else{
			$profession = Input::get('profession');
			$service    = Input::get('service');
			$city		= Input::get('city');
		}
		
		$param['professionlist'] = ProfessionsModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		if($profession == "" &&  $service == "" && $city == ""){
			return Redirect::back()->withErrors(['msg', 'Please select profession or service or city']);
		}
		else{
			$sql1="select * from nc_addservice ";
				if($profession !="" || $service != ""){
					$sql1 .= "where ";
					if($profession !="" && $service != ""){
						$sql1 .="profession_id = '$profession' AND service_id='$service'";
					}else{
						if($profession != "") { $sql1 .= "profession_id='$profession'";}
						elseif($service !="") { $sql1 .=  "service_id='$service'";}
					}
				}
				$sql = "SELECT t1.* ,t2.UserCity, t2.UserName,t3.ServiceName 
						FROM (".$sql1.") AS t1
						LEFT JOIN nc_member AS t2
	 					ON t1.user_id= t2.id 
						left join nc_service as t3
					 	on t1.service_id = t3.id";
				if($city != ""){
					$sql .= " where UserCity ='$city'";
				}
				$list = DB::table('addservice')
					->select(DB::raw('nc_addservice.id as addserviceID, nc_addservice.service_title, nc_addservice.service_description,nc_addservice.image1 as image1,nc_addservice.image2 as image2,
							  nc_addservice.was_price, nc_addservice.now_price, nc_addservice.specialoffer,nc_addservice.image3 as image3,nc_addservice.image4 as image4,
						      nc_member.UserName, nc_member.UserCity, nc_member.UserCity, nc_member.UserStatus,nc_service.ServiceName,nc_service.profession_id,nc_addservice.user_id,nc_addservice.service_id'))
			      ->leftJoin('member', 'user_id', '=', 'member.id')
			      ->leftJoin('service', 'service_id', '=', 'service.id')
				  ->where('member.UserStatus', '=', 'Active');
				if($profession != "" ) {
					$list =$list->where('service.profession_id','=',$profession); 		
				}
				if($service != ""){
					$list =$list->where('addservice.service_id','=',$service);
				}
				if($city !="") {
					$list =$list->where('member.UserCity','=',$city);
				}
				
			     $list = $list->paginate(9);
			    
				
				Session::set('profession', $profession);
				Session::set('service',    $service);
				Session::set('city',       $city);
				//$list =DB::select($sql);
				$param['addservice'] = $list;
				$param['addservice'] ->appends(array('profession' => $profession, 'service' =>$service,'city' =>$city));
				$param['pageNo'] ="11";
		}
		return View::make('user.store.search')->with($param);
	}
	public function product($id){
		$param['pageNo'] =12;
		$param['professionlist'] = ProfessionsModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		$addservice = AddServiceModel::find($id);
		$param['addservice'] = $addservice;
		$param['rate']=DB::table('rate')
						 ->where('confirm', '=' , '1')
						 ->where('product_id', '=', $id) 
						->leftjoin('member', 'rate.sender_id', '=', 'member.id')
						->select('rate.*', 'member.UserName')
						->get();
		
		$param['rateuser'] = DB::table('rate')
						 ->where('product_id', '=', $id)
						 ->where('sender_id' , '=', Session::get('user_id')) 
						->join('member', 'rate.sender_id', '=', 'member.id')
						->select('rate.*', 'member.UserName')
						->get();						
		$param['productID'] =$id;		
		return View::make('user.store.product')->with($param);
	}
	public function addreview(){
		
		$rules = array('review'  => 'required');
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			$valid =$validator->errors();
			$valid->add('reviewError', 'reviewError');
			return Redirect::back()->withErrors($valid)->withInput();
		}else{
			$productID = Input::get('productID');
			$serviceID = Input::get('serviceID');
			$userID = Input::get('userID');
			
			$customservice = Input::get('input-1');
			$valuemoney = Input::get('input-2');
			$price = Input::get('input-3');
			$overall = Input::get('input-4');
			$reliability =Input::get('input-5');
			if($customservice == 0 && $valuemoney == 0 && $price ==0 && $overall==0 && $reliability ==0)
			{
				$alert['msg'] = 'You have to select rating for this product.';
				$alert['type'] = 'danger';
				$alert['list'] = "reviewSuccess";
			}else{
				
				
				$customservice = $customservice*20;
				$valuemoney =$valuemoney *20;
				$price = $price*20;
				$overall = $overall*20;
				$reliability = $reliability*20;
				$rate = ($customservice + $valuemoney + $price +$overall+ $reliability)/5 ;
				$ratevalue = new RateModel;
				$ratevalue ->service_id = $serviceID;
				$ratevalue ->receive_id = $userID;
				$ratevalue ->sender_id = Session::get('user_id');
				$ratevalue ->rate = $rate;
				$ratevalue ->Price = $price;
				$ratevalue ->Work = $customservice;
				$ratevalue ->Professionalism = $overall;
				$ratevalue ->Accuracy = $valuemoney; // value money //
				$ratevalue ->Reliability =$reliability;
				$ratevalue ->review = Input::get('review');
				$ratevalue ->product_id = $productID;
				$ratevalue ->save();
				
				$userlist = UserModel::find($userID);
				$UserName = $userlist->UserName;
				$sendderUserList = UserModel::find(Session::get('user_id'));
				$senderName = $sendderUserList->UserName;
				$data = array(
						'username' =>$UserName,
						'sendername'    =>$senderName,
						'rate' =>$rate
				
				);
				Mail::send('emails.addreview', $data, function($message) {
					$message->from("comparejersey1@gmail.com", 'Add Review');
					$message->to("admin@compare.je", 'Admin')->subject('Add Review');
				});
				
				
				
				
				$alert['msg'] = 'Review and Rating has been saved successfully';
				$alert['type'] = 'success';
				$alert['list'] = "reviewSuccess";
				
			}
		}
		return Redirect::route('user.store.product',$productID)->with('alert', $alert);
	}
	public function professions($id){
		$param['pageNo'] = 14;
		$param['profession'] = ProfessionsModel::find($id);
		$sql= "SELECT 
						t1.* ,t2.UserName, t2.UserEmail, 
						t2.UserPhoneNumber,UserEmail,UserImage,
						t3.ImageUrl,t2.UserWebsite,t2.UserAddress, 
						t2.UserCity, t2.UserCountry,t2.UserPostCode,t2.UserStatus
				FROM 
				(SELECT * FROM nc_addservice WHERE profession_id='$id') AS t1
				LEFT JOIN nc_member AS t2
				ON t1.user_id = t2.id
				LEFT JOIN nc_userimage AS t3
				ON t2.UserImage= t3.id
				where t2.UserStatus ='Active'
				GROUP BY user_id";
		$param['addservice'] = DB::select($sql);
		$param['professionlist'] = ProfessionsModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		return View::make('user.store.professions')->with($param);
	}
	public function voucher($id){
		$param['pageNo'] = 13;
		$param['professionlist'] = ProfessionsModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		return View::make('user.store.voucher')->with($param);
	}
  public function privacy(){
  	$param['pageNo'] = 0;
  	$param['professionlist'] = ProfessionsModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
  	return View::make('user.store.privacy')->with($param);
  }
}