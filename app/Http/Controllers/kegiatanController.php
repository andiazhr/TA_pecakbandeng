<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kegiatan;
use App\Models\ProdukKegiatan;

class kegiatanController extends Controller
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
        $data = Kegiatan::when($request->search, function ($query) use ($request) {
            $query->where('nama_kegiatan', 'like', "%{$request->search}%");
        })->paginate(5);
        return view('kegiatan.index', compact('data'));
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
        // $this->validate($request, [
        //     'nama_kegiatan' => 'required|unique:kegiatan'
        // ]);

        $exists = Kegiatan::where('nama_kegiatan', $request->nama_kegiatan)->exists();
        
        if($exists == true){
            return redirect('/kegiatan')->with(['fail' => 'Nama kegiatan telah dimasukkan']);
        }
        
        $input = $request->get('periode_awal');
        $input2 = $request->get('periode_akhir');
        $periode_awal = date('Y-m-d', strtotime($input));
        $periode_akhir = date('Y-m-d', strtotime($input2));

        $kegiatan = new Kegiatan([
            'nama_kegiatan' => $request->get('nama_kegiatan'),
            'deskripsi' => $request->get('deskripsi'),
            'periode_awal' => $periode_awal,
            'periode_akhir' => $periode_akhir,
          ]);
        $kegiatan->save();
        return redirect()->to('/kegiatan')->with('success', 'Data ditambahkan');
    }

    public function createProdukKegiatan(Request $request)
    {
        $get_url = $request->segment(3);
        $data = ProdukKegiatan::where('id_kegiatan', $get_url)->get();
        $datakegiatan = Kegiatan::all();
        $dataproduk = Produk::all();
        return view('produk_kegiatan.index', compact('data', 'datakegiatan', 'dataproduk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProdukKegiatan(Request $request)
    {
        $url_id = $request->segment(3);
        $get_kegiatan = $request->id_kegiatan;
        $explode = explode("|",$get_kegiatan);
        $id_kegiatan = $explode[0];
        
        $get_produk = $request->id_produk;
        $explode2 = explode("|",$get_produk);
        $id_produk = $explode2[0];

        $exists = ProdukKegiatan::where('id_kegiatan', $id_kegiatan)->where('id_produk', $id_produk)->exists();
        
        if($exists == true){
            return redirect()->to('/kegiatan/addprodukkegiatan/'.$id_kegiatan)->with(['fail' => 'Nama kegiatan dan nama produk telah dimasukkan']);
        }

        $input = $request->get('discount');
        if ($input < 0){
            return redirect()->to('/kegiatan/addprodukkegiatan/'.$id_kegiatan)->with(['fail' => 'Nilai diskon tidak bisa dibawah 0']);
        } elseif ($input > 100){
            return redirect()->to('/kegiatan/addprodukkegiatan/'.$id_kegiatan)->with(['fail' => 'Nilai diskon tidak bisa diatas 100']);
        }
        
        $produkkegiatan = new ProdukKegiatan([
            'id_kegiatan' => $id_kegiatan,
            'id_produk' => $id_produk,
            'discount' => $request->get('discount')
          ]);  
        $produkkegiatan->save();

        return redirect()->to('/kegiatan/addprodukkegiatan/'.$id_kegiatan)->with(['success' => 'Data ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $get_kegiatan = $request->segment(3);
        $data = Kegiatan::find($id);
        $data2 = ProdukKegiatan::where('id_kegiatan', $get_kegiatan)->get();
        return view('kegiatan.detail', compact('data', 'data2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kegiatan = Kegiatan::find($id);
        return view('kegiatan.edit', compact('kegiatan', 'data'));
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
        $input = $request->get('periode_awal');
        $input2 = $request->get('periode_akhir');
        $periode_awal = date('Y-m-d', strtotime($input));
        $periode_akhir = date('Y-m-d', strtotime($input2));

        $kegiatan = Kegiatan::find($id);
        $kegiatan->nama_kegiatan = $request->get('nama_kegiatan');
        $kegiatan->deskripsi = $request->get('deskripsi');
        $kegiatan->periode_awal = $periode_awal;
        $kegiatan->periode_akhir = $periode_akhir;
        $kegiatan->update();
        return redirect()->to('/kegiatan')->with('success', 'Data diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kegiatan = Kegiatan::find($id);
        $kegiatan->delete();

        return redirect('kegiatan')->with('success', 'Data dihapus');
    }
}
