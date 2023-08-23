<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
Use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request=request();

        // SELECT a.*, b.name as parent_name
        // FROM categories as a
        // LEFT JOIN categories as b ON b.id = a.parent_id


        $query=Product::query();

        if($name =$request->query('name')){
            $query->where('name','LIKE',"%$name%");
        }

        if($status =$request->query('status')){
            $query->where('status','=',"$status");
        }

        // $user=Auth::user();
        // if($user->store_id){
        //     $products=$query->where('store_id','=',$user->store_id)
        //     ->OrderBy('products.name')->paginate(10);

        // }
        // else{
        //     $products=$query
        //     ->OrderBy('products.name')->paginate(10);

        $products=$query
        ->with(['Category','store'])
        ->OrderBy('products.name')
        ->paginate(10);
        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product=Product::all();
        return view('dashboard.products.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Product::rules(),[
            'required' =>'This field (:attribute) is required',
            'unique=>This is name already exists'
        ]);

        
        $request->merge([
            'slug'=>Str::slug($request->post('name'))
        ]);
        $data =$request->except('image');
        if ($request->hasFile('image')){
               $file=$request->file('image');
               $path=$file->store('uploads','public');
               $data['image']=$path;
        }

        $product=Product::create($data);
        return Redirect::route('products.index')->
        with('success','Product created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('dashboard.products.show',[
            'product' => $product
           ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
