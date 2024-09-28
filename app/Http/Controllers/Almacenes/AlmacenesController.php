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
	Almacen
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
			
			return Redirect::to(env('user').'/home');
		}else {
			return View($this->folder.'index',[
				'form_url' => Asset(env('user').'/login')
			]);
		}
		
	}

	/*
	|------------------------------------------------------------------
	|Login attempt,check username & password
	|------------------------------------------------------------------
	*/
	public function login(Request $request)
	{
		$username = $request->input('email');
		$password = $request->input('password');
		if (auth()->guard()->attempt(['email' => $username, 'password' => $password,'status' => 1]))
		{
			return Redirect::to(env('user').'/home')->with('message', 'Bienvenido(a) de nuevo a tu panel de control...');
		}
		else
		{
			
			// Validamos si los accesos son de Administrador
			if (Auth::guard('admin')->attempt(['email' => $username, 'password' => $password]))
			{
				return Redirect::route('admin.dash')->with('message', 'Bienvenido ! Estás conectado ahora.');
			}
			else
			{
				return Redirect::to(env('user').'/login')->with('error', 'Correo y/o Contraseña no coinciden, Por favor verifica nuevamente.')->withInput();
			}
			
		}
	}

	/*
	|------------------------------------------------------------------
	|Logout
	|------------------------------------------------------------------
	*/
	public function logout()
	{
		if (Auth::guard('admin')->check())
		{
			Auth::guard('admin')->logout();
		}else {
			auth()->guard()->logout();
		}
		

		return Redirect::to('/')->with('message', 'Ha cerrado sesión con éxito !');
	}

	/*
	|------------------------------------------------------------------
	|Homepage, Dashboard
	|------------------------------------------------------------------
	*/
	public function home()
	{ 
		$allData = Almacen::where('user_id', Auth::user()->id)
		->where('status',1)
		->withCount('products') 
		->get();

		return view($this->folder.'dashboard.home', [ 
			'almacens' => $allData
        ]); 
	}

	/*
	|------------------------------------------------------------------
	|Menu
	|------------------------------------------------------------------
	*/
	public function pos()
	{ 
        $prod = new Product;
		// return response()->json([
		// 	'data' => $prod->getAll()
		// ]);
        return view($this->folder.'pos.index', [
			'categories' => Category::get(),
			'brands' => Brand::get(),
            'data' => $prod->getAll() ?? []
        ]); 
	}

	/*
	|------------------------------------------------------------------
	| Payment
	|------------------------------------------------------------------
	*/
	public function payment()
	{
		return View($this->folder.'payment.index');
	}

	/*
	|------------------------------------------------------------------
	|Account Settings
	|------------------------------------------------------------------
	*/
	public function account()
	{
		$data = User::find(User::find(Auth::user()->id))->first();  
        
		// return response()->json([
		// 	'data' => $data,
		// 	'Auth::user()->id' => Auth::user()->id
		// ]);

        return view($this->folder.'dashboard.account', [ 
            'data' => $data,
            'form_url'	=> Asset('/update_account'),
        ]); 
	}

	public function update_account(Request $request)
	{
		try {
			$lim_data_account = User::find(Auth::user()->id);
			$input = $request->all();
			$switchPsw = false;
			// return response()->json([
			// 	'user' => $lim_data_account,
			// 	'data' => $input
			// ]);


			if (isset($input['logo']) && $input['logo'] != null) {
				$image = $request->logo;

				// Verificamos si ya tenia una imagen anterior
				if ($lim_data_account->logo != NULL) { 
					// Validamos que no sea la imagen por defecto
				    if ($lim_data_account->logo != 'user-1.png') {
						@unlink('assets/images/users/'.$lim_data_account->logo);
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
						@unlink('assets/images/users/'.$lim_data_account->logo_top);
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
						@unlink('assets/images/users/'.$lim_data_account->logo_top_sm);
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
			}else {
				auth()->guard()->logout();
				return Redirect::to('/')->with('message', 'Tu contraseña ha sido cambiada, por favor vuelve a iniciar sesión');
			}
        } catch (\Exception $th) {
            return redirect('account')->with('error', $th->getMessage());
        }
	}
 
	public function getProductId($id)
    {
        try {
            $product = Product::find($id);
            return response()->json(['data' => $product,'status' => 200]);
        } catch (\Exception $th) {
            return response()->json(['data' => [], 'msg' => $th->getMessage()], 500);
        }
    }

	public function getUserId($id)
	{
		try {
            $user = User::where('id',$id)->first();
			if ($user) {
				return response()->json(['data' => $user,'status' => 200]);
			}else {
				return response()->json(['data' => [],'msg' => "Usuario no encontrado"], 500);
			}
        } catch (\Exception $th) {
            return response()->json(['data' => [],'msg' => $th->getMessage()], 500);
        }
	}
}
