<?php

include '../koneksi.php';

if(isset($_POST['edit']))
{
    $id_forum = $_POST['id_forum'];
    $nama_forum = $_POST['nama_forum'];
    $link = $_POST['link'];
    $deskripsi_forum = $_POST['deskripsi_forum'];

    $query = pg_query("UPDATE forum SET nama_forum='$nama_forum', deskripsi_forum='$deskripsi_forum', link='$link' WHERE id_forum='$id_forum' ");

    if ($query){
        echo "<script>alert ('Data Successfully Change');</script>";
    }else{
        echo "<script>alert ('Error');</script>";
    }
    header("location:../index-diskusi.php?berhasil=yes");

}


?>