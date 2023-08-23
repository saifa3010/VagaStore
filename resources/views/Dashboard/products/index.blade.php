@extends('layouts.dashboard')

@section('title')
Products
@endsection


@section('content')
    
<div class="mb-5">
    <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
</div>

@if(session()->has('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif



<form action="{{URL::current()}}" method="get" class="form-inline">
    
    <div class="form-group mx-sm-3 mb-2">
      <input name="name" type="text" class="form-control" value="{{request('name')}}" placeholder="products">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <select name="status" class="form-control">
            <option value="">All</option>
            <option value="active"  @selected(request('status')== 'active')>Active</option>
            <option value="draft" @selected(request('status')== 'draft')>draft</option>
            <option value="archived" @selected(request('status')== 'archived')>Archived</option>

        </select>
      </div>
    <button type="submit" class="btn btn-primary mb-2">Search</button>
  </form>





<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>
            <th colspane="2"></th>

        </tr>
    </thead>
    <tbody>
        {{-- @if($categories->count()) --}}
        @forelse ($products as $product)
            
        <tr>
            <td><img src="{{ asset('storage/'.$product->image)}}" alt="" height="50"></td>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->category->name}}</td>
            {{-- <td>{{$product->category? $product->category->name:''}}</td> --}}
            <td>{{$product->store->name}}</td>
            <td>{{$product->status}}</td>
            <td>{{$product->created_at}}</td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
            {{-- @can('categories.delete') --}}
            <form action="{{ route('products.destroy', $product->id) }}" method="post">
            @csrf
                               <!-- Form Method Spoofing -->
                {{-- <input type="hidden" name="_method" value="delete"> --}}
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9"> 
                No find categories

            </td>
        </tr>
            
        @endforelse
        {{-- @else 
        <tr>
            <td colspan="7"> 
                No find categories

            </td>
        </tr>
        @endif --}}

    </tbody>
</table>
{{$products->WithQueryString()->links()}}


@endsection