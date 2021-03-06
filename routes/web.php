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

// Catatan pada file database.php strict sebelumnya true bukan false

Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/dashboard/terjualhariIni', 'HomeController@terjualhariIni')->name('terjualhariIni');
Route::get('/dashboard/pendphariIni', 'HomeController@pendphariIni')->name('pendphariIni');
Route::get('/dashboard/newOrder', 'HomeController@newOrder')->name('newOrder');
Route::get('/dashboard/userRegistrations', 'HomeController@Users')->name('users');
Route::get('/dashboard/produkTerjual', 'HomeController@produkTerjual')->name('produkTerjual');
Route::get('/dashboard/byProdukterjualMakanan','HomeController@byProdukterjualMakanan');
Route::get('/dashboard/byProdukterjualMinuman','HomeController@byProdukterjualMinuman');
Route::get('/dashboard/byPendpHarian','HomeController@byPendpHarian');
Route::get('/dashboard/byPendpBulanan','HomeController@byPendpBulanan');
Route::get('/dashboard/byPendpTahunan','HomeController@byPendpTahunan');
Route::get('/dashboard/Pengeluaran','HomeController@Pengeluaran');
Route::get('/dashboard/LabaBersih','HomeController@LabaBersih');

Route::prefix('admin')->group(function(){
    Route::get('/profil/{id}', 'AdminController@profile')->name('profil');
    Route::put('/profil/{id}', 'AdminController@update')->name('edit.profil');
    Route::get('/logout', 'AdminController@logout')->name('logout.profil');
});

Route::prefix('kategoriProduk')->group(function(){
    Route::get('/', 'kategoriprodukController@index');
    Route::get('/search', 'kategoriprodukController@search')->name('search.kategoriProduk');
    Route::get('/add', 'kategoriprodukController@create')->name('add.kategoriProduk');
    Route::post('/add', 'kategoriprodukController@store')->name('submit.kategoriProduk');
    Route::get('/edit/{id}', 'kategoriprodukController@edit')->name('edit.kategoriProduk');
    Route::put('/edit/{id}', 'kategoriprodukController@update')->name('update.kategoriProduk');
    Route::put('/status/{id}', 'kategoriprodukController@status')->name('status.kategoriProduk');
    Route::delete('/delete/{id}', 'kategoriprodukController@destroy')->name('delete.kategoriProduk');
});

Route::prefix('produk/review')->group(function(){
    Route::get('/', 'ReviewController@index');
    Route::put('/status/{id}', 'ReviewController@status')->name('review.status');
    Route::delete('/delete/{id}', 'ReviewController@destroy')->name('delete.review');
});

Route::prefix('Stok')->group(function(){
    Route::get('/', 'StokController@index');
    Route::get('/search', 'StokController@search')->name('search.stok');
    Route::get('/add', 'StokController@create')->name('add.stok');
    Route::post('/add', 'StokController@store')->name('submit.stok');
    Route::get('/edit/{id}', 'StokController@edit')->name('edit.stok');
    Route::put('/edit/{id}', 'StokController@update')->name('update.stok');
    Route::put('/status/{id}', 'StokController@status')->name('status.stok');
    Route::delete('/delete/{id}', 'StokController@destroy')->name('delete.stok');
});

Route::prefix('produk')->group(function(){
    Route::get('/', 'produkController@index');
    Route::get('/search', 'produkController@search')->name('search.produk');
    Route::get('/add', 'produkController@create')->name('add.produk');
    Route::post('/add', 'produkController@store')->name('submit.produk');
    Route::get('/edit/{id}', 'produkController@edit')->name('edit.produk');
    Route::put('/edit/{id}', 'produkController@update')->name('update.produk');
    Route::put('/status/{id}', 'produkController@status')->name('status.produk');
    Route::delete('/delete/{id}', 'produkController@destroy')->name('delete.produk');
});

