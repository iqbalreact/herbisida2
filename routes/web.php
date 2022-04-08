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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/pencarian', 'Frontend\PencarianController@index')->name('frontend.pencarian');
Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth','revalidate']], function (){
    // Route::get('/', 'PageController@index');
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
        Route::get('/produk', 'ProdukController@Produk')->name('Produk');
        Route::get('/produk/id/{id}', 'ProdukController@getProduk')->name('getProduk');
        Route::post('/produk/add', 'ProdukController@addProduk')->name('addProduk');
        Route::post('/produk/update', 'ProdukController@updateProduk')->name('updateProduk');
        Route::get('/produk/delete/{id}', 'ProdukController@deleteProduk')->name('deleteProduk');
    
        Route::get('/penjualan', 'PenjualanController@Penjualan')->name('Penjualan');
        Route::get('/penjualan/id/{id}', 'PenjualanController@getPenjualan')->name('getPenjualan');
        Route::post('/penjualan/add', 'PenjualanController@addPenjualan')->name('addPenjualan');
        Route::post('/penjualan/update', 'PenjualanController@updatePenjualan')->name('updatePenjualan');
        Route::get('/penjualan/delete/{id}', 'PenjualanController@deletePenjualan')->name('deletePenjualan');
    
        Route::get('/prediksi', 'PrediksiController@index')->name('Prediksi');
        Route::post('/prediksi/proses', 'PrediksiController@Prediksi')->name('proses-prediksi');
        Route::post('/prediksi/simpan', 'PrediksiController@simpan')->name('simpan-prediksi');
        Route::get('/prediksi/data', 'PrediksiController@data')->name('data-prediksi');
        Route::get('/prediksi/delete/{id}', 'PrediksiController@deletePrediksi')->name('deletePrediksi');
    
        // end route 
        Route::resource('/pengguna', 'UserController');
        Route::get('/pengguna/get/{id}', 'UserController@getPengguna')->name('get-pengguna');
        Route::post('/pengguna/update', 'UserController@updatePengguna')->name('update-pengguna');
        Route::get('/pengguna/delete/{id}', 'UserController@deletePengguna')->name('delete-pengguna');
        Route::get('/peran/get/{id}', 'UserController@getRole')->name('get-role');
        Route::post('/peran/update', 'UserController@updatePeran')->name('update-peran');
        Route::get('/peran/delete/{id}', 'UserController@deletePeran')->name('delete-peran');
        Route::post('/peran/', 'UserController@addRole')->name('tambah-peran');
    
    });
    
});






Route::get('/roles', function () {
    return view('admin.pengguna.roles');
});
