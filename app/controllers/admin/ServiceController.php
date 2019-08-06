<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator,File;
	use Service as ServiceModel, Profession as ProfessionModel;
class ServiceController extends \BaseController {
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}

	public function index() {
		$param['service'] = ServiceModel::get();
		$param['pageNo'] = 3;
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		return View::make('admin.service.index')->with($param);
	}
	public function create(){
		$param['pageNo'] = 3;
		$param['profession'] = ProfessionModel::all();
		
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		return View::make('admin.service.create')->with($param);
	}
	public function store(){
		$profession_id = array();
        $profession_id = Input::get('profession_id');
        $rules = ['profession_id'  => 'required',
		'service' => 'required',
		];
        $validator = Validator::make(Input::all(), $rules);
        
		if ($validator->fails()) {
			return Redirect::back()
			->withErrors($validator)
			->withInput();
		}else{
			foreach (Input::get('profession_id') as $item) {
				$serviceName= Input::get('service');
				$profession_id = $item;
				$service_find = ServiceModel::whereRaw('ServiceName = ? and profession_id = ?', array($serviceName, $profession_id))->get();
				$check_service =0;
				if (Input::has('service_id')) {
					$id = Input::get('service_id');
					$service = ServiceModel::find($id);
				}else{
					$service = new ServiceModel; 
					if(count($service_find)!=0){
						$alert['msg'] = 'Service has been exist';
						$alert['type'] = 'danger';
						$check_service =1;
					}
				}
				
			if($check_service ==0){
					$service->ServiceName=$serviceName; 
					$service->profession_id= $profession_id;
					$service->save();
					$alert['msg'] = 'Service has been saved successfully';
					$alert['type'] = 'success';
				}
			}
			return Redirect::route('admin.service')->with('alert', $alert);
		}
	}
	public function edit($id){
		$param['pageNo'] = 3;
		$param['service'] = ServiceModel::find($id);
		$param['profession'] = ProfessionModel::all();
		
		return View::make('admin.service.edit')->with($param);
	}
	public function delete($id){
		try {
			ServiceModel::find($id)->delete();
			 
			$alert['msg'] = 'Service has been deleted successfully';
			$alert['type'] = 'success';
		} catch(\Exception $ex) {
			$alert['msg'] = 'This Service has been already used';
			$alert['type'] = 'danger';
		}
		return Redirect::route('admin.service')->with('alert', $alert);
	}
}