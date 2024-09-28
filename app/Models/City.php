<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use Validator;
use Redirect;
class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    protected $fillable = [
        'name',
        'lat',
        'lng',
        'status'
    ];

    /*
    |----------------------------------------------------------------
    |   Validation Rules and Validate data for add & Update Records
    |----------------------------------------------------------------
    */
    
    public function rules($type)
    {
        return [
            'name'      => 'required',
        ];
    }
    
    public function validate($data,$type)
    {

        $validator = Validator::make($data,$this->rules($type));       
        if($validator->fails())
        {
            return $validator;
        }
    }


    /*
    |--------------------------------
    |Create/Update city
    |--------------------------------
    */ 
    public function addNew($data,$type)
    {
         
        $add                = $type === 'add' ? new City : City::find($type);
        $add->name          = isset($data['name']) ? $data['name'] : null;
        $add->lat           = isset($data['lat']) ? $data['lat'] : 0;
        $add->lng           = isset($data['lng']) ? $data['lng'] : 0;  
        $add->status        = isset($data['status']) ? $data['status'] : null; 
        $add->save();

    }   

    /*
    |--------------------------------------
    |Get all data from db
    |--------------------------------------
    */
    public function getAll($type = null)
    {
        return City::where(function($query) use($type) {

            if($type)
            {
                $query->where('status',$type);
            }

        })->orderBy('id','DESC')->get();
    }

}
