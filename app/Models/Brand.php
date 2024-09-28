<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Validator;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $fillable = [
        'user_id',
        'name',
        'meta',
        'description',
        'logo',
        'status'
    ];


    public function rules($type)
    {
        if ($type === "add") {
            return [
                'name'      => 'required|unique:brands',
            ];
        } else {
            return [

                'name'      => 'required|unique:brands,name,' . $type,
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
    |Create/Update Brand
    |--------------------------------
    */

    public function addNew($data, $type)
    {

        $add        = $type === 'add' ? new Brand : Brand::find($type);
        $add->user_id = auth()->user()->id;
        $add->name  = isset($data['name']) ? $data['name'] : null;
        $add->meta  = isset($data['meta']) ? $data['meta'] : null;
        $add->description  = isset($data['description']) ? $data['description'] : null;

        if (isset($data['logo'])) {
            $filename   = time() . rand(111, 699) . '.' . $data['logo']->getClientOriginalExtension();
            $data['logo']->move("public/upload/brands/", $filename);
            $add->logo = $filename;
        }

        if (isset($data['status']) && $data['status'] === 'on') {
            $add->status = 1;
        } else {
            $add->status = 0;
        }
        $add->save();
    }
}