Route::prefix('kegiatan')->group(function(){
    Route::get('/', 'kegiatanController@index');
    Route::get('/search', 'kegiatanController@search')->name('search.kegiatan');
    Route::get('/add', 'kegiatanController@create')->name('add.kegiatan');
    Route::post('/add', 'kegiatanController@store')->name('submit.kegiatan');
    Route::get('/addprodukkegiatan/{id}', 'kegiatanController@createProdukKegiatan')->name('add.createProdukKegiatan');
    Route::post('/addprodukkegiatan/{id}', 'kegiatanController@storeProdukKegiatan')->name('submit.storeProdukKegiatan');
    Route::get('/edit/{id}', 'kegiatanController@edit')->name('edit.kegiatan');
    Route::put('/edit/{id}', 'kegiatanController@update')->name('update.kegiatan');
    Route::get('/detail/{id}', 'kegiatanController@show')->name('detail.kegiatan');
    Route::delete('/delete/{id}', 'kegiatanController@destroy')->name('delete.kegiatan');
});

Route::prefix('produkKegiatan')->group(function(){
    Route::get('/', 'produkkegiatanController@index');
    Route::get('/search', 'produkkegiatanController@search')->name('search.produkKegiatan');
    Route::get('/add', 'produkkegiatanController@create')->name('add.produkKegiatan');
    Route::post('/add', 'produkkegiatanController@store')->name('submit.produkKegiatan');
    Route::get('/edit/{id}', 'produkkegiatanController@edit')->name('edit.produkKegiatan');
    Route::put('/edit/{id}', 'produkkegiatanController@update')->name('update.produkKegiatan');
    Route::delete('/delete/{id}', 'produkkegiatanController@destroy')->name('delete.produkKegiatan');
});

Route::prefix('order')->group(function(){
    Route::get('/', 'orderController@index');
    Route::post('/', 'orderController@update')->name('edit.order');
    Route::get('/search', 'orderController@search')->name('search.order');
    Route::get('/order_details/{id}', 'orderController@show')->name('order.details');
    Route::put('/status/{id}', 'orderController@update')->name('status.order');
    Route::get('/cetak_pdf/{id}', 'orderController@cetak_pdf')->name('cetak_pdf');
    Route::delete('/delete/{id}', 'orderController@destroy')->name('delete.order');
});

Route::prefix('Pendapatan/pendpPerHari')->group(function(){
    Route::get('/', 'pendapatanController@pendpPerHari');
    Route::get('/search', 'pendapatanController@searchtotalpendpPerHari')->name('search.pendpPerHari');
    Route::post('/add', 'pendapatanController@storependpPerHari')->name('submit.pendpPerHari');
    Route::delete('/delete/{id}', 'pendapatanController@destroypendpPerHari')->name('delete.pendpPerHari');
});

Route::prefix('Pendapatan/pendpPerBulan')->group(function(){
    Route::get('/', 'pendapatanController@pendpPerBulan');
    Route::get('/search', 'pendapatanController@searchtotalpendpPerBulan')->name('search.pendpPerBulan');
    Route::post('/add', 'pendapatanController@storependpPerBulan')->name('submit.pendpPerBulan');
    Route::delete('/delete/{id}', 'pendapatanController@destroypendpPerBulan')->name('delete.pendpPerBulan');
});

Route::prefix('Pendapatan/pendpPerTahun')->group(function(){
    Route::get('/', 'pendapatanController@pendpPerTahun');
    Route::get('/search', 'pendapatanController@searchpendpPerTahun')->name('search.pendpPerTahun');
    Route::post('/add', 'pendapatanController@storependpPerTahun')->name('submit.pendpPerTahun');
    Route::delete('/delete/{id}', 'pendapatanController@destroypendpPerTahun')->name('delete.pendpPerTahun');
});

