@extends('layouts.dashboard')

@section('title')
Create
@endsection


@section('content')


{{-- @if($errors->any())
<div class ="alert alert-danger">
    <h3>Error Occured</h3>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif --}}
    
<form action="{{route('products.store')}} "method="post" enctype="multipart/form-data">
@csrf

<div class="form-group">
    <label>Product Name</label>
    <input type="text" name="name" class="form-control" value="{{old('name')}}">
    @error('name')
    <div class="text-danger">
        {{$message}}
    </div>
    @enderror

</div>

<div class="form-group">
    <label>Category</label>
    <select name="category_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach(App\Models\Category::all() as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    @error('category_id')
    <div class="text-danger">
        {{$message}}
    </div>
    @enderror
</div>


<div class="form-group">
    <label>Store</label>
    <select name="store_id" class="form-control form-select">
        <option value="">Primary Store</option>
        @foreach(App\Models\Store::all() as $store)
        <option value="{{ $store->id }}">{{ $store->name }}</option>
        @endforeach
    </select>

    @error('store_id')
    <div class="text-danger">
        {{$message}}
    </div>
    @enderror
</div>



<div class="form-group">
    <label>Description</label>
    <textarea type="text" name="description" class="form-control">{{old('description')}}</textarea>
    @error('description')
    <div class="text-danger">
        {{$message}}
    </div>
    @enderror
</div>


<div class="form-group">
    <label>Price</label>
    <textarea type="text" name="price" class="form-control">{{old('price')}}</textarea>
    @error('price')
    <div class="text-danger">
        {{$message}}
    </div>
    @enderror
</div>


<div class="form-group">
    <label>Compare Price</label>
    <textarea type="text" name="compare_price" class="form-control">{{old('compare_price')}}</textarea>
    @error('compare_price')
    <div class="text-danger">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <label>Image</label>
    <input type="file" name="image" class="form-control">

    @error('image')
    <div class="text-danger">
        {{$message}}
    </div>
    @enderror
</div>


<div class="form-group">
    <label>Status</label>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status"  value="active" checked>
            <label class="form-check-label">
              Active
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="status"  value="archived">
            <label class="form-check-label">
             Archived
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="status"  value="draft">
            <label class="form-check-label">
              Araft
            </label>
          </div>
    </div>

        @error('image')
    <div class="text-danger">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
<button type="submit" class="btn btn-primary">Save</button>
</div>

</form>


@endsection