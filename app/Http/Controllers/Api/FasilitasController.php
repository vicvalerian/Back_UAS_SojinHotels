<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Fasilitas;

class FasilitasController extends Controller
{
    public function index(){
        $fasilitas = Fasilitas::all();

        if(count($fasilitas)>0){
            return response ([
                'message' => 'Retrieve All Fasilitas Success',
                'data' => $fasilitas
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function indexByEmail($email){
        $fasilitas = Fasilitas::where('email', $email)->get();

        if(count($fasilitas)>0){
            return response ([
                'message' => 'Retrieve All Fasilitas Success',
                'data' => $fasilitas
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id){
        $fasilitas = Fasilitas::find($id);

        if(!is_null($fasilitas)){
            return response ([
                'message' => 'Retrieve Fasilitas Success',
                'data' => $fasilitas
            ],200);
        }

        return response([
            'message' => 'Fasilitas Not Found',
            'data' => null
        ],404);
    }

    public function store (Request $request){
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'barang' => 'required',
            'jmlBarang' => 'required|numeric|min:1',
            'biayaBarang' => 'required',
            'email' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
            $fasilitas = Fasilitas::create($storeData);
            return response([
                'message' => 'Add Fasilitas Success',
                'data' => $fasilitas
            ],200);
    }

    public function destroy($id){
        $fasilitas = Fasilitas::find($id);

        if (is_null($fasilitas)) {
            return response([
                'message' => 'Fasilitas Not Found',
                'data' => null
            ],404);
        }

        if($fasilitas->delete()) {
            return response([
                'message' => 'Delete Fasilitas Success',
                'data' => $fasilitas
            ],200);
        }

        return response([
            'message' => 'Delete Fasilitas Failed',
            'data' => null,
        ],400);
    }

    public function update(Request $request, $id){
        $fasilitas = Fasilitas::find($id);
        if(is_null($fasilitas)){
            return response([
                'message' => 'Fasilitas Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'barang' => 'required',
            'jmlBarang' => 'required|numeric|min:1',
            'biayaBarang' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $fasilitas->barang = $updateData['barang'];
        $fasilitas->jmlBarang = $updateData['jmlBarang'];
        $fasilitas->biayaBarang = $updateData['biayaBarang'];

        if($fasilitas->save()){
            return response([
                'message' => 'Update Fasilitas Success',
                'data' => $fasilitas
            ], 200);
        }

        return response([
            'message' => 'Update Fasilitas Success',
            'data' => null,
        ], 400);
    }
}
