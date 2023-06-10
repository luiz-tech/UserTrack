<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\userController;
use App\Http\Controllers\productController;

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

    return view('login');
})->name('home');


//rota de tratamento do login
Route::post('/login',[userController::class,'auth'])->name('login');

Route::get('/logout',[userController::class,'logout'])->name('logout');


Route::middleware('auth')->group(function () {

    // Rotas protegidas pelo Auth
    Route::get('/dashboard', function(){ return view('dashboard'); })->name('dashboard');

    Route::get('/profile',[userController::class,'load_profile'])->name('profile');

    Route::post('/storeprofile',[userController::class,'storeprofile'])->name('storeprofile');

    Route::get('/userlist',[userController::class,'load_all_users'])->name('userlist');

    Route::get('/newuser',function(){

        return view('newuser');
    })->name('newuser');

    Route::post('/storenewuser',[userController::class,'storeNewUser'])->name('storenewuser');

    Route::get('/editnewuser',[userController::class,'edit_new_user'])->name('edituser');

    Route::post('/updateuser',[userController::class,'update_user'])->name('updateuser');

    Route::get('/deleteuser',[userController::class,'delete_new_user'])->name('deleteuser');
    
    //-------------- Product Routes ----------------- //

    Route::get('/productlist',[productController::class,'load_products_user'])->name('productlist');

    Route::get('/deleteproduct',[productController::class,'delete_new_product'])->name('deleteproduct');

    Route::get('/newproduct',function()
    {
        return view('newproduct');
    })->name('newproduct');

    Route::post('/storenewproduct',[productController::class,'store_new_product'])->name('storenewproduct');

    Route::get('/editnewproduct',[productController::class,'edit_new_produtct'])->name('editnewproduct');

    Route::post('/updatedproduct',[productController::class,'updated_product'])->name('updatedproduct');



    



    



        

});