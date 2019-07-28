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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect(route('login'));
});
Auth::routes();
Route::group(['middleware' => 'auth'], function ()
{


        Route::resource('/role', 'RoleController')->except([
            'create', 'show', 'edit', 'update'
        ]);

        Route::resource('/users', 'UserController')->except([
            'show'
        ]);
        Route::get('/users/roles/{id}', 'UserController@roles')->name('users.roles');
        Route::put('/users/roles/{id}', 'UserController@setRole')->name('users.set_role');
        Route::post('/users/permission', 'UserController@addPermission')->name('users.add_permission');
        Route::get('/users/role-permission', 'UserController@rolePermission')->name('users.roles_permission');
        Route::put('/users/permission/{role}', 'UserController@setRolePermission')->name('users.setRolePermission');
    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::group(['middleware' => ['permission:manajemen kasir']], function() {
        Route::resource('/employees','EmployeeController')->except([
            'show'
        ]);
//        Route::get('employees/create', 'EmployeeController@getOutlet')->name('employees.create');
        Route::get('/employees/roles/{id}', 'EmployeeController@roles')->name('employees.roles');
        Route::put('/employees/roles/{id}', 'EmployeeController@setRole')->name('employees.set_role');
        Route::post('/employees/permission', 'EmployeeController@addPermission')->name('employees.add_permission');
        Route::get('/employees/role-permission', 'EmployeeController@rolePermission')->name('employees.roles_permission');
        Route::put('/employees/permission/{role}', 'EmployeeController@setRolePermission')->name('employees.setRolePermission');
    });
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    Route::group(['middleware' => ['permission:manajemen bisnis']], function() {
        Route::resource('/bisnis','BusinessController');
        Route::resource('/outlet','OutletController');
    });
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        Route::resource('/home', 'HomeController');
        Route::get('/home', 'HomeController@index')->name('home');





///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    Route::group(['middleware' => ['permission:manajemen produk']], function() {
        Route::resource('/kategori','CategoryController')->except([
            'create','show'
        ]);

        Route::resource('/produk', 'ProductController');
    });

///////////////////////////////////////////////////////////////////////////////////////////////////////

    Route::group(['middleware' => ['permission:bahan baku']], function() {
        Route::resource('/material', 'RawMaterialController');

        Route::resource('/resep', 'IngredientController');
    });


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    Route::group(['middleware' => ['permission:laporan']], function() {
        Route::get('/order', 'OrderController@index')->name('order.index');
        Route::get('/penjualan', 'SalesController@index')->name('penjualan.index');
        Route::get('/order/pdf/{invoice}', 'OrderController@invoicePdf')->name('order.pdf');
        Route::get('/order/excel/{invoice}', 'OrderController@invoiceExcel')->name('order.excel');
    });
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //route group untuk kasir


    Route::get('/transaksi', 'OrderController@addOrder')->name('order.transaksi');
    Route::get('/checkout', 'OrderController@checkout')->name('order.checkout');
    Route::post('/checkout', 'OrderController@storeOrder')->name('order.storeOrder');

    Route::get('/dashboard','DashboardController@index');
});

