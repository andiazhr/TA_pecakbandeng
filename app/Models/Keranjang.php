<?php

namespace App\Models;

class Keranjang
{
    public $produks = null;
    public $idProduk = 0;
    public $hargaProduk = 0;
    public $totalJumbel = 0;
    public $totalPembelian = 0;

    public function __construct($Keranjanglama)
    {
        if($Keranjanglama) {
            $this->idProduk = $Keranjanglama->idProduk;
            $this->hargaProduk = $Keranjanglama->hargaProduk;
            $this->produks = $Keranjanglama->produks;
            $this->totalJumbel = $Keranjanglama->totalJumbel;
            $this->totalPembelian = $Keranjanglama->totalPembelian;
        }
    }

    public function add($produk, $id_produk)
    {
        $storedProduk = ['jumbel' => 0, 'harga_produk' => $produk->harga_produk, 'produk' => $produk];
        if($this->produks){
            if (array_key_exists($id_produk, $this->produks)){
                $storedProduk = $this->produks[$id_produk];
            }
        }
        $storedProduk['jumbel']++;
        $storedProduk['harga_produk'] = $produk->harga_produk * $storedProduk['jumbel'];
        $this->produks[$id_produk] = $storedProduk;
        $this->idProduk = $produk->id_produk;
        $this->hargaProduk = $produk->harga_produk;
        $this->totalJumbel++;
        $this->totalPembelian += $produk->harga_produk;
    }

    public function kurangiSatu($id_produk)
    {
        $this->produks[$id_produk]['jumbel']--; 
        $this->produks[$id_produk]['harga_produk'] -= $this->produks[$id_produk]['produk']['harga_produk'];
        $this->totalJumbel--;
        $this->totalPembelian -= $this->produks[$id_produk]['produk']['harga_produk'];

        if ($this->produks[$id_produk]['jumbel'] <= 0)
        {
            unset($this->produks[$id_produk]);
        }
    }

    public function hapusSemua($id_produk)
    {
        $this->totalJumbel-= $this->produks[$id_produk]['jumbel'];
        $this->totalPembelian -= $this->produks[$id_produk]['harga_produk'];
        unset($this->produks[$id_produk]);
    }
}
