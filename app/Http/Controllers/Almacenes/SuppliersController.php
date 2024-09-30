<?php

namespace App\Http\Controllers\Almacenes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Suppliers;
use App\Models\Admin;

use Auth;
use DB;
use Validator;
use Redirect;
class SuppliersController extends Controller
{
	public $folder = "almacenes.suppliers.";

    /*
	|------------------------------------------------------------------
	|Index page for login
	|------------------------------------------------------------------
	*/

	public function index()
	{ 
		$res = new Suppliers; 

		return view($this->folder.'index', [  
			'data' => Suppliers::where('almacen_id', Auth::user()->id)->get(),
			'link' => '/suppliers/',
        ]); 
	}

	public function create()
	{
        return view($this->folder.'.create', [ 
            'form_url'	=> Asset('suppliers'),
			'link' => '/suppliers/',
			'data' => new Suppliers
        ]); 
    }
 
    public function store(Request $request)
    {
        $data = new Suppliers;

		if($data->validate($request->all(),'add'))
		{
			return redirect::back()->withErrors($data->validate($request->all(),'add'))->withInput();
		}

		$data->addNew($request->all(),"add");
 
        return redirect('suppliers')->with('message','Elemento creado con éxito.');
    }
	

	 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id 
     */
    public function edit($id)
    {
        $data = Suppliers::find($id);

        return view($this->folder.'.edit', [ 
            'data' => $data,
            'form_url'	=> Asset('suppliers/'.$id),
            'link' => 'suppliers/', 
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
        $data = new Suppliers;
		
		if($data->validate($request->all(),$id))
		{
			return redirect::back()->withErrors($data->validate($request->all(),$id))->withInput();
		}
 
		$data->addNew($request->all(),$id); 
		return Redirect::route('suppliers')->with('message','Registro actualizado con éxito.');
    }

	public function deleteSuppliers($id)
	{
		$suppliers = Suppliers::find($id);
		unlink("public/upload/suppliers/logo/".$suppliers->logo);
		$suppliers->delete();

		return Redirect::route('suppliers')->with('message','Registro eliminado con éxito.');
	}


	/*
	|---------------------------------------------
	|@Change Status
	|---------------------------------------------
	*/
	public function status($id)
	{
		$res 			= Suppliers::find($id);
		
        if(isset($_GET['type']) && $_GET['type'] == "open")
		{
			$res->open 	= $res->open == 0 ? 1 : 0;
		}else {
			$res->status = $res->status == 0 ? 1 : 0;
		}

		$res->save();

		return redirect('/suppliers')->with('message','Status Updated Successfully.');
	}
}