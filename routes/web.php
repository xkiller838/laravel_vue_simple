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
    return view('welcome');  
});

Route::get('archivo','ArchivosController@getArchivo')->name('archivo');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    
//rutas locations
Route::get('/location/index', 'LocationController@index')->name('location.index');

Route::post('/location/store', 'LocationController@store')->name('location.store');


// rutas album
Route::get('/album/index', 'AlbumController@index')->name('album.index');

Route::post('/album/store', 'AlbumController@store')->name('album.store');


//rutas role
Route::get('/role/index', 'RoleController@index')->name('role.index');

Route::get('/role/show', 'RoleController@show')->name('role.show');

Route::post('/role/store', 'RoleController@store')->name('role.store');

Route::post('/role/delete', 'RoleController@delete')->name('role.destroy');

//rutas member
Route::get('/member/index', 'MemberController@index')->name('member.index');

Route::get('/member/select', 'MemberController@select_rol')->name('member.select');

Route::post('/member/store', 'MemberController@store')->name('member.store');

//rutas de photo
Route::get('/photo/index', 'PhotoController@index')->name('photo.index');

Route::get('/photo/show', 'PhotoController@show')->name('photo.show');

Route::get('/photo/select_member', 'PhotoController@select_member')->name('photo.select_member');

Route::get('/photo/select_location', 'PhotoController@select_location')->name('photo.select_location');

Route::get('/photo/select_album', 'PhotoController@select_album')->name('photo.select_album');

Route::post('/photo/store', 'PhotoController@store')->name('photo.store');

Route::get('/photo/tabla_photos', 'PhotoController@tabla_photos')->name('photo.tabla_photos');


//rutas comentarios
Route::get('/comment/index', 'CommentController@index')->name('comment.index');

Route::get('/comment/img', 'CommentController@show_img')->name('comment.img');

Route::post('/comment/store', 'CommentController@store')->name('comment.store');


// rutas usuario
Route::get('/user/ver', 'UserController@show_user')->name('user.ver');

Route::get('/user/index', 'UserController@index')->name('user.index');

Route::post('/user/activar', 'UserController@activar')->name('user.activa');

Route::post('/user/desactivar', 'UserController@desactivar')->name('user.desactivar');

Route::post('/user/is_admin', 'UserController@is_admin')->name('user.is_admin');

Route::post('/user/no_admin', 'UserController@no_admin')->name('user.no_admin');

Route::get('/user/album_user', 'UserController@album_user')->name('user.album_user');

Route::get('/user/tabla', 'UserController@index_table')->name('user.tabla');

});