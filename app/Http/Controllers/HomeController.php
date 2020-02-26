<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\PendpPerHari;
use App\Models\UsersPelanggan;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tgl = Date("Y-m-d");
        $userRegistrations = UsersPelanggan::count('*');
        $totalProduk = Produk::count('*');
        $neworder = Order::where('created_at', 'like', "%{$tgl}%")->where('status', '0')->count('*');
        $jumbelProduk = OrderDetails::join('order', 'order_details.id_order', '=', 'order.id_order')->where(DB::raw('substr(order_details.created_at, 1, 10)'), '=', $tgl)->where('order.status', '=', '1')->sum('jumbel_produk');
        $Produkterjual = OrderDetails::join('order', 'order_details.id_order', '=', 'order.id_order')->where('order.status', '=', '1')->sum('jumbel_produk', 'as', 'jumbel_produk');
        $pendpHrIni = PendpPerHari::where('created_at', 'like', "%{$tgl}%")->sum('total_pendpPerHari');
        return view('dashboard.content',
        compact('userRegistrations',
                'neworder',
                'totalProduk',
                'jumbelProduk',
                'pendpHrIni',
                'Produkterjual'
            ));
    }

    public function terjualhariIni()
    {
        $tgl = Date("Y-m-d");
        $data = OrderDetails::join('order', 'order_details.id_order', '=', 'order.id_order')
                ->where(DB::raw('substr(order_details.created_at, 1, 10)'), '=', $tgl)
                ->where('order.status', '=', '1')
                ->get();
        $sum = OrderDetails::join('order', 'order_details.id_order', '=', 'order.id_order')
                ->where(DB::raw('substr(order_details.created_at, 1, 10)'), '=', $tgl)
                ->where('order.status', '=', '1')
                ->select(DB::raw('SUM(jumbel_produk) as jumbel_produk'))
                ->get();
        return view('dashboard.terjualhariini', compact('data', 'sum'));
    }

    public function pendphariIni()
    {
        $tanggal = date("Y-m-d");
        $data = DB::select("SELECT * FROM pendpperhari WHERE SUBSTRING(created_at, 1, 10) = '$tanggal'");
        $sum = DB::select("SELECT SUM(total_pendpperhari) as total_pendp FROM pendpperhari WHERE SUBSTRING(created_at, 1, 10) = '$tanggal'");
        return view('dashboard.pendphariini', compact('data', 'sum'));
    }

    public function produkTerjual()
    {
        $tgl = Date("Y-m-d");
        $data = Produk::join('order_details', 'produk.id_produk', '=', 'order_details.id_produk')
                ->join('order', 'order_details.id_order', '=', 'order.id_order')
                ->where('order.status', '=', '1')->groupBy('order_details.id_produk')
                ->select(DB::raw('SUM(jumbel_produk) as jumbel_produk, produk.nama_produk'))
                ->get();
        $sum = OrderDetails::join('order', 'order_details.id_order', '=', 'order.id_order')->where('order.status', '=', '1')
                ->select(DB::raw('SUM(jumbel_produk) as jumbel_produk'))
                ->get();
        return view('dashboard.produkterjual', compact('data', 'sum'));
    }

    public function newOrder()
    {
        $tgl = Date("Y-m-d");
        $data = Order::where('created_at', 'like', "%{$tgl}%")->where('status', '0')->get();
        return view('dashboard.neworder', compact('data'));
    }

    public function Users()
    {
        $data = UsersPelanggan::all();
        return view('dashboard.users', compact('data'));
    }

    public function byProdukterjualMakanan()
    {
        $result = DB::select("SELECT produk.nama_produk, sum(order_details.jumbel_produk) as jumbel_produk 
                                FROM `order` 
                                INNER JOIN order_details using(id_order)
                                INNER JOIN produk USING(id_produk)
                                INNER JOIN kategori_produk USING(id_kategori)
                                WHERE `order`.`status` = '1' AND kategori_produk.nama_kategori = 'Makanan'
                                GROUP BY order_details.id_produk ORDER BY jumbel_produk DESC");
        return response()->json($result);
    }

    public function byProdukterjualMinuman()
    {
        $result = DB::select("SELECT produk.nama_produk, sum(jumbel_produk) as jumbel_produk 
                                FROM `order` 
                                INNER JOIN order_details using(id_order)
                                INNER JOIN produk USING(id_produk)
                                INNER JOIN kategori_produk USING(id_kategori)
                                WHERE `order`.`status` = '1' AND kategori_produk.nama_kategori = 'Minuman'
                                GROUP BY order_details.id_produk ORDER BY jumbel_produk DESC");
        return response()->json($result);
    }

    public function byPendpHarian()
    {
        $result = DB::select("SELECT SUM(total_pendpPerHari) AS pendpHarian, CONCAT(DAY(SUBSTRING(created_at,1 ,10)), ' ', MONTHNAME(SUBSTRING(created_at,1 ,10)), ' ',YEAR(SUBSTRING(created_at,1 ,10))) AS tglpendpHarian FROM `pendpperhari` GROUP BY SUBSTRING(created_at,1 ,10)");
        return response()->json($result);
    }

    public function byPendpBulanan()
    {
        $result = DB::select("SELECT SUM(total_pendpPerBulan) AS pendpBulanan, CONCAT(MONTHNAME(bulan), ' ',YEAR(bulan)) AS bulanPendp FROM `pendpperbulan` GROUP BY MONTHNAME(bulan) ORDER BY MONTH(bulan) ASC");
        return response()->json($result);
    }
    
    public function byPendpTahunan()
    {
        $result = DB::select("SELECT SUM(total_pendpPerTahun) AS pendpTahunan, tahun FROM `pendppertahun` GROUP BY tahun ORDER BY tahun ASC");
        return response()->json($result);
    }

    public function Pengeluaran()
    {
        $result = DB::select("SELECT SUM(total) AS Pengeluaran, CONCAT(MONTHNAME(tanggal), ' ',YEAR(tanggal)) AS bulan FROM `pengeluaran` GROUP BY MONTHNAME(tanggal) ORDER BY MONTHNAME(tanggal) ASC");
        return response()->json($result);
    }

    public function LabaBersih()
    {
        $result = DB::select("SELECT SUM(total) AS LabaBersih, CONCAT(MONTHNAME(tanggal), ' ',YEAR(tanggal)) AS bulan FROM `laba_bersih` GROUP BY MONTHNAME(tanggal) ORDER BY MONTHNAME(tanggal) ASC");
        return response()->json($result);
    }
}
