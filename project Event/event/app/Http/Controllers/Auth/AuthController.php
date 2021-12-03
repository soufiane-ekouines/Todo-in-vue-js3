<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login(Request $request){
        $request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);

        $userauth=request(['email','password']);

        if(!Auth::attempt($userauth)){
            return response()->json([
                'message'=>'Unauthorized'
            ],401);
        }
        $user=$request->user();
        $tokenResult=$user->createToken('Access Token');
        //$token = $tokenResult->token;

        // if ($request->remember_me)
        //     $token->expires_at = Carbon::now()->addWeeks(1);
        // $token->save();

        return response()->json([
            'Access_Token'=>$tokenResult->accessToken,
            'Type_Token'=>'Bearer',
            'expers_at'=>Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
        }

        function register(Request $request)
        {
            $request->validate([
                'name'=>'required|string',
                'email'=>'required|string',
                'password'=>'required|string'
            ]);

            $user =new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=bcrypt($request->password);
            $user->save();

            return response()->json([
                'message'=>'user is register'
            ],201);
        }

        public function logout(Request $request)
        {
             $request->user()->token()->revoke();
             return response()->json([
               'message' => 'Successfully logged out'
             ]);
     }
}
