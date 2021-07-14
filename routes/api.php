<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('employee','Api\EmployeeController');
Route::get('employee-names','Api\EmployeeController@employname');
Route::apiResource('supplier','Api\SupplierController');
Route::apiResource('category','Api\CategoryController');
Route::apiResource('product','Api\ProductController');
Route::apiResource('customer','Api\CustomerController');
Route::get('/category/product/{id}','Api\ProductController@categorywiseproduct');
Route::get('/stock/out/products','Api\ProductController@stockoutproduct');
Route::get('/addToCart/{id}','Api\CartController@addToCart');
Route::get('/Cart/product','Api\CartController@getCartProduct');
Route::get('/remove/cart/{id}','Api\CartController@removeCart');
Route::get('/increment/cart/{id}','Api\CartController@increment');
Route::get('/decrement/cart/{id}','Api\CartController@decrement');
Route::post('/orderdone','Api\CartController@orderdone');

Route::get('/sales/list','Api\CartController@salesList');
Route::get('/sales/details/{id}','Api\CartController@salesDetails');
Route::get('/sales/details/all/{id}','Api\CartController@salesDetailsall');

Route::apiResource('expense','Api\ExpenseController');
Route::post('salary/paid/{id}','Api\SalaryController@salary_paid');

Route::post('saveproduct','Api\PurchaseController@saveproduct');
Route::get('getvertualproduct','Api\PurchaseController@getvertualproduct');
Route::get('clearproduct','Api\PurchaseController@clearproduct');
Route::post('purchase/store','Api\PurchaseController@storepurchase');
Route::get('vproduct/delete/{id}','Api\PurchaseController@vproductdelete');
Route::get('/purchase/list','Api\PurchaseController@allPurchase');
Route::get('/purchase/details/{id}','Api\PurchaseController@purchasedetails');
Route::get('/purchase/details/product/{id}','Api\PurchaseController@purchasedetailsproduct');

// Report
Route::get('productget/for/purchase','Api\ProductController@getProductForPurchase');
Route::post('/getpurchaseproductbyid','Api\ReportController@getpurchaseproductbyid');
Route::get('/daily/purchase/report','Api\ReportController@dailyPurchaseReport');
