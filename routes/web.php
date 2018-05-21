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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/','FrontController@home');
Route::get('/nosotros','FrontController@nosotros');
Route::get('/portafoliodetalle','FrontController@portafoliodetalle');
Route::get('/portafolio/{id}/{slug}','FrontController@portafoliodetalle');
Route::get('/portafolio','FrontController@portafolio');
Route::get('/comunidad','FrontController@comunidad');
Route::get('/eventos/{id}/{slug}','FrontController@evento');
Route::get('/galeria/{id}/{slug}','FrontController@galeria');
Route::get('/mensaje-datos','FrontController@datos');
Route::get('/getmenuportafolio','FrontController@getmenuportafolio');
Route::post('/sendEmail','FrontController@sendEmail');
Route::post('/sendContacto','FrontController@sendContacto');
Route::post('/mensaje-brochure','FrontController@descargararchivo');

Route::get('/admin', 'AdminController@home');
Route::get('/admin/contacto', 'ContactoController@contacto');
Route::get('/admin/getcontacto','ContactoController@getcontacto');
Route::get('/admin/suscriptores','SuscriptoresController@suscriptores');
Route::get('/admin/getsuscriptores','SuscriptoresController@getsuscriptores');

Route::get('/admin/paginas','PaginasController@paginas');
Route::get('/admin/getpaginas','PaginasController@getpaginas');
Route::get('/admin/paginas/edit/{id}','PaginasController@edit');
// Route::get('/admin/editarpaginas','PaginasController@editarpaginas');
Route::post('/admin/paginas/update/{id}','PaginasController@update');


Route::get('/admin/paginas/{id}/banner','BannersController@banners');
Route::get('/admin/getbanners','BannersController@getbanners');
Route::get('/admin/paginas/{id_pagina}/banner/edit/{id_banner}','BannersController@edit');
Route::post('/admin/banners/update/{id_pagina}/{id_banner}','BannersController@update');
Route::post('/admin/banners/removearchivo/{id_banner}','BannersController@removearchivo');


Route::get('/admin/portafolio','PortafolioController@portafolio');
Route::get('/admin/getportafolio','PortafolioController@getportafolio');
Route::get('/admin/portafolio/{id}/detalleportafolio','DetallePortafolioController@detalleportafolio');
Route::get('/admin/portafolio/edit/{id}','PortafolioController@edit');
Route::post('/admin/portafolio/update/{id}','PortafolioController@update');
Route::get('/admin/detalleportafolio/getbeneficios','DetallePortafolioController@getbeneficios');
Route::get('/admin/detalleportafolio/getslick','DetallePortafolioController@getslick');
Route::get('/admin/detalleportafolio/getmultimedia','DetallePortafolioController@getmultimedia');
Route::get('/admin/detalleportafolio/getequipo','DetallePortafolioController@getequipo');
Route::get('/admin/detalleportafolio/{id_detalleportafolio}/beneficios/edit/{id_beneficio}','DetallePortafolioController@editBeneficio');
Route::get('/admin/detalleportafolio/{id_detalleportafolio}/multimedia/edit/{id_multimedia}','DetallePortafolioController@editMultimedia');
Route::get('/admin/detalleportafolio/{id_detalleportafolio}/slick/edit/{id_slick}','DetallePortafolioController@editslick');
Route::post('/admin/detalleportafolio/createbeneficio','DetallePortafolioController@createbeneficio');
Route::post('/admin/detalleportafolio/createimagen','DetallePortafolioController@createimagen');
Route::post('/admin/detalleportafolio/createmultimedia','DetallePortafolioController@createmultimedia');
Route::post('/admin/detalleportafolio/createequipo','DetallePortafolioController@createequipo');
Route::post('/admin/detalleportafolio/updatebeneficio/{id}','DetallePortafolioController@updatebeneficio');
Route::post('/admin/detalleportafolio/updateequipo/{id}','DetallePortafolioController@updateequipo');
Route::post('/admin/detalleportafolio/updateslick/{id}','DetallePortafolioController@updateslick');
Route::post('/admin/detalleportafolio/updatemultimedia/{id}','DetallePortafolioController@updatemultimedia');
Route::post('/admin/detalleportafolio/deletebeneficio/{id}','DetallePortafolioController@deletebeneficio');
Route::post('/admin/detalleportafolio/deletemultimedia/{id}','DetallePortafolioController@deletemultimedia');
Route::post('/admin/detalleportafolio/deleteslick/{id}','DetallePortafolioController@deleteslick');
Route::post('/admin/detalleportafolio/deleteequipo/{id}','DetallePortafolioController@deleteequipo');
Route::post('/admin/portafolio/delete/{id}','PortafolioController@delete');
Route::post('/admin/portafolio/store','PortafolioController@store');
Route::get('/admin/portafolio/crear','PortafolioController@create');

