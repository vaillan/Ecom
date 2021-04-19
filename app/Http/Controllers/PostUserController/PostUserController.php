<?php

namespace App\Http\Controllers\PostUserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostUsers\PostUsers;
use Validator;

class PostUserController extends Controller
{
    public function postUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'description' => 'required|string',
            'budget_minimum' => 'required',
            'budget_maximum' => 'required',
            'init_date' => 'required',
            'end_date' => 'required',
            'divisa_budget_minimum' => 'required',
            'divisa_budget_maximum' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }else {
            $query = [
                'user_id' => $request->input('user_id'),
                'budget_minimum' => $request->input('budget_minimum'),
                'budget_maximum' => $request->input('budget_maximum'),
                'init_date' => $request->input('init_date'),
                'end_date' => $request->input('end_date'),
                'divisa_budget_minimum' => $request->input('divisa_budget_minimum'),
                'divisa_budget_maximum' => $request->input('divisa_budget_maximum'),
                'description' => $request->input('description'),
            ]; 
            PostUsers::create($query);
            return response()->json(['valid' => true, 'message' => 'post wass created successfully'],200);
        }

    }
}
