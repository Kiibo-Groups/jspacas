<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
 
 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::namespace('App\Http\Controllers\Almacenes')->group(static function() {


    Route::middleware('auth')->group(static function () {
        
        /*
        |-----------------------------------------
        | Home
        |-----------------------------------------
        */
        Route::get('/',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'index']); 
 
        /*
        |-----------------------------------------
        | Orders
        |-----------------------------------------
        */
        Route::get('/orders', [App\Http\Controllers\Almacenes\OrdersController::class, 'index'])->name('orders.index');
        Route::post('/orders', [App\Http\Controllers\Almacenes\OrdersController::class, 'store'])->name('orders.store');


        /*
        |-----------------------------------------
        |Almacenes
        |-----------------------------------------
        */
        Route::get('almacenes',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'getAlmacens'])->name('almacenes.index'); 
        Route::get('almacenes/add',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'createAlmacens'])->name('almacenes.create'); 
        Route::post('almacenes/store',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'addAlmacens'])->name('almacenes.store'); 
        Route::get('almacenes/{id}/edit',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'editAlmacens'])->name('almacenes.edit'); 
        Route::patch('almacenes/update/{id}',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'updateAlmacens'])->name('almacenes.update'); 
        Route::get('almacenes/delete/{id}',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'deleteAlmacens'])->name('almacenes.delete'); 
        Route::get('almacenes/status/{id}',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'status']);
        

        /*
        |-----------------------------------------
        |Almacenistas
        |-----------------------------------------
        */
        Route::resource('Almacenistas',"AppUserController"); 
        Route::get('Almacenistas',[App\Http\Controllers\Almacenes\AppUserController::class, 'index'])->name('almacenistas'); 
        Route::get('Almacenistas/delete/{id}',[App\Http\Controllers\Almacenes\AppUserController::class, 'deleteAppUsers'])->name('almacenistas.delete'); 
        Route::get('Almacenistas/status/{id}',[App\Http\Controllers\Almacenes\AppUserController::class, 'status']);
        
        
        /*
        |-----------------------------------------
        |Proveedores
        |-----------------------------------------
        */
        Route::resource('suppliers',"SuppliersController"); 
        Route::get('suppliers',[App\Http\Controllers\Almacenes\SuppliersController::class, 'index'])->name('suppliers'); 
        Route::get('suppliers/delete/{id}',[App\Http\Controllers\Almacenes\SuppliersController::class, 'deleteSuppliers'])->name('suppliers.delete'); 
        Route::get('suppliers/status/{id}',[App\Http\Controllers\Almacenes\SuppliersController::class, 'status']);
        
        /*
        |-----------------------------------------
        |Productos Categories
        |-----------------------------------------
        */
        Route::resource('products/categories', App\Http\Controllers\Almacenes\CategoriesController::class);
        Route::get('products/categories/delete/{id}',[App\Http\Controllers\Almacenes\CategoriesController::class, 'destroy'])->name('products.categories.delete');
        Route::get('products/categories/status/{id}',[App\Http\Controllers\Almacenes\CategoriesController::class, 'status']);

        /*
        |-----------------------------------------
        |Productos Brands
        |-----------------------------------------
        */
        Route::resource('products/brands', App\Http\Controllers\Almacenes\BrandsController::class);
        Route::get('products/brands/delete/{id}',[App\Http\Controllers\Almacenes\BrandsController::class, 'destroy'])->name('brands.delete'); 
        Route::get('products/brands/status/{id}',[App\Http\Controllers\Almacenes\BrandsController::class, 'status']);

        /*
        |-----------------------------------------
        |Productos Almacens
        |-----------------------------------------
        */
        Route::resource('products/almacens', App\Http\Controllers\Almacenes\BodegasController::class);
        Route::get('products/almacens/delete/{id}',[App\Http\Controllers\Almacenes\BodegasController::class, 'destroy'])->name('almacens.delete'); 
        Route::get('products/almacens/status/{id}',[App\Http\Controllers\Almacenes\BodegasController::class, 'status']);
      
        /*
        |-----------------------------------------
        |Productos Etiquetas
        |-----------------------------------------
        */
        Route::resource('products/print_labels', App\Http\Controllers\Almacenes\PrintLabelsController::class);
        Route::get('products/print_labels', [App\Http\Controllers\Almacenes\PrintLabelsController::class, 'index'])->name('print_labels');
      

        /*
        |-----------------------------------------
        |Productos
        |-----------------------------------------
        */
        Route::resource('products', App\Http\Controllers\Almacenes\ProductsController::class);
        Route::get('products/delete/{id}',[App\Http\Controllers\Almacenes\ProductsController::class, 'destroy'])->name('products.delete'); 
        Route::get('products/status/{id}',[App\Http\Controllers\Almacenes\ProductsController::class, 'status']);
      
        /*
        |-----------------------------------------
        |Dashboard and Account Setting & Logout
        |-----------------------------------------
        */
        Route::get('home',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'home'])->name('home');


     
        /*
        |-------------------------------
        |Bills Controllers
        |-------------------------------
        */
        Route::get('account',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'account'])->name('account'); 
        Route::post('update_account',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'update_account']);
 

        
        Route::get('entradas', [App\Http\Controllers\Almacenes\AppUserController::class, 'entradas'])->name('entradas');
        Route::get('salidas', [App\Http\Controllers\Almacenes\AppUserController::class, 'salidas'])->name('salidas');
        Route::get('pendientes', [App\Http\Controllers\Almacenes\AppUserController::class, 'pendientes'])->name('pendientes');
    });
 

    

    Route::get('getProductId/{id}',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'getProductId']);
    Route::get('getProductBarCode/{code}',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'getProductBarCode']);
    Route::get('getProductBarCodeSalidas/{code}',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'getProductBarCodeSalidas']);
    Route::get('getUserId/{id}',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'getUserId']);
});


/*
|--------------------------------------------------------------------------
| Control de fallos
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return view('errors.404');
});
