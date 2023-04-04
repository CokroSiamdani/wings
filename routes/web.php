<?php

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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/kirim-email', 'MailController@index');

/**
 * ProductStaff Route
 */
Route::prefix('product_staff')->group(function () {
    Route::get('/', 'ProductStaffController@index')->name('product_staff.index');
    Route::get('/add', 'ProductStaffController@add')->name('product_staff.add');
    Route::post('save', 'ProductStaffController@save')->name('product_staff.save');
    Route::get('/view/{id}', 'ProductStaffController@details')->name('product_staff.details');
    Route::get('/edit/{id}', 'ProductStaffController@edit')->name('product_staff.edit');
    Route::put('/update/{id}', 'ProductStaffController@update')->name('product_staff.update');
    Route::get('/delete/{id}', 'ProductStaffController@delete')->name('product_staff.delete');
});

/**
 * Transaction Route
 */
Route::prefix('transaction')->group(function () {
    Route::get('/', 'TransactionController@index')->name('transaction.index');
    Route::get('/add', 'TransactionController@add')->name('transaction.add');
    Route::post('save-transaction', 'TransactionController@save_transaction')->name('transaction.save-transaction');
    Route::get('/view/{id}', 'TransactionController@transaction_details')->name('transaction.view-details');
    Route::get('/edit/{id}', 'TransactionController@edit')->name('transaction.edit');
    Route::post('/update', 'TransactionController@update')->name('transaction.update');
    Route::get('/delete/{id}', 'TransactionController@delete')->name('transaction.delete');
    Route::get('/download-qr-code/{id}', 'TransactionController@download_qr_code')->name('transaction.download-qr-code');
});

/**
 * Stock Route
 */
Route::prefix('stock')->group(function () {
    Route::get('/add', 'StockController@index')->name('stock.add');
    Route::post('save-purchase', 'StockController@save_purchase')->name('stock.save-purchase');
    Route::get('/', 'StockController@manage')->name('stock.manage');
    Route::get('/view/{id}', 'StockController@stock_details')->name('stock.view-details');
    Route::get('/edit/{id}', 'StockController@edit')->name('stock.edit');
    Route::post('/update', 'StockController@update')->name('stock.update');
    Route::get('/delete/{id}', 'StockController@delete')->name('stock.delete');
    Route::post('/import_excel', 'StockController@import_excel')->name('stock.import_excel');
    Route::post('/notif/{id}', 'StockController@email')->name('stock.save-email');
    Route::get('/notifunpublished/{id}', 'StockController@notifunpublished')->name('stock.notifunpublished');
    Route::get('/notifpublished/{id}', 'StockController@notifpublished')->name('stock.notifpublished');
    Route::get('/email', 'StockController@email')->name('stock.email');
    Route::get('/download-qr-code/{id}', 'StockController@download_qr_code')->name('stock.download-qr-code');
});

/**
 * Supplier Route
 */
Route::prefix('supplier')->group(function () {
    Route::get('/', 'SupplierController@index')->name('supplier');
    Route::post('/store', 'SupplierController@store')->name('supplier.store');
    Route::get('/unpublished/{id}', 'SupplierController@unpublished')->name('supplier.unpublished');
    Route::get('/published/{id}', 'SupplierController@published')->name('supplier.published');
    Route::post('/update', 'SupplierController@update')->name('supplier.update');
    Route::post('/delete', 'SupplierController@delete')->name('supplier.delete');
});

/**
 * Brand Route
 */
Route::prefix('brand')->group(function () {
    Route::get('/', 'BrandController@index')->name('brand');
    Route::post('/store', 'BrandController@store')->name('brand.store');
    Route::get('/unpublished/{id}', 'BrandController@unpublished')->name('brand.unpublished');
    Route::get('/published/{id}', 'BrandController@published')->name('brand.published');
    Route::post('/update', 'BrandController@update')->name('brand.update');
    Route::post('/delete', 'BrandController@delete')->name('brand.delete');
});

