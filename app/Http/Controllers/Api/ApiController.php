<?php namespace App\Http\Controllers\api;

use App\Http\Requests;
use App\Http\Controllers\Controller; 

use Illuminate\Http\Request;
use App\Models\{
    User, 
    Banners,
    CategoryStore,
    Product};
use Auth;
use DB;
use Validator;
use Redirect;
use JWTAuth;

class ApiController extends Controller 
{


    public function __construct()
	{
		$this->middleware('authenticate:api')->except(['login','signup']);
	}

    public function welcome()
	{
		return response()->json(['data' => "Bienvenido al API de JSPACAS"]);
	}

    public function getDataInit()
    {
        try {
            $banners = new Banners;
            $user    = new User;
            $category = new CategoryStore;

            return response()->json([
                'urlBack' => asset('upload/'),
                'promos' => $banners::where('status', '1')->orderBy('id','DESC')->get(),
                'stores' => $user::where('status', '1')->where('role',2)->with(['categories','almacenes','marcas','promos'])->orderBy('id','DESC')->get(),
                'categorys' => $category::where('status','1')->orderBy('id','DESC')->get(),
            ]);

        } catch (\Exception $th) {
            return response()->json(['data' => 'error', 'msg' => $th->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|min:6',
            ]);
               
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['data' => [], 'msg' => $errors], 400);
            }
              
            $res = new User;
            $data = $res->login($request);
            
            return response()->json($data, 200);
        } catch (\Exception $th) {
            return response()->json(['data' => [], 'msg' => $th->getMessage()], 500);
        }
    }

    public function chkUser(Request $Request)
	{
		try {
            $res = new User;
            return response()->json($res->chkUser($Request->all()));
        } catch (\Exception $th) {
            return response()->json(['data' => [], 'msg' => $th->getMessage()], 500);
        }
	}

    public function updateInfo($id, Request $Request)
    {
        try {
            $user = new User;
 
           return response()->json($user->UpdateUserApp($Request->all(), $id), 200);
        } catch (\Exception $th) {
            return response()->json(['data' => [], 'msg' => $th->getMessage()], 500);
        }
    }

    public function signup(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => ['required','string','max:255'],
                'email' => ['required','string','email','max:255','unique:users'],  
                'password' => ['required','string','min:6'],
            ]);
               
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['data' => [], 'msg' => $errors], 400);
            }
            
            $res = new User;
            $data = $res->signupAPP($request);
            
            return response()->json($data, 200);
        } catch (\Exception $th) {
            return response()->json(['data' => [], 'msg' => $th->getMessage()], 500);
        }
    }

	public function logout()
    {
        try {
            $res = new User;
            return response()->json($res->logout(), 200);
        } catch (\Exception $th) {
            return response()->json(['data' => [], 'msg' => $th->getMessage()], 500);
        }
    }

   
}