<?php

namespace App\Http\Controllers\Almacenes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\User;
use App\Models\Settings;
use App\Models\{
	Product,
	Category,
	Brand,
	Almacen,
	Suppliers,
	Entradas,
	Salidas
};

use Auth;
use DB;
use Validator;
use Redirect;
class AlmacenesController extends Controller
{
	public $folder = "almacenes.";

	/*
	|------------------------------------------------------------------
	|Index page for login
	|------------------------------------------------------------------
	*/
	public function index()
	{
		if (Auth::guard()->user()) {
			return Redirect::to(env('user') . '/home');
		} else {
			return View($this->folder . 'index', [
				'form_url' => Asset(env('user') . '/login')
			]);
		}

	}


	/*
	   |------------------------------------------------------------------
	   |Homepage, Dashboard
	   |------------------------------------------------------------------
	   */
	public function home()
	{
		$allData = Almacen::where('user_id', Auth::user()->id)
			->where('status', 1)
			->withCount('products')
			->get();

		return view($this->folder . 'dashboard.home', [
			'almacens' => $allData
		]);
	}

	/*
	   |------------------------------------------------------------------
	   |Account Settings
	   |------------------------------------------------------------------
	   */
	public function account()
	{
		$admin_id = Auth::user()->id;
		$data = User::find($admin_id);

		return view($this->folder . 'dashboard.account', [
			'data' => $data,
			'form_url' => Asset('/update_account'),
		]);
	}

	public function update_account(Request $request)
	{
		try {
			$admin_id = Auth::user()->id;
			$lim_data_account = User::find($admin_id);
			$input = $request->all();
			$switchPsw = false;

			if (isset($input['logo']) && $input['logo'] != null) {
				$image = $request->logo;

				// Verificamos si ya tenia una imagen anterior
				if ($lim_data_account->logo != NULL) {
					// Validamos que no sea la imagen por defecto
					if ($lim_data_account->logo != 'user-1.png') {
						@unlink('assets/images/users/' . $lim_data_account->logo);
					}
				}

				$ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
				$imageName = date("Ymdhis");
				$imageName = $imageName . '.' . $ext;
				$image->move('assets/images/users', $imageName);

				$input['logo'] = $imageName;
			}

			if (isset($input['logo_top']) && $input['logo_top'] != null) {
				$imageTop = $request->logo_top;

				// Verificamos si ya tenia una imagen anterior
				if ($lim_data_account->logo_top != NULL) {
					// Validamos que no sea la imagen por defecto
					if ($lim_data_account->logo_top != 'logo-top.png') {
						@unlink('assets/images/users/' . $lim_data_account->logo_top);
					}
				}

				$ext = pathinfo($imageTop->getClientOriginalName(), PATHINFO_EXTENSION);
				$imageName = date("Ymdhis");
				$imageName = $imageName . '.' . $ext;
				$imageTop->move('assets/images/users', $imageName);

				$input['logo_top'] = $imageName;
			}

			if (isset($input['logo_top_sm']) && $input['logo_top_sm'] != null) {
				$imageTopSm = $request->logo_top_sm;

				// Verificamos si ya tenia una imagen anterior
				if ($lim_data_account->logo_top_sm != NULL) {
					// Validamos que no sea la imagen por defecto
					if ($lim_data_account->logo_top_sm != 'logo-sm.png') {
						@unlink('assets/images/users/' . $lim_data_account->logo_top_sm);
					}
				}

				$ext = pathinfo($imageTopSm->getClientOriginalName(), PATHINFO_EXTENSION);
				$imageName = date("Ymdhis");
				$imageName = $imageName . '.' . $ext;
				$imageTopSm->move('assets/images/users', $imageName);

				$input['logo_top_sm'] = $imageName;
			}

			if (isset($input['new_password']) && $input['new_password'] != null) {
				// Cambiamos la contraseña
				$input['shw_password'] = $input['new_password'];
				$input['password'] = bcrypt($input['new_password']);
				$switchPsw = true;
			}

			$lim_data_account->update($input);

			if (!$switchPsw) {
				return redirect('/account')->with('message', 'Datos de la cuenta actualizada con éxito ...');
			} else {
				auth()->guard()->logout();
				return Redirect::route('/logout')->with('message', 'Tu contraseña ha sido cambiada, por favor vuelve a iniciar sesión');
			}
		} catch (\Exception $th) {
			return redirect('/account')->with('error', $th->getMessage());
		}
	}

