@extends('layouts.dashboard')

@section('title')
Edit Profile
@endsection
@section('content')






@if(session()->has('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif



<form action="{{route('profile.update')}} "method="post" enctype="multipart/form-data">
    @csrf
    @method("patch")    
    <div class="col-md-4">
      <input name="first_name" type="text" class="form-control" value="{{$user->profile=='first_name'}}" placeholder="First name">
      @error('first_name')
      <div class="text-danger">
          {{$message}}
      </div>
      @enderror
    </div>

    <div class="col-md-4">
        <input name="last_name" type="text" class="form-control" value="{{$user->profile=='last_name'}}" placeholder="Last name">
        @error('last_name')
      <div class="text-danger">
          {{$message}}
      </div>
      @enderror
      </div>

      <div class="col-md-4">
        <input name="birthday" type="date" class="form-control" value="{{$user->profile=='birthday'}}" placeholder="Birthday">
      </div>


      <div class="col-md-6">
        <label>Gender</label>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender"  value="mail" @checked($user->profile=='male')>
                <label class="form-check-label">
                  Male
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender"  value="femile" @checked($user->profile=='female')>
                <label class="form-check-label">
                 Female
                </label>
              </div>
        </div>

        @error('status')
        <div class="text-danger">
            {{$message}}
        </div>
        @enderror
    </div>


    <div class="col-md-4">
        <input name="street_address" type="text" class="form-control" value="{{$user->profile=='street_address'}}" placeholder="Street address">
      </div>

      <div class="col-md-4">
        <input name="city" type="text" class="form-control" value="{{$user->profile=='city'}}" placeholder="City">
      </div>

      <div class="col-md-4">
        <input name="state" type="text" class="form-control" value="{{$user->profile=='state'}}" placeholder="State">
      </div>

      <div class="col-md-4">
        <input name="postal_code" type="text" class="form-control" value="{{$user->profile=='postal_code'}}" placeholder="Postal code">
      </div>


    <div class="col-md-4">
        <select name="country" class="form-control">
            @foreach($countries as $value=>$text)
            <option value="$value"  @selected($user->profile=='country')>{{$text}}</option>
            @endforeach
        </select>
       
        @error('country')
      <div class="text-danger">
          {{$message}}
      </div>
      @enderror
      </div>

      <div class="col-md-4">
        <select name="locale" class="form-control">
            @foreach($locales as $value=>$text)
            <option value="$value"  @selected($user->profile=='locale')>{{$text}}</option>
            @endforeach
        </select>

        @error('locale')
      <div class="text-danger">
          {{$message}}
      </div>
      @enderror
      </div>

      


      <button type="submit" class="btn btn-primary">Save</button>
    </form>








@endsection