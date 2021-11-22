<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // inside of the constructor, the functions don't require login of the user
    public function __construct()
    {
        $this->middleware("auth:sanctum", ['except'=>["register","show","index","login"]]);
    }


    // Register user
    public function register(Request $request) {
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|unique:users,email',
            'password'=>'required|string|confirmed',
            'role'=>'required|string'
        ]);

        $user=User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>bcrypt($request->password),
            "role"=>$request->role
        ]);
        
        $token=$user->createToken("token-name")->plainTextToken;
        $user->attachRole($request->role);

        return response()->json(["user"=>$user,"token"=>$token,], 200);
    }


    // Logout of the user
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(["message"=>"Logged out!"], 200);
    }


    // login of the user
    public function login(Request $request) {
        $request->validate([
            "email"=>"required|email",
            "password"=>"required",
        ]);

        if(!Auth::attempt($request->only("email","password"))) {
            return response()->json(["message"=>"The provided credentials are not right. Please try again."], 404);
        }
        
        $user = User::where("email", $request["email"])->firstOrFail();
        $token = $user->createToken("token-name")->plainTextToken;
        
        return response()->json(["user"=>$user, "token"=>$token], 200);
    }

    // Show specific user from users
    public function show($id) {
        $user=User::with('comments')->find($id);
        if($user == null) {
            return response()->json(["message"=>"The user doesn't exist!"], 404);
        } else {
            return response()->json(["user"=>$user,], 200);
        }
    }

    // Show full list of users
    public function index() {   
        $users=User::with('comments')->paginate(5);
        return response()->json(["users"=>$users,], 200);
    }


    // Delete user and comments related to the user
    public function destroy($id) {
        $user = User::find($id);
        $user->comments()->delete();
        // $user->problems()->delete();
        $user->delete();
        return response()->json([], 204);
    }
}
