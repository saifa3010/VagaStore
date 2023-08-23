@extends('layouts.dashboard')

@section('title')
Edit
@endsection


@section('content')
    
<form action="{{route('categories.update',$category->id)}} "method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
    <div class="form-group">
        <label>Category Name</label>
        <input type="text" name="name" class="form-control" value="{{$category->name}}">

        @error('name')
        <div class="text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    
    <div class="form-group">
        <label>Category Parent</label>
        <select name ="parent_id" class="form-control form-select">
            <option value="">Primary Category</option>
            @foreach($parents as $parent)
            <option value="{{$parent->id}}" @selected($category->parent_id==$parent->id)>{{$parent->name}}</option>
            @endforeach
        </select>

        @error('parent_id')
        <div class="text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    
    <div class="form-group">
        <label>Description</label>
        <textarea type="text" name="description" class="form-control">{{$category->description}}</textarea>

        @error('description')
        <div class="text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    
    <div class="form-group">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
        @if($category->image)
        <img src="{{ asset('storage/'.$category->image)}}" alt="" height="50">
        @endif

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
                <input class="form-check-input" type="radio" name="status"  value="active" @checked($category->status=='active')>
                <label class="form-check-label">
                  Active
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="status"  value="archived" @checked($category->status=='archived')>
                <label class="form-check-label">
                 Archived
                </label>
              </div>
        </div>

        @error('status')
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