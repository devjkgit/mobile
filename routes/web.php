<?php



use Illuminate\Support\Facades\Route;



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

// Route::view('/test', 'userlogin');


Route::get('/metalsprices','admin\productscontroller@metalsprices');

Route::view('/', 'userlogin')->name("login")->middleware('guest');

Route::post('/loginuser','admin\logincontroller@login');
Route::post('/contactform','admin\contactformcontroller@contactform');

Route::group( ['middleware' => 'auth' ], function(){
	Route::view('/search', 'search')->name("search");
	Route::get('/searchresults/{productcodekeywords}/', 'admin\searchcontroller@searchresults');
	Route::get('/searchresults/', 'admin\searchcontroller@searchresults');
	Route::get('/searchresults-new/{productcodekeywords}/', 'admin\searchcontroller@searchresultsnew');

	Route::get('/users/deleteuser/{userid}','admin\userscontroller@deleteuser');
	Route::get('/users','admin\userscontroller@index')->middleware('checktype');
	Route::get('/users/getallusers','admin\userscontroller@getallusers');
	Route::post('/users/adduser','admin\userscontroller@adduser');
	Route::post('/users/updateuser','admin\userscontroller@updateuser');
	Route::get('/users/deleteuser/{userid}','admin\userscontroller@deleteuser');
	Route::get('/users/selectuser/{userid}','admin\userscontroller@selectuser');
	Route::get('/users/profile','admin\userscontroller@profile');
	Route::post('/users/profilename','admin\userscontroller@profilename');
	Route::post('/users/changeimage','admin\userscontroller@changeimage');
	Route::get('/users/removeprofile','admin\userscontroller@removeprofile');
	Route::post('/users/changepwd','admin\userscontroller@changepwd');
	
	// Repairing
	Route::get('/repairing','admin\repairingcontroller@index')->name('repairing');
	Route::get('/repairing/getall','admin\repairingcontroller@getall');
	Route::post('/repairing/addentry','admin\repairingcontroller@addentry');
	Route::post('/repairing/updateentry','admin\repairingcontroller@updateentry');
	Route::get('/repairing/deleteentry/{repairing_id}','admin\repairingcontroller@deleteentry');
	Route::get('/repairing/selectentry/{repairing_id}','admin\repairingcontroller@selectentry');
	// repairing

	Route::get('/dashboard','admin\dashboardcontroller@index')->name("dashboard")->middleware('checktype');

	Route::get('/products','admin\productscontroller@index')->middleware('checktype');
	Route::get('/products/getallproducts','admin\productscontroller@getallproducts');
	Route::get('products/selectproduct/{userid}','admin\productscontroller@selectproduct');
	Route::post('/products/addproduct','admin\productscontroller@addproduct');
	Route::post('products/updateproduct','admin\productscontroller@updateproduct');
	Route::get('/product/productcodes','admin\productscontroller@productcodesforautocomplete');
	Route::get('/products/deleteproduct/{productid}','admin\productscontroller@deleteproduct');
	Route::get('/product/{productcode}/','admin\productscontroller@singleproddetails')->where('productcode', '.*');
	Route::get('/product-new/{productcode}/','admin\productscontroller@singleproddetailsnew');
	Route::post('/check_availability','admin\productscontroller@check_availability')->name('check_availability');
	Route::post('/RemovePimage','admin\productscontroller@RemovePimage')->name('RemovePimage');

	//product price routes
	Route::post('Product_actual1','admin\productscontroller@Product_actual1')->name('Product_actual1');
	Route::post('Product_price1','admin\productscontroller@Product_price1')->name('Product_price1');
	Route::post('Product_actual2','admin\productscontroller@Product_actual2')->name('Product_actual2');
	Route::post('Product_price2','admin\productscontroller@Product_price2')->name('Product_price2');
	Route::post('Product_actual3','admin\productscontroller@Product_actual3')->name('Product_actual3');
	Route::post('Product_price3','admin\productscontroller@Product_price3')->name('Product_price3');
	Route::post('Product_actual4','admin\productscontroller@Product_actual4')->name('Product_actual4');
	Route::post('Product_price4','admin\productscontroller@Product_price4')->name('Product_price4');

	Route::get('/settings','admin\settingscontroller@index')->middleware('checktype');
	Route::post('/settings/updatesetting/','admin\settingscontroller@updatesetting');

	Route::get('/companies','admin\companycontroller@index')->middleware('checktype');
	Route::get('/companies/getallcompanies','admin\companycontroller@getallcompanies');
	Route::post('/companies/addcompany','admin\companycontroller@addcompany');
	Route::get('/companies/selectcompany/{companyid}','admin\companycontroller@selectcompany');
	Route::post('/companies/updatecompany/','admin\companycontroller@updatecompany');
	Route::get('/companies/deletecompany/{companyid}','admin\companycontroller@deletecompany');

	Route::get('/issues','admin\issuescontroller@index');
	Route::get('/issues/getallissues','admin\issuescontroller@getallissues');
	Route::post('/issues/addissue','admin\issuescontroller@addissue');
	Route::get('/issues/selectissue/{issueid}','admin\issuescontroller@selectissue');
	Route::post('/issues/updateissue/','admin\issuescontroller@updateissue');
	Route::get('/issues/deleteissue/{issueid}','admin\issuescontroller@deleteissue');

	Route::get('/logout','admin\logincontroller@logout');

});

?>