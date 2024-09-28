<?php

namespace App\Http\Controllers\Almacenes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Redirect;


class BrandsController extends Controller
{
    public $folder = "almacenes.products.brands";
   
    
    public function index()
    {
        return view($this->folder.'.index', [ 
            'data' => Brand::where('user_id', auth()->user()->id)->latest()->get(),
			'link' => 'products/brands/'
        ]); 
    }
 
    public function create()
    {
        return view($this->folder.'.create', [ 
            'form_url'	=> Asset('products/brands'),
			'link' => 'products/brands/',
			'data' => new Brand
        ]); 
    }

    
    public function store(Request $request)
    {
        $data = new Brand;

		if($data->validate($request->all(),'add'))
		{
			return redirect::back()->withErrors($data->validate($request->all(),'add'))->withInput();
			exit;
		}

		$data->addNew($request->all(),"add");
 
        return redirect('/products/brands')->with('message','Elemento creado con éxito.');
    }

     
    public function edit($id)
    {
        $data = Brand::find($id);

        return view($this->folder.'.edit', [ 
            'data' => $data,
            'form_url'	=> Asset('products/brands/'.$id),
            'link' => 'products/brands/',
        ]); 
    }

    
    public function update(Request $request, $id)
    {
        $data = new Brand;
		
		if($data->validate($request->all(),$id))
		{
			return redirect::back()->withErrors($data->validate($request->all(),$id))->withInput();
		}

		$data->addNew($request->all(),$id);
		 
        return redirect('/products/brands')->with('message','Elemento actualizado con éxito.');
    }

    public function destroy($id)
    {
        Brand::find($id)->delete();
 
        return redirect('/products/brands')->with('message','Elemento eliminado con éxito.');
    }

    public function status($id)
	{
		$res = Brand::find($id);
		if ($res) {
			$res->status = $res->status == 0 ? 1 : 0;
			$res->save();
			return redirect('products/brands')->with('message','Status del elementos Actualizado');
		}else {
			return redirect('products/brands')->with('error','Elementos No Encontrado');
		}
	}
}
