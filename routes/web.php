<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\Home\LoginController;
use App\Http\Controllers\Pdfs\ApplicantController;
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
	Route::post('checklogin', [LoginController::class, 'checklogin'])->name('login.checklogin');
});


// main模块
Route::group(['prefix'=>'', 'namespace'=>'Main', 'middleware'=>['jwtauth']], function() {
	Route::get('/', [MainController::class, 'mainPortal']);
	Route::get('portal', [MainController::class, 'mainPortal'])->name('portal');
	Route::get('configgets', [MainController::class, 'configGets'])->name('smt.configgets');

	// logout
	Route::get('logout', [MainController::class, 'logout'])->name('main.logout');

	// dateofsetup
	Route::get('dateofsetup', [MainController::class, 'dateofsetup'])->name('dateofsetup');
});


// Pdfs路由
// Route::group(['prefix'=>'renshi', 'namespace'=>'Admin', 'middleware'=>['jwtauth','permission:permission_admin_permission|permission_super_admin']], function() {
Route::group(['prefix'=>'pdfs', 'namespace'=>'Pdfs', 'middleware'=>['jwtauth']], function() {

    // 11111111111111
    // 显示applicant页面
    Route::get('applicant', [ApplicantController::class, 'applicant'])->name('pdfs.applicant');

    // jiaban gets列表
    Route::get('getsApplicant', [ApplicantController::class, 'getsApplicant'])->name('pdfs.getsapplicant');

    // applicant页面 查询employee_uid
    Route::get('uidList', [ApplicantController::class, 'uidList'])->name('renshi.jiaban.applicant.uidlist');

    // applicant页面 查询auditing
    Route::get('auditingList', [ApplicantController::class, 'auditingList'])->name('renshi.jiaban.applicant.auditinglist');

    // applicant页面 查询employee
    Route::get('employeeList', [ApplicantController::class, 'employeeList'])->name('renshi.jiaban.applicant.employeelist');

    // applicant页面 批量录入1
    Route::post('applicantCreate1', [ApplicantController::class, 'applicantCreate1'])->name('pdfs.applicant.applicantcreate1');

    // applicant页面 批量录入2
    Route::post('applicantCreate2', [ApplicantController::class, 'applicantCreate2'])->name('renshi.jiaban.applicant.applicantcreate2');

    // applicant页面 软删除
    Route::post('applicantTrash', [ApplicantController::class, 'applicantTrash'])->name('renshi.jiaban.applicant.applicanttrash');

    // applicant页面 软删除恢复
    Route::post('applicantRestore', [ApplicantController::class, 'applicantRestore'])->name('renshi.jiaban.applicant.applicantrestore');

    // applicant页面 硬删除
    Route::post('applicantDelete', [ApplicantController::class, 'applicantDelete'])->name('renshi.jiaban.applicant.applicantdelete');

    // applicant页面 归档
    Route::post('applicantArchived', [ApplicantController::class, 'applicantArchived'])->name('renshi.jiaban.applicant.applicantarchived');

    // applicant页面 查询department
    // Route::get('departmentList', 'ApplicantController@departmentList')->name('renshi.jiaban.applicant.departmentlist');
    
    // 列出当前用户拥有的角色
    // Route::get('department2Applicant', 'ApplicantController@department2Applicant')->name('renshi.jiaban.applicant.department2applicant');

    // 列出Tree用户
    Route::get('loadApplicant', [ApplicantController::class, 'loadApplicant'])->name('renshi.jiaban.applicant.loadapplicant');

    // 列出loadapplicantgroup
    Route::get('loadApplicantGroup', [ApplicantController::class, 'loadApplicantGroup'])->name('renshi.jiaban.applicant.loadapplicantgroup');

    // loadapplicantgroupdetails
    Route::get('loadApplicantGroupDetails', [ApplicantController::class, 'loadApplicantGroupDetails'])->name('renshi.jiaban.applicant.loadapplicantgroupdetails');

    // 新增人员组
    Route::post('createApplicantGroup', [ApplicantController::class, 'createApplicantGroup'])->name('renshi.jiaban.applicant.createapplicantgroup');

    // 删除人员组
    Route::post('deleteApplicantGroup', [ApplicantController::class, 'deleteApplicantGroup'])->name('renshi.jiaban.applicant.deleteapplicantgroup');

    // 配置变更
    Route::post('changeConfigs', [ApplicantController::class, 'changeConfigs'])->name('pdfs.applicant.changeconfigs');

    // 导出列表
    Route::get('applicantExport', [ApplicantController::class, 'applicantExport'])->name('renshi.jiaban.applicant.applicantexport');

	// 上传导入pdf文件
	Route::post('applicantimport', [ApplicantController::class, 'applicantImport'])->name('pdfs.applicantimport');


    // 22222222222
    // 显示todo页面
    Route::get('todo', [ApplicantController::class, 'todo'])->name('pdfs.todo');

    // jiaban gets列表
    Route::get('todoGets', [ApplicantController::class, 'todoGets'])->name('pdfs.todogets');

    // todo页面 pass
    Route::post('todoPass', [ApplicantController::class, 'todoPass'])->name('pdfs.todo.pass');

    // todo页面 deny
    Route::post('todoDeny', [ApplicantController::class, 'todoDeny'])->name('pdfs.todo.deny');

    // todo页面 软删除
    Route::post('todoTrash', [ApplicantController::class, 'todoTrash'])->name('pdfs.todo.todotrash');

    // todo页面 软删除恢复
    Route::post('todoRestore', [ApplicantController::class, 'todoRestore'])->name('pdfs.todo.todorestore');
    
    // todo 硬删除
    Route::post('todoDelete', [ApplicantController::class, 'todoDelete'])->name('pdfs.todo.tododelete');
    

    // 333333333
    // 显示confirm页面
    Route::get('jiabanConfirm', 'ConfirmController@jiabanConfirm')->name('pdfs.confirm');

    // jiaban confirm gets列表
    //Route::get('jiabanGetsConfirm', 'ConfirmController@jiabanGetsConfirm')->name('renshi.jiaban.jiabangetsconfirm');



    // 444444444
    // 显示confirm todo页面
    Route::get('jiabanConfirmTodo', 'ConfirmController@jiabanConfirmTodo')->name('pdfs.confirm_todo');

    // jiaban confirm todo gets列表
    //Route::get('jiabanGetsConfirmTodo', 'ConfirmController@jiabanGetsConfirmTodo')->name('renshi.jiaban.jiabangetsconfirmtodo');

    // 确认-确认 页面 查询auditing
    //Route::get('auditingListConfirm', 'ConfirmController@auditingListConfirm')->name('renshi.jiaban.applicant.auditinglistconfirm');




    // 555555555
    // 显示archived页面
    Route::get('jiabanArchived', 'ApplicantController@jiabanArchived')->name('pdfs.archived');

    // archived gets列表
    //Route::get('jiabanGetsArchived', 'ApplicantController@jiabanGetsArchived')->name('renshi.jiaban.jiabangetsarchived');

    // archived页面 软删除
    //Route::post('archivedTrash', 'ApplicantController@archivedTrash')->name('renshi.jiaban.archived.archivedtrash');

    // archived页面 软删除恢复
    //Route::post('archivedRestore', 'ApplicantController@archivedRestore')->name('renshi.jiaban.archived.archivedrestore');
    
    // archived 硬删除
    //Route::post('archivedDelete', 'ApplicantController@archivedDelete')->name('renshi.jiaban.archived.archiveddelete');

    // 导出列表
    //Route::get('archivedExport', 'ApplicantController@archivedExport')->name('renshi.jiaban.archived.archivedexport');


    // 66666666
    // 显示Analytics页面
    Route::get('jiabanAnalytics', 'ApplicantController@jiabanAnalytics')->name('pdfs.analytics');

    // Analytics gets列表
    //Route::get('jiabanGetsAnalytics', 'ApplicantController@jiabanGetsAnalytics')->name('renshi.jiaban.jiabangetsanalytics');

    // Analytics 查询applicant
    //Route::get('applicantList', 'ApplicantController@applicantList')->name('renshi.jiaban.applicant.applicantlist');

    
});


