<?php

namespace App\Http\Controllers\Almacenes;

// Controller Facturama
use App\Http\Controllers\FacturamaController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

use App\Models\Category;
use App\Models\Almacen;
use App\Models\Brand;
use App\Models\Suppliers;

use Redirect;
use Auth;

class ProductsController extends Controller
{
    public $folder = "almacenes.products";
 
    public function index()
    {
        $prod = new Product;

        return view($this->folder.'.index', [ 
            'data' => $prod->getAll(),
			'link' => 'products/',
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     * 
     */
    public function create()
    {
        return view($this->folder.'.create', [ 
            'form_url'	=> Asset('products'),
			'link' => 'products/',
			'data' => new Product,
            'categorys' => Category::where('status',1)->get(),
            'almacens' => Almacen::where('user_id', Auth::user()->id)->where('status',1)->get(),
            'suppliers' => Suppliers::where('almacen_id', Auth::user()->id)->where('status',1)->get(),
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     * 
     */
    public function store(Request $request)
    {
        $data = new Product;

		if($data->validate($request->all(),'add'))
		{
			return redirect::back()->withErrors($data->validate($request->all(),'add'))->withInput();
		}
        
        $data->addNew($request->all(),"add");
        return Redirect::route('products.index')->with('message', 'Registro creado con éxito');
    
    }

    /**
     * Display the specified resource.
     * 
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id 
     */
    public function edit($id)
    {
        $data = Product::find($id);

        return view($this->folder.'.edit', [ 
            'data' => $data,
            'form_url'	=> Asset('products/'.$id),
            'link' => 'products/',
            'categorys' => Category::where('status',1)->get(),
            'almacens' => Almacen::where('user_id', Auth::user()->id)->where('status',1)->get(),
            'suppliers' => Suppliers::where('almacen_id', Auth::user()->id)->where('status',1)->get(),
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $data = new Product;
		
		if($data->validate($request->all(),$id))
		{
			return redirect::back()->withErrors($data->validate($request->all(),$id))->withInput();
		}
 
        $data->addNew($request->all(),$id); 
        return Redirect::route('products.index')->with('message','Registro actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        unlink("public/upload/products/".$product->image);
        $product->delete();
        return Redirect::route('products.index')->with('message','Registro eliminado con éxito.');

    }

    public function status($id)
	{
		$res = Product::find($id);
		if ($res) {
			$res->status = $res->status == 0 ? 1 : 0;
			$res->save();
			return redirect('products')->with('message','Status del elementos Actualizado');
		}else {
			return redirect('products')->with('error','Elementos No Encontrado');
		}
	}
}
