<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Validator;

class Almacen extends Model
{
    use HasFactory;

    protected $table = 'almacens';

    protected $fillable = [
        'user_id',
        'almacenista_id',
        'name',
        'email',
        'phone',
        'street',
        'zip_code',
        'state',
        'city',
        'no_exterior',
        'no_interior',
        'details',
        'status'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'bodega_id')->whereStatus(1);
    }

    public function productsTotalPrice()
    {
        return $this->hasMany(Product::class, 'bodega_id')->sum('price');
    }

    public function rules($type)
    {
        if ($type === "add") {
            return [
                'name'      => 'required|unique:almacens',
            ];
        } else {
            return [

                'name'      => 'required|unique:almacens,name,' . $type,
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

    /*
    |--------------------------------
    |Create/Update Almacen
    |--------------------------------
    */

    public function addNew($data, $type)
    {
        $add                = $type === 'add' ? new Almacen : Almacen::find($type);
        $add->user_id       = auth()->user()->id;
        $add->almacenista_id = isset($data['almacenista_id']) ? $data['almacenista_id'] : 0;
        $add->name          = isset($data['name']) ? $data['name'] : null;
        $add->email         = isset($data['email']) ? $data['email'] : null;
        $add->phone         = isset($data['phone']) ? $data['phone'] : null;
        $add->street        = isset($data['street']) ? $data['street'] : null;
        $add->zip_code      = isset($data['zip_code']) ? $data['zip_code'] : null;
        $add->state         = isset($data['state']) ? $data['state'] : null;
        $add->city          = isset($data['city']) ? $data['city'] : null;
        $add->no_exterior   = isset($data['no_exterior']) ? $data['no_exterior'] : null;
        $add->no_interior   = isset($data['no_interior']) ? $data['no_interior'] : null;
        $add->details       = isset($data['details']) ? $data['details'] : null;

        if (isset($data['status']) && $data['status'] === 'on') {
            $add->status = 1;
        } else {
            $add->status = 0;
        }
        $add->save();
    }
}
