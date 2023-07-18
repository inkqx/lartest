<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HelloController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// 默认域名的默认命名空间
Route::get('/', function () {
    return view('welcome');
});

Route::match(['GET'], '/hello', [HelloController::class, 'hello'])->name('test.hello');

// 路由路径带参数
Route::prefix('auth111')->group(function () {

    Route::get('test/{id}', function ($id) {
        return '你已登录,id：' . $id;
    });
});


// 子域名
Route::domain('son.lartest.cc')->group(function () {
    // 如果需要配置/路径，会和第一个路由/冲突，先匹配到上面的
    Route::get('/abc', function () {
        return '这是一个子域名';
    });
});

// 带前缀的子命名空间
// 写法1
// Route::namespace('/Admin')->prefix('/admin')->group(function () {
//     Route::get('login', [AdminController::class, 'login']);
// });
// 写法2
Route::group(['namespace' => '/Admin', 'prefix' => '/admin'], function () {
    Route::get('login', [AdminController::class, 'login']);
});
