<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LawyerController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentProviderController;



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

Route::get('/', function () {
    return view('index');
});
Route::get('/', [LawyerController::class, 'index'])->name('index');

Route::get('terms_and_conditions', [LawyerController::class, 'terms_and_conditions'])->name('terms_and_conditions');





############################################ Start Custmer Routs ##############################################
###############################################################################################################
Route::post('add_customer', [CustomerController::class, 'add_customer'])->name('add_customer');
Route::get('customer_login_form', [CustomerController::class, 'customer_login_form'])->name('customer_login_form');
Route::post('customer_login', [CustomerController::class, 'customer_login'])->name('customer_login');
Route::group(['prefix'=>'customers','middleware'=>'CustomerAuth'],function() {
	Route::get('dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
	Route::get('custome_order/{ServiceID}', [CustomerController::class, 'custome_order'])->name('custome_order');
	Route::get('customer_custome_orders', [CustomerController::class, 'customer_custome_orders'])->name('customer_custome_orders');
	Route::post('add_custom_order', [CustomerController::class, 'add_custom_order'])->name('add_custom_order');

	Route::get('show_customer_custome_order/{ShowID}', [CustomerController::class, 'show_customer_custome_order'])->name('show_customer_custome_order');
	Route::post('update_customer_custome_order', [CustomerController::class, 'update_customer_custome_order'])->name('update_customer_custome_order');
	Route::get('delete_customer_custome_order/{CustomOrderID}', [CustomerController::class, 'delete_customer_custome_order'])->name('delete_customer_custome_order');
	Route::get('show_customer_offer_details/{ShowID}', [CustomerController::class, 'show_customer_offer_details'])->name('show_customer_offer_details');
	Route::post('buy_custom_service', [PaymentProviderController::class, 'buy_custom_service'])->name('buy_custom_service');
	Route::get('payoffer', [PaymentProviderController::class, 'payoffer'])->name('payoffer');
	Route::get('custom_order_offers', [CustomerController::class, 'custom_order_offers'])->name('custom_order_offers');
	Route::get('custom_done_order_offers', [CustomerController::class, 'custom_done_order_offers'])->name('custom_done_order_offers');

	Route::get('order/{ServiceID}', [PaymentProviderController::class, 'order'])->name('order');


	Route::get('logout', [CustomerController::class, 'logout'])->name('logout');


});
###############################################################################################################
###############################################################################################################


##################################### Start Provider Routs ###################################################
###############################################################################################################
Route::post('add_provider', [ProviderController::class, 'add_provider'])->name('add_provider');
Route::get('provider_login_form', [ProviderController::class, 'provider_login_form'])->name('provider_login_form');
Route::post('provider_login', [ProviderController::class, 'provider_login'])->name('provider_login');
Route::group(['prefix'=>'providers','middleware'=>'ProviderAuth'],function() {
	Route::get('dashboard', [ProviderController::class, 'dashboard'])->name('dashboard');

	Route::get('logout', [ProviderController::class, 'logout'])->name('logout');

});
###############################################################################################################
###############################################################################################################


############################################  Start Lawyer Routs  #############################################
###############################################################################################################
Route::post('add_lawyer', [LawyerController::class, 'add_lawyer'])->name('add_lawyer');
Route::get('lawyer_login_form', [LawyerController::class, 'lawyer_login_form'])->name('lawyer_login_form');
Route::post('lawyer_login', [LawyerController::class, 'lawyer_login'])->name('lawyer_login');
Route::group(['prefix'=>'lawyers','middleware'=>'LawyerAuth'],function() {
	Route::get('dashboard', [LawyerController::class, 'dashboard'])->name('dashboard');
	Route::get('active_orders', [LawyerController::class, 'active_orders'])->name('active_orders');
	Route::get('newoffer/{ShowID}', [LawyerController::class, 'newoffer'])->name('newoffer');
	Route::post('add_new_offer', [LawyerController::class, 'add_new_offer'])->name('add_new_offer');
	Route::post('update_offer', [LawyerController::class, 'update_offer'])->name('update_offer');
	Route::post('delete_offer', [LawyerController::class, 'delete_offer'])->name('delete_offer');

	Route::get('lawyer_offers', [LawyerController::class, 'lawyer_offers'])->name('lawyer_offers');
	Route::get('lawyer_done_offers', [LawyerController::class, 'lawyer_done_offers'])->name('lawyer_done_offers');
	

	Route::get('logout', [LawyerController::class, 'logout'])->name('logout');
});
###############################################################################################################
###############################################################################################################




Route::get('login_form', [UserController::class, 'login_form'])->name('login_form');
Route::post('user_login', [UserController::class, 'user_login'])->name('user_login');
Route::group(['prefix'=>'admin','middleware'=>'AdminAuth'],function() {
	Route::get('users', [UserController::class, 'show_users'])->name('show_users');
	Route::post('add_user', [UserController::class, 'add_user'])->name('add_user');
	Route::get('show_user/{user_id}', [UserController::class, 'show_user'])->name('show_user');
	Route::post('update_user', [UserController::class, 'update_user'])->name('update_user');
	Route::post('delete_user}', [UserController::class, 'delete_user'])->name('delete_user');
	Route::post('disable_user}', [UserController::class, 'disable_user'])->name('disable_user');
	Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');

	Route::get('lawyers', [MainController::class, 'lawyers'])->name('lawyers');
	Route::get('show_lawyer/{LawyerID}', [MainController::class, 'show_lawyer'])->name('show_lawyer');
	Route::get('delete_lawyer/{LawyerID}', [MainController::class, 'delete_lawyer'])->name('delete_lawyer');

	Route::get('providers', [MainController::class, 'providers'])->name('providers');
	Route::get('show_provider/{ProviderID}', [MainController::class, 'show_provider'])->name('show_provider');
	Route::get('delete_provider/{ProviderID}', [MainController::class, 'delete_provider'])->name('delete_provider');
	
	Route::get('customers', [MainController::class, 'customers'])->name('customers');
	Route::get('show_customer/{CustomerID}', [MainController::class, 'show_customer'])->name('show_customer');
	Route::get('delete_customer/{CustomerID}', [MainController::class, 'delete_customer'])->name('delete_customer');


	####################################################################################################
	########################################### POSTS ##################################################
	Route::get('posts', [MainController::class, 'posts'])->name('posts');
	Route::get('post/{SubjectID}', [MainController::class, 'post'])->name('post');
	Route::post('add_post', [MainController::class, 'add_post'])->name('add_post');
	Route::post('update_post', [MainController::class, 'update_post'])->name('update_post');
	Route::post('delete_post', [MainController::class, 'delete_post'])->name('delete_post');

	####################################################################################################
	########################################### SERVICES ##################################################
	Route::get('services', [MainController::class, 'services'])->name('admin_services');
	Route::get('service/{ServiceID}', [MainController::class, 'service'])->name('service');
	Route::post('add_service', [MainController::class, 'add_service'])->name('add_service');
	Route::post('update_service', [MainController::class, 'update_service'])->name('update_service');
	Route::post('delete_service', [MainController::class, 'delete_service'])->name('delete_service');

	####################################################################################################
	########################################### COURSES ################################################

	Route::get('courses', [MainController::class, 'courses'])->name('courses');
	Route::get('course/{CourseID}', [MainController::class, 'course'])->name('course');
	Route::post('add_course', [MainController::class, 'add_course'])->name('add_course');
	Route::post('update_course', [MainController::class, 'update_course'])->name('update_course');
	Route::post('delete_course', [MainController::class, 'delete_course'])->name('delete_course');

	####################################################################################################
	########################################### Orders #################################################
	Route::get('show_orders', [OrderController::class, 'show_orders'])->name('show_orders');
	Route::get('show_offers', [OrderController::class, 'show_offers'])->name('show_offers');
	Route::get('show_offer/{OrderID}', [OrderController::class, 'show_offer'])->name('show_offer');
	Route::get('change_orders/{OrderID}', [OrderController::class, 'change_orders'])->name('change_orders');
	Route::get('orders_report', [OrderController::class, 'orders_report'])->name('orders_report');
	Route::post('orders_report_result', [OrderController::class, 'orders_report_result'])->name('orders_report_result');
});//END Route::group(['prefix'=>'admin','middleware'=>'AdminAuth'],function()


############################################################################################################
############################################## Orders ######################################################

// Route::post('buyservice', [OrderController::class, 'buyservice'])->name('buyservice');

Route::post('buyservice', [PaymentProviderController::class, 'buyservice'])->name('buyservice');




Route::get('services', [OrderController::class, 'services'])->name('services');
Route::get('courses', [OrderController::class, 'courses'])->name('courses');
Route::get('libraries', [OrderController::class, 'libraries'])->name('libraries');

// Route::get('courses', [MainController::class, 'courses'])->name('courses');
// Route::get('search', [MainController::class, 'search'])->name('search');
Route::post('search', [MainController::class, 'search'])->name('search');
Route::post('search-result', [MainController::class, 'search'])->name('search-result');




