<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


//AUTH
Route::post('/auth/register', 'AuthController@register');
Route::post('/auth/login', 'AuthController@login');

//FOOD
Route::get('/food', 'FoodsController@getFood');

//ORDERS
Route::post('/users/{userId}/orders', 'OrdersController@setOrders');
Route::get('/users/{userId}/orders', 'OrdersController@getAllOrders');
Route::get('/users/{userId}/orders/last', 'OrdersController@getLastOrder');
Route::patch('/users/{userId}/orders/{orderId}', 'OrdersController@completedOrder');

//ORDER ITEM
Route::post('/users/{userId}/orders/{orderId}/order-item', 'OrdersController@setOrderItem');
Route::delete('/users/{userId}/orders/{orderId}/order-item/{order_item_id}', 'OrdersController@deleteOrderItem');