<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;

class StokController extends Controller
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
        $data = Stok::when($request->search, function ($query) use ($request) {
            $query->where('nama_barang', 'like', "%{$request->search}%");
        })->paginate(10);
        return view('stok.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stok.add');
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

        $exists = Stok::where('nama_barang', $request->nama_barang)->exists();
        
        if($exists == true){
            return redirect()->back()->with(['fail' => $request->nama_barang .' telah dimasukkan']);
        }
        $stok = new Stok();
        $stok->nama_barang = $request->get('nama_barang');
        $stok->stok = $request->get('stok');
        $stok->status = $request->get('status');
        $stok->save();
        return redirect('Stok')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, $id)
    {
        $stok = Stok::find($id);
        $stok->status = $request->get('status');
        $stok->update();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stok = Stok::find($id);
        return view('stok.edit', compact('stok'));
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
        $stok = Stok::find($id);
        $stok->nama_barang = $request->get('nama_barang');
        $stok->stok = $request->get('stok');
        $stok->status = $request->get('status');
        $stok->update();
        return redirect('Stok')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stok = Stok::find($id);
        $stok->delete();

        return redirect('Stok')->with('success', 'Data dihapus');
    }
}
