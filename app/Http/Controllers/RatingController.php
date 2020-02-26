<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
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

        $exists = Rating::where('id_pelanggan', $request->id_pelanggan)->where('id_produk', $request->id_produk)->exists();
        // dd($request->id_produk);
        if($exists == true){
            $id = $request->id_rating;
            // dd($id);
            $rating = Rating::find($id);
            $rating->nilai = $request->get('nilai');
            $rating->status = '1';
            $rating->update();        
            return redirect()->back();
        }else{
            $rating = new Rating();
            $rating->id_pelanggan = $request->get('id_pelanggan');
            $rating->id_produk = $request->get('id_produk');
            $rating->nilai = $request->get('nilai');
            $rating->save();
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
        $id = $request->get('id_rating');
        $rating = Rating::find($id);
        $rating->status = '0';
        $rating->update();
        
        return redirect()->back();
    }
}
