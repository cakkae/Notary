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




Route::get('/', function () {
    return redirect(route('login'));
});


Auth::routes();

Route::namespace('Admin')->group(function () {
    Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function()
    {
        Route::get('/', 'Dashboard@index');
        Route::get('/dashboard', 'Dashboard@index');
        Route::get('/order', 'Order@index');
        Route::get('/notary', 'Notary@index');
        Route::get('/clients', 'Users@clients')->name('client.index');
        Route::get('/clients/create', 'Users@create')->name('client.create');
        Route::post('/clients/store', 'Users@store')->name('client.store');
        Route::get('/users', 'Users@index');
        Route::get('/reports', 'Reports@index');
        Route::get('/settings', 'Settings@index');
        Route::post('/updateSettings', 'Settings@update')->name('updateSettings');
    });
});

Route::namespace('Owner')->group(function () {
    Route::group(['prefix' => 'owner',  'middleware' => 'auth'], function()
    {
        Route::get('/', 'Dashboard@index')->middleware('role:Owner');
        Route::get('/accouting', 'Accouting@index')->middleware('role:Owner');
        Route::get('/settings', 'Settings@index')->name('settings')->middleware('role:Owner');
        Route::post('/update_company_fee', 'Company@updateFee')->name('update_company_fee')->middleware('role:Owner');
        Route::post('/update_company_account', 'Company@updateAccount')->name('update_company_account')->middleware('role:Owner');
        Route::post('/create_user', 'Company@createUser')->name('create_user')->middleware('role:Owner');
        Route::post('/update_organization_info', 'Settings@updateOrganization')->name('update_organization_info')->middleware('role:Owner');
        Route::resource('company', 'Company')->middleware('role:Owner');
        Route::post('/add_super_admin', 'Company@createSuperAdmin')->name('add_super_admin')->middleware('role:Owner');
    });
});

Route::namespace('Vendor')->group(function () {
    Route::group(['prefix' => 'vendor',  'middleware' => 'auth'], function()
    {
        // Navigation route
        Route::get('/', 'Dashboard@index');
        Route::get('/dashboard', 'Dashboard@index');
        Route::get('/settings', 'Settings@index');
        Route::get('/coverage', 'Coverage@index');
        Route::get('/documents', 'Documents@index');
        Route::post('/documents/upload', 'Documents@upload')->name('uploadDocuments');
        Route::get('/hardware', 'Hardware@index');
        Route::get('/invoice', 'Invoice@index');
        Route::get('/pricing', 'Pricing@index');
        Route::get('/skills', 'SkillsAndExperience@index');

        // Navigation for form
        Route::post('/updateAccountSettings', 'Settings@update')->name('updateAccountSettings');
        Route::post('/updateHardwareSettings', 'Hardware@update')->name('updateHardwareSettings');
        Route::post('/updateCoverage', 'Coverage@update')->name('updateCoverage');

    });
    Route::get('/getCountry/{state_id}','Coverage@getCountry');
    Route::get('/getZipCode/{country_name}','Coverage@getZipCode');
});


Route::get('/user', 'Shared\Order@index')->name('shared.orders')->middleware('role:User,Admin,Client,Owner');
Route::post('/create_order', 'Shared\Order@create')->name('create_order')->middleware('role:User,Admin,Client');
Route::post('/add_document_order', 'Shared\Order@addDocuments')->name('add_document_order')->middleware('role:User,Admin');
Route::post('/send_order_email', 'Shared\Order@send_order_email')->name('send_order_email')->middleware('role:User,Admin');
Route::get('/uploaded_documents_list/{order_id}','Order@getAllDocumentsByOrder')->name('uploaded_documents_list')->middleware('role:User,Admin');
Route::delete('/delete_document/{document_id}','Order@deleteDocument')->name('delete_document')->middleware('role:User,Admin');

Route::post('/sendTestEmail', 'Shared\SendTestEmail@send_email')->name('sendTestEmail');
Route::get('/shared/vendors', 'Shared\Vendor@index')->name('shared.vendors');
Route::get('/shared/vendors/create', 'Shared\Vendor@create')->name('vendor.create');
Route::post('/shared/vendors/store', 'Shared\Vendor@store')->name('vendor.store');

// Route::get('/', 'HomeController@index')->name('home');

Route::get('/vendor/dashboard', 'HomeController@index');
//Route::get('/home', 'HomeController@index')->name('home')->middleware('role:User,Admin');

// Route::get('/test', function (\Illuminate\Http\Request $request) {
//     $user = $request->user();
//     dd($user->hasRole('Owner'));
// });

// Route::get('/test', function (\Illuminate\Http\Request $request) {
//     $user = $request->user();
//     dd($user->can('delete'));
// });

// Route::get('/test', function (\Illuminate\Http\Request $request) {
//     $user = $request->user();
//     $user->givePermission();
// });

// Route::get('/test', function (\Illuminate\Http\Request $request) {
//     $user = $request->user();
//     $user->removePermission('delete');
// });

// Route::get('/test', function (\Illuminate\Http\Request $request) {
//     $user = $request->user();
//     $user->modifyPermission('delete');
// });

