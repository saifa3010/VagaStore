<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', [
            'user' => $user,
            'countries' => Countries::getNames(),
            'locales' => Languages::getNames(),
            
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['nullable', 'date', 'before:today'],
            'gender' => ['in:male,female'],
            'country' => ['required', 'string'],
        ]);

        // $user = $request->user();
        $user = Auth::user();



        // $profile = $user->profile;
        // if ($profile->first_name) {
        //     $profile->update($request->all());
        // } else {
        //     // $request->merge([
        //     //     'user_id' => $user->id,
        //     // ]);
        //     // Profile::create($request->all());

        //     $user->profile()->create($request->all());
        // }
        $user->profile->fill( $request->all() )->save();

        return redirect()->route('profile.edit')
            ->with('success', 'Profile updated!');
    }
    
}
