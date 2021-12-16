<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index(){
        $review = Review::all();

        if(count($review)>0){
            return response ([
                'message' => 'Retrieve All Review Success',
                'data' => $review
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id){
        $review = Review::find($id);

        if(!is_null($review)){
            return response ([
                'message' => 'Retrieve Review Success',
                'data' => $review
            ],200);
        }

        return response([
            'message' => 'Review Not Found',
            'data' => null
        ],404);
    }

    public function store (Request $request){
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'namaReview' => 'required|regex:/^[\pL\s]+$/u',
            'isiReview' => 'required',
            'jmlBintang' => 'required|numeric|min:1|max:5',
            'email' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
            $review = Review::create($storeData);
            return response([
                'message' => 'Add Review Success',
                'data' => $review
            ],200);
    }

    public function destroy($id){
        $review = Review::find($id);

        if (is_null($review)) {
            return response([
                'message' => 'Review Not Found',
                'data' => null
            ],404);
        }

        if($review->delete()) {
            return response([
                'message' => 'Delete Review Success',
                'data' => $review
            ],200);
        }

        return response([
            'message' => 'Delete Review Failed',
            'data' => null,
        ],400);
    }

    public function update(Request $request, $id){
        $review = Review::find($id);
        if(is_null($review)){
            return response([
                'message' => 'Review Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'namaReview' => 'required|regex:/^[\pL\s]+$/u',
            'isiReview' => 'required',
            'jmlBintang' => 'required|numeric|min:1|max:5'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $review->namaReview = $updateData['namaReview'];
        $review->isiReview = $updateData['isiReview'];
        $review->jmlBintang = $updateData['jmlBintang'];

        if($review->save()){
            return response([
                'message' => 'Update Review Success',
                'data' => $review
            ], 200);
        }

        return response([
            'message' => 'Update Review Success',
            'data' => null,
        ], 400);
    }
}
