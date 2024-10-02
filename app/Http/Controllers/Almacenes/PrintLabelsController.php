<?php

namespace App\Http\Controllers\Almacenes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Models\{
    Almacen,
    Product
};


use Auth;
use Redirect;
use Excel;

class PrintLabelsController extends Controller
{
    public $folder = "almacenes.products.print_labels";
   
    
    public function index()
    {
        return view($this->folder.'.index', [ 
            'products' => Product::where('user_id', Auth::user()->id)->where('status',1)->get(),
            'form_url'	=> Asset('products/print_labels'),
			'link' => 'products/print_labels/'
        ]); 
    }
 
    public function store(Request $request)
    {

        $input = $request->all();
        if (isset($input['product_id']) && $input['product_id'] != null) {
            return Excel::download(new ProductsExport, 'print_labels.xlsx');
        }else {
            return redirect()->route('print_labels')->with('error', 'No hay productos seleccionados.');
        }
    }

}