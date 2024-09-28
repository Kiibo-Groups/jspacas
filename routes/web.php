<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
 

/*
|-----------------------------------------
| Admin Routes
|-----------------------------------------
*/

include("admin.php");
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::namespace('App\Http\Controllers\Almacenes')->group(static function() {

    Route::get('/',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'index']);
    Route::get('login',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'index']);
    Route::post('login', [App\Http\Controllers\Almacenes\AlmacenesController::class, 'login']);

    Route::middleware('auth')->group(static function () {
 
        /*
        |-----------------------------------------
        | Orders
        |-----------------------------------------
        */
        Route::get('/orders', [App\Http\Controllers\Almacenes\OrdersController::class, 'index'])->name('orders.index');
        Route::post('/orders', [App\Http\Controllers\Almacenes\OrdersController::class, 'store'])->name('orders.store');


        /*
        |-----------------------------------------
        |Almacenistas
        |-----------------------------------------
        */
        Route::resource('Almacenistas',"AppUserController"); 
        Route::get('Almacenistas',[App\Http\Controllers\Almacenes\AppUserController::class, 'index'])->name('almacenistas'); 
        Route::get('Almacenistas/delete/{id}',[App\Http\Controllers\Almacenes\AppUserController::class, 'deleteAlmacenistas'])->name('almacenistas.delete'); 
        Route::get('Almacenistas/status/{id}',[App\Http\Controllers\Almacenes\AppUserController::class, 'status']);
        
        
        /*
        |-----------------------------------------
        |Almacenistas
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
        // Route::get('/',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'home'])->name('user.dash');
        Route::get('home',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'home'])->name('home');

        Route::get('/pos',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'pos'])->name('pos');
        Route::get('/payment',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'payment'])->name('payment');

        /*
        |-------------------------------
        |Bills Controllers
        |-------------------------------
        */
        Route::resource('bill','BillController');
        Route::get('bill/delete/{id}',[App\Http\Controllers\Almacenes\BillController::class, 'delete']);
        Route::get('bill/status/{id}',[App\Http\Controllers\Almacenes\BillController::class, 'status']);

        Route::get('bill_products',[App\Http\Controllers\Almacenes\BillController::class, 'get_products']);
        Route::get('add_product',[App\Http\Controllers\Almacenes\BillController::class, 'addProduct']);
        Route::post('addProduct',[App\Http\Controllers\Almacenes\BillController::class, '_addProduct']);
        Route::get('bill_products/delete/{id}',[App\Http\Controllers\Almacenes\BillController::class, 'deleteProduct']);

        Route::get('bill_clients',[App\Http\Controllers\Almacenes\BillController::class , 'getClients']);
        Route::get('add_client',[App\Http\Controllers\Almacenes\BillController::class , 'addClient'])->name('addClient');
        Route::post('addClient',[App\Http\Controllers\Almacenes\BillController::class , '_addClient']);
        Route::get('bill_clients/{id}/edit',[App\Http\Controllers\Almacenes\BillController::class , 'editClient']);
        Route::post('updateClient',[App\Http\Controllers\Almacenes\BillController::class , 'updateClient']);
        Route::get('bill_clients/delete/{id}',[App\Http\Controllers\Almacenes\BillController::class , 'deleteClient']);

        Route::get('generate_bill_client/{id}', [App\Http\Controllers\Almacenes\BillController::class ,'generate_bill_client']);
        Route::get('generate_bill', [App\Http\Controllers\Almacenes\BillController::class ,'generate_bill']);
        Route::post('generate_bill', [App\Http\Controllers\Almacenes\BillController::class ,'_generate_bill']);

        Route::get('download_bill/{id}/{type}', [App\Http\Controllers\Almacenes\BillController::class ,'download_bill']);
        Route::get('send_bill_email/{id}', [App\Http\Controllers\Almacenes\BillController::class, 'send_bill_email']);
        Route::get('cancel_bill/{id}', [App\Http\Controllers\Almacenes\BillController::class, 'cancel_bill']);
        Route::post('cancel_bill', [App\Http\Controllers\Almacenes\BillController::class ,'_cancel_bill']);

        Route::get('logout',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'logout'])->name('user.logout');
     
    });
 

    

    Route::get('getProductId/{id}',[App\Http\Controllers\Almacenes\AlmacenesController::class, 'getProductId']);
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
