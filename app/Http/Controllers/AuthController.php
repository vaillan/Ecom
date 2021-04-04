<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\GetFullUser;
use App\User;
use Validator;

class AuthController extends Controller {

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'update']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Email or password was wrong'], 401);
        }

        return $this->createNewToken($token);
    }


    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'role' => 'required|string',
            'about_me' => 'required|string',
            'name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            'nick' => 'required|string|between:2,20',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);


        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        
        User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)],
                ));

        return response()->json([
            'message' => 'User successfully registered',
        ], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    public function update(Request $request){

        $user = User::find($request->input('id'));
        $id = $user->id;
        
        
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','between:2,100'],
            'about_me' => ['required','string','between:5,100'],
            'last_name' => ['required','string','between:2,100'],
            'nick' => ['required','string','between:2,20', 'unique:users,nick,'.$id],
            'email' => ['required','unique:users,email,'.$id],
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }else {
            $name = $request->input('name');
            $about_me = $request->input('about_me');
            $last_name = $request->input('last_name');
            $nick = $request->input('nick');
            $email = $request->input('email');

            $user->name = $name;
            $user->last_name = $last_name;
            $user->about_me = $about_me;
            $user->nick = $nick;
            $user->email = $email;
            
            $save = $user->update() ? true : false;
            if($save) {
                $getFullUser = new GetFullUser();
                return response()->json(['valid' => true, 'message' => 'datos actualizados correctamente', 'user' => $getFullUser->getUserInfo($user)],200);
            }
        }

        
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){

        $getFullUser = new GetFullUser();
        
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $getFullUser->getUserInfo(auth()->user())
        ]);
    }

}
