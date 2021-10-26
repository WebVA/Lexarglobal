<?php

use Illuminate\Support\Facades\Route;

//ADMIN CONTROLLER----------------------------------------------------
use App\Http\Controllers\UnlockController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlandController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\DecorationController;
use App\Http\Controllers\PoActionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PoController;
use App\Http\Controllers\WebsettingController;

//USER CONTROLLER-------------------------------------------------------
use App\Http\Controllers\ULoginController;
use App\Http\Controllers\UBrandController;
use App\Http\Controllers\UContactusController;
use App\Http\Controllers\UHomeController;
use App\Http\Controllers\UMainController;
use App\Http\Controllers\UDetailController;
use App\Http\Controllers\UTrackorderController;
use App\Http\Controllers\UWishlistController;
use App\Http\Controllers\UProfileController;
use App\Http\Controllers\UOrderController;
use App\Http\Controllers\UOtherController;
use App\Http\Controllers\PDFController;

// use App\Http\Middleware\IsValidUser;
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

//ADMIN PANEL===============================================================================

//Unlock page---------------------------------------------------------------
Route::get('/admin', [UnlockController::class, 'index'])->name('first');
Route::post('/unlock/check', [UnlockController::class, 'check']);
Route::any('/log-out', [UnlockController::class, 'logOut'])->name('log_out');
Route::get('/change_pwd', [UnlockController::class, 'change_pwd']);
Route::post('/change_pwd', [UnlockController::class, 'change_pwd_api']);

//Dashboard page-------------------------------------------------------------
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Products page---------------------------------------------------------------
Route::get('/products/products/{main_category}/{sub_category}/{brand}', [ProductController::class, 'show_products'])->middleware('is_vaild_user');
Route::get('/products/view_product', [ProductController::class, 'view_product'])->middleware('is_vaild_user');
Route::get('/products/add_product', [ProductController::class, 'add_product'])->middleware('is_vaild_user');
Route::post('/products/add_product', [ProductController::class, 'add_product_api']);
Route::post('/products/upload_product', [ProductController::class, 'upload_product_api']);
Route::get('/products/edit_product/{id}', [ProductController::class, 'edit_product'])->middleware('is_vaild_user');
Route::post('/products/edit_product', [ProductController::class, 'edit_product_api']);
Route::post('/products/edit_product_image', [ProductController::class, 'edit_product_image_api']);
Route::post('/products/remove_image', [ProductController::class, 'remove_image_api']);
Route::post('/products/set_img_order', [ProductController::class, 'set_img_order_api']);
Route::post('/products/get_sub_category', [ProductController::class, 'get_sub_category_api']);
Route::post('/products/set_sub_category', [ProductController::class, 'set_sub_category_api']);
Route::get('/products/find_product/{category}/{sub_category}', [ProductController::class, 'find_product_api'])->middleware('is_vaild_user');
Route::post('/products/del_product', [ProductController::class, 'del_product_api']);
Route::get('/products/search_product/{key}', [ProductController::class, 'search_product_by_key']);

//Blands page---------------------------------------------------------------
Route::get('/blands/blands', [BlandController::class, 'show_blands'])->middleware('is_vaild_user');
Route::get('/blands/add_bland', [BlandController::class, 'add_bland'])->middleware('is_vaild_user');
Route::post('/blands/add_bland', [BlandController::class, 'add_bland_api']);
Route::get('/blands/edit_bland/{id}', [BlandController::class, 'edit_bland'])->middleware('is_vaild_user');
Route::post('/blands/edit_bland', [BlandController::class, 'edit_bland_api']);
Route::post('/blands/del_bland', [BlandController::class, 'del_bland_api']);

//Materials page---------------------------------------------------------------
Route::get('/materials/materials', [MaterialController::class, 'show_materials'])->middleware('is_vaild_user');
Route::get('/materials/add_material', [MaterialController::class, 'add_material'])->middleware('is_vaild_user');
Route::post('/materials/add_material', [MaterialController::class, 'add_material_api']);
Route::get('/materials/edit_material/{id}', [MaterialController::class, 'edit_material'])->middleware('is_vaild_user');
Route::post('/materials/edit_material', [MaterialController::class, 'edit_material_api']);
Route::post('/materials/del_material', [MaterialController::class, 'del_material_api']);

