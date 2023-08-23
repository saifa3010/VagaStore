<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
Use Illuminate\Support\Str;

class CategoriesController extends Controller
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


        $query=Category::query();

        if($name =$request->query('name')){
            $query->where('name','LIKE',"%$name%");
        }

        if($status =$request->query('status')){
            $query->where('status','=',"$status");
        }

        $categories=$query
        ->leftJoin('categories as parents','parents.id','=','categories.parent_id')
        ->select([
            'categories.*',
            'parents.name as parent_name'
        ])
        // ->select('categories.*')
        // ->selectRaw('(SElECT COUNT(*) FROM products WHERE category_id = categories.id) as products_count')
        ->withCount('products')
        ->OrderBy('categories.name')
        ->paginate(10);
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $parents=Category::all();
        return view('dashboard.categories.create',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
 
        // $request->validate(([
        //     'name'=>'required|string|min:3|max:255',
        //     'parent_id'=>[
        //         'nullable','int','exists:categories,id'
        //     ],
        //     'image'=>[
        //         'image','max:1048576','dimensions:min-width=100,min-hight-100'
        //     ],
        //     'status'=>'in:active,archived',

        // ]));
        $request->validate(Category::rules(),[
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


      
        $category=Category::create($data);
        return Redirect::route('categories.index')->
        with('success','Category created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
       return view('dashboard.categories.show',[
        'category' => $category
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         // SELECT * FROM categories WHERE id <> $id 
        // AND (parent_id IS NULL OR parent_id <> $id)
        $parents =Category::Where('id','<>',$id)
        ->Where(function($query) use ($id){
            $query->WhereNull('parent_id')
            ->OrWhere('parent_id','<>',$id);
        })
        ->get();

        $category=Category::findOrFail($id);
        return view('dashboard.categories.edit',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        // $request->validate(([
        //     'name'=>'required|string|min:3|max:255',
        //     'parent_id'=>[
        //         'nullable','int','exists:categories,id'
        //     ],
        //     'image'=>[
        //         'image','max:1048576','dimensions:min-width=100,min-hight-100'
        //     ],
        //     'status'=>'in:active,archived',

        // ]));
        $request->validate(Category::rules($id),[
            'required' =>'This field (:attribute) is required',
            'unique=>This is name already exists'
        ]);



        $category=Category::findOrFail($id);

        $old_image=$category->image;

        $data =$request->except('image');
        if ($request->hasFile('image')){
               $file=$request->file('image');
               $path=$file->store('uploads','public');
               $data['image']=$path;
        }
        if($old_image && isset($data['image'])){
            Storage::disk('public')->delete($old_image);
        }

        $category->update($data);
        return Redirect::route('categories.index')->
        with('success','Category updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::findOrFail($id);
        $category->delete();
        // Category::destroy($id);
       // Category::Where('id','=',$id)->delete();
       if($category->image){
        Storage::disk('public')->delete($category->image);
    }
        return Redirect::route('categories.index')->
        with('success','Category deleted');

       

    }
}
