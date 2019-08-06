<?php
Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[a-zA-Z0-9-]+');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	 return Redirect::route('user.home');
}); 
	Route::get('home',         		        		['as' => 'user.home',                    'uses' => 'User\StoreController@home']);
	Route::post('doLogin',              			['as' => 'user.auth.doLogin',     		 'uses' => 'User\AuthController@doLogin']);
	Route::get('register',              			['as' => 'user.auth.register',    		 'uses' => 'User\AuthController@register']);
	Route::get('contact-us',            			['as' => 'user.auth.contact',     		 'uses' => 'User\AuthController@contact']);
	Route::post('contactTo',                		['as' => 'user.auth.contactTo',     	 'uses' => 'User\AuthController@contactTo']);
	Route::post('registerstore',            		['as' => 'user.auth.registerstore',      'uses' => 'User\AuthController@registerstore']);
	Route::get('about',                    			['as' => 'user.auth.about',     		 'uses' => 'User\AuthController@about']);
	Route::get('service',                   		['as' => 'user.auth.service',     		 'uses' => 'User\AuthController@service']);
	Route::get('faqs',                      		['as' => 'user.auth.faqs',     			 'uses' => 'User\AuthController@faqs']);
	Route::any('specialoffer',                   	['as' => 'user.auth.specialoffer',     	 'uses' => 'User\AuthController@specialoffer']);
	Route::get('doLogout',      	        		['as' => 'user.auth.doLogout',      	 'uses' => 'User\AuthController@doLogout']);
	Route::post('homegetservice' ,          		['as' => 'user.store.homegetservice',    'uses' => 'User\StoreController@homegetservice']);
	Route::post('homegetcity' ,             		['as' => 'user.store.homegetcity',       'uses' => 'User\StoreController@homegetcity']);
	Route::any('search_result',   					['as' => 'user.store.search_result',      'uses' => 'User\StoreController@search_result']);
	Route::get('product/{id}',                      ['as' => 'user.store.product',            'uses' => 'User\StoreController@product']);
	Route::post('addreview',   					    ['as' => 'user.store.addreview',          'uses' => 'User\StoreController@addreview']);
	Route::get('professions/{id}',                  ['as' => 'user.store.professions',        'uses' => 'User\StoreController@professions']);
	Route::get('privacy-policy',                    ['as' => 'user.store.privacy',            'uses' => 'User\StoreController@privacy']);
	Route::get('voucher/{id}',                      ['as' => 'user.vourcher',                 'uses' => 'User\VourcherController@index']);