//Decorations page---------------------------------------------------------------
Route::get('/decorations/decorations', [DecorationController::class, 'show_decorations'])->middleware('is_vaild_user');
Route::get('/decorations/add_decoration', [DecorationController::class, 'add_decoration'])->middleware('is_vaild_user');
Route::post('/decorations/add_decoration', [DecorationController::class, 'add_decoration_api']);
Route::get('/decorations/edit_decoration/{id}', [DecorationController::class, 'edit_decoration'])->middleware('is_vaild_user');
Route::post('/decorations/edit_decoration', [DecorationController::class, 'edit_decoration_api']);
Route::post('/decorations/del_decoration', [DecorationController::class, 'del_decoration_api']);

//Po Actions page---------------------------------------------------------------
Route::get('/po_actions/po_actions', [PoActionController::class, 'show_po_actions'])->middleware('is_vaild_user');
Route::get('/po_actions/add_po_action', [PoActionController::class, 'add_po_action'])->middleware('is_vaild_user');
Route::post('/po_actions/add_po_action', [PoActionController::class, 'add_po_action_api']);
Route::get('/po_actions/edit_po_action/{id}', [PoActionController::class, 'edit_po_action'])->middleware('is_vaild_user');
Route::post('/po_actions/edit_po_action', [PoActionController::class, 'edit_po_action_api']);
Route::post('/po_actions/del_po_action', [PoActionController::class, 'del_po_action_api']);

//Customers page---------------------------------------------------------------
Route::get('/customers/customers', [CustomerController::class, 'show_customers'])->middleware('is_vaild_user');
Route::get('/customers/add_customer', [CustomerController::class, 'add_customer'])->middleware('is_vaild_user');
Route::post('/customers/add_customer', [CustomerController::class, 'add_customer_api']);
Route::get('/customers/edit_customer/{id}', [CustomerController::class, 'edit_customer'])->middleware('is_vaild_user');
Route::post('/customers/edit_customer', [CustomerController::class, 'edit_customer_api']);
Route::post('/customers/del_customer', [CustomerController::class, 'del_customer_api']);
Route::get('/customers/detail_customer', [CustomerController::class, 'edit_customer'])->middleware('is_vaild_user');
Route::get('/customers/export-file', [CustomerController::class, 'exportFile'])->name('export-file');
Route::get('/customers/subscribers', [CustomerController::class, 'show_subscribers'])->middleware('is_vaild_user');
Route::get('/customers/add_subscribers', [CustomerController::class, 'add_subscribers'])->middleware('is_vaild_user');
Route::post('/customers/add_subscribers', [CustomerController::class, 'add_subscribers_api']);
Route::get('/customers/edit_subscribers/{id}', [CustomerController::class, 'edit_subscribers'])->middleware('is_vaild_user');
Route::post('/customers/edit_subscribers', [CustomerController::class, 'edit_subscribers_api']);
Route::post('/customers/del_subscribers', [CustomerController::class, 'del_subscribers_api']);
Route::get('/customers/export-subscriber-file', [CustomerController::class, 'export_subscriberFile'])->name('export-subscriber-file');
Route::get('/customers/contacts', [CustomerController::class, 'show_contacts'])->middleware('is_vaild_user');
Route::post('/customers/del_contact', [CustomerController::class, 'del_contact_api']);
Route::get('/customers/detail_contact/{id}', [CustomerController::class, 'edit_contacts'])->middleware('is_vaild_user');
Route::get('/customers/export-contact-file', [CustomerController::class, 'export_contactFile'])->name('export-contact-file');

//Categories page---------------------------------------------------------------
Route::get('/categories/categories', [CategoryController::class, 'show_categories'])->middleware('is_vaild_user');
Route::post('/categories/add_category', [CategoryController::class, 'add_category_api']);
Route::post('/categories/add_subcategory', [CategoryController::class, 'add_subcategory_api']);
Route::post('/categories/edit_category', [CategoryController::class, 'edit_category_api']);
Route::post('/categories/edit_subcategory', [CategoryController::class, 'edit_subcategory_api']);
Route::post('/categories/del_category', [CategoryController::class, 'del_category_api']);
Route::post('/categories/del_subcategory', [CategoryController::class, 'del_subcategory_api']);

//Report page---------------------------------------------------------------
Route::get('/report/most_viewed_products/{main_category}/{sub_category}/{brand}/{state}/{start_date}/{to_date}', [ReportController::class, 'most_viewed_products'])->middleware('is_vaild_user');
Route::get('/report/sample_order/{main_category}/{sub_category}/{brand}/{state}/{start_date}/{to_date}', [ReportController::class, 'sample_order'])->middleware('is_vaild_user');
Route::get('/report/product_rating/{main_category}/{sub_category}/{brand}/{state}/{start_date}/{to_date}', [ReportController::class, 'product_rating'])->middleware('is_vaild_user');
Route::post('/report/change_rating_state', [ReportController::class, 'change_rating_state_api']);
Route::get('/report/recent_search', [ReportController::class, 'recent_search'])->middleware('is_vaild_user');

