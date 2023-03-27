<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{



    public function index(){
        if(Auth::user()->hasRole('superadministrator')){

            $users = User::all();
            return view('superadmin.users')->with('users', $users);
        }
        else{
            return 'you dont have permission to access this page';
        }
        
   }
   public function search(Request $request)
   {
       $search = $request->get('search');
   
       $users = User::where('name', 'like', '%' . $search . '%')->get();

       return response()->json($users);
   }
   public function edit(User $user)
   {
       return view('superadmin.edit', compact('user'));
   }
   
   public function update(Request $request, User $user)
   {
       $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
           'password' => 'nullable|string|min:8|confirmed',
       ]);
   
       $user->name = $request->input('name');
       $user->email = $request->input('email');
   
       if ($request->has('password')) {
           $user->password = Hash::make($request->input('password'));
       }
   
       $user->save();
   
       return redirect()->route('users.edit', $user)->with('success', 'User details updated successfully.');
   }
   
}
