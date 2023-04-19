<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\Home\LoginController;
use App\Http\Controllers\Test\testController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// home模块
Route::group(['prefix' => 'login', 'namespace' =>'Home'], function() {
	Route::get('/', [LoginController::class, 'index'])->name('login');
	Route::get('cube', 'LogincubeController@index')->name('logincube');
	Route::post('checklogin', [LoginController::class, 'checklogin'])->name('login.checklogin');
	Route::post('checklogincube', 'LogincubeController@checklogin')->name('logincube.checklogin');
});


// main模块
Route::group(['prefix'=>'', 'namespace'=>'Main', 'middleware'=>['jwtauth']], function() {
	Route::any('/', [MainController::class, 'mainPortal']);
	Route::get('portal', [MainController::class, 'mainPortal'])->name('portal');
	// Route::get('portalcube', 'MainController@mainPortalcube')->name('portalcube');
	// Route::get('portalcubeuser', 'MainController@portalcubeUser')->name('portalcubeuser');
	Route::get('configgets', [MainController::class, 'configGets'])->name('smt.configgets');

	// logout
	Route::get('logout', [MainController::class, 'logout'])->name('main.logout');

	// dateofsetup
	Route::get('dateofsetup', [MainController::class, 'dateofsetup'])->name('dateofsetup');
});


// Pdfs路由
// Route::group(['prefix'=>'renshi', 'namespace'=>'Admin', 'middleware'=>['jwtauth','permission:permission_admin_permission|permission_super_admin']], function() {
Route::group(['prefix'=>'pdfs', 'namespace'=>'Pdfs', 'middleware'=>['jwtauth']], function() {

    // 显示applicant页面
    Route::get('applicant', 'ApplicantController@applicant')->name('pdfs.applicant');

    // jiaban gets列表
    Route::get('jiabanGetsApplicant', 'ApplicantController@jiabanGetsApplicant')->name('renshi.jiaban.jiabangetsapplicant');

    // applicant页面 查询employee_uid
    Route::get('uidList', 'ApplicantController@uidList')->name('renshi.jiaban.applicant.uidlist');

    // applicant页面 查询auditing
    Route::get('auditingList', 'ApplicantController@auditingList')->name('renshi.jiaban.applicant.auditinglist');

    // applicant页面 查询employee
    Route::get('employeeList', 'ApplicantController@employeeList')->name('renshi.jiaban.applicant.employeelist');

    // applicant页面 批量录入1
    Route::post('applicantCreate1', 'ApplicantController@applicantCreate1')->name('renshi.jiaban.applicant.applicantcreate1');

    // applicant页面 批量录入2
    Route::post('applicantCreate2', 'ApplicantController@applicantCreate2')->name('renshi.jiaban.applicant.applicantcreate2');

    // applicant页面 软删除
    Route::post('applicantTrash', 'ApplicantController@applicantTrash')->name('renshi.jiaban.applicant.applicanttrash');

    // applicant页面 软删除恢复
    Route::post('applicantRestore', 'ApplicantController@applicantRestore')->name('renshi.jiaban.applicant.applicantrestore');

    // applicant页面 硬删除
    Route::post('applicantDelete', 'ApplicantController@applicantDelete')->name('renshi.jiaban.applicant.applicantdelete');

    // applicant页面 归档
    Route::post('applicantArchived', 'ApplicantController@applicantArchived')->name('renshi.jiaban.applicant.applicantarchived');

    // applicant页面 查询department
    // Route::get('departmentList', 'ApplicantController@departmentList')->name('renshi.jiaban.applicant.departmentlist');
    
    // 列出当前用户拥有的角色
    // Route::get('department2Applicant', 'ApplicantController@department2Applicant')->name('renshi.jiaban.applicant.department2applicant');

    // 列出Tree用户
    Route::get('loadApplicant', 'ApplicantController@loadApplicant')->name('renshi.jiaban.applicant.loadapplicant');

    // 列出loadapplicantgroup
    Route::get('loadApplicantGroup', 'ApplicantController@loadApplicantGroup')->name('renshi.jiaban.applicant.loadapplicantgroup');

    // loadapplicantgroupdetails
    Route::get('loadApplicantGroupDetails', 'ApplicantController@loadApplicantGroupDetails')->name('renshi.jiaban.applicant.loadapplicantgroupdetails');

    // 新增人员组
    Route::post('createApplicantGroup', 'ApplicantController@createApplicantGroup')->name('renshi.jiaban.applicant.createapplicantgroup');

    // 删除人员组
    Route::post('deleteApplicantGroup', 'ApplicantController@deleteApplicantGroup')->name('renshi.jiaban.applicant.deleteapplicantgroup');

    // 配置变更
    Route::post('changeConfigs', 'ApplicantController@changeConfigs')->name('renshi.jiaban.applicant.changeconfigs');

    // 导出列表
    Route::get('applicantExport', 'ApplicantController@applicantExport')->name('renshi.jiaban.applicant.applicantexport');


    // 22222222222
    // 显示todo页面
    Route::get('jiabanTodo', 'ApplicantController@jiabanTodo')->name('renshi.jiaban.applicant_todo');

    // jiaban gets列表
    Route::get('jiabanGetsTodo', 'ApplicantController@jiabanGetsTodo')->name('renshi.jiaban.jiabangetstodo');

    // todo页面 pass
    Route::post('todoPass', 'ApplicantController@todoPass')->name('renshi.jiaban.todo.pass');

    // todo页面 deny
    Route::post('todoDeny', 'ApplicantController@todoDeny')->name('renshi.jiaban.todo.deny');

    // todo页面 软删除
    Route::post('todoTrash', 'ApplicantController@todoTrash')->name('renshi.jiaban.todo.todotrash');

    // todo页面 软删除恢复
    Route::post('todoRestore', 'ApplicantController@todoRestore')->name('renshi.jiaban.todo.todorestore');
    
    // todo 硬删除
    Route::post('todoDelete', 'ApplicantController@todoDelete')->name('renshi.jiaban.todo.tododelete');
    

    // 333333333
    // 显示confirm页面
    Route::get('jiabanConfirm', 'ConfirmController@jiabanConfirm')->name('renshi.jiaban.confirm');

    // jiaban confirm gets列表
    Route::get('jiabanGetsConfirm', 'ConfirmController@jiabanGetsConfirm')->name('renshi.jiaban.jiabangetsconfirm');



    // 444444444
    // 显示confirm todo页面
    Route::get('jiabanConfirmTodo', 'ConfirmController@jiabanConfirmTodo')->name('renshi.jiaban.confirm_todo');

    // jiaban confirm todo gets列表
    Route::get('jiabanGetsConfirmTodo', 'ConfirmController@jiabanGetsConfirmTodo')->name('renshi.jiaban.jiabangetsconfirmtodo');

    // 确认-确认 页面 查询auditing
    Route::get('auditingListConfirm', 'ConfirmController@auditingListConfirm')->name('renshi.jiaban.applicant.auditinglistconfirm');




    // 555555555
    // 显示archived页面
    Route::get('jiabanArchived', 'ApplicantController@jiabanArchived')->name('renshi.jiaban.archived');

    // archived gets列表
    Route::get('jiabanGetsArchived', 'ApplicantController@jiabanGetsArchived')->name('renshi.jiaban.jiabangetsarchived');

    // archived页面 软删除
    Route::post('archivedTrash', 'ApplicantController@archivedTrash')->name('renshi.jiaban.archived.archivedtrash');

    // archived页面 软删除恢复
    Route::post('archivedRestore', 'ApplicantController@archivedRestore')->name('renshi.jiaban.archived.archivedrestore');
    
    // archived 硬删除
    Route::post('archivedDelete', 'ApplicantController@archivedDelete')->name('renshi.jiaban.archived.archiveddelete');

    // 导出列表
    Route::get('archivedExport', 'ApplicantController@archivedExport')->name('renshi.jiaban.archived.archivedexport');


    // 66666666
    // 显示Analytics页面
    Route::get('jiabanAnalytics', 'ApplicantController@jiabanAnalytics')->name('renshi.jiaban.analytics');

    // Analytics gets列表
    Route::get('jiabanGetsAnalytics', 'ApplicantController@jiabanGetsAnalytics')->name('renshi.jiaban.jiabangetsanalytics');

    // Analytics 查询applicant
    Route::get('applicantList', 'ApplicantController@applicantList')->name('renshi.jiaban.applicant.applicantlist');

    
});