/**
 * Category Route
 */
Route::prefix('category')->group(function () {
    Route::get('/', 'CategoryController@index')->name('category');
    Route::post('/store', 'CategoryController@store')->name('category.store');
    Route::get('/unpublished/{id}', 'CategoryController@unpublished')->name('category.unpublished');
    Route::get('/published/{id}', 'CategoryController@published')->name('category.published');
    Route::post('/update', 'CategoryController@update')->name('category.update');
    Route::post('/delete', 'CategoryController@delete')->name('category.delete');
});

/**
 * Staff Route
 */
Route::prefix('staff')->group(function () {
    Route::get('/', 'StaffController@index')->name('staff.index');
    Route::get('/add', 'StaffController@add')->name('staff.add');
    Route::post('save-staff', 'StaffController@save_staff')->name('staff.save-staff');
    Route::get('/view/{id}', 'StaffController@staff_details')->name('staff.view-details');
    Route::get('/edit/{id}', 'StaffController@edit')->name('staff.edit');
    Route::post('/update', 'StaffController@update')->name('staff.update');
    Route::get('/delete/{id}', 'StaffController@delete')->name('staff.delete');
    Route::get('/export_excel', 'StaffController@export_excel')->name('staff.export_excel');
    Route::post('/import_excel', 'StaffController@import_excel')->name('staff.import_excel');
});

/**
 * maintenance_pc_laptop Route
 */
Route::prefix('maintenance_pc_laptop')->group(function () {
    Route::get('/', 'Maintenance_pc_laptop_Controller@index')->name('maintenance_pc_laptop.index');
    Route::get('/add', 'Maintenance_pc_laptop_Controller@add')->name('maintenance_pc_laptop.add');
    Route::post('save-maintenance_pc_laptop', 'Maintenance_pc_laptop_Controller@save_maintenance_pc_laptop')->name('maintenance_pc_laptop.save-maintenance_pc_laptop');
    Route::get('/view/{id}', 'Maintenance_pc_laptop_Controller@maintenance_pc_laptop_details')->name('maintenance_pc_laptop.view-details');
    Route::get('/edit/{id}', 'Maintenance_pc_laptop_Controller@edit')->name('maintenance_pc_laptop.edit');
    Route::post('/update', 'Maintenance_pc_laptop_Controller@update')->name('maintenance_pc_laptop.update');
    Route::get('/delete/{id}', 'Maintenance_pc_laptop_Controller@delete')->name('maintenance_pc_laptop.delete');
    Route::get('/unsigned/{id}', 'Maintenance_pc_laptop_Controller@unsigned')->name('maintenance_pc_laptop.unsigned');
    Route::get('/signed/{id}', 'Maintenance_pc_laptop_Controller@signed')->name('maintenance_pc_laptop.signed');
    Route::get('/cetak_pdf/{data}', 'Maintenance_pc_laptop_Controller@cetak_pdf');
    Route::get('/view_pdf/{data}', 'Maintenance_pc_laptop_Controller@view_pdf');
    // Route::get('/export_excel', 'Maintenance_pc_laptop_Controller@export_excel')->name('maintenance_pc_laptop.export_excel');
    // Route::post('/import_excel', 'Maintenance_pc_laptop_Controller@import_excel')->name('maintenance_pc_laptop.import_excel');
});

/**
 * maintenance_network Route
 */
