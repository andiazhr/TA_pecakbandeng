<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersPelanggan;
use App\Models\Kegiatan;
use App\Models\Stok;
use App\Models\Produk;
use App\Models\ProdukKegiatan;
use App\Models\Keranjang;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Rating;
use App\Models\Like;
use App\Models\Review;
use Stripe\Stripe;
use Stripe\Charge;
Use DB;
use Session;

class ItsFoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $five = 10;
        // $four = 8;
        // $three = 6;
        // $two = 4;
        // $one = 2;
        // $sum = round(($one + $one + $two)/3);
        // if($sum  > 8 && $sum <= 10){
        //     print_r('bintang 5');
        // }elseif($sum  > 6 && $sum <= 8){
        //     print_r('bintang 4');
        // }
        // elseif($sum  > 4 && $sum <= 6){
        //     print_r('bintang 3');
        // }
        // elseif($sum  > 2 && $sum <= 4){
        //     print_r('bintang 2');
        // }
        // else{
        //     print_r('bintang 1');
        // }

        $data = Produk::all();
        $datamkn = Produk::join('kategori_produk', 'kategori_produk.id_kategori', '=', 'produk.id_kategori')->where('kategori_produk.nama_kategori', '=', 'Makanan')->limit(4)->get();
        $datamnm = Produk::join('kategori_produk', 'kategori_produk.id_kategori', '=', 'produk.id_kategori')->where('kategori_produk.nama_kategori', '=', 'Minuman')->limit(4)->get();
        $kegiatan = Kegiatan::all();
        $now = date('Y-m-d');
        $produkkegiatan = ProdukKegiatan::all();
        // $produkkegiatan = ProdukKegiatan::join('kegiatan', 'produk_kegiatan.id_kegiatan', '=', 'kegiatan.id_kegiatan')->where('kegiatan.periode_awal', '<=', $now)->where('kegiatan.periode_akhir', '>=', $now)->get();
        // $produkkegiatan = DB::select("SELECT * FROM `kegiatan` INNER JOIN `produk_kegiatan` USING(id_kegiatan) INNER JOIN produk USING(id_produk) WHERE CURRENT_DATE() BETWEEN kegiatan.periode_awal AND COALESCE(kegiatan.periode_akhir, NOW())");
        // $produkkegiatan = DB::select("SELECT * FROM `kegiatan` INNER JOIN `produk_kegiatan` USING(id_kegiatan) INNER JOIN produk USING(id_produk) WHERE kegiatan.periode_awal <= CURRENT_DATE() AND kegiatan.periode_akhir >= CURRENT_DATE()");
        // dd($datamnm);
        return view('index.index', compact('data', 'datamkn', 'datamnm', 'kegiatan', 'produkkegiatan'));
    }

    public function search(Request $request)
    {
        $countrating = Rating::count();
        $countlike = Like::count();
        $countreview = Review::count();
        $rating = DB::table('rating')
                ->join('produk', 'rating.id_produk', '=', 'produk.id_produk')
                ->select('rating.*')
                ->where('rating.status', '=', '1')
                ->groupBy('rating.id_pelanggan')
                ->groupBy('rating.id_produk')
                ->get();
        $ratingProduk = DB::table('rating')
                ->join('produk', 'rating.id_produk', '=', 'produk.id_produk')
                ->select('rating.*', DB::raw('count(*) as total, sum(nilai) as hasil'))
                ->where('rating.status', '=', '1')
                ->groupBy('rating.id_produk')
                ->get();
        $like = DB::table('like')
                ->join('produk', 'like.id_produk', '=', 'produk.id_produk')
                ->select('like.*')
                ->where('like.status', '=', '1')
                ->groupBy('like.id_pelanggan')
                ->groupBy('like.id_produk')
                ->get();
        $likeProduk = DB::table('like')
                ->join('produk', 'like.id_produk', '=', 'produk.id_produk')
                ->select('like.*', DB::raw('count(*) as total'))
                ->where('like.status', '=', '1')
                ->groupBy('like.id_produk')
                ->get();
        $review = DB::table('review')
                ->join('produk', 'review.id_produk', '=', 'produk.id_produk')
                ->select('review.*')
                ->where('review.status', '=', '1')
                ->groupBy('review.id_pelanggan')
                ->groupBy('review.id_produk')
                ->get();
        $reviewProduk = DB::table('review')
                ->join('produk', 'review.id_produk', '=', 'produk.id_produk')
                ->select('review.*', DB::raw('count(*) as total'))
                ->where('review.status', '=', '1')
                ->groupBy('review.id_produk')
                ->get();
        $search = $request->get('search');
        $exists = DB::table('produk')
        ->join('kategori_produk', 'produk.id_kategori', '=', 'kategori_produk.id_kategori')
        ->where('nama_produk', 'like', "%{$search}%")
        ->orwhere('nama_kategori', 'like', "%{$search}%")
        ->orwhere('harga_produk', 'like', "%{$search}%")
        ->select('*')
        ->exists();
       
        $kategori = DB::table('produk')
        ->join('kategori_produk', 'produk.id_kategori', '=', 'kategori_produk.id_kategori')
        ->select(DB::raw('count(produk.nama_produk) as nama_produk, kategori_produk.nama_kategori'))
        ->distinct()
        ->groupBy('kategori_produk.nama_kategori')
        ->orderBy('kategori_produk.nama_kategori', 'asc')
        ->get();

        if($exists === false){
            return view('itsfood.Not_Found');
        }elseif($exists === true){
            $hasil = DB::table('produk')
            ->join('kategori_produk', 'produk.id_kategori', '=', 'kategori_produk.id_kategori')
            ->where('nama_produk', 'like', "%{$search}%")
            ->orwhere('nama_kategori', 'like', "%{$search}%")
            ->orwhere('harga_produk', 'like', "%{$search}%")
            ->select('*')
            ->paginate(4);

            foreach($hasil as $check)
            {
                $data = $check->nama_kategori;
            }
            
            if($data == 'Makanan'){
                $minuman = DB::table('produk')
                ->join('kategori_produk', 'produk.id_kategori', '=', 'kategori_produk.id_kategori')
                ->where('nama_kategori', 'Minuman')
                ->select('*')
                ->get();

                if (is_null(auth('pelanggan')->user())){
                    return view('itsfood.search', compact('hasil', 'minuman', 'countrating', 'kategori', 'countlike', 'countreview', 'rating', 'ratingProduk', 'like', 'likeProduk', 'review', 'reviewProduk'));
                }
        
                $editRating = DB::table('rating')
                        ->join('produk', 'rating.id_produk', '=', 'produk.id_produk')
                        ->select('rating.*')
                        ->where('rating.id_pelanggan', '=', auth('pelanggan')->user()->id_pelanggan)
                        ->where('rating.status', '=', '0')
                        ->groupBy('rating.id_produk')
                        ->get();
                $editLike = DB::table('like')
                        ->join('produk', 'like.id_produk', '=', 'produk.id_produk')
                        ->select('like.*')
                        ->where('like.id_pelanggan', '=', auth('pelanggan')->user()->id_pelanggan)
                        ->where('like.status', '=', '0')
                        ->groupBy('like.id_produk')
                        ->get();
                $editReview = DB::table('review')
                        ->join('produk', 'review.id_produk', '=', 'produk.id_produk')
                        ->select('review.*')
                        ->where('review.status', '=', '0')
                        ->where('review.id_pelanggan', '=', auth('pelanggan')->user()->id_pelanggan)
                        ->groupBy('review.id_produk')
                        ->get();
                        
                return view('itsfood.search', compact('hasil', 'minuman', 'countrating', 'kategori', 'countlike', 'countreview', 'rating', 'ratingProduk', 'editRating', 'like', 'likeProduk', 'editLike', 'review', 'reviewProduk', 'editReview'));
            }
            elseif($data == 'Minuman'){
                $makanan = DB::table('produk')
                ->join('kategori_produk', 'produk.id_kategori', '=', 'kategori_produk.id_kategori')
                ->where('nama_kategori', 'Makanan')
                ->select('*')
                ->get();

                if (is_null(auth('pelanggan')->user())){
                    return view('itsfood.search', compact('hasil', 'makanan', 'countrating', 'kategori', 'countlike', 'countreview', 'rating', 'ratingProduk', 'like', 'likeProduk', 'review', 'reviewProduk'));
                }
        
                $editRating = DB::table('rating')
                        ->join('produk', 'rating.id_produk', '=', 'produk.id_produk')
                        ->select('rating.*')
                        ->where('rating.id_pelanggan', '=', auth('pelanggan')->user()->id_pelanggan)
                        ->where('rating.status', '=', '0')
                        ->groupBy('rating.id_produk')
                        ->get();
                $editLike = DB::table('like')
                        ->join('produk', 'like.id_produk', '=', 'produk.id_produk')
                        ->select('like.*')
                        ->where('like.id_pelanggan', '=', auth('pelanggan')->user()->id_pelanggan)
                        ->where('like.status', '=', '0')
                        ->groupBy('like.id_produk')
                        ->get();
                $editReview = DB::table('review')
                        ->join('produk', 'review.id_produk', '=', 'produk.id_produk')
                        ->select('review.*')
                        ->where('review.status', '=', '0')
                        ->where('review.id_pelanggan', '=', auth('pelanggan')->user()->id_pelanggan)
                        ->groupBy('review.id_produk')
                        ->get();

                return view('itsfood.search', compact('hasil', 'makanan', 'countrating', 'kategori', 'countlike', 'countreview', 'rating', 'ratingProduk', 'editRating', 'like', 'likeProduk', 'editLike', 'review', 'reviewProduk', 'editReview'));
            }
            elseif(($data != 'Makanan') && ($data != 'Minuman')){
                $shop = DB::table('produk')
                ->join('kategori_produk', 'produk.id_kategori', '=', 'kategori_produk.id_kategori')
                ->where('nama_kategori', '!=', 'Makanan')
                ->where('nama_kategori', '!=', 'Minuman')
                ->where('nama_kategori', '!=', 'Alat Dapur')
                ->select('*')
                ->get();
                
                return view('itsfood.search', compact('hasil', 'shop', 'kategori', 'countrating', 'countlike', 'countreview', 'rating', 'ratingProduk', 'like', 'likeProduk', 'review', 'reviewProduk'));
            }
        }
    }

    public function showRegisterForm()
    {
        return view('itsfood.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'nama_pelanggan' => 'required',
            'username' => 'required|unique:users_pelanggan',
            'email_pelanggan' => 'required|email|unique:users_pelanggan',
            'phone_number' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);
        
        $userspelanggan = UsersPelanggan::create(request(['nama_pelanggan', 'username', 'email_pelanggan', 'phone_number', 'password']));
        
        auth('pelanggan')->login($userspelanggan);
        
        if (Session::has('keranjang')) {
            $id = auth('pelanggan')->user()->id_pelanggan;
            // dd($id);
            $login = UsersPelanggan::find($id);
            $login->status = '1';
            $login->update();
            return redirect()->to('/keranjang')->with('login', 'Hai');
        }

        if (!Session::has('keranjang')) {
            $id = auth('pelanggan')->user()->id_pelanggan;
            // dd($id);
            $login = UsersPelanggan::find($id);
            $login->status = '1';
            $login->update();
            return redirect()->to('/')->with('login', 'Hai');
        }
    }

    public function showLoginForm()
    {
        return view('itsfood.login');
    }

    public function login()
    {
        if (!Session::has('keranjang')) {
            if (auth('pelanggan')->attempt(request(['email_pelanggan', 'password'])) == false) {
                return redirect()->route('masuk')->with('fail', 'Email dan Password tidak valid');
            }
            $id = auth('pelanggan')->user()->id_pelanggan;
            // dd($id);
            $login = UsersPelanggan::find($id);
            $login->status = '1';
            $login->update();
            return redirect()->to('/')->with('login', 'Hai');
        }

        if (Session::has('keranjang')) {
            if (auth('pelanggan')->attempt(request(['email_pelanggan', 'password'])) == false) {
                return redirect()->route('masuk')->with('fail', 'Email dan Password tidak valid');
            }
            $id = auth('pelanggan')->user()->id_pelanggan;
            // dd($id);
            $login = UsersPelanggan::find($id);
            $login->status = '1';
            $login->update();
            return redirect()->route('keranjang')->with('login', 'Hai');
        }
    }

    public function profile(Request $request, $id_pelanggan)
    {
        if (is_null(auth('pelanggan')->user())){
            return redirect()->route('masuk');
        }

        // if (!($url == NULL)){
            $pelanggan = UsersPelanggan::find($id_pelanggan);
            $order = DB::table('order')
            ->join('order_details', 'order.id_order', '=', 'order_details.id_order')
            ->join('produk', 'order_details.id_produk', '=', 'produk.id_produk')
            ->join('kategori_produk', 'produk.id_kategori', '=', 'kategori_produk.id_kategori')
            ->where('order.id_pelanggan', auth('pelanggan')->user()->id_pelanggan)
            ->where('order.status', 'Lunas')
            ->where('kategori_produk.nama_kategori', 'Makanan')
            ->orwhere('kategori_produk.nama_kategori', 'Minuman')
            ->select(DB::raw('SUM(order_details.jumbel_produk) as jumbel_produk, produk.nama_produk'))
            ->distinct()
            ->groupBy('produk.nama_produk')
            ->orderBy('produk.nama_produk', 'asc')
            ->get();

            $produk = DB::table('order')
            ->join('order_details', 'order.id_order', '=', 'order_details.id_order')
            ->join('produk', 'order_details.id_produk', '=', 'produk.id_produk')
            ->join('kategori_produk', 'produk.id_kategori', '=', 'kategori_produk.id_kategori')
            ->where('order.id_pelanggan', auth('pelanggan')->user()->id_pelanggan)
            ->where('kategori_produk.nama_kategori', '!=', 'Makanan')
            ->where('kategori_produk.nama_kategori', '!=', 'Minuman')
            ->select(DB::raw('SUM(order_details.jumbel_produk) as jumbel_produk, produk.nama_produk'))
            ->distinct()
            ->groupBy('produk.nama_produk')
            ->orderBy('produk.nama_produk', 'asc')
            ->get();
            return view('Itsfood.profile', compact('pelanggan', 'order', 'produk'));
        // }
    }

    public function logout()
    {
        $id = auth('pelanggan')->user()->id_pelanggan;
        // dd($id);
        $login = UsersPelanggan::find($id);
        $login->status = '0';
        $login->update();

        auth('pelanggan')->logout();
        
        return redirect()->route('masuk');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menu()
    {
        $countProduk = Produk::count();
        $countrating = Rating::count();
        $countlike = Like::count();
        $countreview = Review::count();
        $rating = DB::table('rating')
                ->join('produk', 'rating.id_produk', '=', 'produk.id_produk')
                ->select('rating.*')
                ->where('rating.status', '=', '1')
                ->groupBy('rating.id_pelanggan')
                ->groupBy('rating.id_produk')
                ->get();
        $ratingProduk = DB::table('rating')
                ->join('produk', 'rating.id_produk', '=', 'produk.id_produk')
                ->select('rating.*', DB::raw('count(*) as total, sum(nilai) as hasil'))
                ->where('rating.status', '=', '1')
                ->groupBy('rating.id_produk')
                ->get();
        $like = DB::table('like')
                ->join('produk', 'like.id_produk', '=', 'produk.id_produk')
                ->select('like.*')
                ->where('like.status', '=', '1')
                ->groupBy('like.id_pelanggan')
                ->groupBy('like.id_produk')
                ->get();
        $likeProduk = DB::table('like')
                ->join('produk', 'like.id_produk', '=', 'produk.id_produk')
                ->select('like.*', DB::raw('count(*) as total'))
                ->where('like.status', '=', '1')
                ->groupBy('like.id_produk')
                ->get();
        $review = DB::table('review')
                ->join('produk', 'review.id_produk', '=', 'produk.id_produk')
                ->select('review.*')
                ->where('review.status', '=', '1')
                ->groupBy('review.id_pelanggan')
                ->groupBy('review.id_produk')
                ->get();
        $reviewProduk = DB::table('review')
                ->join('produk', 'review.id_produk', '=', 'produk.id_produk')
                ->select('review.*', DB::raw('count(*) as total'))
                ->where('review.status', '=', '1')
                ->groupBy('review.id_produk')
                ->get();
        // $review = Review::all();
        // dd($reviewProduk);
        $data = Produk::with('Like')->with('ProdukKegiatan')
                ->join('kategori_produk', 'produk.id_kategori', '=', 'kategori_produk.id_kategori')
                ->where('kategori_produk.status', '=', '1')
                ->where('produk.status', '=', '1')
                ->paginate(8);
        // dd($data);
        // $data = Produk::with('ProdukKegiatan')->get();
        // dd($data);
        // $produkkegiatan = ProdukKegiatan::all();
        // $data = DB::table('produk')
        // ->join('kategori_produk', 'produk.id_kategori', '=', 'kategori_produk.id_kategori')
        // ->where('nama_kategori', 'Makanan')
        // ->orwhere('nama_kategori', 'Minuman')
        // ->select('*')
        // ->get();
        
        if (is_null(auth('pelanggan')->user())){
            return view('itsfood.menu', compact('data', 'countProduk', 'produkkegiatan', 'rating', 'ratingProduk', 'like', 'likeProduk', 'review', 'reviewProduk', 'countrating', 'countlike', 'countreview'));
        }

        $editRating = DB::table('rating')
                ->join('produk', 'rating.id_produk', '=', 'produk.id_produk')
                ->select('rating.*')
                ->where('rating.id_pelanggan', '=', auth('pelanggan')->user()->id_pelanggan)
                ->where('rating.status', '=', '0')
                ->groupBy('rating.id_produk')
                ->get();
        $editLike = DB::table('like')
                ->join('produk', 'like.id_produk', '=', 'produk.id_produk')
                ->select('like.*')
                ->where('like.id_pelanggan', '=', auth('pelanggan')->user()->id_pelanggan)
                ->where('like.status', '=', '0')
                ->groupBy('like.id_produk')
                ->get();
        $editReview = DB::table('review')
                ->join('produk', 'review.id_produk', '=', 'produk.id_produk')
                ->select('review.*')
                ->where('review.status', '=', '0')
                ->where('review.id_pelanggan', '=', auth('pelanggan')->user()->id_pelanggan)
                ->groupBy('review.id_produk')
                ->get();
                
        return view('itsfood.menu', compact('data', 'countProduk', 'produkkegiatan', 'rating', 'ratingProduk', 'editRating', 'like', 'likeProduk', 'editLike', 'review', 'reviewProduk', 'editReview', 'countrating', 'countlike', 'countreview'));
    }

    public function create()
    {
        if (!Session::has('keranjang')) {
            return view ('itsfood.keranjang', ['produks' => null]);
        }
        $Keranjanglama = Session::get('keranjang');
        $keranjang = new Keranjang($Keranjanglama);
        $produkkegiatan = ProdukKegiatan::all();
        return view ('itsfood.keranjang', ['produks' => $keranjang->produks, 'produkkegiatan' => $produkkegiatan, 'totalPembelian' => $keranjang->totalPembelian]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        if (is_null(auth('pelanggan')->user()))
        {
            return redirect()->route('masuk')->with('login', 'Harus Login Terlebih Dahulu');
        }
        if (!Session::has('keranjang')) {
            return view ('itsfood.keranjang', ['produks' => null]);
        }
        $Keranjanglama = Session::get('keranjang');
        $keranjang = new Keranjang($Keranjanglama);
        $produkkegiatan = ProdukKegiatan::all();
        $valid = DB::table('produk')
        ->join('kategori_produk', 'produk.id_kategori', '=', 'kategori_produk.id_kategori')
        ->select('*')
        ->get();
        return view ('itsfood.checkout', ['produks' => $keranjang->produks, 'totalPembelian' => $keranjang->totalPembelian, 'produkkegiatan' => $produkkegiatan, 'valid' => $valid]);
    }

    public function store(Request $request)
    {
        $get_nomor = auth('pelanggan')->user()->phone_number;
        $nomor = substr($get_nomor, 2);
        $menit = Date('i'); 
        $tgl = Date('ymd');
        $kodeOrder = 'OFD'.$tgl.$nomor.$menit;
        $jumbel = $request->get('min_jumbel');
        $menu = $request->get('menu');

        $this->validate($request, [
            'status' => 'required',
        ]);

        if (!Session::has('keranjang')){
            return redirect()->to('/');
        }
        
        $Keranjanglama = Session::get('keranjang');
        $keranjang = new Keranjang($Keranjanglama);

            $pesan = new Order();
            $pesan->id_pelanggan = auth('pelanggan')->user()->id_pelanggan;
            $pesan->kode_order = $pesan->id_order.$kodeOrder;
            $pesan->status = "0";
            $pesan->total_order = $request->get('total_pembelian');
            $pesan->save();

            if($request->get('catatan')){
                $id_produk = $request->id_produk;
                $get_status = $request->status;
                $explode = explode("|",$get_status);
                $status = $explode[0];
                $harga_produk = $request->harga_produk;
                $bobot_produk = $request->bobot_produk;
                $jumbel_produk = $request->jumbel_produk;
                    for ($i = 0; $i < count($id_produk); $i++){
                        $detail = new OrderDetails();
                        $detail->id_order = $pesan->id_order;
                        $detail->id_produk = $id_produk[$i];
                        $detail->catatan = $request->get('catatan');
                        $detail->status = $status;
                        $detail->ongkir = $request->get('ongkir');
                        $detail->harga_produk = $harga_produk[$i];
                        $detail->jumbel_produk = $jumbel_produk[$i];
                        $detail->save();
                    }

                    $detail = Stok::join('produk', 'produk.id_stok', '=', 'stok.id_stok')
                        ->join('order_details', 'order_details.id_produk', '=', 'produk.id_produk')
                        ->join('order', 'order.id_order', '=', 'order_details.id_order')
                        ->select('stok.*', 'order_details.jumbel_produk')
                        ->where('order.kode_order', $kodeOrder)->exists();
                    
                    if($detail == true){
                        $detail = Stok::join('produk', 'produk.id_stok', '=', 'stok.id_stok')
                            ->join('order_details', 'order_details.id_produk', '=', 'produk.id_produk')
                            ->join('order', 'order.id_order', '=', 'order_details.id_order')
                            ->select('stok.*', 'order_details.jumbel_produk', DB::raw('sum(jumbel_produk) as jumbel'))
                            ->groupBy('stok.id_stok')
                            ->where('order.kode_order', $kodeOrder)->get();
            
                            foreach($detail as $details){
                                $id_stok[] = [$details->id_stok , $details->stok, $details->jumbel];
                            }
                            $min_stok = $id_stok;  //here scores is the input array param 
                            foreach($min_stok as $row){
                                $stok = Stok::find($row[0]); 
                                $stok->stok = $row[1] - $row[2];
                                $stok->save(); 
                            }
                        }
                    
            Session::forget('keranjang');
            return redirect()->to('/')->with('success', 'Pesanan Anda Telah Dikirim');
            }        
                
        return redirect('/checkout')->with('fail', 'Please Pilih Dikirim atau Pilihan Lain');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $countProduk = Produk::count();
        $countrating = Rating::count();
        $countlike = Like::count();
        $countreview = Review::count();
        $rating = DB::table('rating')
                ->join('produk', 'rating.id_produk', '=', 'produk.id_produk')
                ->select('rating.*')
                ->where('rating.status', '=', '1')
                ->groupBy('rating.id_pelanggan')
                ->groupBy('rating.id_produk')
                ->get();
        $ratingProduk = DB::table('rating')
                ->join('produk', 'rating.id_produk', '=', 'produk.id_produk')
                ->select('rating.*', DB::raw('count(*) as total, sum(nilai) as hasil'))
                ->where('rating.status', '=', '1')
                ->groupBy('rating.id_produk')
                ->get();
        $like = DB::table('like')
                ->join('produk', 'like.id_produk', '=', 'produk.id_produk')
                ->select('like.*')
                ->where('like.status', '=', '1')
                ->groupBy('like.id_pelanggan')
                ->groupBy('like.id_produk')
                ->get();
        $likeProduk = DB::table('like')
                ->join('produk', 'like.id_produk', '=', 'produk.id_produk')
                ->select('like.*', DB::raw('count(*) as total'))
                ->where('like.status', '=', '1')
                ->groupBy('like.id_produk')
                ->get();
        $review = DB::table('review')
                ->join('produk', 'review.id_produk', '=', 'produk.id_produk')
                ->select('review.*')
                ->where('review.status', '=', '1')
                ->groupBy('review.id_pelanggan')
                ->groupBy('review.id_produk')
                ->get();
        $reviewProduk = DB::table('review')
                ->join('produk', 'review.id_produk', '=', 'produk.id_produk')
                ->select('review.*', DB::raw('count(*) as total'))
                ->where('review.status', '=', '1')
                ->groupBy('review.id_produk')
                ->get();
        $data = Produk::with('ProdukKegiatan')->find($id);
        // dd($data);
        $getUlasan = Review::where('status', '1')->get();
        // dd($data);
        if($data === null){
            return view('itsfood.Not_Found');
        }

        if (is_null(auth('pelanggan')->user())){
            return view('itsfood.detailproduk', compact('data', 'countrating', 'countlike', 'countreview', 'rating', 'ratingProduk', 'like', 'likeProduk', 'review', 'reviewProduk', 'getUlasan'));
        }

        $editRating = DB::table('rating')
                ->join('produk', 'rating.id_produk', '=', 'produk.id_produk')
                ->select('rating.*')
                ->where('rating.id_pelanggan', '=', auth('pelanggan')->user()->id_pelanggan)
                ->where('rating.status', '=', '0')
                ->groupBy('rating.id_produk')
                ->get();
        $editLike = DB::table('like')
                ->join('produk', 'like.id_produk', '=', 'produk.id_produk')
                ->select('like.*')
                ->where('like.id_pelanggan', '=', auth('pelanggan')->user()->id_pelanggan)
                ->where('like.status', '=', '0')
                ->groupBy('like.id_produk')
                ->get();
        $editReview = DB::table('review')
                ->join('produk', 'review.id_produk', '=', 'produk.id_produk')
                ->select('review.*')
                ->where('review.status', '=', '0')
                ->where('review.id_pelanggan', '=', auth('pelanggan')->user()->id_pelanggan)
                ->groupBy('review.id_produk')
                ->get();
                
        return view('itsfood.detailproduk', compact('data', 'countrating', 'countlike', 'countreview', 'rating', 'ratingProduk', 'editRating', 'like', 'likeProduk', 'editLike', 'review', 'reviewProduk', 'editReview', 'getUlasan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id_pelanggan)
    {
        $pelanggan = UsersPelanggan::find($id_pelanggan);
        return view('Itsfood.editprofile', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_pelanggan)
    {
        $profil = UsersPelanggan::find($id_pelanggan);
        
        $data = $profil->foto_profil;
        
        if(empty($request->hasfile('foto_profil')))
        {
            $profil->nama_pelanggan = $request->get('nama_pelanggan');
            $profil->username = $request->get('username');
            $profil->email_pelanggan = $request->get('email_pelanggan');
            $profil->phone_number = $request->get('phone_number');
            $profil->bio = $request->get('bio');
            $profil->update();
        }

        if($request->hasfile('foto_profil'))
        {
            foreach($request->file('foto_profil') as $image)
            {
                $gambar=$image->getClientOriginalName();
                $image->move(public_path().'/imageforuser/pelanggan', $gambar);  
            }
            $profil->nama_pelanggan = $request->get('nama_pelanggan');
            $profil->username = $request->get('username');
            $profil->email_pelanggan = $request->get('email_pelanggan');
            $profil->phone_number = $request->get('phone_number');
            $profil->foto_profil = $gambar;
            $profil->bio = $request->get('bio');
            $profil->update();
        }
        elseif($data != NULL && !empty($request->hasfile('foto_profil'))){
            
            unlink(public_path().'/imageforuser/pelanggan/'. $profil->foto_profil);
            foreach($request->file('foto_profil') as $image)
            {
                $gambar=$image->getClientOriginalName();
                $image->move(public_path().'/imageforuser/pelanggan', $gambar);
            }
            $profil->nama_pelanggan = $request->get('nama_pelanggan');
            $profil->username = $request->get('username');
            $profil->email_pelanggan = $request->get('email_pelanggan');
            $profil->phone_number = $request->get('phone_number');
            $profil->foto_profil = $gambar;
            $profil->bio = $request->get('bio');
            $profil->update();
        }

        return redirect()->to('profile/' . $id_pelanggan)->with('success', 'Profile Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addKeranjang(Request $request, $id_produk)
    {
        $produk = Produk::find($id_produk);
        $Keranjanglama = Session::has('keranjang') ? Session::get('keranjang') : null;
        $keranjang = new Keranjang($Keranjanglama);
        $keranjang->add($produk, $produk->id_produk);
        $url = $request->segment(2);

        $request->session('keranjang')->put('keranjang', $keranjang);

        $data = DB::table('produk')
        ->join('kategori_produk', 'produk.id_kategori', '=', 'kategori_produk.id_kategori')
        ->where('id_produk', $url)
        ->select('*')
        ->get();
        
        foreach($data as $result){
            $test = $result->nama_kategori;
        }
        
        if($test == 'Makanan' || $test == 'Minuman'){
            return redirect()->to('/menu');
        }
        elseif($test != 'Makanan' || $test != 'Minuman'){
            return redirect()->to('/shop');
        }
    }

    public function tambahKeranjang(Request $request, $id_produk)
    {
        $produk = Produk::find($id_produk);
        $Keranjanglama = Session::has('keranjang') ? Session::get('keranjang') : null;
        $keranjang = new Keranjang($Keranjanglama);
        $keranjang->add($produk, $produk->id_produk);

        $request->session('keranjang')->put('keranjang', $keranjang);
        return redirect()->to('/keranjang');
    }
    
    public function kurangiKeranjang($id_produk)
    {
        $Keranjanglama = Session::has('keranjang') ? Session::get('keranjang') : null;
        $keranjang = new Keranjang($Keranjanglama);
        $keranjang->kurangiSatu($id_produk);
         
        if (count($keranjang->produks) > 0){
            Session::put('keranjang', $keranjang);
        } else {
            Session::forget('keranjang');
        }
        return redirect()->route('keranjang');
    }    
    
    public function destroy($id_produk)
    {
        $Keranjanglama = Session::has('keranjang') ? Session::get('keranjang') : null;
        $keranjang = new Keranjang($Keranjanglama);
        $keranjang->hapusSemua($id_produk);

        if (count($keranjang->produks) > 0){
            Session::put('keranjang', $keranjang);
        } else {
            Session::forget('keranjang');
        }
        return redirect()->route('keranjang');
    }
    
    public function remove(Request $request, $id_pelanggan)
    {
        $profil = UsersPelanggan::find($id_pelanggan);
        unlink(public_path().'/imageforuser/pelanggan/'. $profil->foto_profil);
        $profil->nama_pelanggan = $request->get('nama_pelanggan');
        $profil->username = $request->get('username');
        $profil->email_pelanggan = $request->get('email_pelanggan');
        $profil->phone_number = $request->get('phone_number');
        $profil->foto_profil = NULL;
        $profil->bio = $request->get('bio');
        $profil->update();

        return redirect('editprofile/' . $id_pelanggan)->with('success', 'Photo Removed');
    }
}