// 测试用
// Route::group(['prefix'=>'test', 'namespace'=>'Test', 'middleware'=>['jwtauth','permission:permission_super_admin']], function() {
Route::group(['prefix'=>'test', 'namespace'=>'Test', 'middleware'=>[]], function() {
    Route::get('test', [testController::class, 'test']);
    // Route::get('phpinfo', 'testController@phpinfo');
    Route::get('phpinfo', [testController::class, 'phpinfo']);
    Route::get('ldap', [testController::class, 'ldap']);
    Route::get('scroll', [testController::class, 'scroll']);
    Route::get('mint', [testController::class, 'mint']);
    Route::get('muse', [testController::class, 'muse']);
    Route::get('vant', [testController::class, 'vant']);
    Route::get('cube', [testController::class, 'cube']);
    Route::get('mysql', [testController::class, 'mysql']);
    Route::get('pgsql', [testController::class, 'pgsql']);
    Route::get('pdf', [testController::class, 'pdf']);

    // 测试camera
    Route::get('camera', [testController::class, 'camera']);
    Route::post('testCamera', [testController::class, 'testCamera'])->name('test.camera.testcamera');

    // 测试邮件
    Route::get('mail', [testController::class, 'mail']);

    // 测试echarts
    Route::get('echarts', [testController::class, 'echarts']);
});
    