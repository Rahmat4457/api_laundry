<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Outlet;

class OutletController extends Controller
{
    public function insert(Request $request){
        $validator = Validator::make($request->all(),['nama_outlet'=>'required|string']);

        if($validator->fails()){
            return response()->json([
                'success'=>'false',
                'message'=>$validator->errors(),
            ]);
        }

        $outlet=new Outlet();

        $outlet -> nama_outlet = $request->nama_outlet;
        $outlet->save();

        $data = Outlet::where('id_outlet','=',$outlet->id_outlet)->first();

        return response()->json([
            'success'=>'true',
            'message'=>'Data Outlet Berhasil Ditambahkan',
            'data'=>$data,
        ]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'nama_outlet'=>'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ]);
        }

        $user = Outlet::where('id_outlet',$id)->first();
        $user->nama_outlet = $request->nama_outlet;
        $user->save();

        return response()->json([
            'success'=>true,
            'message'=>'Data outlet berhasil diubah'
        ]);
    }

    public function delete($id){
        $delete = Outlet::where('id_outlet',$id)->delete();

        if($delete){
            return response()->json([
                'success'=>true,
                'message'=>'data outlet berhasil dihapus'
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'data outlet gagal dihapus'
            ]);
        }
    }

    public function getAll(){
        $data["count"] = Outlet::count();
        $data["outlet"] = Outlet::get();

        return response()->json([
            'success'=>true,
            'data'=>$data
        ]);
    }

    public function getById($id){
        $data = Outlet::where('id_outlet',$id)->first();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }   
}