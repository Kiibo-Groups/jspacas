<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Validator;

class Suppliers extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'almacen_id',
        'logo',
        'name',
        'email',
        'phone',
        'address',
        'status'
    ];


    public function rules($type)
    {
        if ($type === "add") {
            return [
                'name'      => 'required|unique:suppliers', 
            ];
        } else {
            return [
                'email'      => 'required|unique:suppliers,name,' . $type,
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
        $add                = $type === 'add' ? new Suppliers : Suppliers::find($type);
        $add->almacen_id    = isset($data['almacen_id']) ? $data['almacen_id'] : null;
        $add->name          = isset($data['name']) ? $data['name'] : null;
        $add->email         = isset($data['email']) ? $data['email'] : 'null';
        $add->phone         = isset($data['phone']) ? $data['phone'] : 'null';
        $add->address       = isset($data['address']) ? $data['address'] : 'null';

        if (isset($data['status']) && $data['status'] === 'on') {
            $add->status = 1;
        } else {
            $add->status = 0;
        }
        
        if (isset($data['logo'])) {
            $filename = time() . rand(111, 699) . '.' . $data['logo']->getClientOriginalExtension();
            $data['logo']->move("public/upload/suppliers/logo/", $filename);
            $add->logo = $filename;
        }


        $add->save();
    }
}
