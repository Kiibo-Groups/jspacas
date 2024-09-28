<?php

namespace App\Http\Controllers\Almacenes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\User;
use App\Models\Admin;
use App\Models\City;
use App\Models\Settings;

use Auth;
use DB;
use Validator;
use Redirect;
class AppUserController extends Controller
{
	public $folder = "almacenes.appUser.";

    /*
	|------------------------------------------------------------------
	|Index page for login
	|------------------------------------------------------------------
	*/

	public function index()
	{ 
		$res = new User; 

		return view($this->folder.'index', [  
			'data' => $res->getAll(0, 1, Auth::user()->id),
			'link' => '/Almacenistas/',
        ]); 
	}

	public function create()
	{
        return view($this->folder.'.create', [ 
            'form_url'	=> Asset('Almacenistas'),
			'link' => '/Almacenistas/',
			'data' => new User
        ]); 
    }
 
    public function store(Request $request)
    {
        $data = new User;

		if($data->validate($request->all(),'add'))
		{
			return redirect::back()->withErrors($data->validate($request->all(),'add'))->withInput();
		}

		$data->addNew($request->all(),"add");
 
        return redirect('Almacenistas')->with('message','Elemento creado con éxito.');
    }
	

	 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id 
     */
    public function edit($id)
    {
        $data = User::find($id);

        return view($this->folder.'.edit', [ 
            'data' => $data,
            'form_url'	=> Asset('Almacenistas/'.$id),
            'link' => 'Almacenistas/', 
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
        $data = new User;
		
		if($data->validate($request->all(),$id))
		{
			return redirect::back()->withErrors($data->validate($request->all(),$id))->withInput();
		}
 
		$data->addNew($request->all(),$id); 
		return Redirect::route('almacenistas')->with('message','Registro actualizado con éxito.');
    }

	public function deleteAppUsers($id)
	{
		User::find($id)->delete();
		return Redirect::route('almacenistas')->with('message','Registro eliminado con éxito.');
	}


	/*
	|---------------------------------------------
	|@Change Status
	|---------------------------------------------
	*/
	public function status($id)
	{
		$res 			= User::find($id);
		
		if(isset($_GET['type']) && $_GET['type'] == "trend")
		{
			$res->trending 	= $res->trending == 0 ? 1 : 0;
		}
		elseif(isset($_GET['type']) && $_GET['type'] == "open")
		{
			$res->open 	= $res->open == 0 ? 1 : 0;
		}else {
			$res->status = $res->status == 0 ? 1 : 0;
		}

		$res->save();

		return redirect('/Almacenistas')->with('message','Status Updated Successfully.');
	}
}
