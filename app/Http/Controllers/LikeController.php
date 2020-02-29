<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Carbon\Carbon;

class LikeController extends Controller
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
    public function store(Request $request)
    {
        if (is_null(auth('pelanggan')->user()))
        {
            return redirect()->route('masuk')->with('login', 'Harus Login Terlebih Dahulu');
        }
        $exists = Like::where('id_pelanggan', $request->id_pelanggan)->where('id_produk', $request->id_produk)->exists();
        // dd($exists);
        if($exists == true){
            $tgl = Date('Y-m-d h:i:s');
            $id = $request->id_like;
            // dd($id);
            $like = Like::find($id);
            $like->status = '1';
            $like->created_at = $tgl;
            $like->updated_at = $tgl;
            $like->update();  
            return redirect()->back();
        }else{
            $like = new Like();
            $like->id_pelanggan = $request->get('id_pelanggan');
            $like->id_produk = $request->get('id_produk');
            $like->save();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(Request $request, $id)
    {   
        $like = Like::find($id);
        $like->status = '0';
        $like->update();
        
        return redirect()->back();
    }
}