//Website setting page-----------------------------------------------------------
Route::get('/websetting/hero_setting', [WebsettingController::class, 'hero_setting'])->middleware('is_vaild_user');
Route::get('/websetting/category_setting', [WebsettingController::class, 'category_setting'])->middleware('is_vaild_user');
Route::get('/websetting/popup-setting', [WebsettingController::class, 'popup_setting'])->middleware('is_vaild_user');
Route::get('/websetting/edit-popup/{id}', [WebsettingController::class, 'edit_popup_setting'])->middleware('is_vaild_user');
Route::post('/websetting/save-popup-img', [WebsettingController::class, 'save_popup_image']);
Route::post('/websetting/popup_status_toggle', [WebsettingController::class, 'popup_status_toggle']);
Route::get('/websetting/modal_setting', [WebsettingController::class, 'modal_setting'])->middleware('is_vaild_user');
Route::get('/websetting/imgbar_setting', [WebsettingController::class, 'imgbar_setting'])->middleware('is_vaild_user');
Route::get('/websetting/sideimg_setting', [WebsettingController::class, 'sideimg_setting'])->middleware('is_vaild_user');
Route::post('/websetting/save_news_setting', [WebsettingController::class, 'save_news_setting']);
Route::post('/websetting/save_testimonials_setting', [WebsettingController::class, 'save_testimonials_setting']);
Route::post('/websetting/save_announcements_setting', [WebsettingController::class, 'save_announcements_setting']);
Route::post('/websetting/save_category_setting', [WebsettingController::class, 'save_category_setting']);
Route::post('/websetting/save_category_image', [WebsettingController::class, 'save_category_image']);
Route::post('/websetting/save_hero_title', [WebsettingController::class, 'save_hero_title']);
Route::post('/websetting/save_hero_text', [WebsettingController::class, 'save_hero_text']);
Route::post('/websetting/save_hero_image', [WebsettingController::class, 'save_hero_image']);
Route::post('/websetting/save_other_img', [WebsettingController::class, 'save_other_img']);
Route::get('/websetting/news_setting', [WebsettingController::class, 'news_setting'])->middleware('is_vaild_user');
Route::get('/websetting/add_news', [WebsettingController::class, 'add_news'])->middleware('is_vaild_user');
Route::post('/websetting/add_news', [WebsettingController::class, 'add_news_api']);
Route::get('/websetting/edit_news/{id}', [WebsettingController::class, 'edit_news'])->middleware('is_vaild_user');
Route::post('/websetting/edit_news', [WebsettingController::class, 'edit_news_api']);
Route::post('/websetting/del_news', [WebsettingController::class, 'del_news_api']);
Route::get('/websetting/testimonials_setting', [WebsettingController::class, 'testimonials_setting'])->middleware('is_vaild_user');
Route::get('/websetting/add_testimonials', [WebsettingController::class, 'add_testimonials'])->middleware('is_vaild_user');
Route::post('/websetting/add_testimonials', [WebsettingController::class, 'add_testimonials_api']);
Route::get('/websetting/edit_testimonials/{id}', [WebsettingController::class, 'edit_testimonials'])->middleware('is_vaild_user');
Route::post('/websetting/edit_testimonials', [WebsettingController::class, 'edit_testimonials_api']);
Route::post('/websetting/del_testimonials', [WebsettingController::class, 'del_testimonials_api']);
Route::get('/websetting/announcements_setting', [WebsettingController::class, 'announcements_setting'])->middleware('is_vaild_user');
Route::get('/websetting/add_announcements', [WebsettingController::class, 'add_announcements'])->middleware('is_vaild_user');
Route::post('/websetting/add_announcements', [WebsettingController::class, 'add_announcements_api']);
Route::get('/websetting/edit_announcements/{id}', [WebsettingController::class, 'edit_announcements'])->middleware('is_vaild_user');
Route::post('/websetting/edit_announcements', [WebsettingController::class, 'edit_announcements_api']);
Route::post('/websetting/del_announcements', [WebsettingController::class, 'del_announcements_api']);
Route::post('/websetting/remove_img', [WebsettingController::class, 'remove_img']);

