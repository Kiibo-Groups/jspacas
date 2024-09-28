<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\User;
use App\Models\Admin;
use App\Models\City;
use App\Models\Settings;
use App\Models\CategoryStore;
use Auth;
use DB;
use Validator;
use Redirect;
class AdminController extends Controller
{
	public $folder = "admin.";

    /*
	|------------------------------------------------------------------
	|Index page for login
	|------------------------------------------------------------------
	*/

	public function index()
	{ 
		return View($this->folder.'index',[
			'form_url' => Asset('admin/login')
		]);
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
		if (auth()->guard('admin')->attempt(['email' => $username, 'password' => $password]))
		{
			return Redirect::route($this->folder . 'dash')->with('message', 'Bienvenido ! Estás conectado ahora.');
		}
		else
		{
			return Redirect::route($this->folder . 'login')->with('error', 'La contraseña y/o Nombre de usuario no coinciden')->withInput();
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
		return View($this->folder.'dashboard.home');
	}

	/*
	|------------------------------------------------------------------
	|Account
	|------------------------------------------------------------------
	*/
	public function account()
	{
		$admin_id = Auth::guard('admin')->id();
		$data = Admin::find($admin_id);
        
		// return response()->json([
		// 	'data' => $data,
		// 	'Auth::user()->id' => Auth::user()->id
		// ]);

        return view($this->folder.'dashboard.account', [ 
            'data' => $data,
            'form_url'	=> Asset('/admin/update_account'),
        ]); 
	}

	public function update_account(Request $request)
	{
		try {
			$admin_id = Auth::guard('admin')->id();
			$lim_data_account = Admin::find($admin_id);
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
				return redirect('/admin/account')->with('message', 'Datos de la cuenta actualizada con éxito ...');
			}else {
				auth()->guard()->logout();
				return Redirect::to('/admin/login')->with('message', 'Tu contraseña ha sido cambiada, por favor vuelve a iniciar sesión');
			}
        } catch (\Exception $th) {
            return redirect('admin/account')->with('error', $th->getMessage());
        }
	}

	public function setting()
	{
		$settings = Settings::where('admin', Auth::guard('admin')->id())->first();
		return view($this->folder.'dashboard.setting', [ 
            'data' => (Settings::where('admin', Auth::guard('admin')->id())->count() > 0) ? $settings : new Settings,
            'form_url'	=> Asset('admin/update_setting'),
        ]); 
	}

	public function update_setting(Request $request)
	{
		try {
			$admin_id = Auth::guard('admin')->id();

			$settings = Settings::firstOrNew();

			// Asignar los nuevos valores
			$settings->admin = $admin_id;
			$settings->ApiKey_google = $request->get('ApiKey_google');
			$settings->stripe_api_id = $request->get('stripe_api_id');
			$settings->stripe_client_id = $request->get('stripe_client_id');

			$settings->save();

            return redirect('/admin/setting')->with('message', 'Configuración actualizada con éxito ...');
        } catch (\Exception $th) {
            return redirect('/admin/setting')->with('error', $th->getMessage());
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

		return view($this->folder.'almacenes.index', [ 
            // 'data' => User::latest()->get(),
			'data' => $res->getAll(0,2),
			'link' => env('admin').'/almacenes/',
        ]); 
	}

	public function createAlmacens()
	{
		$city  = new City;

		return view($this->folder.'almacenes.create', [ 
            'form_url'	=> Asset('admin/almacenes/store'),
			'link' => 'admin',
			'data' => new User,
			'citys'  => $city->getAll(0),
        ]); 
	}

	public function addAlmacens(Request $request)
	{
		$data = new User;

		if($data->validate($request->all(),'add'))
		{
			return redirect::back()->withErrors($data->validate($request->all(),'add'))->withInput();
			exit;
		}

		$data->addNew($request->all(),"add");

		return Redirect::route($this->folder . 'almacenes')->with('message', 'Registro creado con éxito');

	}

	public function editAlmacens($id)
	{		
		$data = User::find($id);
		$city  = new City;

        return view($this->folder.'almacenes.edit', [ 
            'data' => $data,
            'form_url'	=> Asset('admin/almacenes/update/'.$id),
			'link' => 'admin',
			'citys'  => $city->getAll(0),
        ]); 
	}

	public function updateAlmacens(Request $Request,$id)
	{	
		$data = new User;
		
		if($data->validate($Request->all(),$id))
		{
			return redirect::back()->withErrors($data->validate($Request->all(),$id))->withInput();
			exit;
		}

		$data->addNew($Request->all(),$id);
		
		return Redirect::route($this->folder . 'almacenes')->with('message','Registro actualizado con éxito.');
	}

	public function deleteAlmacens($id)
	{
		User::find($id)->delete();

		return Redirect::route($this->folder . 'almacenes')->with('message','Registro eliminado con éxito.');

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

		return redirect(env('admin').'/restaurants')->with('message','Status Updated Successfully.');
	}
}
