<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JWTAuth;
use App\User;
use Validator;
use App\Http\Requests\RegisterFormRequest;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:10',
        ]);

        if ($validator->fails()) {
            return response([
                'success'=>0,
                'status' => 'error',
                'errors' =>$request->all()
            ], 200);
        }else{
                $user = new User;
                $user->email = $request->email;
                $user->name = $request->name;
                $user->password = bcrypt($request->password);
                $user->save();
                $lastId = $user->id;
                if($lastId>0){
                    return response([
                        'success'=>1,
                        'status' => 'success',
                        'data' => $user
                    ], 200);
                }
        } 
      
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'error',
                'errors' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }
        return response([
            'status' => 'success',
            'userId'=>Auth::user()->id,
            'data'=> [
                'token' => $token
                // You can add more details here as per you requirment. 
            ]
        ])
            ->header('Authorization', $token);
    }
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response([
            'status' => 'success',
            'data' => $user
        ]);
       
    }
    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }
    public function logout()
    {
        JWTAuth::invalidate();
        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
   public function test(Request $request){
    
     //  $user = JWTAuth::toUser($request->token);
       //return response()->json(['result' => $user]);

   }
  
   
}
