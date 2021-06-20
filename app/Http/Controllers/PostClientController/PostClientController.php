<?php

namespace App\Http\Controllers\PostClientController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\PostClient\PostClient;
use App\Models\Address\Address;
use App\Models\Estado\Estado;
use App\Models\Municipio\Municipio;
use App\Models\Localidad\Localidad;

use Validator;
use App\Helpers\Helpers;
use App\User;

class PostClientController extends Controller
{
    public function createPostClient(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'description' => 'required',
            'services' => 'required',
            'type_post' => 'required',
            'post_client_status' => 'required',
            'price' => 'required',
            'divisa' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


    }
}
