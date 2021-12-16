<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $user = User::all();

        if(count($user)>0){
            return response ([
                'message' => 'Retrieve All User Success',
                'data' => $user
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id){
        $user = User::find($id);

        if(!is_null($user)){
            return response ([
                'message' => 'Retrieve User Success',
                'data' => $user
            ],200);
        }

        return response([
            'message' => 'Reservasi User Not Found',
            'data' => null
        ],404);
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        if(is_null($user)){
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'name' => 'required|max:60',
            'noTelp' => 'required|numeric|digits_between:0,13|starts_with:08'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $user->name = $updateData['name'];
        $user->noTelp = $updateData['noTelp'];

        if($user->save()){
            return response([
                'message' => 'Update User Success',
                'data' => $user
            ], 200);
        }

        return response([
            'message' => 'Update User Success',
            'data' => null,
        ], 400);
    }
}
