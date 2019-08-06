<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator,File;
use Faq as FaqModel;
class FaqController extends \BaseController {
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
	public function index() {
		$param['faq'] = FaqModel::get();
		$param['pageNo'] = 8;
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		return View::make('admin.faq.index')->with($param);
	}
	public function create(){
		$param['pageNo'] =8;
		return View::make('admin.faq.create')->with($param);
	}
	
	public function store(){
		$rules = ['subName'  => 'required',
		'subBody' => 'required',
		];
		$validator = Validator::make(Input::all(), $rules);
	
		if ($validator->fails()) {
			return Redirect::back()
			->withErrors($validator)
			->withInput();
		}else{
			$subName = Input::get('subTitle');
			$subBody = Input::get('subContent');
			$client_find = FaqModel::whereRaw('Question=? and Answer = ?', array($subName, $subBody))->get();
			$check_exist= 0;
			if (Input::has('client_id')) {
				$id = Input::get('client_id');
				$client = FaqModel::find($id);
			}else{
				$client = new FaqModel;
				if(count($client_find) != 0){
					$alert['msg'] = 'This content has been exist';
					$alert['type'] = 'danger';
					$check_exist= 1;
				}
			}
			if($check_exist == 0){
				$client->Question = $subName;
				$client->Answer = $subBody;
				$client->save();
				$alert['msg'] = 'This content has been saved successfully';
				$alert['type'] = 'success';
			}
		}
		return Redirect::route('admin.faq')->with('alert', $alert);
	}
	public function edit($id){
		$param['pageNo'] =8;
		$param['client'] = FaqModel::find($id);
		return View::make('admin.faq.edit')->with($param);
	}
	public function delete($id){
		try {
			FaqModel::find($id)->delete();
			$alert['msg'] = 'This content has been deleted successfully';
			$alert['type'] = 'success';
		} catch(\Exception $ex) {
			$alert['msg'] = 'This content has been already used';
			$alert['type'] = 'danger';
		}
		return Redirect::route('admin.faq')->with('alert', $alert);
	}
}