//po page----------------------------------------------------------------------
Route::get('/po/create_po', [PoController::class, 'create_po']);
Route::post('/po/add_po', [PoController::class, 'add_po_api']);
Route::get('/po/edit_po/{po_number}/{company_name}', [PoController::class, 'edit_po']);
Route::post('/po/del_po', [PoController::class, 'del_po_api']);
Route::get('/po/search_po', [PoController::class, 'search_po']);
Route::post('/po/search_result', [PoController::class, 'search_result']);
Route::post('/po/add_action', [PoController::class, 'add_action_api']);
Route::post('/po/edit_action', [PoController::class, 'edit_action_api']);
Route::post('/po/del_action', [PoController::class, 'del_action_api']);
Route::get('/po/report_po', [PoController::class, 'report_po']);
Route::post('/po/send_email', [PoController::class, 'send_email']);

//END ADMIN===============================================================================================




//USER PANEL ==============================================================================================

//Login page---------------------------------------------------------------
Route::get('/user/login', [ULoginController::class, 'login'])->name('login');
Route::get('/user/logout', [ULoginController::class, 'logout']);
Route::get('/user/login_check', [ULoginController::class, 'login_check_api']);

//Register page---------------------------------------------------------------
Route::get('/user/register', [ULoginController::class, 'register']);
Route::post('/user/register_api', [ULoginController::class, 'register_api']);

//Home page-----------------------------------------------------------------
Route::get('/', [UHomeController::class, 'index'])->name('index');
Route::post('/user/send_subscribe', [UHomeController::class, 'send_subscribe']);

//Main page------------------------------------------------------------------
Route::get('/user/main', [UMainController::class, 'index']);
Route::get('/user/search_product_api', [UMainController::class, 'search_product_api']);
Route::get('/user/search_by_brand/{brand}', [UMainController::class, 'search_by_brand_api']);
Route::get('/user/search_by_category/{category}', [UMainController::class, 'search_by_category_api']);
Route::get('/user/search_by_key/{key}', [UMainController::class, 'search_by_key_api']);

//Detail page-----------------------------------------------------------------
Route::get('/user/detail/{id}', [UDetailController::class, 'index']);
Route::post('/user/send_visit_report', [UDetailController::class, 'send_visit_report_api']);

//Wish list page-----------------------------------------------------------
Route::get('/user/wishlist', [UWishlistController::class, 'index']);
Route::post('/user/add_wishlist', [UWishlistController::class, 'add_wishlist_api']);
Route::post('/user/del_wishlist', [UWishlistController::class, 'del_wishlist_api']);

//Brand page--------------------------------------------------------------------
Route::get('/user/brand', [UBrandController::class, 'index']);

//Track order page-------------------------------------------------------------
Route::get('/user/trackorder', [UTrackorderController::class, 'index']);
Route::post('/user/search_po', [UTrackorderController::class, 'search_po_api']);

//Contact us page--------------------------------------------------------------
Route::get('/user/contactus', [UContactusController::class, 'index']);
Route::post('/user/contactus', [UContactusController::class, 'contactus_api']);

//My Account page--------------------------------------------------------------
Route::get('/user/myaccount', [UProfileController::class, 'myaccount'])->name('myaccount');

//Profile page--------------------------------------------------------------
Route::get('/user/profile', [UProfileController::class, 'profile'])->name('profile');
Route::post('/user/change_pwd_api', [UProfileController::class, 'change_pwd_api']);
Route::post('/user/change_profile_api', [UProfileController::class, 'change_profile_api']);

//Address page--------------------------------------------------------------
Route::get('/user/address', [UProfileController::class, 'address']);
Route::post('/user/change_address_api', [UProfileController::class, 'change_address_api']);

//Faq page--------------------------------------------------------------
Route::get('/user/faq', [UOtherController::class, 'faq']);

//Policy page--------------------------------------------------------------
Route::get('/user/policy', [UOtherController::class, 'policy']);

//About us page--------------------------------------------------------------
Route::get('/user/aboutus', [UOtherController::class, 'aboutus']);

//About us page--------------------------------------------------------------
Route::get('/user/international', [UOtherController::class, 'international']);

//About us page--------------------------------------------------------------
Route::get('/user/artwork', [UOtherController::class, 'artwork']);

//About us page--------------------------------------------------------------
Route::get('/user/refund', [UOtherController::class, 'refund']);

//About us page--------------------------------------------------------------
Route::get('/user/shipping_policies', [UOtherController::class, 'shipping_policies']);

//About us page--------------------------------------------------------------
Route::get('/user/solution', [UOtherController::class, 'solution']);


//Send email-------------------------------------------------------------
Route::get('send-email-pdf', [PDFController::class, 'index']);
Route::get('user/email_moreinfo', [PDFController::class, 'email_moreinfo']);