<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if (is_null(auth()->user()))
        {
            return redirect()->route('login')->with('login', 'Harus Login Terlebih Dahulu');
        }
        $data = Review::all();
        return view('review.index', compact('data'));
    }

    public function status(Request $request, $id)
    {
        if (is_null(auth()->user()))
        {
            return redirect()->route('login')->with('login', 'Harus Login Terlebih Dahulu');
        }
        $review = Review::find($id);
        $review->status = $request->get('status');
        $review->update();
        return redirect()->back();
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

        $exists = Review::where('id_pelanggan', $request->id_pelanggan)->where('id_produk', $request->id_produk)->exists();
        // dd($request->id_produk);
        if($exists == true){
            $tgl = Date('Y-m-d h:i:s');
            $id = $request->id_review;
            // dd($id);
            $review = Review::find($id);
            $review->id_pelanggan = $request->get('id_pelanggan');
            $review->id_produk = $request->get('id_produk');
            $review->review = $request->get('review');
            $review->created_at = $tgl;
            $review->updated_at = $tgl;
            $review->update();
            return redirect()->back();
        }else{
            $review = new Review();
            $review->id_pelanggan = $request->get('id_pelanggan');
            $review->id_produk = $request->get('id_produk');
            $review->review = $request->get('review');
            $review->save();
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
        $id = $request->get('id_review_edit');
        $review = Review::find($id);
        $review->id_pelanggan = $request->get('id_pelanggan_edit');
        $review->id_produk = $request->get('id_produk_edit');
        $review->review = $request->get('review_edit');
        $review->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = $request->get('id_review_delete');
        $review = Review::find($id);
        $review->status = '0';
        $review->update();
        
        return redirect()->back();
    }
}
