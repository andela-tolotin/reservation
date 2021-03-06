<?php
namespace App\Http\Controllers\Api;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    			], 200);
    		} 

    		return response()->json(['status' => false, 'message' => 'Login Failed!'], 400);
    	}
    }

    public function save(Request $request)
    {
    	if ($request->has('username') && 
            $request->has('password') && 
            $request->has('name') && 
            $request->has('email')
    	) {
    		$user = User::findOneByEmail($request->email);

    		if ($user instanceof User) {
    			return response()->json(['status' => false, 'message' => 'Email Already Exists'], 400);
    		}

    		$user = User::findOneByUsername($request->username);

    		if ($user instanceof User) {
    			return response()->json(['status' => false, 'message' => 'Username has been taken'], 400);
    		}

    		$user = User::create([
    			'name' =>  $request->name, 
    			'username' => $request->username, 
    			'email' => $request->email, 
    			'password' => bcrypt($request->password)
    		]);

    		if ($user instanceof User) {
    			return response()->json(['status' => true, 'message' => 'Registration Successful!'], 200);
    		}

    		return response()->json(['status' => false, 'message' => 'Registration Failed!'], 400);
    	}
    }
}