Route::get('/admin/redessociales','RedesController@redessociales');
Route::get('/admin/getredessociales','RedesController@getredessociales');
Route::post('/admin/redessociales/deleteredsocial/{id}','RedesController@deleteredsocial');
Route::post('/admin/redessociales/updateredsocial/{id}','RedesController@updateredsocial');
Route::post('/admin/redessociales/createredsocial','RedesController@createredsocial');

Route::get('/admin/eventos','EventosController@eventos');
Route::get('/admin/geteventos','EventosController@geteventos');
Route::get('/admin/eventos/crear','EventosController@create');
Route::post('/admin/eventos/store','EventosController@store');
Route::post('/admin/eventos/deleteevento/{id}','EventosController@deleteevento');
Route::get('/admin/eventos/editar/{id}','EventosController@edit');
Route::post('/admin/eventos/update/{id}','EventosController@update');

Route::get('/admin/galeria','GaleriasController@galerias');
Route::get('/admin/getgalerias','GaleriasController@getgalerias');
Route::get('/admin/galeria/crear','GaleriasController@create');
Route::post('/admin/galeria/store','GaleriasController@store');
Route::post('/admin/galeria/deletegaleria/{id}','GaleriasController@deletegaleria');
Route::get('/admin/galeria/editar/{id}','GaleriasController@edit');
Route::post('/admin/galeria/update/{id}','GaleriasController@update');
Route::get('/admin/galeria/{id}/imagenes','GaleriasController@imagenesgaleria');

Route::get('/admin/galeria/{id}/imagenes','GaleriasController@imagenesgaleria');
Route::get('/admin/getimagenesgaleria','GaleriasController@getimagenesgaleria');
Route::post('/admin/galeria/createimagen','GaleriasController@createimagen');
Route::post('/admin/galeria/updateimagen/{id}','GaleriasController@updateimagen');
Route::post('/admin/galeria/deleteimagen/{id}','GaleriasController@deleteimagen');

Route::get('/admin/clientes','ClienteController@clientes');
Route::get('/admin/getclientes','ClienteController@getclientes');
Route::post('/admin/clientes/store','ClienteController@store');
Route::post('/admin/clientes/update/{id}','ClienteController@update');
Route::post('/admin/clientes/delete/{id}','ClienteController@delete');

Route::get('/admin/paginas/galeria/{id}','GaleriaPaginaController@galeria');
Route::get('/admin/getpaginasgaleria/{idpagina}','GaleriaPaginaController@getpaginasgaleria');
Route::post('/admin/paginasgaleria/store','GaleriaPaginaController@store');
Route::post('/admin/paginasgaleria/update/{id}','GaleriaPaginaController@update');
Route::post('/admin/paginasgaleria/delete/{id}','GaleriaPaginaController@delete');

Route::get('/admin/certificaciones','ItemsController@certificaciones');
Route::get('/admin/servicios','ItemsController@servicios');
Route::get('/admin/getitems','ItemsController@getitems');
Route::post('/admin/items/store','ItemsController@store');
Route::post('/admin/items/update/{id}','ItemsController@update');
Route::post('/admin/items/delete/{id}','ItemsController@delete');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('salir',function(){
  Auth::logout();
  return redirect('/');
});

Route::get('/home', 'HomeController@index')->name('home');
