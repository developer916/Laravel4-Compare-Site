<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session,DB, Validator;
use Analytics as AnalyticsModel,User as UserModel;
class AnalyticsController extends \BaseController {
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
	public function index() {
		
		$param['analytics'] = DB::table('analytics')
					->select(DB::raw('nc_analytics.id as analyticsID, nc_analytics.user_id, nc_analytics.usernumber,nc_member.UserType,nc_member.UserName' ))
					->leftjoin('member','analytics.user_id','=','member.id')
					->orderBy('analytics.usernumber','DESC')
					->get();
		$param['pageNo'] =15;
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		return View::make('admin.analytics.index')->with($param);
	}
}