// AdminController路由 修改密码
Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['jwtauth','permission:permission_admin_changepassword|permission_super_admin']], function() {
	// 修改密码
	Route::post('passwordchange', 'AdminController@passwordChange')->name('admin.password.change');
});


// AdminController路由
Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['jwtauth','permission:permission_super_admin']], function() {
	// 显示system页面
	Route::get('systemIndex', 'AdminController@systemIndex')->name('admin.system.index');
	
	// 获取config数据信息
	Route::get('systemList', 'AdminController@systemList')->name('admin.system.list');


	// 显示config页面
	Route::get('configIndex', 'AdminController@configIndex')->name('admin.config.index');

	// 获取config数据信息
	Route::get('configList', 'AdminController@configList')->name('admin.config.list');

	// 获取group数据信息
	Route::get('groupList', 'AdminController@groupList')->name('admin.group.list');
	

	// 修改config数据
	Route::post('configChange', 'AdminController@configChange')->name('admin.config.change');

	// logout
	Route::get('logout', 'AdminController@logout')->name('admin.logout');

});


// UserController路由
Route::group(['prefix'=>'user', 'namespace'=>'Admin', 'middleware'=>['jwtauth','permission:permission_admin_user|permission_super_admin']], function() {

	// 显示user页面
	Route::get('userIndex', 'UserController@userIndex')->name('admin.user.index');

	// 获取user数据信息
	Route::get('userList', 'UserController@userList')->name('admin.user.list');

	// 列出指定的用户
	Route::get('uidList', 'UserController@uidList')->name('admin.user.uidlist');

	// 创建user
	Route::post('userCreate', 'UserController@userCreate')->name('admin.user.create');

	// 禁用user（软删除）
	Route::post('userTrash', 'UserController@userTrash')->name('admin.user.trash');

	// 删除user
	Route::post('userDelete', 'UserController@userDelete')->name('admin.user.delete');

	// 编辑user
	Route::post('userUpdate', 'UserController@userUpdate')->name('admin.user.update');

	// 测试excelExport
	Route::get('excelExport', 'UserController@excelExport')->name('admin.user.excelexport');

	// 清除user的ttl
	Route::post('userclsttl', 'UserController@userClsttl')->name('admin.user.clsttl');

	// 列出当前用户拥处理用户 申请->批量 OK
	Route::get('userHasAuditing1Applicant', 'UserController@userHasAuditing1Applicant')->name('admin.user.userhasauditing1applicant');

	// 列出当前用户拥处理用户 确认->批量 OK
	Route::get('userHasAuditing1Confirm', 'UserController@userHasAuditing1Confirm')->name('admin.user.userhasauditing1confirm');

	// 列出当前用户的处理用户 申请->单独 OK
	Route::get('userHasAuditing2', 'UserController@userHasAuditing2')->name('admin.user.userhasauditing2');

	// 列出当前用户的处理用户 确认->单独 OK
	Route::get('userHasAuditing2Confirm', 'UserController@userHasAuditing2Confirm')->name('admin.user.userhasauditing2confirm');

	// 添加处理用户
	Route::post('auditingAdd', 'UserController@auditingAdd')->name('admin.user.auditingadd');

	// 添加处理用户 确认->单独
	Route::post('auditingAddConfirm', 'UserController@auditingAddConfirm')->name('admin.user.auditingaddconfirm');

	// 更新处理用户
	Route::post('auditingUpdate', 'UserController@auditingUpdate')->name('admin.user.auditingupdate');

	// 排序移动处理用户
	Route::post('auditingSort', 'UserController@auditingSort')->name('admin.user.auditingsort');

	// 排序移动处理用户 confirm
	Route::post('auditingSortConfirm', 'UserController@auditingSortConfirm')->name('admin.user.auditingsortconfirm');

	// 删除处理用户
	Route::post('auditingRemove', 'UserController@auditingRemove')->name('admin.user.auditingremove');

	// 删除处理用户 confirm
	Route::post('auditingRemoveConfirm', 'UserController@auditingRemoveConfirm')->name('admin.user.auditingremoveconfirm');

	// 加载外部数据源用户
	Route::get('getExternalUsers', 'UserController@getExternalUsers')->name('admin.user.getexternalusers');
	

});


