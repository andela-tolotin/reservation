<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
    	if ($request->has('username') && $request->has('password')) {
    		if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
    			return response()->json([
    				'status' => true, 
    				'message' => 'Login Successful!',
    				'data' => Auth::user(),
    			]);
    		} 

    		return response()->json(['status' => false, 'message' => 'Login Failed!']);
    	}
    }

    public function save(Request $request)
    {
    	if ($request->has('username') 
    		&& $request->has('password') 
    		&& $request->has('name') 
    		&& $request->has('email')
    	) {
    		$user = User::findOneByEmail($request->email);

    		if ($user instanceof User) {
    			return response()->json(['status' => false, 'message' => 'Email Already Exists']);
    		}

    		$user = User::findOneByUsername($request->username);

    		if ($user instanceof User) {
    			return response()->json(['status' => false, 'message' => 'Username has been taken']);
    		}

    		$user = User::create([
    			'name' =>  $request->name, 
    			'username' => $request->username, 
    			'email' => $request->email, 
    			'password' => bcrypt($request->password)
    		]);

    		if ($user instanceof User) {
    			return response()->json(['status' => true, 'message' => 'Registration Successful!']);
    		}

    		return response()->json(['status' => false, 'message' => 'Registration Failed!']);
    	}
    }
}
