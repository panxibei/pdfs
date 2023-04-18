<?php

use Illuminate\Support\Facades\Route;

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
    