Route::group(['prefix' => 'company'], function () {
	
	Route::get('/', 			         ['as' => 'user.company',      				     'uses' => 'User\CompanyController@index']);
	Route::post('userimagestore',        ['as' => 'user.company.userimagestore',    	 'uses' => 'User\CompanyController@userimagestore']);
	Route::post('useraboutus',           ['as' => 'user.company.useraboutus',   		 'uses' => 'User\CompanyController@useraboutus']);
	Route::post('userqualification',     ['as' => 'user.company.userqualification', 	 'uses' => 'User\CompanyController@userqualification']);
	Route::post('useraccredited',        ['as' => 'user.company.useraccredited',    	 'uses' => 'User\CompanyController@useraccredited']);
	Route::post('uservideoimage',        ['as' => 'user.company.uservideoimage',    	 'uses' => 'User\CompanyController@uservideoimage']);
	Route::post('uservideofile',         ['as' => 'user.company.uservideofile',          'uses' => 'User\CompanyController@uservideofile']);
	Route::post('uservideodelete',       ['as' => 'user.company.uservideodelete',        'uses' => 'User\CompanyController@uservideodelete']);
	Route::post('companyImageUpload',    ['as' => 'user.company.companyImageUpload',     'uses' => 'User\CompanyController@companyImageUpload']);
	Route::post('companyImageDelete',    ['as' => 'user.company.companyImageDelete',     'uses' => 'User\CompanyController@companyImageDelete']);
	Route::post('companyeditprofile',    ['as' => 'user.company.companyeditprofile',     'uses' => 'User\CompanyController@companyeditprofile']);
	Route::post('companygetservice',     ['as' => 'user.company.companygetservice',      'uses' => 'User\CompanyController@companygetservice']);
	Route::any('companyproductimage',    ['as' => 'user.company.companyproductimage',    'uses' => 'User\CompanyController@companyproductimage']);
	Route::any('productdelete',          ['as' => 'user.company.productdelete',          'uses' => 'User\CompanyController@productdelete']);
	Route::post('getSerivce',            ['as' => 'user.company.getSerivce',             'uses' => 'User\CompanyController@getSerivce']);
	Route::post('addService',            ['as' => 'user.company.addService',             'uses' => 'User\CompanyController@addService']);
	Route::get('profile-view/{id}',      ['as' => 'user.company.companyprofileview',     'uses' => 'User\CompanyProfileController@companyprofileview']);
	Route::get('addservicedelete/{id}',  ['as' => 'user.company.addservicedelete',       'uses' => 'User\CompanyController@addservicedelete']);
	Route::get('edit/{id}',              ['as' => 'user.company.edit',                   'uses' => 'User\CompanyController@edit']);
	Route::post('productdetail',         ['as' => 'user.company.productdetail',          'uses' => 'User\CompanyController@productdetail']);
	Route::post('productprice',          ['as' => 'user.company.productprice',           'uses' => 'User\CompanyController@productprice']);
	Route::post('productimage',          ['as' => 'user.company.productimage',           'uses' => 'User\CompanyController@productimage']);
});
Route::group(['prefix' => 'admin'], function () {

	Route::get('/',         ['as' => 'admin.auth',         'uses' => 'Admin\AuthController@index']);
	Route::get('login',     ['as' => 'admin.auth.login',   'uses' => 'Admin\AuthController@login']);
	Route::post('doLogin',  ['as' => 'admin.auth.doLogin', 'uses' => 'Admin\AuthController@doLogin']);
	Route::get('logout',    ['as' => 'admin.auth.logout',  'uses' => 'Admin\AuthController@logout']);

	Route::get('dashboard', ['as' => 'admin.dashboard',    'uses' => 'Admin\DashboardController@index']);
	
	Route::get('profile', ['as' => 'admin.profile',    'uses' => 'Admin\ProfileController@index']);
	Route::post('profilestore', ['as' => 'admin.profilestore',    'uses' => 'Admin\ProfileController@store']);
	
	
	Route::group(['prefix' => 'profession'], function () {
		Route::get('/',           ['as' => 'admin.profession',         'uses' => 'Admin\ProfessionController@index']);
		Route::get('create',      ['as' => 'admin.profession.create',  'uses' => 'Admin\ProfessionController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.profession.edit',    'uses' => 'Admin\ProfessionController@edit']);
		Route::post('store',      ['as' => 'admin.profession.store',   'uses' => 'Admin\ProfessionController@store']);
		Route::get('delete/{id}', ['as' => 'admin.profession.delete',  'uses' => 'Admin\ProfessionController@delete']);
	});
	Route::group(['prefix' => 'milstone'], function () {
		Route::get('/',           ['as' => 'admin.milestone',         'uses' => 'Admin\MilestoneController@index']);
		Route::get('create',      ['as' => 'admin.milestone.create',  'uses' => 'Admin\MilestoneController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.milestone.edit',    'uses' => 'Admin\MilestoneController@edit']);
		Route::post('store',      ['as' => 'admin.milestone.store',   'uses' => 'Admin\MilestoneController@store']);
		Route::get('delete/{id}', ['as' => 'admin.milestone.delete',  'uses' => 'Admin\MilestoneController@delete']);
	});
	Route::group(['prefix' => 'image'], function () {
		Route::get('/',           ['as' => 'admin.image',         'uses' => 'Admin\ImageController@index']);
		Route::get('create',      ['as' => 'admin.image.create',  'uses' => 'Admin\ImageController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.image.edit',    'uses' => 'Admin\ImageController@edit']);
		Route::post('store',      ['as' => 'admin.image.store',   'uses' => 'Admin\ImageController@store']);
		Route::get('delete/{id}', ['as' => 'admin.image.delete',  'uses' => 'Admin\ImageController@delete']);
	});
	Route::group(['prefix' => 'service'], function () {
		Route::get('/',           ['as' => 'admin.service',         'uses' => 'Admin\ServiceController@index']);
		Route::get('create',      ['as' => 'admin.service.create',  'uses' => 'Admin\ServiceController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.service.edit',    'uses' => 'Admin\ServiceController@edit']);
		Route::post('store',      ['as' => 'admin.service.store',   'uses' => 'Admin\ServiceController@store']);
		Route::get('delete/{id}', ['as' => 'admin.service.delete',  'uses' => 'Admin\ServiceController@delete']);
	});
	
	Route::group(['prefix' => 'user'], function () {
		Route::get('/',           ['as' => 'admin.user',         'uses' => 'Admin\UserController@index']);
		Route::get('create',      ['as' => 'admin.user.create',  'uses' => 'Admin\UserController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.user.edit',    'uses' => 'Admin\UserController@edit']);
		Route::post('store',      ['as' => 'admin.user.store',   'uses' => 'Admin\UserController@store']);
		Route::post('set',      ['as' => 'admin.user.set',   'uses' => 'Admin\UserController@set']);
		Route::post('status',      ['as' => 'admin.user.status',   'uses' => 'Admin\UserController@status']);
		Route::get('delete/{id}', ['as' => 'admin.user.delete',  'uses' => 'Admin\UserController@delete']);
	});
	Route::group(['prefix' => 'do'], function () {
		Route::get('/',           ['as' => 'admin.do',         'uses' => 'Admin\DoClientController@index']);
		Route::get('create',      ['as' => 'admin.do.create',  'uses' => 'Admin\DoClientController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.do.edit',    'uses' => 'Admin\DoClientController@edit']);
		Route::post('store',      ['as' => 'admin.do.store',   'uses' => 'Admin\DoClientController@store']);
		Route::get('delete/{id}', ['as' => 'admin.do.delete',  'uses' => 'Admin\DoClientController@delete']);
	});
	Route::group(['prefix' => 'faq'], function () {
		Route::get('/',           ['as' => 'admin.faq',         'uses' => 'Admin\FaqController@index']);
		Route::get('create',      ['as' => 'admin.faq.create',  'uses' => 'Admin\FaqController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.faq.edit',    'uses' => 'Admin\FaqController@edit']);
		Route::post('store',      ['as' => 'admin.faq.store',   'uses' => 'Admin\FaqController@store']);
		Route::get('delete/{id}', ['as' => 'admin.faq.delete',  'uses' => 'Admin\FaqController@delete']);
	});
	Route::group(['prefix' => 'contact'], function () {
		Route::get('/',           ['as' => 'admin.contact',         'uses' => 'Admin\ContactController@index']);
		Route::get('create',      ['as' => 'admin.contact.create',  'uses' => 'Admin\ContactController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.contact.edit',    'uses' => 'Admin\ContactController@edit']);
		Route::post('store',      ['as' => 'admin.contact.store',   'uses' => 'Admin\ContactController@store']);
		Route::get('delete/{id}', ['as' => 'admin.contact.delete',  'uses' => 'Admin\ContactController@delete']);
	});
	Route::group(['prefix' => 'rate'], function () {
		Route::get('/',           ['as' => 'admin.rate',         'uses' => 'Admin\RateController@index']);
		Route::get('create',      ['as' => 'admin.rate.create',  'uses' => 'Admin\RateController@create']);
		Route::get('confirm/{id}',   ['as' => 'admin.rate.confirm',    'uses' => 'Admin\RateController@confirm']);
		Route::post('store',      ['as' => 'admin.rate.store',   'uses' => 'Admin\RateController@store']);
		Route::get('delete/{id}', ['as' => 'admin.rate.delete',  'uses' => 'Admin\RateController@delete']);
	});

	Route::group(['prefix' => 'cms'], function () {
		Route::get('/',           ['as' => 'admin.cms',         'uses' => 'Admin\CmsController@index']);
		Route::get('create',      ['as' => 'admin.cms.create',  'uses' => 'Admin\CmsController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.cms.edit',    'uses' => 'Admin\CmsController@edit']);
		Route::post('store',      ['as' => 'admin.cms.store',   'uses' => 'Admin\CmsController@store']);
		Route::get('delete/{id}', ['as' => 'admin.cms.delete',  'uses' => 'Admin\CmsController@delete']);
	});
	Route::group(['prefix' => 'client'], function () {
		Route::get('/',           ['as' => 'admin.client',         'uses' => 'Admin\ClientController@index']);
		Route::get('create',      ['as' => 'admin.client.create',  'uses' => 'Admin\ClientController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.client.edit',    'uses' => 'Admin\ClientController@edit']);
		Route::post('store',      ['as' => 'admin.client.store',   'uses' => 'Admin\ClientController@store']);
		Route::get('delete/{id}', ['as' => 'admin.client.delete',  'uses' => 'Admin\ClientController@delete']);
	});
	
	Route::group(['prefix' => 'analytics'], function () {
		Route::get('/',           ['as' => 'admin.anlaytics',         'uses' => 'Admin\AnalyticsController@index']);
	});
});