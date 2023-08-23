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
    
<form action="{{route('categories.store')}} "method="post" enctype="multipart/form-data">
@csrf

<div class="form-group">
    <label>Category Name</label>
    <input type="text" name="name" class="form-control" value="{{old('name')}}">
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
        <option value="{{$parent->id}}">{{$parent->name}}</option>
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
    <textarea type="text" name="description" class="form-control">{{old('description')}}</textarea>
    @error('description')
    <div class="text-danger">
        {{$message}}
    </div>
    @enderror
</div>
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