Route::prefix('pengeluaran')->group(function(){
    Route::get('/', 'PengeluaranController@index');
    Route::get('/search', 'PengeluaranController@search')->name('search.pengeluaran');
    Route::get('/searchtotal', 'PengeluaranController@searchtotalPengeluaran')->name('search.totalpengeluaran');
    Route::get('/add', 'PengeluaranController@create')->name('add.pengeluaran');
    Route::post('/add', 'PengeluaranController@store')->name('submit.pengeluaran');
    Route::get('/edit/{id}', 'PengeluaranController@edit')->name('edit.pengeluaran');
    Route::put('/edit/{id}', 'PengeluaranController@update')->name('update.pengeluaran');
    Route::delete('/delete/{id}', 'PengeluaranController@destroy')->name('delete.pengeluaran');
});

Route::prefix('labaBersih')->group(function(){
    Route::get('/', 'LabaBersihController@index');
    Route::get('/search', 'LabaBersihController@search')->name('search.labaBersih');
    Route::get('/searchlabaBersih', 'LabaBersihController@searchtotalLabaBersih')->name('search.totallabaBersih');
    Route::get('/add', 'LabaBersihController@create')->name('add.labaBersih');
    Route::post('/add', 'LabaBersihController@store')->name('submit.labaBersih');
    Route::get('/edit/{id}', 'LabaBersihController@edit')->name('edit.labaBersih');
    Route::put('/edit/{id}', 'LabaBersihController@update')->name('update.labaBersih');
    Route::delete('/delete/{id}', 'LabaBersihController@destroy')->name('delete.labaBersih');
});

Route::prefix('/')->group(function(){
    Route::get('/', 'ItsFoodController@index');
    Route::get('/search', 'ItsfoodController@search')->name('search');
    Route::get('/checkout/search/jasa', 'ItsfoodController@searchJasa')->name('search.jasa');
    Route::get('/profile/{id}', 'ItsfoodController@profile')->name('profile');
    Route::get('/editprofile/{id}', 'ItsfoodController@edit')->name('editprofile');
    Route::put('/editprofile/{id}', 'ItsfoodController@update')->name('editprofile.submit');
    Route::put('/removephoto/{id}', 'ItsfoodController@remove')->name('removephoto');
    Route::get('/daftar', 'ItsFoodController@showRegisterForm')->name('daftar');
    Route::post('/daftar', 'ItsFoodController@register')->name('daftar.submit');
    Route::get('/masuk', 'ItsFoodController@showLoginForm')->name('masuk');
    Route::post('/masuk', 'ItsFoodController@login')->name('masuk.submit');
    Route::get('/keluar', 'ItsFoodController@logout')->name('keluar');
    Route::get('/menu', 'ItsFoodController@menu')->name('menu');
    Route::post('/menu/rating', 'RatingController@store')->name('submit.rating');
    Route::put('/menu/edit/rating/{id}', 'RatingController@update')->name('update.rating');
    Route::put('/menu/rating/{id}', 'RatingController@destroy')->name('delete.rating');
    Route::post('/menu/like', 'LikeController@store')->name('submit.like');
    Route::put('/menu/like/{id}', 'LikeController@destroy')->name('delete.like');
    Route::post('/menu/review', 'ReviewController@store')->name('submit.review');
    Route::put('/menu/edit/review/{id}', 'ReviewController@update')->name('update.review');
    Route::put('/menu/review/{id}', 'ReviewController@destroy')->name('delete.review');
    Route::get('/checkout', 'ItsFoodController@checkout')->name('checkout');
    Route::post('/checkout', 'ItsfoodController@store')->name('checkout.submit');
    Route::get('/detailproduk/{id}', 'ItsFoodController@show')->name('detailproduk');
    Route::get('/keranjang', 'ItsfoodController@create')->name('keranjang');
    Route::get('/keranjang/{id_produk}', 'ItsfoodController@addKeranjang')->name('addkeranjang');
    Route::get('/tambah/{id_produk}', 'ItsfoodController@tambahKeranjang')->name('tambahSatu');
    Route::get('/kurangi/{id_produk}', 'ItsfoodController@kurangiKeranjang')->name('kurangiSatu');
    Route::get('/hapus/{id_produk}', 'ItsfoodController@destroy')->name('hapusSemua');
});

