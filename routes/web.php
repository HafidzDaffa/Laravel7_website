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
Route::get('/','UserController@index')->name('user.index');
Route::get('/powerplay/kategori/{kategori}','UserController@kategori')->name('user.kategori');
Route::get('/powerplay/{powerplays}','UserController@show')->name('user.show');
Route::get('/powerplay/search','UserController@search')->name('user.search');
Route::get('/powerplay/detail/{powerplays}','UserController@detail')->name('user.detail');

Route::get('/limcycle','UserController@index1')->name('user.index1');
Route::get('/limcycle/kategori/{kategori1}','UserController@kategori1')->name('user.kategori1');
Route::get('/limcycle/{limcycles}','UserController@show1')->name('user.show1');
Route::get('/limcycle/search','UserController@search1')->name('user.search1');
Route::get('/limcycle/detail/{limcycles}','UserController@detail1')->name('user.detail1');



Route::get('/loginloginpowerplay','AuthController@index')->name('auth.index');
Route::post('/loginloginlogin','AuthController@process')->name('auth.process');
Route::group(['middleware' => ['login_auth']], function () {
    Route::get('/321312323wrqwqrqwds', 'AdminController@index')->name('halaman.index');

    // Powerplay
    Route::get('/dsadadsadsa3232wdsdasad','AdminController@powerplay')->name('powerplay');
    Route::get('/weqwqeqwenj42bi1hb4i/search','AdminController@powerplay_search')->name('powerplay.search');
    Route::get('/rwqrwq2321n34j3n4j/add','AdminController@powerplay_create')->name('powerplay.add');
    Route::post('/dsad2323n4k4k3nk44/add','AdminController@powerplay_store')->name('powerplay.store');
    Route::get('/4431231ejdsndjakds/edit/{powerplays}','AdminController@powerplay_edit')->name('powerplay.edit');
    Route::patch('/ewq43432ndjskndkja/edit/{powerplays}','AdminController@powerplay_update')->name('powerplay.update');
    Route::delete('/434314155sjhdaihsdia/delete/{powerplays}', 'AdminController@powerplay_destroy')->name('powerplay.destroy');

    //kategori
    Route::get('/321312421n43j4n34fdnfd','AdminController@kategori')->name('kategori');
    Route::get('/wdasdaasdn4jk3n43ki/add','AdminController@kategori_create')->name('kategori.add');
    Route::post('/32131dsmn4i3h4ui3h4i/add','AdminController@kategori_store')->name('kategori.store');
    Route::get('/sdadasda3232sn34h3uihi/edit/{kategori}','AdminController@kategori_edit')->name('kategori.edit');
    Route::patch('/dsadasd323132n43ih4ih23/edit/{kategori}','AdminController@kategori_update')->name('kategori.update');
    Route::delete('/dsadadaw22nkjhbhiu3g4387/delete/{kategori}','AdminController@kategori_destroy')->name('kategori.destroy');

    
    //limcycle
    Route::get('/32131231n4ui3h4343743dfd','AdminController@limcycle')->name('limcycle');
    Route::get('/321313243oih434h378fgf/search','AdminController@limcycle_search')->name('limcycle.search');
    Route::get('/l3333232n4545hyy489y54/add','AdminController@limcycle_create')->name('limcycle.add');
    Route::post('/dsadada23232mhgirohgr4954/add','AdminController@limcycle_store')->name('limcycle.store');
    Route::delete('/n43j43h3h43h/delete/{limcycles}', 'AdminController@limcycle_destroy')->name('limcycle.destroy');
    Route::get('/3213123n43b43iug43g/edit/{limcycles}','AdminController@limcycle_edit')->name('limcycle.edit');
    Route::patch('/2323ewewjtirt8r98y4ht4/edit/{limcycles}','AdminController@limcycle_update')->name('limcycle.update');

    //kategori1
    Route::get('/dhsjadaksdasdsudhsuaihdiashdi','AdminController@kategori1')->name('kategori1');
    Route::get('/dsadsadsadwewe2jdsajdjahda/add','AdminController@kategori1_create')->name('kategori1.add');
    Route::post('/23h2j1h3j1sdjhsasjhdsjkahd/add','AdminController@kategori1_store')->name('kategori1.store');
    Route::get('/3j2kj3kl1jjer3yr3hrhi3h/edit/{kategori1}','AdminController@kategori1_edit')->name('kategori1.edit');
    Route::patch('/j2j3lj3hn3jrnjn38343kn/edit/{kategori1}','AdminController@kategori1_update')->name('kategori1.update');
    Route::delete('/hfdjhfdhfdk4n3j43hn437bnbfd/delete/{kategori1}','AdminController@kategori1_destroy')->name('kategori1.destroy');

});

Route::get('logout','AuthController@logout')->name('auth.logout');

