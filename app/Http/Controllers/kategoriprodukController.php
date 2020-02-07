<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriProduk;

class kategoriprodukController extends Controller
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
        $data = KategoriProduk::when($request->search, function ($query) use ($request) {
            $query->where('nama_kategori', 'like', "%{$request->search}%");
        })->paginate(5);
        return view('kategori_produk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori_produk.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required'
        ]);

        $exists = KategoriProduk::where('nama_kategori', $request->nama_kategori)->exists();
        
        if($exists == true){
            return redirect('/kategoriProduk')->with(['fail' => 'Nama kategori telah dimasukkan']);
        }

        $kategori = new KategoriProduk([
            'nama_kategori' => $request->get('nama_kategori'),
            'status' => $request->get('status')
          ]);
        $kategori->save();
        return redirect()->to('/kategoriProduk')->with('success', 'Data ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, $id)
    {
        $kategori = KategoriProduk::find($id);
        $kategori->status = $request->get('status');
        $kategori->update();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data = KategoriProduk::when($request->search, function ($query) use ($request) {
            $query->where('nama_kategori', 'like', "%{$request->search}%");
        })->paginate(5);
        $kategori = KategoriProduk::find($id);
        return view('kategori_produk.edit', compact('kategori', 'data'));
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
        $kategori = KategoriProduk::find($id);
        $kategori->nama_kategori = $request->get('nama_kategori');
        $kategori->status = $request->get('status');
        $kategori->update();
        return redirect()->to('/kategoriProduk')->with('success', 'Data diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = KategoriProduk::find($id);
        $kategori->delete();

        return redirect('kategoriProduk')->with('success', 'Data dihapus');
    }
}
