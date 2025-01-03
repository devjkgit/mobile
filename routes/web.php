<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\companycontroller;
use App\Http\Controllers\admin\logincontroller;
use App\Http\Controllers\admin\userscontroller;
use App\Http\Controllers\admin\repairingcontroller;
use App\Http\Controllers\admin\mobilescontroller;
use App\Http\Controllers\admin\dashboardcontroller;
use App\Http\Controllers\admin\issuescontroller;
use App\Http\Middleware\CheckType;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/metalsprices','admin\productscontroller@metalsprices');

Route::view('/', 'userlogin')->name("login")->middleware('guest');
// Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');

Route::post('/loginuser',[logincontroller::class, 'login']);
// Route::post('/contactform','admin\contactformcontroller@contactform');

Route::group( ['middleware' => 'auth' ], function(){

    Route::get('/users/deleteuser/{userid}',[userscontroller::class, 'deleteuser']);
    Route::get('/users',[userscontroller::class, 'index'])->middleware(CheckType::class);
    Route::get('/users/getallusers',[userscontroller::class, 'getallusers']);
    Route::post('/users/adduser',[userscontroller::class, 'adduser']);
    Route::post('/users/updateuser',[userscontroller::class, 'updateuser']);
    Route::get('/users/deleteuser/{userid}',[userscontroller::class, 'deleteuser']);
    Route::get('/users/selectuser/{userid}',[userscontroller::class, 'selectuser']);
    Route::get('/users/profile',[userscontroller::class, 'profile']);
    Route::post('/users/profilename',[userscontroller::class, 'profilename']);
    Route::post('/users/changeimage',[userscontroller::class, 'changeimage']);
    Route::get('/users/removeprofile',[userscontroller::class, 'removeprofile']);
    Route::post('/users/changepwd',[userscontroller::class, 'changepwd']);
    
    // Repairing
    Route::get('/repairing',[repairingcontroller::class, 'index'])->name('repairing');
    Route::get('/repairing/getall',[repairingcontroller::class, 'getall']);
    Route::post('/repairing/addentry',[repairingcontroller::class, 'addentry']);
    Route::post('/repairing/updateentry',[repairingcontroller::class, 'updateentry']);
    Route::get('/repairing/deleteentry/{repairing_id}',[repairingcontroller::class, 'deleteentry']);
    Route::get('/repairing/selectentry/{repairing_id}',[repairingcontroller::class, 'selectentry']);
    // Repairing

    // Mobiles
    Route::get('/mobiles',[mobilescontroller::class, 'index'])->name('mobiles');
    Route::get('/mobiles/getall',[mobilescontroller::class, 'getall']);
    Route::post('/mobiles/addentry',[mobilescontroller::class, 'addentry']);
    Route::post('/mobiles/updateentry',[mobilescontroller::class, 'updateentry']);
    Route::get('/mobiles/deleteentry/{mobile_id}',[mobilescontroller::class, 'deleteentry']);
    Route::get('/mobiles/selectentry/{mobile_id}',[mobilescontroller::class, 'selectentry']);
    // Mobiles

    Route::get('/dashboard',[dashboardcontroller::class, 'index'])->name("dashboard");

    // Route::get('/products','admin\productscontroller@index')->middleware('checktype');
    // Route::get('/products/getallproducts','admin\productscontroller@getallproducts');
    // Route::get('products/selectproduct/{userid}','admin\productscontroller@selectproduct');
    // Route::post('/products/addproduct','admin\productscontroller@addproduct');
    // Route::post('products/updateproduct','admin\productscontroller@updateproduct');
    // Route::get('/product/productcodes','admin\productscontroller@productcodesforautocomplete');
    // Route::get('/products/deleteproduct/{productid}','admin\productscontroller@deleteproduct');
    // Route::get('/product/{productcode}/','admin\productscontroller@singleproddetails')->where('productcode', '.*');
    // Route::get('/product-new/{productcode}/','admin\productscontroller@singleproddetailsnew');
    // Route::post('/check_availability','admin\productscontroller@check_availability')->name('check_availability');
    // Route::post('/RemovePimage','admin\productscontroller@RemovePimage')->name('RemovePimage');

    // Route::get('/settings','admin\settingscontroller@index')->middleware('checktype');
    // Route::post('/settings/updatesetting/','admin\settingscontroller@updatesetting');

    Route::get('/companies',[companycontroller::class, 'index']);
    Route::get('/companies/getallcompanies',[companycontroller::class, 'getallcompanies']);
    Route::post('/companies/addcompany',[companycontroller::class, 'addcompany']);
    Route::get('/companies/selectcompany/{companyid}',[companycontroller::class, 'selectcompany']);
    Route::post('/companies/updatecompany/',[companycontroller::class, 'updatecompany']);
    Route::get('/companies/deletecompany/{companyid}',[companycontroller::class, 'deletecompany']);

    Route::get('/issues',[issuescontroller::class, 'index']);
    Route::get('/issues/getallissues',[issuescontroller::class, 'getallissues']);
    Route::post('/issues/addissue',[issuescontroller::class, 'addissue']);
    Route::get('/issues/selectissue/{issueid}',[issuescontroller::class, 'selectissue']);
    Route::post('/issues/updateissue/',[issuescontroller::class, 'updateissue']);
    Route::get('/issues/deleteissue/{issueid}',[issuescontroller::class, 'deleteissue']);

    Route::get('/logout',[logincontroller::class, 'logout']);

});

?>