<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Validator;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

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
                'name'      => 'required|unique:categories',
            ];
        } else {
            return [

                'name'      => 'required|unique:categories,name,' . $type,
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
    |Create/Update Category
    |--------------------------------
    */

    public function addNew($data, $type)
    {

        $add        = $type === 'add' ? new Category : Category::find($type);
        $add->user_id = auth()->user()->id;
        $add->name  = isset($data['name']) ? $data['name'] : null;
        $add->meta  = isset($data['meta']) ? $data['meta'] : null;
        $add->description  = isset($data['description']) ? $data['description'] : null;

        if (isset($data['logo'])) {
            $filename   = time() . rand(111, 699) . '.' . $data['logo']->getClientOriginalExtension();
            $data['logo']->move("public/upload/categories/", $filename);
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
