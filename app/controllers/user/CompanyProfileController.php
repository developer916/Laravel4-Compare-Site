<?php namespace User;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator, DB, Mail,File, Request,Response;
use User as UserModel,UserImage as UserImageModel, Memberdetail as MemberdetailModel,
	Image as ImageModel,Profession as ProfessionsModel, Service as ServiceModel,
	AddImage as AddImageModel, Analytics as AnalyticsModel, 
	Addservice as AddserviceModel, Rate as RateModel;

class CompanyProfileController extends \BaseController {
	public function companyprofileview($id){
		$param['pageNo'] = 10;
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		$company = UserModel::find($id);
		$analytics = AnalyticsModel::whereRaw('user_id = ?', array($id))->get();
		
		if(count($analytics) >  0 ){
			$usernumberrule =$analytics[0]['usernumber'];
			$userAnalyticsID =$analytics[0]['id'];
			$analyticsSave = AnalyticsModel::find($userAnalyticsID);
			$analyticsSave->usernumber = $usernumberrule+1;
			$analyticsSave->save();
		}else{
			$analyticsSave = new AnalyticsModel;
			$analyticsSave->user_id = $id;
			$analyticsSave->usernumber = "1";
			$analyticsSave->extra = "";
			$analyticsSave->save();
		}
		
		if($company->UserStatus == "Active") {
		$param['professionlist'] = ProfessionsModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		$memberDetail = MemberdetailModel::whereRaw('member_id = ?', array($id))->get();
		$param['company'] = $company;
		$param['professions'] = ProfessionsModel::whereRaw(true)->orderby('ProfessionName','asc')->get();
		$param['services'] = ServiceModel:: whereRaw(true)->orderby('ServiceName','asc')->get();
		$param['addservice'] = DB::table('addservice')
									->select(DB::raw('nc_addservice.id as addserviceID, nc_addservice.service_title, nc_addservice.service_description,nc_addservice.image1 as image1, nc_addservice.image2 as image2,
													  nc_addservice.was_price, nc_addservice.now_price, nc_addservice.specialoffer,nc_addservice.image3 as image3,nc_addservice.image4 as image4,
												      nc_member.UserName, nc_member.UserCity, nc_member.UserCity, nc_service.ServiceName'))->where('user_id', '=', $id)
									->leftJoin('member', 'user_id', '=', 'member.id')
									->leftJoin('service', 'service_id', '=', 'service.id')
		 							->paginate(12);
		$param['companyImage'] = ImageModel::whereRaw('addservice_id = ?', array($id))->get();
		$param['memberDetail'] =$memberDetail;
		$sql = "SELECT t1.* ,t2.UserName,t2.UserImage, t2.UserImageType,t3.ImageUrl
					FROM 
					(SELECT * FROM nc_rate WHERE receive_id='$id') AS t1
					LEFT JOIN nc_member AS t2
					ON t1.sender_id= t2.id
					LEFT JOIN nc_userimage AS t3
					ON t2.UserImage= t3.id";
		$param['ourclient'] = DB::select($sql);
		$param['rate'] = RateModel::whereRaw('receive_id =?',array($id))->get();
		if(($company->UserType == "s") || ($company->UserType == "c" && $company->UserImageType=="1")){
			$userImage = UserImageModel::find($company->UserImage);
			$param['userImage'] =$userImage;
		}
		return View::make('user.company.profile')->with($param);
		}else{
			return Redirect::route('user.home');
		}
	}
}