	/*
	|------------------------------------------------------------------
	| Almacenes
	|------------------------------------------------------------------
	*/
	public function getAlmacens()
	{
		$res = new User; 
		return view($this->folder . 'almacenes.index', [
			// 'data' => User::latest()->get(),
			'data' => $res->getAll(0, 1),
			'link' => '/almacenes/',
		]);
	}

	public function createAlmacens()
	{
		return view($this->folder . 'almacenes.create', [
			'form_url' => Asset('almacenes/store'),
			'link' => '',
			'data' => new User
		]);
	}

	public function addAlmacens(Request $request)
	{
		$data = new User;
		if ($data->validate($request->all(), 'add')) {
			return redirect::back()->withErrors($data->validate($request->all(), 'add'))->withInput();
		}
		$data->addNew($request->all(), "add");

		return Redirect::route('almacenes.index')->with('message', 'Registro creado con éxito');

	}

	public function editAlmacens($id)
	{
		$data = User::find($id);
		return view($this->folder . 'almacenes.edit', [
			'data' => $data,
			'form_url' => Asset('almacenes/update/' . $id),
			'link' => '',
		]);
	}

	public function updateAlmacens(Request $Request, $id)
	{
		$data = new User;
		if ($data->validate($Request->all(), $id)) {
			return redirect::back()->withErrors($data->validate($Request->all(), $id))->withInput();
		}

		$data->addNew($Request->all(), $id);
		return Redirect::route($this->folder . 'almacenes')->with('message', 'Registro actualizado con éxito.');
	}

	public function deleteAlmacens($id)
	{
		User::find($id)->delete();
		return Redirect::route('almacenes.index')->with('message', 'Registro eliminado con éxito.');
	}

	public function getProductId($id)
	{
		try {
			$product = Product::find($id);
			$supplier = Suppliers::find($product->supplier_id);
			$category = Category::find($product->category_id);
			$ImageProduct = asset('upload/products/'.$product->image);

			$htmlProduct = "<tr>";
			$htmlProduct .= "<td><img src='". $ImageProduct ."' style='height: 40px;width: 40px;border-radius: 2003px;'>";
			$htmlProduct .= "<td>" . $product->name . "</td>"; 
			$htmlProduct .= "<td>" . $product->meta . "</td>";
			$htmlProduct .= "<td>" . $supplier->name . "</td>";
			$htmlProduct .= "<td>" . $category->meta . "</td>";
			$htmlProduct .= "<td><span class='badge bg-success'>$" . number_format($product->price,2) . "</span></td>";
			$htmlProduct .= "</tr>";

			return response()->json(['htmlProduct' => $htmlProduct,'product_id' => $id, 'status' => 200]);
		} catch (\Exception $th) {
			return response()->json(['data' => [], 'msg' => $th->getMessage()], 500);
		}
	}

	public function getProductBarCode($codebar)
	{
		try {
			$code = str_split($codebar); // JSP<ID Supplier><ID Product><Serializacion> |JSP380004  JS37001
			$product_id = $code[4];
			$supplier_id = $code[3];

			// Validamos si este codigo no se ha ingreado anterioremente
			$chkCode = Entradas::where('barcode', $codebar)->count();
			if ($chkCode > 0) {
				return response()->json(['data' => 'codeRegister' , 'status' => 200]);
			}

			$product = Product::find($product_id);
			$supplier = Suppliers::find($supplier_id);

			// Asignamos la bodega / Agregamos QTY
			$product->bodega_id = Auth::user()->almacen_id;
			$product->qty = $product->qty+1;
			$product->save();

			// Agregamos la entrada
			$entrada = new Entradas;
            $entrada->products_id = $product_id;
            $entrada->barcode = $codebar;
			$entrada->user_id = Auth::user()->id;
            $entrada->qty = 1;
            $entrada->save();

			$bodega   =   Almacen::find($product->bodega_id)->name;
			$category = Category::find($product->category_id);
			$ImageProduct = asset('upload/products/'.$product->image);

			// Generamos el nuevo campo
			$htmlProduct = "<tr>";
			$htmlProduct .= "<td>" . $product->id . "</td>"; 
			$htmlProduct .= "<td><img src='". $ImageProduct ."' style='height: 40px;width: 40px;border-radius: 2003px;'>";
			$htmlProduct .= "<td>" . $product->name . "</td>";  
			$htmlProduct .= "<td>" . $supplier->name . "</td>"; 
			$htmlProduct .= "<td>" . $bodega . "</td>";
			$htmlProduct .= "<td>" . $category->meta . "</td>";
			$htmlProduct .= "<td><span class='badge bg-success'>$" . number_format($product->price,2) . "</span></td>";
			$htmlProduct .= "<td><span class='badge bg-info'>" . $codebar . "</span></td>";
			$htmlProduct .= "</tr>";


			$dataProd = (object)[
				'id' => $product->id,
				'image' => $ImageProduct,
				'name' => $product->name,
				'supplier' => $supplier->name,
				'bodega' => $bodega,
				'category' => $category->meta,
				'price' => number_format($product->price,2),
				'code' => $codebar
			];

			return response()->json([
				'data' => 'success',
				'htmlProduct' => $htmlProduct,
				'product_id' => $product_id,
				'dataProd' => $dataProd,
			 	'AuthUser' => Auth::user()->id,
				'status' => 200
			]);
		} catch (\Exception $th) {
			return response()->json(['data' => [], 'msg' => $th->getMessage()], 500);
		}
	}

