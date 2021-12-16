<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Kamar;

class KamarController extends Controller
{
    public function index(){
        $kamar = Kamar::all();

        if(count($kamar)>0){
            return response ([
                'message' => 'Retrieve All Reservasi Kamar Success',
                'data' => $kamar
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function indexByEmail($email){
        $kamar = Kamar::where('email', $email)->get();

        if(count($kamar)>0){
            return response ([
                'message' => 'Retrieve All Reservasi Kamar Success',
                'data' => $kamar
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id){
        $kamar = Kamar::find($id);

        if(!is_null($kamar)){
            return response ([
                'message' => 'Retrieve Reservasi Kamar Success',
                'data' => $kamar
            ],200);
        }

        return response([
            'message' => 'Reservasi Kamar Not Found',
            'data' => null
        ],404);
    }

    public function store (Request $request){
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'nama' => 'required|regex:/^[\pL\s]+$/u',
            'nik' => 'required|numeric|digits:9',
            'noTelp' => 'required|numeric|digits_between:0,13|starts_with:08',
            'tipeKamar' => 'required',
            'biayaKamar' => 'required',
            'email' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
            $kamar = Kamar::create($storeData);
            return response([
                'message' => 'Add Reservasi Kamar Success',
                'data' => $kamar
            ],200);
    }

    public function destroy($id){
        $kamar = Kamar::find($id);

        if (is_null($kamar)) {
            return response([
                'message' => 'Reservasi Kamar Not Found',
                'data' => null
            ],404);
        }

        if($kamar->delete()) {
            return response([
                'message' => 'Delete Reservasi Kamar Success',
                'data' => $kamar
            ],200);
        }

        return response([
            'message' => 'Delete Reservasi Kamar Failed',
            'data' => null,
        ],400);
    }

    public function update(Request $request, $id){
        $kamar = Kamar::find($id);
        if(is_null($kamar)){
            return response([
                'message' => 'Reservasi Kamar Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama' => 'required|regex:/^[\pL\s]+$/u',
            'nik' => 'required|numeric|digits:9',
            'noTelp' => 'required|numeric|digits_between:0,13|starts_with:08',
            'tipeKamar' => 'required',
            'biayaKamar' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $kamar->nama = $updateData['nama'];
        $kamar->nik = $updateData['nik'];
        $kamar->noTelp = $updateData['noTelp'];
        $kamar->tipeKamar = $updateData['tipeKamar'];
        $kamar->biayaKamar = $updateData['biayaKamar'];

        if($kamar->save()){
            return response([
                'message' => 'Update Reservasi Kamar Success',
                'data' => $kamar
            ], 200);
        }

        return response([
            'message' => 'Update Reservasi Kamar Success',
            'data' => null,
        ], 400);
    }
}
