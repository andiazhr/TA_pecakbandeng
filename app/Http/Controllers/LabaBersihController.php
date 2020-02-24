<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabaBersih;
use App\Models\Pengeluaran;
Use DB;

class LabaBersihController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data = LabaBersih::when($request->search, function ($query) use ($request) {
            $query->where('nama_barang', 'like', "%{$request->search}%");
        })->get();
        return view('laba_bersih.index', compact('data'));
    }

    public function searchtotalLabaBersih(Request $request)
    {
        $data = LabaBersih::when($request->search, function ($query) use ($request) {
            $query->where('nama_barang', 'like', "%{$request->search}%");
        })->get();
        $input = $request->get('tanggal');
        $tanggal = date('Y-m', strtotime($input));
        $totalPendp = DB::select("SELECT MONTHNAME(bulan) AS bulan, SUM(total_pendpperbulan) AS total FROM `pendpperbulan` WHERE SUBSTRING(bulan, 1, 7) = '$tanggal'");
        $totalPengeluaran = DB::select("SELECT MONTHNAME(tanggal) AS bulan, SUM(total) AS total FROM `pengeluaran` WHERE SUBSTRING(tanggal, 1, 7) = '$tanggal'");
        return view('laba_bersih.index', compact('data', 'totalPendp', 'totalPengeluaran'));
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
        $input = $request->get('tanggal');
        $tanggal = date('Y-m-d', strtotime($input));
        $lababersih = new LabaBersih();
        $lababersih->tanggal = $tanggal;
        $lababersih->total = $request->get('total');
        $lababersih->save();
        return redirect('labaBersih')->with('success', 'Data berhasil ditambahkan');
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
        $lababersih = LabaBersih::find($id);
        return view('laba_bersih.edit', compact('lababersih'));
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
        $lababersih = LabaBersih::find($id);
        $lababersih->tanggal = $request->get('tanggal');
        $lababersih->total = $request->get('total');
        $lababersih->update();
        return redirect('labaBersih')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lababersih = LabaBersih::find($id);
        $lababersih->delete();
        
        return redirect()->back();
    }
}
