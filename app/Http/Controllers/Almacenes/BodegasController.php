<?php

namespace App\Http\Controllers\Almacenes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Almacen;
use App\Models\User;
use Auth;
use DB;
use Validator;
use Redirect;
class BodegasController extends Controller
{
    public $folder = "almacenes.products.almacens";
    
    public function index()
    {
        return view($this->folder.'.index', [ 
            'data' => Almacen::latest()->get(),
			'link' => 'products/almacens/'
        ]); 
    }

    
    public function create()
    {
        $almacenistas = new User; 

        return view($this->folder.'.create', [ 
            'form_url'	=> Asset('products/almacens'),
			'link' => 'products/almacens/',
			'data' => new Almacen,
            'almacenistas' => $almacenistas->getAll(0, 2, Auth::user()->id),
        ]); 
    }
 
    public function store(Request $request)
    {
        $data = new Almacen;

		if($data->validate($request->all(),'add'))
		{
			return redirect::back()->withErrors($data->validate($request->all(),'add'))->withInput();
			exit;
		}

		$data->addNew($request->all(),"add");
 
        return redirect('products/almacens')->with('message','Elemento creado con éxito.');
    }
 
    
    public function edit($id)
    {
        $data = Almacen::find($id);
        $almacenistas = new User; 
        return view($this->folder.'.edit', [ 
            'data' => $data,
            'form_url'	=> Asset('products/almacens/'.$id),
            'link' => 'products/almacens/',
            'almacenistas' => $almacenistas->getAll(0, 2, Auth::user()->id),
        ]); 
    }
 
    public function update(Request $request, $id)
    {
        $data = new Almacen;
		
		if($data->validate($request->all(),$id))
		{
			return redirect::back()->withErrors($data->validate($request->all(),$id))->withInput();
		}

		$data->addNew($request->all(),$id);
		 
        return redirect('products/almacens')->with('message','Elemento actualizado con éxito.');
    }
 
    public function destroy($id)
    {
        Almacen::find($id)->delete();
 
        return redirect('products/almacens')->with('message','Elemento eliminado con éxito.');
    }

    public function status($id)
	{
		$res = Almacen::find($id);
		if ($res) {
			$res->status = $res->status == 0 ? 1 : 0;
			$res->save();
			return redirect('products/almacens')->with('message','Status del elementos Actualizado');
		}else {
			return redirect('products/almacens')->with('error','Elementos No Encontrado');
		}
	}
}
