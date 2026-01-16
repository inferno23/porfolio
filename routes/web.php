<?php

use Illuminate\Support\Facades\Route;

//Home Namespace
use App\Http\Controllers\Home\HomeController;

//Auth Namespace
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Auth\ForgotPasswordController;

//Admin Namespace
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LayoutController;

use App\Http\Controllers\Admin\InstituteController;

use App\Http\Controllers\Admin\PersonaController;

use App\Http\Controllers\Admin\LocalidadController;
use App\Http\Controllers\Admin\ProvinciaController;
use App\Http\Controllers\Admin\TelegramaController;

use App\Http\Controllers\Admin\OrganizacionController;


use App\Http\Controllers\Admin\RegistroController;
use App\Http\Controllers\Admin\UserController;

use App\Exports\TelegramaExport;

use App\Exports\UsersExport;

use Maatwebsite\Excel\Facades\Excel;

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

Route::get('/excel', function () {
    return Excel::download(new TelegramaExport, 'telegramas.xlsx');
});


Route::namespace('Home')->group(function(){
	Route::get('/',[HomeController::class,'index']);
	Route::get('/',[HomeController::class,'index'])->name('home');
	Route::get('/novedades',[HomeController::class,'novedades'])->name('novedades');

	Route::get('/cursos',[HomeController::class,'cursos'])->name('cursos');
	Route::get('/institucional',[HomeController::class,'institucional'])->name('institucional');
	Route::get('/objetivos',[HomeController::class,'objetivos'])->name('objetivos');
	Route::get('/mision',[HomeController::class,'mision'])->name('mision');

});

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');



Route::namespace('Auth')->group(function(){

	Route::view('/login','auth.login')->name('login')->middleware('guest');
	Route::post('/login',[LoginController::class,'authenticate'])->name('login.post');


	Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
	Route::post('/logout',function(){
		return redirect('/login')->with(Auth::logout());
	});

});

Route::middleware(['auth'])->namespace('Admin')->group(function(){
	Route::get('/admin',[AdminController::class,'index'])->name('admin');
	Route::get('/admin/profile',[AdminController::class,'profile'])->name('admin.profile');
	Route::patch('/admin/profile/update/{id}',[AdminController::class,'update'])->name('admin.profile.update');

	//Layout
	Route::get('admin/layout/header',[LayoutController::class,'header'])->name('layout.header');
	Route::post('admin/layout/setheader',[LayoutController::class,'setHeader'])->name('layout.setheader');
	Route::get('admin/layout/about',[LayoutController::class,'about'])->name('layout.about');
	Route::post('admin/layout/setabout',[LayoutController::class,'setAbout'])->name('layout.setabout');
	Route::get('admin/layout/footer',[LayoutController::class,'footer'])->name('layout.footer');
	Route::post('admin/layout/setfooter',[LayoutController::class,'setFooter'])->name('layout.setfooter');


   //Route::get('localidad/getLocalidadxprovincia/{id}','LocalidadController@getLocalidadxprovincia')->name('getLocalidadxprovincia');
    Route::get('admin/localidad/getLocalidadxprovincia/{id}',[LocalidadController::class,'getLocalidadxprovincia'])->name('admin.localidad.getLocalidadxprovincia');
	Route::get('admin/provincia/getProvinciaxpais/{id}',[ProvinciaController::class,'getProvinciaxpais'])->name('admin.provincia.getProvinciaxpais');
	
	Route::get('admin/user/export',[UserController::class,'export'])->name('user.export');
	Route::get('admin/telegrama/export',[TelegramaController::class,'export'])->name('telegrama.export');

	Route::post('admin/telegrama/storeLocalidad',[TelegramaController::class,'storeLocalidad'])->name('telegrama.storeLocalidad');

	Route::post('admin/telegrama/storeProvincia',[TelegramaController::class,'storeProvincia'])->name('telegrama.storeProvincia');
	Route::post('admin/telegrama/storeSenador',[TelegramaController::class,'storeSenador'])->name('telegrama.storeSenador');
	Route::post('admin/telegrama/storePresidente',[TelegramaController::class,'storePresidente'])->name('telegrama.storePresidente');
	Route::post('admin/telegrama/storeConsejal',[TelegramaController::class,'storeConsejal'])->name('telegrama.storeConsejal');

	Route::post('admin/telegrama/storeDiputadoProv',[TelegramaController::class,'storeDiputadoProv'])->name('telegrama.storeDiputadoProv');

	Route::post('admin/telegrama/storeMunicipal',[TelegramaController::class,'storeMunicipal'])->name('telegrama.storeMunicipal');

	

	Route::get('admin/registro/export',[RegistroController::class,'export'])->name('registro.export');



	Route::get('/charts', 'ChartController@index')->name('charts');

	Route::get('admin/charts/getMesasxLocalidad/{id}',[ChartController::class,'getMesasxLocalidad'])->name('charts.getMesasxLocalidad');

	
	Route::get('admin/chart/getMesasxLocalidad/{id}', 'ChartController@getMesasxLocalidad')->name('chart.getMesasxLocalidad');
	Route::get('admin/chart/getMesasxProvincia/{id}', 'ChartController@getMesasxProvincia')->name('chart.getMesasxProvincia');

	
	Route::get('admin/chart/indexPresidente', 'ChartController@indexPresidente')->name('chart.indexPresidente');

	Route::get('admin/chart/indexGobernador', 'ChartController@indexGobernador')->name('chart.indexGobernador');

	
	Route::get('admin/chart/indexIntendente', 'ChartController@indexIntendente')->name('chart.indexIntendente');

	Route::get('admin/chart/indexConsejal', 'ChartController@indexConsejal')->name('chart.indexConsejal');
	
	Route::get('admin/chart/indexComunal', 'ChartController@indexComunal')->name('chart.indexComunal');

	Route::get('admin/chart/indexDiputadoProvincial', 'ChartController@indexDiputadoProvincial')->name('chart.indexDiputadoProvincial');


	Route::get('admin/logout',function(){
		return redirect('/login')->with(Auth::logout());
	});

	//Crud Resource

	Route::resource('/admin/charts','ChartController');
	Route::resource('/admin/user','UserController');
	Route::resource('/admin/about','AboutController');
	Route::resource('/admin/header','HeaderController');
	Route::resource('/admin/footer','FooterController');
	Route::resource('/admin/portfolio','PortfolioController');
	Route::resource('/admin/skill','SkillController');
	Route::resource('/admin/curso','CursoController');
	Route::resource('/admin/persona','PersonaController');
	Route::resource('/admin/provincia','ProvinciaController');
	Route::resource('/admin/pais','PaisController');
	Route::resource('/admin/localidad','LocalidadController');
	Route::resource('/admin/organizacion','OrganizacionController');
	Route::resource('/admin/registro','RegistroController');

	Route::resource('/admin/obra','ObraController');
	Route::resource('/admin/novedad','NovedadController');
	//Route::resource('/admin/candidato','CandidatoController');
	




});
