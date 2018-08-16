<?php

namespace App\Http\Controllers;

use App\User;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function show(){
        $user=Auth::user();
        return view('Account.showAccount',compact('user'));
    }

    public function edit(){
        $user=Auth::user();
        return view('Account.editAccount',compact('user'));
    }

    public function update(User $user)
    {
        if (request()->hasFile('photo'))
        {
            if(Auth::user()->email == request('email')) {

                $this->validate(request(), [
                    'name' => 'required',
                    'password' => 'required|min:6|confirmed',
                    'photo' => 'mimes:jpeg,png'
                ]);
            }
            else{
                $this->validate(request(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6|confirmed',
                    'photo' => 'mimes:jpeg,png'
                ]);
                $user->email = request('email');
            }

            $path=request()->file('photo')->store('public/profile_pics');
            $paths=explode('/',$path);
            $correct_path_that_gonna_work_for_sure=$paths[1].'/'.$paths[2];
            $user->name = request('name');
            $user->email = request('email');
            $user->password = bcrypt(request('password'));
            $user->photo=$correct_path_that_gonna_work_for_sure;

            $user->save();
        }
        else
        {
            if(Auth::user()->email == request('email')) {

                $this->validate(request(), [
                    'name' => 'required',
                    'password' => 'required|min:6|confirmed'
                ]);
            }
            else{
                $this->validate(request(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6|confirmed'
                ]);
                $user->email = request('email');
            }
            $user->name = request('name');
            $user->password = bcrypt(request('password'));
            $user->save();
        }
        return redirect(route('users.show',Auth::user()->id));
    }
}
