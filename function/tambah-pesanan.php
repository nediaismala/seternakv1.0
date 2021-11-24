<?php

include '../koneksi.php';
// $jml_barang = $_POST['kuantitas'];
// $username =$_GET['username'];
session_start();
if($_SESSION['role']!="1"){
header("location:login.php?pesan=gagal");
}
$username = $_SESSION['username'];

  function generateRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  if(isset($_POST['tambah-pesanan']))
  {
    $no_pemesanan=generateRandomString();
    $tanggal=date('Y-m-d');

    $query = pg_query("INSERT INTO pemesanan (no_pemesanan, id_pemilik, tgl_pesan, status) 
                                      VALUES ('$no_pemesanan', '$username', '$tanggal', 1);");

    $loop = pg_query("SELECT * from keranjang where id_pemilik='$username' and status=1");
    while ($data = pg_fetch_array($loop)) {
      // Insert into detail
      $id_produk= $data['id_produk'];
      $kuantitas= $data['jumlah'];
      $id_keranjang = $data['id_keranjang'];
      $detailquery = pg_query("INSERT INTO detail_pemesanan (no_pemesanan, id_produk, kuantitas) 
                                                     VALUES ('$no_pemesanan','$id_produk',$kuantitas);");
      $selectstock = pg_query("SELECT * from produk where id_produk='$id_produk'");
      $datastock = pg_fetch_assoc($selectstock);
      $stock = $datastock['stok'];
      $sisa = $stock - $kuantitas;
      $updatestock = pg_query("UPDATE produk SET stok =$sisa WHERE id_produk = '$id_produk';") ;
      $updatekeranjang = pg_query("UPDATE keranjang SET status =2 WHERE id_keranjang = '$id_keranjang';") ;
      header("location:../index-keranjang.php?pesanan=berhasil");

    }



  }

?>