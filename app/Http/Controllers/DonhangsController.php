<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use JWTAuth;
use App\User;
use App\Chitietdonhangs;
use App\Magiamgias;
use App\Donhangs;
class DonhangsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //them don hang
    public function store(Request $request)
    {
        //insert đơn hàng
        $giohangs = $request->giohangs;
        $thongtin = $request->thongtin;
       // return response()->json(['success'=>$giohangs,'results'=>$thongtin]);
        $donhang = new Donhangs;
        $donhang->user_id=$thongtin[0]['userId'];
        $donhang->magiamgias_id=$thongtin[0]['magiamgia'];

        $ma = explode(" ",$thongtin[0]['tenkh']);
        $length = count($ma);
        $tenkh = strtoupper($ma[$length-1]);
        $kytu = substr($tenkh,0,1);

        $donhang->madonhang=$kytu."-".$thongtin[0]['userId']."-".time();
        $donhang->tenkh=$thongtin[0]['tenkh'];
        $donhang->diachi=$thongtin[0]['diachi'];
        $donhang->sodienthoai=$thongtin[0]['sodienthoai'];
        $donhang->save();
        $lastInsertedId = $donhang->id;//id insert
       // $t="";
       foreach($giohangs as $value){
           $chitietdonhang = new Chitietdonhangs;
           $chitietdonhang->donhangs_id=$lastInsertedId;
           $chitietdonhang->sochitiet=time()+$lastInsertedId;
           $chitietdonhang->masp =$value['idProduct'];
           $chitietdonhang->tensp = $value['nameProduct'];
           $chitietdonhang->hinh = $value['image'];
           $chitietdonhang->giasp = $value['price'];
           $chitietdonhang->soluong = $value['soluong'];
           $chitietdonhang->tongtien = $value['soluong']*$value['price'];
           $chitietdonhang->save();
          //$t.=$value['nameProduct']."/".$value['price']."/".$value['soluong'];
       }
       if(isset($lastInsertedId) && $lastInsertedId>0){
          return response()->json(['success'=>1,'madonhang'=>$lastInsertedId]);
       }
       else{
          return response()->json(['success'=>0]);
       }
      


    }
    public function chitietdonhang(Request $request)
    {
        $madonhang = $request->madonhang;
        //$madonhang=$id;
        $chitiet = array();
        $chitiet['thongtin'] = Donhangs::find($madonhang)->user;
        $chitiet['donhang'] = Donhangs::find($madonhang);
        $chitiet['chitiet'] = Donhangs::find($madonhang)->chitietdonhang;
        $chitiet['magiamgia'] = Donhangs::find($madonhang)->magiamgias;
       // echo print_r($chitiet2);
        //echo $chitiet2->magiamgia->soluong;
        //$chitiet = Donhangs::find($madonhang)->chitietdonhang;
       // foreach($chitiet2->magiamgia as $value){
           // echo $value->id;
       // }
        return response()->json(['success'=>$chitiet]);

    }

    //magiamgia
    public function magiamgia(Request $request){
        $magiam = $request->magiamgia;
        $check_ma = $request->check_ma;
        $ma = Magiamgias::where('magiamgia',$magiam)->where('soluong','>',0)->count();
        if($ma>0){
            $data = Magiamgias::where('magiamgia',$magiam)->where('soluong','>',0)->get();
            if($check_ma>0){
                    $data[0]->soluong=$data[0]->soluong-1;
                    $data[0]->save();
            }else{
                    $data[0]->soluong=$data[0]->soluong+1;
                    $data[0]->save();
            }
            return response()->json(['success'=>($check_ma>0?1:0),'phantram'=>$data[0]->phantram,'magiamgia'=>$data[0]->magiamgia,'idma'=>$data[0]->id]);
        }
        else{
            return response()->json(['success'=>-1]);
        }
    }

    public function listsdonhang(Request $request){
        $userId = $request->userId;
        $donhang = Donhangs::where("user_id",$userId)->get();
        return response()->json($donhang);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donhangs_id = $id;
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