Route::prefix('maintenance_network')->group(function () {
    Route::get('/', 'Maintenance_network_Controller@index')->name('maintenance_network.index');
    Route::get('/add', 'Maintenance_network_Controller@add')->name('maintenance_network.add');
    Route::post('save-maintenance_network', 'Maintenance_network_Controller@save_maintenance_network')->name('maintenance_network.save-maintenance_network');
    Route::get('/view/{id}', 'Maintenance_network_Controller@maintenance_network_details')->name('maintenance_network.view-details');
    Route::get('/edit/{id}', 'Maintenance_network_Controller@edit')->name('maintenance_network.edit');
    Route::post('/update', 'Maintenance_network_Controller@update')->name('maintenance_network.update');
    Route::get('/delete/{id}', 'Maintenance_network_Controller@delete')->name('maintenance_network.delete');
    Route::get('/unsigned/{id}', 'Maintenance_network_Controller@unsigned')->name('maintenance_network.unsigned');
    Route::get('/signed/{id}', 'Maintenance_network_Controller@signed')->name('maintenance_network.signed');
    Route::get('/cetak_pdf/{data}', 'Maintenance_network_Controller@cetak_pdf');
    Route::get('/view_pdf/{data}', 'Maintenance_network_Controller@view_pdf');
    // Route::get('/export_excel', 'Maintenance_network_Controller@export_excel')->name('maintenance_network.export_excel');
    // Route::post('/import_excel', 'Maintenance_network_Controller@import_excel')->name('maintenance_network.import_excel');
});

/**
 * maintenance_software Route
 */
Route::prefix('maintenance_software')->group(function () {
    Route::get('/', 'Maintenance_software_Controller@index')->name('maintenance_software.index');
    Route::get('/add', 'Maintenance_software_Controller@add')->name('maintenance_software.add');
    Route::post('save-maintenance_software', 'Maintenance_software_Controller@save_maintenance_software')->name('maintenance_software.save-maintenance_software');
    Route::get('/view/{id}', 'Maintenance_software_Controller@maintenance_software_details')->name('maintenance_software.view-details');
    Route::get('/edit/{id}', 'Maintenance_software_Controller@edit')->name('maintenance_software.edit');
    Route::post('/update', 'Maintenance_software_Controller@update')->name('maintenance_software.update');
    Route::get('/delete/{id}', 'Maintenance_software_Controller@delete')->name('maintenance_software.delete');
    Route::get('/unsigned/{id}', 'Maintenance_software_Controller@unsigned')->name('maintenance_software.unsigned');
    Route::get('/signed/{id}', 'Maintenance_software_Controller@signed')->name('maintenance_software.signed');
    Route::get('/cetak_pdf/{data}', 'Maintenance_software_Controller@cetak_pdf');
    Route::get('/view_pdf/{data}', 'Maintenance_software_Controller@view_pdf');
    // Route::get('/export_excel', 'Maintenance_software_Controller@export_excel')->name('maintenance_software.export_excel');
    // Route::post('/import_excel', 'Maintenance_software_Controller@import_excel')->name('maintenance_software.import_excel');
});

/**
 * maintenance_cctv Route
 */
Route::prefix('maintenance_cctv')->group(function () {
    Route::get('/', 'Maintenance_cctv_Controller@index')->name('maintenance_cctv.index');
    Route::get('/add', 'Maintenance_cctv_Controller@add')->name('maintenance_cctv.add');
    Route::post('save-maintenance_cctv', 'Maintenance_cctv_Controller@save_maintenance_cctv')->name('maintenance_cctv.save-maintenance_cctv');
    Route::get('/view/{id}', 'Maintenance_cctv_Controller@maintenance_cctv_details')->name('maintenance_cctv.view-details');
    Route::get('/edit/{id}', 'Maintenance_cctv_Controller@edit')->name('maintenance_cctv.edit');
    Route::post('/update', 'Maintenance_cctv_Controller@update')->name('maintenance_cctv.update');
    Route::get('/delete/{id}', 'Maintenance_cctv_Controller@delete')->name('maintenance_cctv.delete');
    Route::get('/unsigned/{id}', 'Maintenance_cctv_Controller@unsigned')->name('maintenance_cctv.unsigned');
    Route::get('/signed/{id}', 'Maintenance_cctv_Controller@signed')->name('maintenance_cctv.signed');
    Route::get('/cetak_pdf/{data}', 'Maintenance_cctv_Controller@cetak_pdf');
    Route::get('/view_pdf/{data}', 'Maintenance_cctv_Controller@view_pdf');
    // Route::get('/export_excel', 'Maintenance_cctv_Controller@export_excel')->name('maintenance_cctv.export_excel');
    // Route::post('/import_excel', 'Maintenance_cctv_Controller@import_excel')->name('maintenance_cctv.import_excel');
});

