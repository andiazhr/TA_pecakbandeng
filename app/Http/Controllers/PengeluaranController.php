<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
Use DB;

class PengeluaranController extends Controller
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
        $data = Pengeluaran::when($request->search, function ($query) use ($request) {
            $query->where('nama_barang', 'like', "%{$request->search}%");
        })->get();
        return view('pengeluaran.index', compact('data'));
    }

    public function searchtotalPengeluaran(Request $request)
    {
        $input = $request->get('tanggal');
        $tanggal = date('Y-m', strtotime($input));
        $data = Pengeluaran::all();
        $totalBlnIni = DB::select("SELECT MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun, SUM(total) AS total FROM `pengeluaran` WHERE SUBSTRING(tanggal, 1, 7) = '$tanggal'");
        return view('pengeluaran.index', compact('data', 'totalBlnIni'));
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
        $pengeluaran = new Pengeluaran();
        $pengeluaran->nama_barang = $request->get('nama_barang');
        $pengeluaran->tanggal = $tanggal;
        $pengeluaran->total = $request->get('total');
        $pengeluaran->save();
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
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
        $pengeluaran = Pengeluaran::find($id);
        return view('pengeluaran.edit', compact('pengeluaran'));
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
        $input = $request->get('tanggal');
        $tanggal = date('Y-m-d', strtotime($input));
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->nama_barang = $request->get('nama_barang');
        $pengeluaran->tanggal = $tanggal;
        $pengeluaran->total = $request->get('total');
        $pengeluaran->update();
        return redirect('pengeluaran')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();
        
        return redirect()->back();
    }
}
