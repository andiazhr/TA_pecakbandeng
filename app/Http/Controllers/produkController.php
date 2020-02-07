<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\KategoriProduk;
use App\Models\Stok;

class produkController extends Controller
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
        $data = Produk::when($request->search, function ($query) use ($request) {
            $query->where('nama_produk', 'like', "%{$request->search}%");
        })->paginate(5);
        return view('produk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = KategoriProduk::all();
        $stok = Stok::all();
        return view('produk.add', compact('data', 'stok'));
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
            // 'nama_produk'=> 'required|unique:produk',
            'gambar_produk' => 'required',
            'gambar_produk.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'deskripsi_produk' => 'required',
            'harga_produk' => 'required|integer',
        ]);

        $exists = Produk::where('nama_produk', $request->nama_produk)->exists();
        
        if($exists == true){
            return redirect('produk/add')->with(['fail' => 'Nama produk telah dimasukkan']);
        }

        if($request->hasfile('gambar_produk'))
        {
           foreach($request->file('gambar_produk') as $image)
           {
               $gambar=$image->getClientOriginalName();
               $image->move(public_path().'/imageforuser/menu', $gambar);  
           }
        }

        if($request->get('id_kategori') == NULL){
            return redirect('produk/add')->with('error', 'Pilih Kategori Produk');
        }
        elseif($request->get('id_kategori') != NULL){
            $get_id = $request->get('id_kategori');
            $explode = explode("|",$get_id);
            $id_kategori = $explode[0];
            $nama_kategori = $explode[1];
            
            $produk = new Produk([
                'nama_produk' => $request->get('nama_produk'),
                'id_kategori'=> $id_kategori,
                'id_stok'=> $request->get('id_stok'),
                'gambar_produk'=> $gambar,
                'deskripsi_produk'=> $request->get('deskripsi_produk'),
                'harga_produk'=> $request->get('harga_produk'),
            ]);

            $produk->save();
            
        }

        return redirect('produk')->with('success', 'Data Ditambahkan');
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
        $data = KategoriProduk::all();
        $produk = Produk::find($id);
        return view('produk.edit', compact('produk', 'data'));
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
        $produk = Produk::find($id);
        if(empty($request->hasfile('foto_profil')))
        {
            $produk->nama_produk = $request->get('nama_produk');
            $produk->id_kategori = $request->get('id_kategori');
            $produk->id_stok = $request->get('id_stok');
            $produk->deskripsi_produk = $request->get('deskripsi_produk');
            $produk->harga_produk = $request->get('harga_produk');
            $produk->update();
        }

        if($request->hasfile('gambar_produk'))
        {
            unlink(public_path().'/imageforuser/menu/'. $produk->gambar_produk);
            foreach($request->file('gambar_produk') as $image)
            {
                $gambar=$image->getClientOriginalName();
                $image->move(public_path().'/imageforuser/menu', $gambar);  
            }
            $produk->nama_produk = $request->get('nama_produk');
            $produk->id_kategori = $request->get('id_kategori');
            $produk->id_stok = $request->get('id_stok');
            $produk->deskripsi_produk = $request->get('deskripsi_produk');
            $produk->gambar_produk = $gambar;
            $produk->harga_produk = $request->get('harga_produk');
            $produk->update();
        }

        return redirect('produk')->with('success', 'Data diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return redirect('produk')->with('success', 'Data dihapus');
    }
}
