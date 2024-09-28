<?php

// Route::prefix('admin')->name('admin.')->group(function () {
 

    
Route::group(['namespace' => 'App\Http\Controllers\Admin','prefix' => 'admin' , 'as' => 'admin.'], function(){
    
    Route::get('/',[App\Http\Controllers\Admin\AdminController::class, 'index'])->name('login');
    Route::get('login',[App\Http\Controllers\Admin\AdminController::class, 'index'])->name('login');
    Route::post('login', [App\Http\Controllers\Admin\AdminController::class, 'login'])->name('login');
    Route::get('logout',[App\Http\Controllers\Auth\LoginController::class, 'logout']);

    Route::group(['middleware' => 'admin'], function() {
        Route::get('/dashboard',[App\Http\Controllers\Admin\AdminController::class, 'home'])->name('dash');
        Route::get('setting',[App\Http\Controllers\Admin\AdminController::class, 'setting'])->name('setting'); 
        Route::post('/update_setting',[App\Http\Controllers\Admin\AdminController::class, 'update_setting'])->name('setting.update'); 
    
        Route::get('account',[App\Http\Controllers\Admin\AdminController::class, 'account'])->name('account'); 
        Route::post('update_account',[App\Http\Controllers\Admin\AdminController::class, 'update_account']);

        /*
        |-----------------------------------------
        |Categorias
        |-----------------------------------------
        */
        Route::get('categories',[App\Http\Controllers\Admin\CategoriesController::class, 'index'])->name('categories'); 
        Route::get('categories/create',[App\Http\Controllers\Admin\CategoriesController::class, 'create'])->name('categories.create'); 
        Route::post('categories/create',[App\Http\Controllers\Admin\CategoriesController::class, 'store']); 
        Route::get('categories/{id}/edit',[App\Http\Controllers\Admin\CategoriesController::class, 'edit'])->name('categories.edit'); 
        Route::patch('categories/update/{id}',[App\Http\Controllers\Admin\CategoriesController::class, 'update'])->name('categories.update'); 
        Route::get('categories/delete/{id}',[App\Http\Controllers\Admin\CategoriesController::class, 'delete'])->name('categories.delete'); 
        Route::get('categories/status/{id}',[App\Http\Controllers\Admin\CategoriesController::class, 'status']);
        

        /*
        |-----------------------------------------
        |Almacenes
        |-----------------------------------------
        */
        Route::get('almacenes',[App\Http\Controllers\Admin\AdminController::class, 'getAlmacens'])->name('almacenes'); 
        Route::get('almacenes/add',[App\Http\Controllers\Admin\AdminController::class, 'createAlmacens'])->name('almacenes.create'); 
        Route::post('almacenes/store',[App\Http\Controllers\Admin\AdminController::class, 'addAlmacens'])->name('almacenes.store'); 
        Route::get('almacenes/{id}/edit',[App\Http\Controllers\Admin\AdminController::class, 'editAlmacens'])->name('almacenes.edit'); 
        Route::patch('almacenes/update/{id}',[App\Http\Controllers\Admin\AdminController::class, 'updateAlmacens'])->name('almacenes.update'); 
        Route::get('almacenes/delete/{id}',[App\Http\Controllers\Admin\AdminController::class, 'deleteAlmacens'])->name('almacenes.delete'); 
        Route::get('almacenes/status/{id}',[App\Http\Controllers\Admin\AdminController::class, 'status']);
        

        /*
        |-----------------------------------------
        |Banners Publicitarios
        |-----------------------------------------
        */
        Route::resource('banners','\App\Http\Controllers\Admin\BannersController');
        Route::get('banners',[App\Http\Controllers\Admin\BannersController::class, 'index'])->name('banners');
        Route::get('banners/create',[App\Http\Controllers\Admin\BannersController::class, 'create'])->name('banners.create');
        Route::get('banners/delete/{id}',[App\Http\Controllers\Admin\BannersController::class, 'delete']);

        
        /*
        |------------------------------
        |Manage City
        |------------------------------
        */
        Route::resource('city','App\Http\Controllers\Admin\CityController');
        Route::get('city',[App\Http\Controllers\Admin\CityController::class, 'index'])->name('city');
        Route::get('city/create',[App\Http\Controllers\Admin\CityController::class, 'create'])->name('city.create');
        Route::get('city/delete/{id}',[App\Http\Controllers\Admin\CityController::class, 'delete']);
        Route::get('city/status/{id}',[App\Http\Controllers\Admin\CityController::class, 'status']);


    });
});
// });

