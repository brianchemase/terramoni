<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Mail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function userslist()
    {

        $users = DB::table('users')->get();

       // return $users;

        return view ('agents.manageusers',['users' => $users]);
    }

    public function registerUser(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20',
            'username' => 'required|string|max:255',
            'role' => 'required|in:0,1,2',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->mobile_no = $validatedData['phone'];
        $user->username = $validatedData['username'];
        $user->role = $validatedData['role'];
        $user->password = bcrypt($validatedData['password']);
        $user->save();

        // Redirect back or to a success page
        return redirect()->back()->with('success', 'User registered successfully!');
    }

    public function updateUser(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile_no = $request->input('phone');
        $user->username = $request->input('username');
        $user->role = $request->input('role');

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function changePassword(Request $request, User $user)
        {
            $request->validate([
                'new_password' => 'required|min:8|confirmed',
            ]);

            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            return redirect()->back()->with('success', 'Password changed successfully.');
        }




}
