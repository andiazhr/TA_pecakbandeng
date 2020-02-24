<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pendpPerHari;
use App\Models\pendpPerBulan;
use App\Models\pendpPerTahun;
use DB;

class pendapatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pendpPerHari(Request $request)
    {
        $data = pendpPerHari::all();
        return view('pendapatan.pendapatanperhari.index', compact('data'));
    }

    public function searchtotalpendpPerHari(Request $request)
    {
        // $tgl = $request->get('bulan');
        $input = $request->get('tanggal');
        $tanggal = date('Y-m', strtotime($input));
        $data = pendpPerHari::all();
        $totalBlnIni = DB::select("SELECT MONTHNAME(created_at) AS bulan, YEAR(created_at) AS tahun, SUM(total_pendpperhari) AS total_pendpBulanan FROM `pendpperhari` WHERE SUBSTRING(created_at, 1, 7) = '$tanggal'");
        // $totalBlnIni2 = pendpPerHari::select(DB::raw("MONTHNAME(CREATED_at) as bulan, SUM(total_pendpperhari) AS total_pendpBulanan"))->where(DB::raw("SUBSTRING(created_at, 1, 7) = '$tanggal'"))->get();
        // dd($totalBlnIni);
        return view('pendapatan.pendapatanperhari.index', compact('data', 'totalBlnIni'));
    }

    public function destroypendpPerHari($id)
    {
        $pendpPerHari = pendpPerHari::find($id);
        $pendpPerHari->delete();

        return redirect()->to('/Pendapatan/pendpPerHari')->with('success', 'Data dihapus');
    }

    public function pendpPerBulan(Request $request)
    {
        // $data = pendpPerBulan::when($request->search, function ($query) use ($request) {
        //     $query->where('nama_produk', 'like', "%{$request->search}%");
        // })->get();
        // $data = DB::select("SELECT id_pendpPerBulan, CONCAT(MONTHNAME(bulan), '-', YEAR(bulan)) AS tahun, total_pendpperbulan FROM `pendpperbulan`");
        $data = DB::select("SELECT id_pendpPerBulan, bulan, total_pendpperbulan FROM `pendpperbulan`");
        return view('pendapatan.pendapatanperbulan.index', compact('data'));
    }

    public function storependpPerBulan(Request $request){
        $input = $request->get('bulan');
        $tanggal = date('Y-m-d', strtotime($input));
        $pendpBulanan = new pendpPerBulan();
        $pendpBulanan->bulan = $tanggal;
        $pendpBulanan->total_pendpperbulan = $request->get('total_pendpBulanan');
        $pendpBulanan->save();
        return redirect()->to('/Pendapatan/pendpPerBulan')->with('success', 'Data ditambahkan');
    }

    public function searchtotalpendpPerBulan(Request $request)
    {
        // $tgl = $request->get('bulan');
        $input = $request->get('tanggal');
        $tanggal = date('Y', strtotime($input));
        // dd($tanggal);
        $data = DB::select("SELECT id_pendpPerBulan, CONCAT(MONTHNAME(bulan), '-', YEAR(bulan)) AS tahun, total_pendpperbulan FROM `pendpperbulan`");
        $totalBlnIni = DB::select("SELECT YEAR(bulan) AS tahun, SUM(total_pendpperbulan) as total_pendptahunan FROM `pendpperbulan` WHERE bulan LIKE '%$tanggal%'");
        // dd($totalBlnIni);
        return view('pendapatan.pendapatanperbulan.index', compact('data', 'totalBlnIni'));
    }

    public function destroypendpPerBulan($id)
    {
        $pendpPerBulan = pendpPerBulan::find($id);
        $pendpPerBulan->delete();

        return redirect()->to('/Pendapatan/pendpPerBulan')->with('success', 'Data dihapus');
    }

    public function storependpPerTahun(Request $request){
        $pendpTahun = new pendpPerTahun();
        $pendpTahun->tahun = $request->get('tahun');
        $pendpTahun->total_pendppertahun = $request->get('total_pendptahunan');
        $pendpTahun->save();
        return redirect()->to('/Pendapatan/pendpPerTahun')->with('success', 'Data ditambahkan');
    }

    public function pendpPerTahun(Request $request)
    {
        $data = pendpPerTahun::when($request->search, function ($query) use ($request) {
            $query->where('tahun', 'like', "%{$request->search}%");
        })->get();
        return view('pendapatan.pendapatanpertahun.index', compact('data'));
    }

    public function destroypendpPerTahun($id)
    {
        $pendpPerTahun = pendpPerTahun::find($id);
        $pendpPerTahun->delete();

        return redirect()->to('/Pendapatan/pendpPerTahun')->with('success', 'Data dihapus');
    }
}
