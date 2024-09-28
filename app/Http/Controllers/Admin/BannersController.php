<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\User;
use App\Models\Admin;
use App\Models\Banners;

use Auth;
use DB;
use Validator;
use Redirect;
class BannersController extends Controller
{
    public $folder = "admin.banners.";
 
    public function index()
    {
        return View($this->folder.'index',[
            'data' => Banners::OrderBy('id','DESC')->get(),
            'link' => Asset(env('admin') . '/banners/')
		]);
    }

  
    public function create()
    {
        return View($this->folder.'add',[
			'data' 		=> new Banners,
            'stores'     => User::where('role',2)->OrderBy('id','DESC')->get(),
			'form_url' 	=> Asset(env('admin') . '/banners/')
		]);
    }

    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $lims_data_banners = new Banners;

            if (isset($input['status'])) {
                $input['status'] = 1;
            }else {
                $input['status'] = 0;
            }


            if(isset($input['img']))
            {
                $filename   = time().rand(111,699).'.' .$input['img']->getClientOriginalExtension(); 
                $input['img']->move("upload/banner/", $filename);   
                $input['img'] = $filename;   
            }

            $lims_data_banners->create($input);

            return redirect(env('admin').'/banners')->with('message','Elemento agregado con éxito.');

        } catch (\Exception $th) {
            return redirect(env('admin').'/banners')->with('error', $th->getMessage());
        }
        
    }
 
 
    public function edit($id)
    {
        return View($this->folder.'edit',[
			'data' 		=> Banners::find($id),
            'stores'     => User::where('role',2)->OrderBy('id','DESC')->get(),
			'form_url' 	=>  Asset(env('admin') . '/banners/'.$id)
		]);
    }

 
    public function update(Request $request, $id)
    {
        try {
            $input = $request->all();
            $lims_data_banners = Banners::find($id);
 
            if (isset($input['status'])) {
                $input['status'] = 1;
            }else {
                $input['status'] = 0;
            }

            if(isset($input['img']))
            {
                // Eliminamos la imagen anterior
                unlink("upload/banner/".$lims_data_banners->img);

                $filename   = time().rand(111,699).'.' .$input['img']->getClientOriginalExtension(); 
                $input['img']->move("upload/banner/", $filename);   
                $input['img'] = $filename;   
            }

        

            $lims_data_banners->update($input);

            return redirect(env('admin').'/banners')->with('message','Elemento actualizado con éxito.');

        } catch (\Exception $th) {
            return redirect(env('admin').'/banners')->with('error', $th->getMessage());
        }
    }

     public function delete($id)
    {
        try {
            $res = Banners::find($id);
            unlink("upload/banner/".$res->img);
            $res->delete();
            return redirect(env('admin').'/banners')->with('message','Elemento eliminado con éxito.');
        } catch (\Exception $th) {
            return redirect(env('admin').'/banners')->with('error', $th->getMessage());
        }
    }
}
