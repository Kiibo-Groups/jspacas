<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Settings,
    City,
    User};

use Auth;
use DB;
use Validator;
use Redirect;

class CityController extends Controller
{
    
	public $folder  = "admin.city.";

    /*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{					
		$res = new City; 
		return View($this->folder.'index',['data' => $res->getAll(),'link' => env('admin').'/city/']);
	}	
	
	/*
	|---------------------------------------
	|@Add new page
	|---------------------------------------
	*/
	public function create()
	{			
		return View($this->folder.'add',[
			'data' => new City,
			'ApiKey'     => Settings::find(1)->ApiKey_google,
			'form_url' => env('admin').'/city',
        ]);
	}
	
	/*
	|---------------------------------------
	|@Save data in DB
	|---------------------------------------
	*/
	public function store(Request $Request)
	{			
		$data = new City;	
		
		if($data->validate($Request->all(),'add'))
		{
			return redirect::back()->withErrors($data->validate($Request->all(),'add'))->withInput();
			exit;
		}

		$data->addNew($Request->all(),"add"); 
		return redirect(env('admin').'/city')->with('message','New Record Added Successfully.');
	}
	
	/*
	|---------------------------------------
	|@Edit Page 
	|---------------------------------------
	*/
	public function edit($id)
	{		
		return View($this->folder.'edit',[
			'data' => City::find($id),
			'ApiKey'     => Settings::find(1)->ApiKey_google,
			'form_url' => env('admin').'/city/'.$id
        ]);
	}
	
	/*
	|---------------------------------------
	|@update data in DB
	|---------------------------------------
	*/
	public function update(Request $Request,$id)
	{	
		$data = new City;
		
		if($data->validate($Request->all(),$id))
		{
			return redirect::back()->withErrors($data->validate($Request->all(),$id))->withInput();
			exit;
		}

		$data->addNew($Request->all(),$id);
		
		return redirect(env('admin').'/city')->with('message','Record Updated Successfully.');
	}
	
	/*
	|---------------------------------------------
	|@Delete Data
	|---------------------------------------------
	*/
	public function delete($id)
	{
		$users = User::where('city_id',$id);

		if ($users->count() > 0) {
			return redirect::back()->with('error','Existen Comercios agregados en esta ciudad...');
		}else {
			City::where('id',$id)->delete();
			return redirect(env('admin').'/city')->with('message','City Deleted Successfully.');
		}

	}

	/*
	|---------------------------------------------
	|@Change Status
	|---------------------------------------------
	*/
	public function status($id)
	{
		$res 			= City::find($id);
		$res->status 	= $res->status == 0 ? 1 : 0;
		$res->save();

		return redirect(env('admin').'/city')->with('message','Status Updated Successfully.');
	}
}
