<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\StoreScope;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name', 'slug', 'description', 'image', 'category_id', 'store_id',
        'price', 'compare_price', 'status',
    ];


    public static function rules($id=0){
        return[
            'name'=>"required|string|min:3|max:255|unique:products,name,$id",
            'category_id'=>[
                'required','string'
            ],
            'image'=>[
                'image','max:1048576','dimensions:min-width=100,min-hight-100'
            ],
            'status'=>'in:active,archived,draft',

        ];
    }

    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope());

        // static::creating(function(Product $product) {
        //     $product->slug = Str::slug($product->name);
        // });
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id')
        ->withDefault();

    }

    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
        
    }

    // Accessors
    // $product->image_url
    
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://www.incathlab.com/images/products/default_product.png';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }


    public function getSalePercentAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }
        return round(100 - (100 * $this->price / $this->compare_price), 0);
    }

    
}
