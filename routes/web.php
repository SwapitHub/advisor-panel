<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Models\Settings;

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

$prefix = Settings::first()->route_web_prifix ?? 'admin';
Auth::routes();

Route::get('/', [App\Http\Controllers\Frontend\AuthController::class, 'index'])->name('index');
Route::get('/advisory-form', [App\Http\Controllers\FromController::class, 'index'])->name('from.index');
Route::post('/advisory-form', [App\Http\Controllers\FromController::class, 'postAdd'])->name('from.add');
Route::get('/advisory-form-step-2', [App\Http\Controllers\FromController::class, 'secondStep'])->name('from.step2');

## web login
Route::group(['middleware' => 'web'], function () {
    Route::get('/userlogin', [App\Http\Controllers\Frontend\AuthController::class, 'index'])->name('user.login');
    Route::post('/userlogin', [App\Http\Controllers\Frontend\AuthController::class, 'authenticate'])->name('user.auth');
});
Route::get('/userlogout', [App\Http\Controllers\Frontend\AuthController::class, 'logout'])->name('user.logout');
## web login

Route::group(['prefix' => $prefix, 'middleware' => 'admin.guest'], function () {
    Route::get('/login', [App\Http\Controllers\Auth\AdminAuthController::class, 'index'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Auth\AdminAuthController::class, 'authenticate'])->name('admin.auth');
});

Route::group(['prefix' => $prefix, 'middleware' => ['admin.auth', 'checkUserAllowed']], function () {
    Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
    Route::post('/prifix/update', [App\Http\Controllers\Admin\AdminController::class, 'updatePrifix'])->name('update.prifix');
    Route::get('/logout', [App\Http\Controllers\Auth\AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/profile', [App\Http\Controllers\Admin\AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/profile', [App\Http\Controllers\Admin\AdminController::class, 'updateProfile'])->name('admin.updateProfile');
    Route::post('/change_password', [App\Http\Controllers\Admin\AdminController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('/update_icon', [App\Http\Controllers\Admin\AdminController::class, 'updateIcon'])->name('admin.upload_icon');
    Route::get('/siteinfo', [App\Http\Controllers\Admin\SiteinfoController::class, 'index'])->name('admin.siteinfo');
    Route::post('/siteinfo', [App\Http\Controllers\Admin\SiteinfoController::class, 'update_siteinfo'])->name('admin.update_siteinfo');

    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.list');
    Route::get('/users/add', [App\Http\Controllers\Admin\UserController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users/add', [App\Http\Controllers\Admin\UserController::class, 'postCreateUser'])->name('admin.users.postcreate');
    Route::get('/users/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'editUser'])->name('admin.edit.users');
    Route::post('/users/{id}', [App\Http\Controllers\Admin\UserController::class, 'postEditUser'])->name('admin.update.users');
    Route::get('/deleteuser/{id}', [App\Http\Controllers\Admin\UserController::class, 'deleteUser'])->name('admin.deleteadmin.user');

    ## role and permissions route start
    Route::get('/role', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.role.list');
    Route::get('/role/add', [App\Http\Controllers\Admin\RoleController::class, 'addRole'])->name('admin.role.create');
    Route::post('/role/add', [App\Http\Controllers\Admin\RoleController::class, 'postaddRole'])->name('admin.role.postcreate');
    Route::get('/role/edit/{id}', [App\Http\Controllers\Admin\RoleController::class, 'editRole'])->name('admin.role.edit');
    Route::post('/role/{id}', [App\Http\Controllers\Admin\RoleController::class, 'postEditRole'])->name('admin.role.update');
    Route::post('/updatesite_urls', [App\Http\Controllers\Admin\SiteinfoController::class, 'updatesite_urls'])->name('admin.updatesite_urls');
    Route::get('/permissions', [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('admin.permission.list');
    Route::get('/permissions/add', [App\Http\Controllers\Admin\PermissionController::class, 'addPermission'])->name('admin.permission.create');
    Route::post('/permissions/add', [App\Http\Controllers\Admin\PermissionController::class, 'postAdd'])->name('admin.users.postadd');
    Route::get('/permissions/edit/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'editPermission'])->name('admin.edit.permission');
    Route::get('/permissions/edit/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'editPermission'])->name('admin.edit.permission');
    Route::post('/permissions/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'postEditPermission'])->name('admin.update.permission');
    ## role and permissions route start

    Route::get('/form-field-list', [App\Http\Controllers\Admin\FromFieldController::class, 'index'])->name('from.field.list');
    Route::get('/form-field-list/add', [App\Http\Controllers\Admin\FromFieldController::class, 'create'])->name('from.field.add');
    Route::post('/form-field-list/add', [App\Http\Controllers\Admin\FromFieldController::class, 'postCreate'])->name('from.field.postadd');
    Route::get('/form-field-list/edit/{id}', [App\Http\Controllers\Admin\FromFieldController::class, 'edit'])->name('from.field.edit');
    Route::post('/form-field-list/edit/{id}', [App\Http\Controllers\Admin\FromFieldController::class, 'update'])->name('from.field.update');
    Route::get('/form-field-list/delete/{id}', [App\Http\Controllers\Admin\FromFieldController::class, 'distroy']);



    Route::get('/distributor-relationship-content', [App\Http\Controllers\Admin\TemplateContentController::class, 'index'])->name('admin.distributor_relationship');
    Route::post('/distributor-relationship-content/update', [App\Http\Controllers\Admin\TemplateContentController::class, 'update'])->name('admin.distributor_relationship.update');

});