// RoleController路由
Route::group(['prefix'=>'role', 'namespace'=>'Admin', 'middleware'=>['jwtauth','permission:permission_admin_role|permission_super_admin']], function() {

	// 显示role页面
	Route::get('roleIndex', 'RoleController@roleIndex')->name('admin.role.index');

	// 列出所有用户
	Route::get('userList', 'RoleController@userList')->name('admin.role.userlist');

	// 列出所有角色
	Route::get('roleList', 'RoleController@roleList')->name('admin.role.rolelist');

	// 列出所有权限
	Route::get('permissionList', 'RoleController@permissionList')->name('admin.role.permissionlist');

	// 列出所有待删除的角色
	Route::get('roleListDelete', 'RoleController@roleListDelete')->name('admin.role.rolelistdelete');

	// 创建role
	Route::post('roleCreate', 'RoleController@roleCreate')->name('admin.role.create');

	// 编辑role
	Route::post('roleUpdate', 'RoleController@roleUpdate')->name('admin.role.update');
	
	// 删除角色
	Route::post('roleDelete', 'RoleController@roleDelete')->name('admin.role.roledelete');

	// 列出当前用户拥有的角色
	Route::get('userHasRole', 'RoleController@userHasRole')->name('admin.role.userhasrole');

	// 更新当前用户的角色
	Route::post('userUpdateRole', 'RoleController@userUpdateRole')->name('admin.role.userupdaterole');

	// 列出当前用户可追加的角色
	// Route::get('userGiveRole', 'RoleController@userGiveRole')->name('admin.role.usergiverole');

	// 赋予role
	Route::post('roleGive', 'RoleController@roleGive')->name('admin.role.give');
	// 移除role
	// Route::post('roleRemove', 'RoleController@roleRemove')->name('admin.role.remove');

	// 根据角色查看哪些用户
	Route::get('roleToViewUser', 'RoleController@roleToViewUser')->name('admin.role.roletoviewuser');

	// 权限同步到指定角色
	Route::post('syncPermissionToRole', 'RoleController@syncPermissionToRole')->name('admin.role.syncpermissiontorole');

	// 查询角色列表
	Route::get('roleGets', 'RoleController@roleGets')->name('admin.role.rolegets');
	
	// 测试excelExport
	Route::get('excelExport', 'RoleController@excelExport')->name('admin.role.excelexport');
	
});


