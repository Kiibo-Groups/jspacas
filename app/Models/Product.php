<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Validator;
use Auth;
class Product extends Model
{

    protected $table = 'products';

    protected $fillable = [
        'id_sat',
        'user_id',
        'name',
        'brand_id',
        'category_id',
        'almacen_id',
        'bodega_id',
        'image',
        'type_unit',
        'product_key',
        'unit_key',
        'weight',
        'minimum_amount',
        'barcode',
        'labels',
        'meta',
        'description',
        'featured',
        'offer',
        'flash',
        'discount',
        'discount_rate',
        'taxes',
        'price',
        'status'
    ];

    public function rules($type)
    {
        if ($type === "add") {
        return [
            'name' => 'required|unique:products',
        ];
        } else {
            return [
                'name'      => 'required|unique:products,name,' . $type,
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


    public function addNew($data, $type) {

        $add                        = $type === 'add' ? new Product : Product::find($type);
        $add->id_sat                = isset($data['id_sat']) ? $data['id_sat'] : 0;
        $add->user_id               = auth()->user()->id;
        $add->name                  = isset($data['name']) ? $data['name'] : null;
        $add->brand_id              = isset($data['brand_id']) ? $data['brand_id'] : null;
        $add->category_id           = isset($data['category_id']) ? $data['category_id'] : null;
        $add->almacen_id            = isset($data['almacen_id']) ? $data['almacen_id'] : 0;
        $add->bodega_id             = isset($data['bodega_id']) ? $data['bodega_id'] : 0;
        $add->type_unit             = isset($data['type_unit']) ? $data['type_unit'] : null;
        $add->weight                = isset($data['weight']) ? $data['weight'] : null;
        $add->minimum_amount        = isset($data['minimum_amount']) ? $data['minimum_amount'] : null;
        $add->barcode               = isset($data['barcode']) ? $data['barcode'] : null;
        $add->product_key           = isset($data['product_key']) ? $data['product_key'] : null;
        $add->unit_key              = isset($data['unit_key']) ? $data['unit_key'] : null;
        $add->labels                = isset($data['labels']) ? $data['labels'] : null;
        $add->meta                  = isset($data['meta']) ? $data['meta'] : null;
        $add->description           = isset($data['description']) ? $data['description'] : null;
        $add->discount              = isset($data['discount']) ? $data['discount'] : null;
        $add->discount_rate         = isset($data['discount_rate']) ? $data['discount_rate'] : null;
        $add->taxes                 = isset($data['taxes']) ? $data['taxes'] : null;
        $add->price                 = isset($data['price']) ? $data['price'] : null; 

        if (isset($data['status']) && $data['status'] === 'on') {
            $add->status = 1;
        } else {
            $add->status = 0;
        }

        if (isset($data['featured']) && $data['featured'] === 'on') {
            $add->featured = 1;
        } else {
            $add->featured = 0;
        }

        if (isset($data['offer']) && $data['offer'] === 'on') {
            $add->offer = 1;
        } else {
            $add->offer = 0;
        }

        if (isset($data['flash']) && $data['flash'] === 'on') {
            $add->flash = 1;
        } else {
            $add->flash = 0;
        }


        if (isset($data['image'])) {
            $filename   = time() . rand(111, 699) . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->move("public/upload/products/", $filename);
            $add->image = $filename;
        }

        $add->save();

    }

    /*
    |--------------------------------------
    |Get all data from db
    |--------------------------------------
    */
    public function getAll()
    {
        return Product::join('categories','products.category_id','=','categories.id')
                ->Leftjoin('brands','products.brand_id','=','brands.id')
                ->Leftjoin('almacens','products.bodega_id','=','almacens.id')
                ->select('categories.name as Cat','almacens.name as Almacen', 'brands.name as Brand','products.*')
                ->where('products.user_id', auth()->user()->id)
                ->orderBy('products.id','DESC')->get();
    }

    /*
    |--------------------------------------
    |Print LABELS Information
    |--------------------------------------
    */
    public function PrintLabels($bodega)
    {
 
        $prods  = Product::where('bodega_id',$bodega)->where('status',1)->where('user_id', Auth::user()->id)->get();
        $data   = [];

        foreach ($prods as $key) {
            $data[] = [
                'Clave' => $key->barcode,
                'Descripcion' => $key->meta
            ];
        }

        return $data;
    }

}