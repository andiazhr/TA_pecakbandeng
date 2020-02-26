<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rating;
use App\Models\Like;
use App\Models\Review;
use DB;

class AdminController extends Controller
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
        //
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
    public function destroy($id)
    {
        //
    }

    public function profile(Request $request, $id)
    {
        // $id = $request->segment(3);
        $groupdaterating = DB::select("SELECT CONCAT(DAY(SUBSTRING(created_at,1 ,10)), ' ', MONTHNAME(SUBSTRING(created_at,1 ,10)), ' ',YEAR(SUBSTRING(created_at,1 ,10))) AS tanggal FROM `rating` GROUP BY SUBSTRING(created_at,1 ,10) ORDER BY id_rating ASC");
        $grouprating = DB::select("SELECT users_pelanggan.nama_pelanggan, produk.nama_produk, nilai, CONCAT(DAY(SUBSTRING(rating.created_at,1 ,10)), ' ', MONTHNAME(SUBSTRING(rating.created_at,1 ,10)), ' ',YEAR(SUBSTRING(rating.created_at,1 ,10))) AS tanggal, rating.created_at FROM `users_pelanggan` JOIN `rating` USING(id_pelanggan) JOIN `produk` USING(id_produk) WHERE rating.status = '1' ORDER BY id_rating DESC");
        $groupdatelike = DB::select("SELECT CONCAT(DAY(SUBSTRING(created_at,1 ,10)), ' ', MONTHNAME(SUBSTRING(created_at,1 ,10)), ' ',YEAR(SUBSTRING(created_at,1 ,10))) AS tanggal FROM `like` GROUP BY SUBSTRING(created_at,1 ,10) ORDER BY id_like ASC");
        $grouplike = DB::select("SELECT users_pelanggan.nama_pelanggan, produk.nama_produk, CONCAT(DAY(SUBSTRING(like.created_at,1 ,10)), ' ', MONTHNAME(SUBSTRING(like.created_at,1 ,10)), ' ',YEAR(SUBSTRING(like.created_at,1 ,10))) AS tanggal, like.created_at FROM `users_pelanggan` JOIN `like` USING(id_pelanggan) JOIN `produk` USING(id_produk) WHERE like.status = '1' ORDER BY id_like DESC");
        $groupdatereview = DB::select("SELECT CONCAT(DAY(SUBSTRING(created_at,1 ,10)), ' ', MONTHNAME(SUBSTRING(created_at,1 ,10)), ' ',YEAR(SUBSTRING(created_at,1 ,10))) AS tanggal FROM `review` GROUP BY SUBSTRING(created_at,1 ,10) ORDER BY id_review ASC");
        $groupreview = DB::select("SELECT users_pelanggan.nama_pelanggan, produk.nama_produk, review.review, CONCAT(DAY(SUBSTRING(review.created_at,1 ,10)), ' ', MONTHNAME(SUBSTRING(review.created_at,1 ,10)), ' ',YEAR(SUBSTRING(review.created_at,1 ,10))) AS tanggal, review.created_at FROM `users_pelanggan` JOIN `review` USING(id_pelanggan) JOIN `produk` USING(id_produk) ORDER BY id_review DESC");
        // dd($groupdaterating);

        $rating = Rating::where('status', '1')->orderBY('id_rating', 'DESC')->limit(10)->get();
        $like = Like::where('status', '1')->orderBY('id_like', 'DESC')->limit(10)->get();
        $review = Review::orderBY('id_review', 'DESC')->limit(10)->get();
        $profil = User::find($id);
        return view('layouts.profil', compact('profil', 'groupdaterating', 'grouprating', 'rating', 'groupdatelike', 'grouplike', 'like', 'groupdatereview', 'groupreview', 'review'));
    }
}
