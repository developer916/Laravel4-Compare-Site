<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator,File;
use Cms as CmsModel;
class CmsController extends \BaseController {
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
	public function index() {
		$param['cms'] = CmsModel::get();
		$param['pageNo'] = 10;
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		return View::make('admin.cms.index')->with($param);
	}
	public function create(){
		$param['pageNo'] = 10;
		return View::make('admin.cms.create')->with($param);
	}
	
	public function store(){
		$rules = ['subName'  => 'required',
		'subBody'  => 'required',
		'order'    => 'required|numeric',
		'AboutImageUrl'    => 'required',
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
			
				
			if (Input::has('about_id')) {
				$id = Input::get('about_id');
				$do = CmsModel::find($id);
			}else{
				$do = new CmsModel;
				$order= $order+1;
				$do_find= CmsModel::whereRaw('AboutOrder=?', array($order))->get();
				if(count($do_find) != 0){
					$alert['msg'] = 'Sub order has been exist';
					$alert['type'] = 'danger';
					$check_exist= 1;
				}
			}
				
			if($check_exist == 0){
				if (Input::hasFile('AboutImageUrl')) {
					$filename = str_random(24).".".Input::file('AboutImageUrl')->getClientOriginalExtension();
					Input::file('AboutImageUrl')->move(ABS_LOGO_PATH, $filename);
					$DoImage = $filename;
				}
				$do->AboutTitle = $subName;
				$do->AboutContent = $subBody;
				$do->AboutOrder = ($orderList+1);
				$do->AboutImageUrl = $DoImage;
				$do->save();
				$alert['msg'] = 'This content has been saved successfully';
				$alert['type'] = 'success';
			}
		}
		return Redirect::route('admin.cms')->with('alert', $alert);
	}
	public function edit($id){
		$param['pageNo'] = 10;
		$param['cms'] = CmsModel::find($id);
		return View::make('admin.cms.edit')->with($param);
	}
	
	public function delete($id){
		try {
			CmsModel::find($id)->delete();
			$alert['msg'] = 'This content has been deleted successfully';
			$alert['type'] = 'success';
		} catch(\Exception $ex) {
			$alert['msg'] = 'This content has been already used';
			$alert['type'] = 'danger';
		}
		return Redirect::route('admin.cms')->with('alert', $alert);
	}
}