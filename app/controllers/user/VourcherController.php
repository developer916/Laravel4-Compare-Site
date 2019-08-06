<?php namespace User;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator, DB, Mail,File, Request,Response;
use User as UserModel,UserImage as UserImageModel, Memberdetail as MemberdetailModel,
	Image as ImageModel,Profession as ProfessionsModel, Service as ServiceModel, Rate as RateModel,
	AddImage as AddImageModel, Addservice as AddserviceModel, Cms as CmsModel, Client as ClientModel;

class VourcherController extends \BaseController {
	public function index($id){
		$param['pageNo'] = 15;
		$sql= "SELECT 
					t1.id ,t2.ServiceName, t3.service_title, 
					t3.service_description, t3.now_price, 
					t3.was_price, t3.expiry_date,
					t3.image1, t3.image2,t3.image3, t3.image4,t4.UserName
				FROM 
				(SELECT * FROM nc_voucher WHERE product_id='$id') AS t1
				LEFT JOIN nc_service AS t2
				ON t1.service_id = t2.id
				LEFT JOIN nc_addservice AS t3
				ON t1.product_id=t3.id
				LEFT JOIN nc_member AS t4
				ON t3.user_id = t4.id";
		
					
		$param['vourcher']=DB::select($sql);;
		return View::make('user.voucher.index')->with($param);
	}
} 