/**
 * maintenance_email Route
 */
Route::prefix('maintenance_email')->group(function () {
    Route::get('/', 'Maintenance_email_Controller@index')->name('maintenance_email.index');
    Route::get('/add', 'Maintenance_email_Controller@add')->name('maintenance_email.add');
    Route::post('save-maintenance_email', 'Maintenance_email_Controller@save_maintenance_email')->name('maintenance_email.save-maintenance_email');
    Route::get('/view/{id}', 'Maintenance_email_Controller@maintenance_email_details')->name('maintenance_email.view-details');
    Route::get('/edit/{id}', 'Maintenance_email_Controller@edit')->name('maintenance_email.edit');
    Route::post('/update', 'Maintenance_email_Controller@update')->name('maintenance_email.update');
    Route::get('/delete/{id}', 'Maintenance_email_Controller@delete')->name('maintenance_email.delete');
    Route::get('/unsigned/{id}', 'Maintenance_email_Controller@unsigned')->name('maintenance_email.unsigned');
    Route::get('/signed/{id}', 'Maintenance_email_Controller@signed')->name('maintenance_email.signed');
    Route::get('/cetak_pdf/{data}', 'Maintenance_email_Controller@cetak_pdf');
    Route::get('/view_pdf/{data}', 'Maintenance_email_Controller@view_pdf');
    // Route::get('/export_excel', 'Maintenance_email_Controller@export_excel')->name('maintenance_email.export_excel');
    // Route::post('/import_excel', 'Maintenance_email_Controller@import_excel')->name('maintenance_email.import_excel');
});

/**
 * Supplier Payment Route
 */
// Route::prefix('payment')->group(function () {
//     Route::get('/', 'PaymentController@index')->name('payment');
//     Route::post('/supplier', 'PaymentController@save_supplier_payment')->name('payment.supplier');
//     Route::get('/add-details/{id}', 'PaymentController@payment_details')->name('payment.details');
//     Route::get('/stock-details/{id}', 'PaymentController@payment_stock_details')->name('payment.stock.details');
// });

/**
 * Payment Method Route
 */
// Route::prefix('payment-method')->group(function () {
//     Route::get('/', 'PaymentMethodController@index')->name('payment-method');
//     Route::post('/store', 'PaymentMethodController@store')->name('payment-method.store');
//     Route::get('/unpublished/{id}', 'PaymentMethodController@unpublished')->name('payment-method.unpublished');
//     Route::get('/published/{id}', 'PaymentMethodController@published')->name('payment-method.published');
//     Route::post('/update', 'PaymentMethodController@update')->name('payment-method.update');
//     Route::post('/delete', 'PaymentMethodController@delete')->name('payment-method.delete');
// });

/**
 * Invoice PDF Generate
 */

Route::get('/payment/invoice/{id}', 'PaymentController@invoice')->name('payment.invoice');


// API ROUTES

Route::prefix('api')->group(function () {
    Route::get('/userData', 'LoginApiController@userData')->name('api.userData');
    Route::get('/token', function () {
        return csrf_token();
    });
    Route::post('/loginCheck', 'LoginApiController@loginCheck');
    Route::get('/maintenance_pc_laptop', 'MaintenanceApiController@maintenance_pc_laptop')->name('maintenance_api.maintenance_pc_laptop');
    Route::get('/stock', 'StockApiController@read_stock')->name('stock_api.stock');
    Route::get('/category', 'CategoryApiController@read_category')->name('category_api.category');
    // Route::get('/calculateage/{data}', 'HitungUmurController@hitung_umur');
});

Route::prefix('calculateage')->group(function () {
    Route::get('/{data}', 'HitungUmurController@hitung_umur');
});
