<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<div style="float:left; margin-left:150px;">
  <strong><p>Kode Pembelian</p></strong>
  <p style="margin-top:-5px">{{$data->kode_order}}</p>  
</div>
<div style="margin-left:-50px;">
  <strong><p style="text-align: center;">Tanggal Pembelian</p> </strong>
  <p style="text-align: center; margin-top:-5px">
  <?php
    echo substr($data->created_at, 0, 10);
  ?>
  </p>
</div>
<hr width="200px">
<div style="margin-left:130px;" class="box-body table-responsive no-padding">
  <table class="table table-hover table-striped">
    <tr>
      <th style="padding: 15px">Nama Produk</th>
      <th style="text-align: right; padding: 15px"">Jumlah Beli</th>
      <th style="text-align: right; padding: 15px"">Harga Produk (Rp)</th>
    </tr>
    @foreach($detail as $no => $order)
    <tr>
      <td style="padding: 15px">{{$order->Produk->nama_produk}}</td>
      <td style="text-align: right; padding: 15px">{{number_format($order->jumbel_produk)}}</td>
      <td style="text-align: right; padding: 15px">{{number_format($order->harga_produk)}}</td>
    </tr>
    @endforeach
  </table>
</div>
<div style="margin-left:130px;" class="box-body table-responsive no-padding">
  <table class="table table-hover table-striped">
    @foreach($sum as $total)
    <tr>
      <th style="padding-right: 15px; padding-left: 15px; width:150px">Total Beli Produk</th>
      <th style="text-align: right; padding-right: 15px; padding-left: 15px; width:60px">{{number_format($total->jumbel_produk)}}</th>
      <th style="text-align: right; padding-right: 15px; padding-left: 15px;  width:135px">0</th>
    </tr>
    @endforeach
  </table>
</div>
<div style="margin-left:130px;" class="box-body table-responsive no-padding">
  <table class="table table-hover table-striped">
    <tr>
      <th style="padding-right: 15px; padding-left: 15px; width:150px">Ongkir</th>
      <th style="text-align: right; padding-right: 15px; padding-left: 15px; width:60px">-</th>
      <th style="text-align: right; padding-right: 15px; padding-left: 15px;  width:135px">{{number_format($order->ongkir)}}</th>
    </tr>
  </table>
</div>
<hr style="margin-left: 320px" width="250px">
<div style="margin-left:130px;" class="box-body table-responsive no-padding">
  <table class="table table-hover table-striped">
    @foreach($sum as $total)
    <tr>
      <th style="padding-right: 15px; padding-left: 15px;  width:150px">Total</th>
      <th style="text-align: right; padding-right: 15px; padding-left: 15px; width:60px">-</th>
      <th style="text-align: right; padding-right: 15px; padding-left: 15px; background: yellow;  width:135px">{{number_format($order->ongkir + $total->harga_produk)}}</th>
    </tr>
    @endforeach
  </table>
</div>
<div><center><strong><p>Jl. Raya Banten No.59, Unyur, Kec. Serang, Kota Serang, Banten 42111</p> <p style="font-size: 20px;">Terima Kasih Telah Berkunjung</p></strong></center></div>
</body>
</html>