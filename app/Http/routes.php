<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



// Route::get('home', function () {
//     return view('welcome');
// });

Route::get('error', function(){
	return view('errors.503');
});

	

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth','timeout']], function () {

    Route::get('/',['as' => 'dashboard', 'uses'=>'DashboardController@index']);

});



// For Payment Method

Route::resource('payment','PaymentController');
Route::resource('withdrawalpayment','WithdrawalPaymentController');



Route::group(['prefix' => 'profile', 'middleware' => ['auth', 'timeout']], function(){
	Route::get('/', 			[ 'as' => 'profile', 			'uses' => 'ProfileController@index' ]);
	Route::post('/userinfo', 	[ 'as' => 'profile.userinfo', 	'uses' => 'ProfileController@userInfoupdate']);
	Route::post('/password', 	[ 'as' => 'profile.password', 	'uses' => 'ProfileController@passwordChangeRequest']);
	Route::post('/pin', 		[ 'as' => 'profile.pin', 		'uses' => 'ProfileController@pinChangeRequest']);
	Route::post('/email',		[ 'as' => 'profile.email', 		'uses' => 'ProfileController@emailChangeRequest']);
	Route::post('/phone', 		[ 'as' => 'profile.phone', 		'uses' => 'ProfileController@phoneChangeRequest']);

});



Route::get('blank', 'AdminController@blank');

// Routing for Admin Panel 

Route::group(['prefix' => 'admin', 'middleware' => ['auth','timeout','admin:admin']],  function () {
	
	Route::get('/', ['as' =>'admin', 'uses' => 'AdminController@index' ]);


	//reports routes
	Route::get('/reports/deposit', 		['as' =>'admin.reports.deposit', 	 	'uses' => 'AdminReportsController@getDepositReport' ]);
	Route::get('/reports/withdrawl', 	['as' =>'admin.reports.withdrawl',  	'uses' => 'AdminReportsController@getWithdrawlReport' ]);
	Route::get('/reports/transaction', 	['as' =>'admin.reports.transaction', 	'uses' => 'AdminReportsController@getTransactionReport' ]);
	Route::get('/reports/drc', 			['as' =>'admin.reports.drc', 		 	'uses' => 'AdminReportsController@getDrcReport' ]);
	Route::get('/reports/src', 			['as' =>'admin.reports.src', 		 	'uses' => 'AdminReportsController@getSrcReport' ]);
	Route::get('/reports/payment', 		['as' =>'admin.reports.payment', 		'uses' => 'AdminReportsController@getPaymentReport' ]);
	



	Route::get('/totalusers', ['as' =>'admin.totalusers', 'uses' => 'AdminDetailsController@totalusers' ]);		
	Route::get('/totaldeposit', ['as' =>'admin.totaldeposit', 'uses' => 'AdminDetailsController@totaldeposit' ]);		
	Route::get('/totalwithdrawl', ['as' =>'admin.totalwithdrawl', 'uses' => 'AdminDetailsController@totalwithdrawl' ]);		
	
	

	Route::get('/roiprocess', [ 'as' => 'admin/roiprocess', 'uses' => 'AdminController@getRoiProcess']);
	Route::get('/roiprocess/roigenerate', [ 'as' => 'admin.roiprocess.roigenerate', 'uses' => 'AdminController@getRoiGenerate']);


	Route::get('/withdrawal', ['as' =>'admin.withdrawal', 'uses' => 'AdminController@getWithdrawal' ]);
	Route::post('/withdrawal/cancel', [ 'as' => 'admin.withdrawal.cancel', 'uses' => 'AdminController@getWithdrawalCancel']);
	Route::get('/withdrawal/check/{id}', [ 'as' => 'admin.withdrawal.check', 'uses' => 'AdminController@getWithdrawalCheck']);




	Route::get('/transfer', ['as' =>'admin.transfer', 'uses' => 'AdminController@getTransfer' ]);
	Route::get('/stepreferral', [ 'as' => 'admin.stepreferral', 'uses' => 'AdminController@stepReferralGenerate']);
	Route::get('/stepreferral/generate', [ 'as' => 'admin.stepreferral.generate', 'uses' => 'AdminController@getGenerate']);
	


	Route::get('/support/view/{slag}', ['as' =>'admin.support.view', 'uses' => 'SupportController@viewSupport' ]);
	Route::post('/support/response', ['as' =>'admin.support.response', 'uses' => 'SupportController@responseSupport' ]);

	
	Route::get('/manage/uesr', ['as' =>'admin.manage.uesr', 'uses' => 'ManageUserController@getUserRequest' ]);
	Route::get('/manage/uplinechange', ['as' =>'admin.manage.uplinechange', 'uses' => 'ManageUserController@uplineChange' ]);
	Route::post('/manage/uplinechange/request', ['as' =>'admin.manage.uplinechange.request', 'uses' => 'ManageUserController@uplineChangeRequest' ]);

	Route::get('/ccRequest/update/{id}', ['as' =>'admin.ccRequest.update', 'uses' => 'ManageUserController@update' ]);

});

