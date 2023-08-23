<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','description','slug','image','status','parent_id'
    ];


    public static function rules($id=0){
        return[
            'name'=>"required|string|min:3|max:255|unique:categories,name,$id",
            'parent_id'=>[
                'nullable','int','exists:categories,id'
            ],
            'image'=>[
                'image','max:1048576','dimensions:min-width=100,min-hight-100'
            ],
            'status'=>'in:active,archived',

        ];
    }


    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }
}