// PermissionController路由
Route::group(['prefix'=>'permission', 'namespace'=>'Admin', 'middleware'=>['jwtauth','permission:permission_admin_permission|permission_super_admin']], function() {

	// 显示permission页面
	Route::get('permissionIndex', 'PermissionController@permissionIndex')->name('admin.permission.index');

	// 角色列表
	Route::get('permissionGets', 'PermissionController@permissionGets')->name('admin.permission.permissiongets');

	// 创建permission
	Route::post('permissionCreate', 'PermissionController@permissionCreate')->name('admin.permission.create');

	// 编辑permission
	Route::post('permissionUpdate', 'PermissionController@permissionUpdate')->name('admin.permission.update');
	
	// 删除permission
	Route::post('permissionDelete', 'PermissionController@permissionDelete')->name('admin.permission.permissiondelete');

	// 赋予permission
	Route::post('permissionGive', 'PermissionController@permissionGive')->name('admin.permission.give');
	// 移除permission
	Route::post('permissionRemove', 'PermissionController@permissionRemove')->name('admin.permission.remove');

	// 列出当前角色拥有的权限
	Route::get('roleHasPermission', 'PermissionController@roleHasPermission')->name('admin.permission.rolehaspermission');

	// 更新当前角色的权限
	Route::post('roleUpdatePermission', 'PermissionController@roleUpdatePermission')->name('admin.permission.roleupdatepermission');
	
	// 列出所有待删除的权限
	Route::get('permissionListDelete', 'PermissionController@permissionListDelete')->name('admin.permission.permissionlistdelete');

	// 列出所有权限
	Route::get('permissionList', 'PermissionController@permissionList')->name('admin.permission.permissionlist');

	// 根据权限查看哪些角色
	Route::get('permissionToViewRole', 'PermissionController@permissionToViewRole')->name('admin.permission.permissiontoviewrole');

	// 角色同步到指定权限
	Route::post('testUsersPermission', 'PermissionController@testUsersPermission')->name('admin.permission.testuserspermission');
	
	// 测试excelExport
	Route::get('excelExport', 'PermissionController@excelExport')->name('admin.permission.excelexport');

	// 列出所有角色
	Route::get('roleList', 'PermissionController@roleList')->name('admin.permission.rolelist');

	// 列出所有用户
	Route::get('userList', 'PermissionController@userList')->name('admin.permission.userlist');
	
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
    Route::get('mpdf', [testController::class, 'mpdf']);

    // 测试camera
    Route::get('camera', [testController::class, 'camera']);
    Route::post('testCamera', [testController::class, 'testCamera'])->name('test.camera.testcamera');

    // 测试邮件
    Route::get('mail', [testController::class, 'mail']);

    // 测试echarts
    Route::get('echarts', [testController::class, 'echarts']);

	// 测试vuetify
    Route::get('vuetify', [testController::class, 'vuetify']);
});
    