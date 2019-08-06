<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator,File;
use Contact as ContactModel;
class ContactController extends \BaseController {
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
	public function index() {
		$param['client'] = ContactModel::get();
		$param['pageNo'] = 2;
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		return View::make('admin.contact.index')->with($param);
	}
	public function delete($id){
		try {
			ContactModel::find($id)->delete();
			$alert['msg'] = 'This content has been deleted successfully';
			$alert['type'] = 'success';
		} catch(\Exception $ex) {
			$alert['msg'] = 'This content has been already used';
			$alert['type'] = 'danger';
		}
		return Redirect::route('admin.contact')->with('alert', $alert);
	}
}