	public function getProductBarCodeSalidas($codebar)
	{
		try {
			$code = str_split($codebar); // JSP<ID Supplier><ID Product><Serializacion> | JS37001
			$product_id = $code[4];
			$supplier_id = $code[3];

			// Validamos si este codigo no se ha ingreado anterioremente
			$chkCode = Salidas::where('barcode', $codebar)->count();
			if ($chkCode > 0) {
				return response()->json(['data' => 'codeRegister' , 'status' => 200]);
			}

			$product = Product::find($product_id);
 
			// Validamos si este codigo no se ha ingreado anterioremente
			$chkCode = Entradas::where('barcode', $codebar)->count();
			if ($chkCode == 0) {
				return response()->json(['data' => 'notEnoughStock' , 'status' => 200]);
			}

			$supplier = Suppliers::find($supplier_id);

			// Asignamos la bodega / Quitamos QTY
			$product->bodega_id = Auth::user()->almacen_id;
			$product->qty = $product->qty-1;
			$product->save();

			// Agregamos la Salida
			$entrada = new Salidas;
            $entrada->products_id = $product_id;
            $entrada->barcode = $codebar;
			$entrada->user_id = Auth::user()->id;
            $entrada->qty = 1;
            $entrada->save();

			$bodega   =   Almacen::find($product->bodega_id)->name;
			$category = Category::find($product->category_id);
			$ImageProduct = asset('upload/products/'.$product->image);

			// Generamos el nuevo campo
			$htmlProduct = "<tr>";
			$htmlProduct .= "<td>" . $product->id . "</td>"; 
			$htmlProduct .= "<td><img src='". $ImageProduct ."' style='height: 40px;width: 40px;border-radius: 2003px;'>";
			$htmlProduct .= "<td>" . $product->name . "</td>";  
			$htmlProduct .= "<td>" . $supplier->name . "</td>"; 
			$htmlProduct .= "<td>" . $bodega . "</td>";
			$htmlProduct .= "<td>" . $category->meta . "</td>";
			$htmlProduct .= "<td><span class='badge bg-success'>$" . number_format($product->price,2) . "</span></td>";
			$htmlProduct .= "<td><span class='badge bg-info'>" . $codebar . "</span></td>";
			$htmlProduct .= "</tr>";


			$dataProd = (object)[
				'id' => $product->id,
				'image' => $ImageProduct,
				'name' => $product->name,
				'supplier' => $supplier->name,
				'bodega' => $bodega,
				'category' => $category->meta,
				'price' => number_format($product->price,2),
				'code' => $codebar
			];

			return response()->json([
				'data' => 'success',
				'htmlProduct' => $htmlProduct,
				'product_id' => $product_id,
				'dataProd' => $dataProd,
			 	'AuthUser' => Auth::user()->id,
				'status' => 200
			]);
		} catch (\Exception $th) {
			return response()->json(['data' => [], 'msg' => $th->getMessage()], 500);
		}
	}

	public function getUserId($id)
	{
		try {
			$user = User::where('id', $id)->first();
			if ($user) {
				return response()->json(['data' => $user, 'status' => 200]);
			} else {
				return response()->json(['data' => [], 'msg' => "Usuario no encontrado"], 500);
			}
		} catch (\Exception $th) {
			return response()->json(['data' => [], 'msg' => $th->getMessage()], 500);
		}
	}
}
