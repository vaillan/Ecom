<?php

namespace App\Http\Controllers\PostUserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostUsers\PostUsers;
use App\Models\Address\Address;
use App\Models\Estado\Estado;
use App\Models\Municipio\Municipio;
use App\Models\Localidad\Localidad;

use Validator;
use App\Helpers\GetFullUser;

class PostUserController extends Controller
{

    public function postUser(Request $request) {
        $carbon = new \Carbon\Carbon();
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'description' => 'required|string',
            'budget_minimum' => 'required',
            'budget_maximum' => 'required',
            'init_date' => 'required',
            'end_date' => 'required',
            'divisa_budget_minimum' => 'required',
            'divisa_budget_maximum' => 'required',
            'localidad_id' => 'required',
            'address' => 'required',
            
        ]);
        
        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }else {
            $dt1 = $carbon->parse($request->input('init_date'))->locale('English');
            $dt2 = $carbon->parse($request->input('end_date'))->locale('English');
            
            $post_user = PostUsers::create([
                'user_id' => $request->input('user_id'),
                'budget_minimum' => $request->input('budget_minimum'),
                'budget_maximum' => $request->input('budget_maximum'),
                'init_date' => $dt1->format('Y-m-d'),
                'end_date' => $dt2->format('Y-m-d'),
                'divisa_budget_minimum' => $request->input('divisa_budget_minimum'),
                'divisa_budget_maximum' => $request->input('divisa_budget_maximum'),
                'description' => $request->input('description'),
                'localidad_id' => $request->input('localidad_id'),
            ]);

            $mexico = Localidad::with(['municipio' => function($query) {
                $query->with('estado');
            }])->find($request->input('localidad_id'));

            $query = Address::create([
                'user_id' => $request->input('user_id'),
                'post_user_id' => $post_user->id,
                'clave' => $mexico['clave'],
                'estado' => $mexico['municipio']['estado']['nombre'],
                'localidad' => $mexico['nombre'],
                'municipio' => $mexico['municipio']['nombre'],
                'lat' => $mexico['lat'],
                'lng' => $mexico['lng'],
                'address' => $request->input('address'),
            ]);
            
            if($query) {
                return response()->json(['valid' => true, 'message' => 'post wass created successfully'],200);
            }
        }
    }

    public function getPostUser($id) {
        $array_posts_user = PostUsers::with('user','address')->where('user_id',$id)->orderBy('id', 'desc')->get();
        $new_array_posts_user = array();
        $getFullUser = new GetFullUser();
        foreach($array_posts_user as $post_user) {
            $post = [
                'budget_maximum' => $post_user->budget_maximum,
                'budget_minimum' => $post_user->budget_minimum,
                'created_at' => $post_user->created_at,
                'description' => $post_user->description,
                'divisa_budget_maximum' => $post_user->divisa_budget_maximum,
                'divisa_budget_minimum' => $post_user->divisa_budget_minimum,
                'end_date' => $post_user->end_date,
                'id' => $post_user->id,
                'init_date' => $post_user->init_date,
                'updated_at' => $post_user->updated_at,
                'user' => $user = $getFullUser->getUserInfo($post_user->user),
                'user_id' => $post_user->user_id,
                'address' =>  $post_user->address,
            ];
            $new_array_posts_user[] = $post;
        }
        if(count($new_array_posts_user) > 0) {
            return response()->json(['valid' => true,'posts_user' => $new_array_posts_user],200);
        }else {
            return response()->json(['failed' => false],200);
        }
    }
}
