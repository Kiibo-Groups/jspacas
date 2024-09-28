<?php

namespace App\Http\Controllers\Almacenes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Redirect;


class CategoriesController extends Controller
{
    public $folder = "almacenes.products.categories";
    
    public function index()
    {
        return view($this->folder.'.index', [ 
            'data' => Category::where('user_id', auth()->user()->id)->latest()->get(),
			'link' => 'products/categories/'
        ]); 
    }

    
    public function create()
    {
        return view($this->folder.'.create', [ 
            'form_url'	=> Asset('products/categories'),
			'link' => 'products/categories/',
			'data' => new Category
        ]); 
    }

    
    public function store(Request $request)
    {
        $data = new Category;

		if($data->validate($request->all(),'add'))
		{
			return redirect::back()->withErrors($data->validate($request->all(),'add'))->withInput();
		}

		$data->addNew($request->all(),"add");
 
        return redirect('products/categories')->with('message','Elemento agregado con éxito.');
    }
 

     
    public function edit($id)
    {
        $data = Category::find($id);

        return view($this->folder.'.edit', [ 
            'data' => $data,
            'form_url'	=> Asset('products/categories/'.$id),
            'link' => 'products/categories/',
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = new Category;
		
		if($data->validate($request->all(),$id))
		{
			return redirect::back()->withErrors($data->validate($request->all(),$id))->withInput();
		}

		$data->addNew($request->all(),$id);
		
        return redirect('products/categories')->with('message','Elemento editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();

        return redirect('products/categories')->with('message','Elemento eliminado con éxito.');
    }

    public function status($id)
	{
		$res = Category::find($id);
		if ($res) {
			$res->status = $res->status == 0 ? 1 : 0;
			$res->save();
			return redirect('products/categories')->with('message','Status del elementos Actualizado');
		}else {
			return redirect('products/categories')->with('error','Elementos No Encontrado');
		}
	}
}
