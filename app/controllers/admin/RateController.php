<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator,File,DB;
use Rate as RateModel;
class RateController extends \BaseController {
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
	public function index() {
		$sql_select = "SELECT 
							t1.*, t2.UserName AS ReceiveName, 
							t3.UserName AS SenderName ,t4.ServiceName AS ServiceName,
							t5.service_title AS ProductName
							
						FROM
						
							(SELECT * FROM nc_rate ) AS t1
							LEFT JOIN nc_member AS t2
							ON t1.receive_id = t2.id
							LEFT JOIN nc_member AS t3
							ON t1.sender_id = t3.id
							LEFT JOIN nc_service AS t4
							ON t1.service_id =t4.id
							LEFT JOIN nc_addservice AS t5
							ON t1.product_id =t5.id
							order by t1.id desc";
		$param['rate'] = DB::select($sql_select);
							
		
		$param['pageNo'] = 9;
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		return View::make('admin.rate.index')->with($param);
	}
	public function confirm($id){
		$rate = RateModel::find($id);
		if($rate->Confirm == "1") {
			$rate->Confirm = "";
		}else{
			$rate->Confirm = "1";
		}
		$rate->save();
		$alert['msg'] = 'Rate has been confirmed successfully';
		$alert['type'] = 'success';
		return Redirect::route('admin.rate')->with('alert', $alert);
	}
	public function delete($id){
		try {
			RateModel::find($id)->delete();
			$alert['msg'] = 'Rate has been deleted successfully';
			$alert['type'] = 'success';
		} catch(\Exception $ex) {
			$alert['msg'] = 'Rate has been already used';
			$alert['type'] = 'danger';
		}
		return Redirect::route('admin.rate')->with('alert', $alert);
	}
}