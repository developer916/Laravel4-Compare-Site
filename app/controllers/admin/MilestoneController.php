<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator,File;
use Milestone as MilestoneModel;
class MilestoneController extends \BaseController {
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
	public function index() {
		$param['milestone'] = MilestoneModel::get();
		$param['pageNo'] =11;
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
		return View::make('admin.milestone.index')->with($param);
	}
	public function create(){
		$param['pageNo'] =11;
		return View::make('admin.milestone.create')->with($param);
	}
	public function store(){
		$rules = ['SubTitle'  => 'required',
				  'SubYear' => 'required',
				  'SubMonth' => 'required',
				  'Title' => 'required',
				  'Content' => 'required',
		];
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::back()
			->withErrors($validator)
			->withInput();
		}else{
			$SubYear = Input::get('SubYear');
			$SubTitle = Input::get('SubTitle');
			$SubMonth = Input::get('SubMonth');
			$Title = Input::get('Title');
			$client_find = MilestoneModel::whereRaw('SubTitle=? and SubYear = ? and SubMonth = ? and Title = ? ', array($SubTitle, $SubYear,$SubMonth,$Title))->get();
			$check_exist= 0;
			if (Input::has('milestone_id')) {
				$id = Input::get('milestone_id');
				$client = MilestoneModel::find($id);
			}else{
				$client = new MilestoneModel;
				if(count($client_find) != 0){
					$alert['msg'] = 'This milestone has been exist';
					$alert['type'] = 'danger';
					$check_exist= 1;
				}
			}
			
			if($check_exist == 0){
				$client->SubTitle = $SubTitle;
				$client->SubYear = $SubYear;
				$client->SubMonth = $SubMonth;
				$client->Title = $Title;
				$client->Content = Input::get('Content');
				$client->save();
				$alert['msg'] = 'This milestone has been saved successfully';
				$alert['type'] = 'success';
			}
		}
		return Redirect::route('admin.milestone')->with('alert', $alert);
	}
	
	public  function edit($id){
		$param['pageNo'] = 11;
		$param['milestone'] = MilestoneModel::find($id);
		return View::make('admin.milestone.edit')->with($param);
	}
	public function delete($id){
		try {
			MilestoneModel::find($id)->delete();
			$alert['msg'] = 'Milestone has been deleted successfully';
			$alert['type'] = 'success';
		} catch(\Exception $ex) {
			$alert['msg'] = 'This Milestone has been already used';
			$alert['type'] = 'danger';
		}
		return Redirect::route('admin.milestone')->with('alert', $alert);
	}
}