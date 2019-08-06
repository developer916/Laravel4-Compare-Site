<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator,File,DB;
use Client as ClientModel, User as UserModel;
class ClientController extends \BaseController {
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
	public function index() {
		
		$param['client'] = DB::table('client')
						->select(DB::raw('nc_client.id as id, nc_client.Content, nc_member.UserName, nc_client.created_at'))
					      ->leftJoin('member', 'Title', '=', 'member.id')
					      ->get();
		$param['pageNo'] = 7;
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		return View::make('admin.client.index')->with($param);
	}
	public function create(){
		$param['pageNo'] = 7;
		$param['userNames'] = UserModel::whereRaw('UserStatus =?', array('Active'))->get();
		return View::make('admin.client.create')->with($param);
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
			$client_find = ClientModel::whereRaw('Title=? and Content = ?', array($subName, $subBody))->get();
			$check_exist= 0;
			if (Input::has('client_id')) {
				$id = Input::get('client_id');
				$client = ClientModel::find($id);
			}else{
				$client = new ClientModel;
				if(count($client_find) != 0){
					$alert['msg'] = 'This content has been exist';
					$alert['type'] = 'danger';
					$check_exist= 1;
				}
			}
			if($check_exist == 0){
				$client->Title = $subName;
				$client->Content = $subBody;
				$client->save();
				$alert['msg'] = 'This content has been saved successfully';
				$alert['type'] = 'success';
			}
		}
		return Redirect::route('admin.client')->with('alert', $alert);
	}
	public function edit($id){
		$param['pageNo'] = 7;
		$param['client'] = ClientModel::find($id);
		$param['userNames'] = UserModel::whereRaw('UserStatus =?', array('Active'))->get();
		return View::make('admin.client.edit')->with($param);
	}
	public function delete($id){
		try {
			ClientModel::find($id)->delete();
			$alert['msg'] = 'This content has been deleted successfully';
			$alert['type'] = 'success';
		} catch(\Exception $ex) {
			$alert['msg'] = 'This content has been already used';
			$alert['type'] = 'danger';
		}
		return Redirect::route('admin.client')->with('alert', $alert);
	}
}