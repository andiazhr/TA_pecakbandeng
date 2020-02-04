<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kegiatan;
use App\Models\ProdukKegiatan;

class produkkegiatanController extends Controller
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
        $data = ProdukKegiatan::when($request->search, function ($query) use ($request) {
            $query->where('nama_kegiatan', 'like', "%{$request->search}%");
        })->paginate(5);
        $datakegiatan = Kegiatan::all();
        $dataproduk = Produk::all();
        return view('produk_kegiatan.index', compact('data', 'datakegiatan', 'dataproduk'));
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
        $datakegiatan = Kegiatan::all();
        $dataproduk = Produk::all();
        $data = ProdukKegiatan::find($id);
        return view('produk_kegiatan.edit', compact('data', 'datakegiatan', 'dataproduk'));
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
        $data = ProdukKegiatan::find($id);
        $get_kegiatan = $request->id_kegiatan;
        $explode = explode("|",$get_kegiatan);
        $id_kegiatan = $explode[0];

        $data->id_kegiatan = $request->get('id_kegiatan');
        $data->id_produk = $request->get('id_produk');
        $data->discount = $request->get('discount');
        $data->update();
        return redirect()->to('/kegiatan/addprodukkegiatan/'. $id_kegiatan)->with('success', 'Data diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produkkegiatan = ProdukKegiatan::find($id);
        $id = $produkkegiatan->id_kegiatan;
        $produkkegiatan->delete();

        return redirect()->to('/kegiatan/addprodukkegiatan/'. $id)->with('success', 'Data dihapus');
    }
}
