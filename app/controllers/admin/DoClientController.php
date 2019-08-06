<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator,File;
use DoClient as DoClientModel,User as UserModel;
class DoClientController extends \BaseController {
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
	public function index() {
		$param['do'] = DoClientModel::get();
		$param['pageNo'] = 5;
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		return View::make('admin.do.index')->with($param);
	}
	public function create(){
		$param['pageNo'] = 5;
		return View::make('admin.do.create')->with($param);
	}
	public function store(){
		$rules = ['subName'  => 'required',
				  'subBody'  => 'required',
				  'order'    => 'required|numeric',
				  'DoImageUrl'    => 'required',
				];
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::back()
			->withErrors($validator)
			->withInput();
		}else{
			$check_exist =0;
			$subName = Input::get('subTitle');
			$subBody = Input::get('subContent');
			$order = Input::get('order');
			$orderList = $order;
			if (Input::has('do_id')) {
				$id = Input::get('do_id');
				$do = DoClientModel::find($id);
			}else{
				$do = new DoClientModel;
				$order= $order+1;
				$do_find= DoClientModel::whereRaw('DoOrder=?', array($order))->get();
    			if(count($do_find) != 0){
    				$alert['msg'] = 'Sub order has been exist';
    				$alert['type'] = 'danger';
    				$check_exist= 1;
    			}			
			}
			
			if($check_exist == 0){
				if (Input::hasFile('DoImageUrl')) {
					$filename = str_random(24).".".Input::file('DoImageUrl')->getClientOriginalExtension();
					Input::file('DoImageUrl')->move(ABS_LOGO_PATH, $filename);
					$DoImage = $filename;
				}
				$do->DoTitle = $subName;
				$do->DoContent = $subBody;
				$do->DoOrder = ($orderList+1);
				$do->DoImageUrl = $DoImage;
				$do->save();
				$alert['msg'] = 'This content has been saved successfully';
				$alert['type'] = 'success';
			}
		}
		return Redirect::route('admin.do')->with('alert', $alert);
	}
	public function edit($id){
		$param['pageNo'] = 5;
		$param['do'] = DoClientModel::find($id);
		return View::make('admin.do.edit')->with($param);
	}
	public function delete($id){
		try {
			DoClientModel::find($id)->delete();
			$alert['msg'] = 'This content has been deleted successfully';
			$alert['type'] = 'success';
		} catch(\Exception $ex) {
			$alert['msg'] = 'This content has been already used';
			$alert['type'] = 'danger';
		}
		return Redirect::route('admin.do')->with('alert', $alert);
	}
}