// Routing for User Panel 

Route::group(['prefix' => 'user', 'middleware' => ['auth','timeout', 'admin:user']],  function () {
	Route::get('/', ['as' =>'user', 'uses' => 'UserController@index' ]);
	
	Route::get('/register', ['as' =>'user.register', 'uses' => 'UserController@postRegister' ]);
	Route::post('/store', ['as' =>'user.store', 'uses' => 'UserController@store' ]);

	
	

	// Routes for deposit system
	Route::get('/deposit', 			[ 'as' => 'user.deposit', 			'uses' => 'AccountController@getDeposit' ]);
	Route::post('/makedeposit', 	[ 'as' => 'user.makedeposit', 		'uses' => 'AccountController@makeDeposit' ]);
	Route::post('/pmdeposit', 		[ 'as' => 'user.pmdeposit', 		'uses' => 'AccountController@pmDeposit' ]);
	Route::post('/pmpay', 			[ 'as' => 'user.pmpay', 			'uses' => 'AccountController@payWithPerfectMoney']);
	Route::get('/withdrawal', 		[ 'as' => 'user.withdrawal', 		'uses' => 'AccountController@getWithdrawal' ]);
	Route::post('/requestWithdraw',	[ 'as' => 'user.requestWithdraw', 	'uses' => 'AccountController@requestWithdraw'] );



	
	// Routes for internal balance transfer
	Route::get('/transfer', ['as' =>'user.transfer', 'uses' => 'BalanceTransferController@getTransfer' ]);
	Route::post('/rtwtransfer', ['as' =>'user.rtwtransfer', 'uses' => 'BalanceTransferController@rtwTransfer' ]);
	Route::post('/rtrtransfer', ['as' =>'user.rtrtransfer', 'uses' => 'BalanceTransferController@rtrTransfer' ]);
	Route::post('/wtwtransfer', ['as' =>'user.wtwtransfer', 'uses' => 'BalanceTransferController@wtwTransfer' ]);
	Route::get('/balanceTransfer/confirm/{tnx}', ['as' => 'user.transfer.confirm', 'uses' => 'BalanceTransferController@getConfirm']);

	

	Route::get('/pay',  ['as' => 'user.pay', 'uses' => 'UserController@payFromWallet']);
	Route::get('/pmpay',[ 'as'=> 'user.pmpay', 'uses' => 'UserController@payFormPerfectMoney'] );

	Route::post('/support',[ 'as'=> 'user.support', 'uses' => 'SupportController@postSupport'] );
	Route::get('/support/view/{slug}',[ 'as'=> 'user.support.view', 'uses' => 'SupportController@viewNotification'] );
	Route::get('/support/allnotification',[ 'as'=> 'user.support.allnotification', 'uses' => 'SupportController@allNotification'] );

	Route::get('/support/notview/{id}',[ 'as'=> 'user.support.view', 'uses' => 'SupportController@notView'] );

	
});

