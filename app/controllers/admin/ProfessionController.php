<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use Profession as ProfessionModel, Service as ServiceModel;
class ProfessionController extends \BaseController {
    
    public function __construct() {
        $this->beforeFilter(function(){
            if (!Session::has('admin_id')) {
                return Redirect::route('admin.auth.login');
            }
        });
    }   
    
    public function index() {
    	$param['profession'] = ProfessionModel::get();
    	$param['pageNo'] = 6;
    	if ($alert = Session::get('alert')) {
    		$param['alert'] = $alert;
    	}
        return View::make('admin.profession.index')->with($param);
    }
    public function create(){
    	$param['pageNo'] = 6;
    	return View::make('admin.profession.create')->with($param);
    }  
    public function store(){
    	$rules = ['professionName' => 'required'];
    	$validator = Validator::make(Input::all(), $rules);
    	if ($validator->fails()) {
    		return Redirect::back()
    		->withErrors($validator)
    		->withInput();
    	}
    	else {
    		$professionName = Input::get('professionName');
    		$profession_find= ProfessionModel::whereRaw('ProfessionName=?', array($professionName))->get();
    		$check_exist= 0;
    		if (Input::has('profession_id')) {
    			$id = Input::get('profession_id');
    			$profession = ProfessionModel::find($id);
    		} else {
    			$profession = new ProfessionModel;
    			if(count($profession_find) != 0){
    				$alert['msg'] = 'Profession has been exist';
    				$alert['type'] = 'danger';
    				$check_exist= 1;
    			}
    		}
    		
    		if($check_exist == 0){
    		
	    		$profession->ProfessionName = $professionName; 
	    		$profession->save();
	    	
	    		$alert['msg'] = 'Profession has been saved successfully';
	    		$alert['type'] = 'success';
    		}
    	
    		return Redirect::route('admin.profession')->with('alert', $alert);
    	}
    }  
    public function edit($ProfessionID){
    	$param['pageNo'] = 6;
    	$param['profession'] = ProfessionModel::find($ProfessionID);
    	return View::make('admin.profession.edit')->with($param);
    }
    public function delete($id){
    	try {
    		ServiceModel::whereRaw('profession_id=?',array($id))->delete();
    		ProfessionModel::find($id)->delete();
    	
    		$alert['msg'] = 'Profession has been deleted successfully';
    		$alert['type'] = 'success';
    	} catch(\Exception $ex) {
    		$alert['msg'] = 'This Profession has been already used';
    		$alert['type'] = 'danger';
    	}
    	return Redirect::route('admin.profession')->with('alert', $alert);
    }
}
