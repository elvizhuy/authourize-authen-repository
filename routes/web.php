<?php

use App\Events\OrderPayment;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Group;
use App\Models\Order;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Event;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" Middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false
]);

Route::get('/redis', [PostController::class, 'redis'])->name('index');

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::prefix('post')->name('posts.')->middleware('can:posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/add', [PostController::class, 'add'])->name('add')->can('posts.add');
        Route::post('/add', [PostController::class, 'postAdd'])->can('posts.add');
        Route::get('/update/{post}', [PostController::class, 'update'])->name('update');
        Route::post('/update/{post}', [PostController::class, 'postUpdate'])->can('posts.edit');
        Route::get('/delete/{post}', [PostController::class, 'delete'])->name('delete')->can('posts.remove');
    });

    Route::prefix('group')->name('groups.')->middleware('can:groups')->group(function () {
        Route::get('/', [GroupController::class, 'index'])->name('index');
        Route::get('/add', [GroupController::class, 'add'])->name('add')->can('groups.add');
        Route::post('/add', [GroupController::class, 'postAdd'])->can('groups.add');
        Route::get('/edit/{group}', [GroupController::class, 'edit'])->name('edit')->can('groups.edit');
        Route::post('/edit/{group}', [GroupController::class, 'postEdit'])->can('groups.edit');
        Route::get('/delete/{group}', [GroupController::class, 'delete'])->name('delete')->can('groups.remove');
        Route::get('/permission/{group}', [GroupController::class, 'permission'])->name('permission')->can('groups.permission');
        Route::post('/permission/{group}', [GroupController::class, 'postPermission'])->can('groups.permission');
    });


    Route::prefix('User')->name('users.')->middleware('can:users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/add', [UserController::class, 'add'])->name('add')->can('users.add');
        Route::post('/add', [UserController::class, 'postAdd'])->can('users.add');
        Route::get('/edit/{User}', [UserController::class, 'edit'])->name('edit')->can('users.edit');
        Route::post('/edit/{User}', [UserController::class, 'postEdit'])->can('users.edit');
        Route::get('/delete/{User}', [UserController::class, 'delete'])->name('delete')->can('users.remove');
    });
});

Route::prefix('doctors')->name('doctors.')->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'postLogin']);
});
    Route::get('product/get', [ProductController::class, 'index']);
    Route::post('login', [LoginController::class, 'postLogin']);
Route::get('odder/create',function(){
   $order = new Order();
   $order->amount = 12000;
   $order->note = "office time";
   $order->save();
//    OrderPayment::dispatch($order);
   Event::dispatch(new OrderPayment($order));
});
