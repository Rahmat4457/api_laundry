<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Paket;

class PaketController extends Controller
{
    public function insert(Request $request){
        $validator = Validator::make($request->all(),[
            'jenis'=>'required',
            'harga'=>'required|integer']);

        if($validator->fails()){
            return response()->json([
                'success'=>'false',
                'message'=>$validator->errors(),
            ]);
        }

        $paket=new Paket();

        $paket -> jenis = $request->jenis;
        $paket -> harga = $request->harga;
        $paket->save();

        $data = Paket::where('id_paket','=',$paket->id_paket)->first();

        return response()->json([
            'success'=>'true',
            'message'=>'Data paket Berhasil Ditambahkan',
            'data'=>$data,
        ]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'jenis'=>'required',
            'harga'=>'required|integer'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ]);
        }

        $paket = Paket::where('id_paket',$id)->first();
        $paket->jenis = $request->jenis;
        $paket -> harga = $request->harga;
        $paket->save();

        return response()->json([
            'success'=>true,
            'message'=>'Data paket berhasil diubah'
        ]);
    }

    public function delete($id){
        $delete = Paket::where('id_paket',$id)->delete();

        if($delete){
            return response()->json([
                'success'=>true,
                'message'=>'data paket berhasil dihapus'
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'data paket gagal dihapus'
            ]);
        }
    }

    public function getAll(){
        $data["count"] = paket::count();
        $data["paket"] = paket::get();

        return response()->json([
            'success'=>true,
            'data'=>$data
        ]);
    }

    public function getById($id){
        $data["paket"] = Paket::where('id_paket',$id)->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
}
}