Route::group(['prefix' => 'userReports', 'middleware' => ['auth','timeout', 'admin:user']],  function () {
		
		Route::get('/deposit', ['as' =>'userReports.deposit', 'uses' => 'ReportsController@getDepositHistory' ]);	
		Route::get('/withdrawal', ['as' =>'userReports.withdrawal', 'uses' => 'ReportsController@getWithdrawalHistory' ]);
		Route::get('/transaction', ['as' =>'userReports.transaction', 'uses' => 'ReportsController@getTransactionHistory' ]);
		Route::get('/earning', ['as' =>'userReports.earning', 'uses' => 'ReportsController@getEarningDetails' ]);
		Route::get('/drcreport', ['as' =>'userReports.drcreport', 'uses' => 'ReportsController@getDrcReport' ]);
		Route::get('/srcreport', ['as' =>'userReports.srcreport', 'uses' => 'ReportsController@getSrcReport' ]);
		Route::get('/downline', ['as' =>'userReports.downline', 'uses' => 'ReportsController@getDownlineReport' ]);

	});







// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::get('auth/register', 'Auth\AuthController@postRegister');


// Password reset link request routes...
/*Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');*/

// Password reset routes...
// Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
// Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::post('password/reset', 'PasswordResetController@postReset');
Route::get('resetpassword', 'PasswordResetController@resetPassword');
Route::post('resetpassword/save', 'PasswordResetController@savePassword');



// ajax start

Route::get('/ajaxPasswordCheck/{oldPassword}','ProfileController@checkPassword');
Route::get('/ajaxPinCheck/{oldPin}','ProfileController@checkPin');
Route::get('/ajaxEmailChange/{curEmail}','ProfileController@emailChange'); 
Route::get('/ajaxPhoneChange/{curPhone}','ProfileController@phoneChange');

Route::get('/referralTree/{slug}','ReferralController@index');
Route::get('/ajaxSearch/{name}', 'ReferralController@searchName');


// ajax checking routs on balance transfer
Route::get('/ajaxCheckRtwPin/{rtwPin}', 'BalanceTransferController@checkRtwPin');
Route::get('/ajaxCheckRtwAmount/{rtwAmount}','BalanceTransferController@checkRtwAmount');

Route::get('/ajaxCheckRtrAmount/{rtrAmount}','BalanceTransferController@checkRtrAmount');
Route::get('/ajaxCheckRtrReceiver/{rtrReceiver}','BalanceTransferController@checkRtrReceiver');
Route::get('/ajaxCheckRtrPin/{rtrPin}', 'BalanceTransferController@checkRtrPin');

Route::get('/ajaxCheckWtwAmount/{wtwAmount}','BalanceTransferController@checkWtwAmount');
Route::get('/ajaxCheckWtwReceiver/{wtwReceiver}','BalanceTransferController@checkWtwReceiver');
Route::get('/ajaxCheckWtwPin/{wtwPin}', 'BalanceTransferController@checkWtwPin');
// ajax checking routs on balance transfer end


Route::get('/ajaxCheckDeposit/{deposit}', 'AccountController@checkDeposit');


//This route is for checking wb and roi balance on withdrawal request and make compare
Route::get('/ajaxCheckBalanceType/{balanceType}', 'AccountController@checkBalanceTypeAndCompare');
Route::get('/ajaxCheckWithdrawRequestPin/{pinCode}', 'AccountController@checkPinWithdrawalRequest');




Route::get('/ajaxCheckUser/{uname}','UserController@checkUserLive');
Route::get('/ajaxCheckReferrar/{referralId}','UserController@checkReferrar');  
Route::get('/ajaxCheckUplineUser/{uplineId}','UserController@checkUplineUser'); 


Route::get('/ajaxsearchuser/{suser}','ManageUserController@ajaxSearchUser'); 
Route::get('/ajaxCheckNewUpline/{nupline}','ManageUserController@ajaxCheckNewUpline'); 

