<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryStore;
use Redirect;


class CategoriesController extends Controller
{
    public $folder = "admin.categories";
    
    public function index()
    {
        return view($this->folder.'.index', [ 
            'data' => CategoryStore::latest()->get(),
			'link' =>  Asset(env('admin') . '/categories/') 
        ]); 
    }

    
    public function create()
    {
        return view($this->folder.'.create', [ 
            'form_url'	=> Asset(env('admin') . '/categories/create'),
			'link' => Asset(env('admin') . '/categories/'),
			'data' => new CategoryStore
        ]); 
    }

    
    public function store(Request $request)
    {
        $data = new CategoryStore;

		if($data->validate($request->all(),'add'))
		{
			return redirect::back()->withErrors($data->validate($request->all(),'add'))->withInput();
		}

		$data->addNew($request->all(),"add");
 
        return redirect(env('admin') . '/categories')->with('message','Elemento agregado con éxito.');
    }
 

     
    public function edit($id)
    {
        $data = CategoryStore::find($id);

        return view($this->folder.'.edit', [ 
            'data' => $data,
            'form_url'	=> Asset(env('admin') . '/categories/update/'.$id) ,
            'link' => Asset(env('admin') . '/categories/') ,
        ]); 
    }
 
    public function update(Request $request, $id)
    {
        $data = new CategoryStore;
		
		if($data->validate($request->all(),$id))
		{
			return redirect::back()->withErrors($data->validate($request->all(),$id))->withInput();
		}

		$data->addNew($request->all(),$id);
		
        return redirect(env('admin') . '/categories')->with('message','Elemento editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        CategoryStore::find($id)->delete();

        return redirect(env('admin') . '/categories')->with('message','Elemento eliminado con éxito.');
    }

    public function status($id)
	{
		$res = CategoryStore::find($id);
		if ($res) {
			$res->status = $res->status == 0 ? 1 : 0;
			$res->save();
			return redirect(env('admin') . '/categories')->with('message','Status del elementos Actualizado');
		}else {
			return redirect(env('admin') . '/categories')->with('error','Elementos No Encontrado');
		}
	}
}
