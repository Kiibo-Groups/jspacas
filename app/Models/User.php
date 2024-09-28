<?php

namespace App\Models;

// Controller Facturama
use App\Http\Controllers\FacturamaController;
use JWTAuth;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Validator;

use QrCode;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [  
        'role',
        'almacen_id',
        'logo',
        'logo_top',
        'logo_top_sm',
        'name',
        'email',
        'city_id',
        'whatsapp_1',
        'whatsapp_2',
        'rfc',
        'FiscalRegime',
        'zip',
        'perm',
        'username',
        'email_verified_at',
        'password',
        'shw_password',
        'status',
        'categorystore_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'shw_password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rules($type)
    {
        if ($type === "add") {
            return [

                'name' => 'required|unique:users',
                'username' => 'required|unique:users',
                'email' => 'required|unique:users',
                'password' => 'required|min:6',

            ];
        } else {
            return [

                'name' => 'required|unique:users,name,' . $type,
                'username' => 'required|unique:users,name,' . $type,
                'email' => 'required|unique:users,email,' . $type,
            ];
        }
    }

    public function validate($data, $type)
    {

        $validator = Validator::make($data, $this->rules($type));
        if ($validator->fails()) {
            return $validator;
        }
    }

    public function products()
    {
        return $this->hasMany(Product::class)->whereStatus(1);
    }

    public function categories()
    {
        return $this->hasMany(Category::class)->whereStatus(1);
    }

    public function almacenes()
    {
        return $this->hasMany(Almacen::class)->whereStatus(1);
    }

    public function marcas()
    {
        return $this->hasMany(Brand::class)->whereStatus(1);
    }

    public function promos()
    {
        return $this->hasMany(Banners::class)->whereStatus(1);
    }

    /*
    |--------------------------------------
    |Login To
    |--------------------------------------
    */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function login($request)
    {
        $credentials = $request->only('email', 'password');

        $AppUser = User::where('email', $credentials['email'])->where('role', 1)->first();

        if (!$AppUser || !Hash::check($credentials['password'], $AppUser->password)) {
            return ['data' => [], 'msg' => 'Error! Datos de acceso incorrectos'];
        }

        $token = JWTAuth::fromUser($AppUser);

        return ['data' => $AppUser, 'msg' => 'OK', 'token' => $token, 'type' => 'bearer'];
    }

    public function chkUser($data)
    {

        if (isset($data['user_id']) && $data['user_id'] != 'null') {
            // Intentamos con el id
            $res = User::find($data['user_id']);

            if (isset($res->id)) {
                return ['msg' => 'user_exist', 'user_id' => $res->id, 'data' => $res];
            } else {
                return ['msg' => 'not_exist'];
            }
        } else {
            return ['msg' => 'not_exist'];
        }
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return ['msg' => 'OK'];
    }


    /*
    |--------------------------------
    |Create/Update user as Restaturant
    |--------------------------------
    */

    public function addNew($data, $type)
    {

        $add = $type === 'add' ? new User : User::find($type);
        $add->name          = isset($data['name']) ? $data['name'] : null;
        $add->role          = isset($data['role']) ? $data['role'] : null;
        $add->almacen_id    = isset($data['almacen_id']) ? $data['almacen_id'] : 0;
        $add->username      = isset($data['username']) ? $data['username'] : null;
        $add->whatsapp_1    = isset($data['whatsapp_1']) ? $data['whatsapp_1'] : null;
        $add->whatsapp_2    = isset($data['whatsapp_2']) ? $data['whatsapp_2'] : null;
        $add->email         = isset($data['email']) ? $data['email'] : null;
        $add->city_id       = isset($data['city_id']) ? $data['city_id'] : 0;
        $add->categorystore_id = isset($data['categorystore_id']) ? $data['categorystore_id'] : 0;

        if (isset($data['status']) && $data['status'] === 'on') {
            $add->status = 1;
        } else {
            $add->status = 0;
        }

        if (isset($data['logo'])) {
            $filename = time() . rand(111, 699) . '.' . $data['logo']->getClientOriginalExtension();
            $data['logo']->move("public/upload/user/logo/", $filename);
            $add->logo = $filename;
            $add->logo_top = $filename;
            $add->logo_top_sm = $filename;
        }


        if (isset($data['password'])) {
            $add->password = bcrypt($data['password']);
            $add->shw_password = $data['password'];
        }


        $add->save();

    }

    public function signupApp($data)
    {
        $add = new User;

        $add->name = isset($data['name']) ? $data['name'] : null;
        $add->username = $this->remove_charecters($this->remove_accents($data['name']));
        $add->role = 1;
        $add->email = isset($data['email']) ? $data['email'] : null;
        $add->whatsapp_1 = isset($data['phone']) ? $data['phone'] : null;
        $add->rfc = isset($data['rfc']) ? $data['rfc'] : null;
        $add->FiscalRegime = isset($data['FiscalRegime']) ? $data['FiscalRegime'] : null;
        $add->zip = isset($data['zip']) ? $data['zip'] : null;
        $add->status = 1;

        $add->password = bcrypt($data['password']);
        $add->shw_password = $data['password'];

        $token = JWTAuth::fromUser($add);
        return ['data' => $add, 'msg' => 'OK', 'token' => $token, 'type' => 'bearer'];

    }

    public function UpdateUserApp($data, $id)
    {
        $add = User::findOrFail($id);

        $add->name          = isset($data['name']) ? $data['name'] : null;
        $add->username      = $this->remove_charecters($this->remove_accents($data['name']));
        $add->email         = isset($data['email']) ? $data['email'] : null;
        $add->whatsapp_1    = isset($data['whatsapp_1']) ? $data['whatsapp_1'] : null;
        $add->rfc           = isset($data['rfc']) ? $data['rfc'] : null;
        $add->FiscalRegime  = isset($data['FiscalRegime']) ? $data['FiscalRegime'] : null;
        $add->zip           = isset($data['zip']) ? $data['zip'] : null;
 
        if (isset($data['password'])) {
            if ($add->shw_password != $data['password']) {   
                $add->password = bcrypt($data['password']);
                $add->shw_password = $data['password'];
            }
        }

        $add->save();
        return ['data' => $add, 'msg' => 'OK'];
    }

    /*
    |--------------------------------------
    |Get all data from db
    |--------------------------------------
    */
    public function getAll($city_id = 0, $role = 2, $almacen = 0)
    {
        return User::where(function ($query) use ($city_id, $role, $almacen) {
            if ($city_id > 0) {
                $query->where('users.city_id', $city_id)->join('cities', 'users.city_id', '=', 'cities.id')
                ->select('users.*', 'cities.name as city');
            }

            $query->where('users.role', $role);

            if ($almacen > 0) {
                $query->where('users.almacen_id', $almacen);
            }

        })->orderBy('users.id', 'DESC')->get();
    }

    function remove_accents($cadena)
    {

        //Reemplazamos la A y a
        $cadena = str_replace(
            array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
            array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
            $cadena
        );

        //Reemplazamos la E y e
        $cadena = str_replace(
            array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
            array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
            $cadena
        );

        //Reemplazamos la I y i
        $cadena = str_replace(
            array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
            array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
            $cadena
        );

        //Reemplazamos la O y o
        $cadena = str_replace(
            array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
            array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
            $cadena
        );

        //Reemplazamos la U y u
        $cadena = str_replace(
            array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
            array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
            $cadena
        );

        //Reemplazamos la N, n, C y c
        $cadena = str_replace(
            array('Ñ', 'ñ', 'Ç', 'ç'),
            array('N', 'n', 'C', 'c'),
            $cadena
        );

        return $cadena;
    }

    function remove_charecters($text)
    {
        $divider = '-';
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
