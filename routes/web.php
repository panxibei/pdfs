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
    Route::get('test', 'testController@test');
    // Route::get('phpinfo', 'testController@phpinfo');
    Route::get('phpinfo', [testController::class, 'phpinfo']);
    Route::get('ldap', 'testController@ldap');
    Route::get('scroll', 'testController@scroll');
    Route::get('mint', 'testController@mint');
    Route::get('muse', 'testController@muse');
    Route::get('vant', 'testController@vant');
    Route::get('cube', 'testController@cube');
    Route::get('pgsql', 'testController@pgsql');
    Route::get('pdf', 'testController@pdf');

    // 测试camera
    Route::get('camera', 'testController@camera');
    Route::post('testCamera', 'testController@testCamera')->name('test.camera.testcamera');

    // 测试邮件
    Route::get('mail', 'testController@mail');

    // 测试echarts
    Route::get('echarts', 'testController@echarts');
});
    