<?php

namespace App\Http\Controllers\PostUserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostUsers\PostUsers;
use Validator;


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
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }else {
            $dt1 = $carbon->parse($request->input('init_date'))->locale('English');
            $dt2 = $carbon->parse($request->input('end_date'))->locale('English');
            $query = [
                'user_id' => $request->input('user_id'),
                'budget_minimum' => $request->input('budget_minimum'),
                'budget_maximum' => $request->input('budget_maximum'),
                'init_date' => $dt1->format('Y-m-d'),
                'end_date' => $dt2->format('Y-m-d'),
                'divisa_budget_minimum' => $request->input('divisa_budget_minimum'),
                'divisa_budget_maximum' => $request->input('divisa_budget_maximum'),
                'description' => $request->input('description'),
            ];
            
            PostUsers::create($query);
            return response()->json(['valid' => true, 'message' => 'post wass created successfully'],200);
        }

    }
}
