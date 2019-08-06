<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator,File;
use UserImage as UserImageModel;
class ImageController extends \BaseController {
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
	public function index() {
		$param['userimage'] = UserImageModel::get();
		$param['pageNo'] =12;
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		return View::make('admin.image.index')->with($param);
	}
	public function create(){
		$param['pageNo'] = 12;
		return View::make('admin.image.create')->with($param);
	}
	public  function store(){
		$rules = ['ImageUserName'  => 'required',
				  'ImageUrl' => 'required',
		];
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::back()
			->withErrors($validator)
			->withInput();
		}else{
			$ImageUserName = Input::get('ImageUserName');
			$client_find = UserImageModel::whereRaw('ImageUserName=?', array($ImageUserName))->get();
			$check_exist= 0;
			if (Input::has('image_id')) {
				$id = Input::get('image_id');
				$userImage = UserImageModel::find($id);
			}else{
				$userImage = new UserImageModel;
				if(count($client_find) != 0){
					$alert['msg'] = 'This Image Name has been exist';
					$alert['type'] = 'danger';
					$check_exist= 1;
				}
			}
			if($check_exist == 0){
				if (Input::hasFile('ImageUrl')) {
					$filename = str_random(24).".".Input::file('ImageUrl')->getClientOriginalExtension();
					Input::file('ImageUrl')->move(ABS_LOGO_PATH, $filename);
					$DoImage = $filename;
				}
				$userImage->ImageUserName = $ImageUserName;
				$userImage->ImageUrl = $DoImage;
				$userImage->save();
				$alert['msg'] = 'This image  has been saved successfully';
				$alert['type'] = 'success';
			}
		}
		return Redirect::route('admin.image')->with('alert', $alert);
	}
	public function delete($id){
		try {
			UserImageModel::find($id)->delete();
			$alert['msg'] = 'This image has been deleted successfully';
			$alert['type'] = 'success';
		} catch(\Exception $ex) {
			$alert['msg'] = 'This image has been already used';
			$alert['type'] = 'danger';
		}
		return Redirect::route('admin.image')->with('alert', $alert);
	}
	public function edit($id){
		$param['pageNo'] = 12;
		$param['userImage'] = UserImageModel::find($id);
		return View::make('admin.image.edit')->with($param);
	}
}