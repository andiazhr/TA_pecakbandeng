<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Stok;
use App\Models\Produk;
use App\Models\pendpPerHari;
use PDF;
use DB;

class orderController extends Controller
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
        $data = Order::when($request->search, function ($query) use ($request) {
            $query->where('nama_produk', 'like', "%{$request->search}%");
        })->paginate(10);
        return view('order.index', compact('data'));
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
    public function show(Request $request, $id)
    {
        $id_detail = $request->segment(3);
        $data = Order::find($id);
        $detail = OrderDetails::where('id_order', $id_detail)->get();
        $sum = OrderDetails::where('id_order', $id_detail)->get(
            array(
              DB::raw('SUM(jumbel_produk) as jumbel_produk'),
              DB::raw('SUM(harga_produk) as harga_produk')
            )
          );
        return view('order.detail', compact('data', 'detail', 'sum'));
    }

    public function cetak_pdf(Request $request, $id)
    {
        $id_detail = $request->segment(3);
        $data = Order::find($id);
        $detail = OrderDetails::where('id_order', $id_detail)->get();
        $sum = OrderDetails::where('id_order', $id_detail)->get(
            array(
              DB::raw('SUM(jumbel_produk) as jumbel_produk'),
              DB::raw('SUM(harga_produk) as harga_produk')
            )
          );
        // dd($data);
        $pdf = PDF::loadView('order.cetak_pdf', ['data'=>$data, 'detail'=>$detail, 'sum'=>$sum]);
        return $pdf->download('cetak-pembayaran.pdf');
        // return $pdf->stream();
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
    public function update(Request $request)
    {
        $kode = $request->kode_pembayaran;
        $query = DB::select("UPDATE tugasakhir.order SET status = '1' WHERE kode_order = '$kode'");
        $detail = Stok::join('produk', 'produk.id_stok', '=', 'stok.id_stok')
                ->join('order_details', 'order_details.id_produk', '=', 'produk.id_produk')
                ->join('order', 'order.id_order', '=', 'order_details.id_order')
                ->select('stok.*', 'order_details.jumbel_produk')
                ->where('order.kode_order', $kode)->get();
                
        foreach($detail as $details){
            $id_stok[] = [$details->id_stok , $details->stok, $details->jumbel_produk];
            // $stok[] = $details->stok;
            // $jumbel[] = $details->jumbel_produk;
        }
        // dd($id_stok);
        // $get_stok = $stok;
        // $get_jumbel = $jumbel;
        $min_stok = $id_stok;  //here scores is the input array param 
        foreach($min_stok as $row){
            $stok = Stok::find($row[0]); 
            $stok->stok = $row[1] - $row[2];
            $stok->save(); 
        }
        
        $select = Order::where('kode_order', $kode)->get();
        foreach($select as $jumlah){
            $total_order = $jumlah->total_order;
        }

        $pendp = new pendpPerHari();
        $pendp->kode_pendpperhari = $kode;
        $pendp->total_pendpperhari = $total_order;
        $pendp->save();

        return redirect('order')->with('success', 'Pembayaran dengan kode ' .$kode.' telah lunas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect('order')->with('success', 'Data dihapus');
    }
}
