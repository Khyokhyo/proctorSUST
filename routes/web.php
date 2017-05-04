<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', 'HomeController@getWelcome')->name('root');

Route::get('notice', 'HomeController@getNotice');

Route::get('office', 'HomeController@getOffice');

Route::get('policy', 'HomeController@getPolicy');

Route::get('team', 'HomeController@getTeam');

Route::get('login', function () {
    return view('login');
});
Route::get('register', function () {
    return view('register');
});

Route::get('proctor', function () {
    return view('proctor');
});
Route::get('member', function () {
    return view('member');
});

Route::get('registerProc', function () {
    return view('registerProc');
});
Route::get('registerOrg', function () {
    return view('registerOrg');
});

Route::post('registerPostProc', 'HomeController@postRegisterProc');
Route::post('registerPostOrg', 'HomeController@postRegisterOrg');

Route::post('login', 'HomeController@postLogin');

Route::group( ['middleware' => 'auth'], function(){

    Route::get('putEditPassword', array('uses' => 'HomeController@putEditPassword', 'as' => 'putEditPassword'));
    Route::post('logout', 'HomeController@logout');


	//admin routes
    Route::group( ['middleware' => 'role:0'], function(){

    Route::get('adminHome', 'AdminController@getAdminHome');
    Route::get('adminProcList', 'AdminController@getAdminProcList');
    Route::get('adminCommittee', 'AdminController@getAdminCommittee');
    Route::get('putAdminCommittee', array('uses' => 'AdminController@putAdminCommittee', 'as' => 'putAdminCommittee'));
    Route::get('adminPolicy', 'AdminController@getAdminPolicy');
    Route::get('putAdminPolicy', array('uses' => 'AdminController@putAdminPolicy', 'as' => 'putAdminPolicy'));
    Route::post('addAdminPolicy', array('uses' => 'AdminController@addAdminPolicy', 'as' => 'addAdminPolicy'));
    Route::get('deleteAdminPolicy/{id}', array('uses' => 'AdminController@deleteAdminPolicy', 'as' => 'deleteAdminPolicy'));
    Route::get('adminApproval', 'AdminController@getAdminApproval');
    Route::get('putAdminApproval', array('uses' => 'AdminController@putAdminApproval', 'as' => 'putAdminApproval'));
    Route::get('deleteAdminApproval/{id}', array('uses' => 'AdminController@deleteAdminApproval', 'as' => 'deleteAdminApproval'));
    });


    //org routes
    Route::group( ['middleware' => 'role:1'], function(){
    Route::get('orgHome', array('uses' => 'OrgController@getOrgHome', 'as' => 'orgHome'));
    Route::get('orgNotice', array('uses' => 'OrgController@getOrgNotice', 'as' => 'orgNotice'));
    Route::get('orgCommittee', array('uses' => 'OrgController@getOrgCommittee', 'as' => 'orgCommittee'));
    
    Route::get('putOrgHome', array('uses' => 'OrgController@putOrgHome', 'as' => 'putOrgHome'));
    Route::post('addOrgCom', array('uses' => 'OrgController@addOrgCom', 'as' => 'addOrgCom'));
    Route::get('removeAdvisor/{id}', array('uses' => 'OrgController@removeAdvisor', 'as' => 'removeAdvisor'));
    Route::get('removeMember/{id}', array('uses' => 'OrgController@removeMember', 'as' => 'removeMember'));
    
    Route::post('addAdvisor', array('uses' => 'OrgController@addAdvisor', 'as' => 'addAdvisor'));
    });
     

    //proc com routes
    Route::group( ['middleware' => 'role:2'], function(){
    
    Route::get('procHome', array('uses' => 'ProcController@getProcHome', 'as' => 'procHome'));
    
    Route::get('approveOrg/{id}', array('uses' => 'ProcController@approveOrg', 'as' => 'approveOrg'));
    Route::get('approveAdvisor/{id}', array('uses' => 'ProcController@approveAdvisor', 'as' => 'approveAdvisor'));
    Route::get('approveOrgCom/{id}', array('uses' => 'ProcController@approveOrgCom', 'as' => 'approveOrgCom'));
    
    Route::get('denyOrg/{id}', array('uses' => 'ProcController@denyOrg', 'as' => 'denyOrg'));
        
    Route::get('denyOrgCom/{id}', array('uses' => 'ProcController@denyOrgCom', 'as' => 'denyOrgCom'));
    Route::get('denyAdvisor/{id}', array('uses' => 'ProcController@denyAdvisor', 'as' => 'denyAdvisor'));
    Route::get('approveAll/{id}', array('uses' => 'ProcController@getApproveAll', 'as' => 'approveAll'));
    // Route::get('getApproveCom/{id}', array('uses' => 'ProcController@getApproveCom', 'as' => 'approveCom'));
    
    Route::get('viewChangeRequest/{id}', 'ProcController@getViewChangeRequest' )->name('viewChangeRequest');
    
    Route::get('procApprovals', array('uses' => 'ProcController@getProcApprovals', 'as' => 'procApprovals'));
    Route::get('procTeachers', array('uses' => 'ProcController@getProcTeachers', 'as' => 'procTeachers'));

    Route::get('procNotice', 'ProcController@getProcNotice');
    Route::get('procByNotice', 'ProcController@getProcByNotice');
    Route::get('viewProcNotice/{id}', array('uses' => 'ProcController@viewProcNotice', 'as' => 'viewProcNotice'));
    Route::get('deleteProcNotice/{id}', array('uses' => 'ProcController@deleteProcNotice', 'as' => 'deleteProcNotice'));
    Route::get('procOrganizations', 'ProcController@getProcOrganizations');
    Route::get('blockOrg/{id}', array('uses' => 'ProcController@postBlockOrg', 'as' => 'blockOrg'));
    Route::get('unblockOrg/{id}', array('uses' => 'ProcController@postUnblockOrg', 'as' => 'unblockOrg'));
    Route::get('departments', array('uses' => 'ProcController@getDepartments', 'as' => 'departments'));
    Route::get('teachers/{id}', array('uses' => 'ProcController@getTeachers', 'as' => 'teachers'));
    
    Route::post('createNotice', array('uses' => 'ProcController@postCreateNotice', 'as' => 'notice') );

    Route::post('test', array('uses' => 'ProcController@postTest', 'as' => 'test') );

    Route::get('approveNotice', array('uses' => 'ProcController@getApproveNotice', 'as' => 'approveNotice') );
    Route::get('appNotice/{id}', array('uses' => 'ProcController@appNotice', 'as' => 'appNotice'));
    Route::get('denyNotice/{id}', array('uses' => 'ProcController@denyNotice', 'as' => 'denyNotice'));

    });

});