<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use Adminuser as AdminuserModel;
class AuthController extends \BaseController {
    
    public function index() {
        if (Session::has('admin_id')) {
            return Redirect::route('admin.dashboard');
        } else {
            return Redirect::route('admin.auth.login');
        }
    }
    
    public function login() {
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
            return View::make('admin.auth.login')->with($param);
        } else {
            return View::make('admin.auth.login');
        }
    }
    
    public function doLogin() {
        $name = Input::get('username');
        $password = Input::get('password');
        
        $user = AdminuserModel::whereRaw('AdminUserName = ? and AdminUserPassword = md5(?)', array($name, $password))->get();
        if (count($user)!= 0) {
            Session::set('admin_id', 1);
            return Redirect::route('admin.dashboard');
        } else {
            $alert['msg'] = 'Invalid username and password';
            $alert['type'] = 'danger';
            return Redirect::route('admin.auth.login')->with('alert', $alert);
        }
    }
    
    public function logout() {
        Session::forget('admin_id');
        return Redirect::route('admin.auth.login');
    }
}
