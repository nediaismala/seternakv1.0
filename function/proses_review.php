<?php
include('../config.php');

if(isset($_POST['submit'])){
    $feedback=$_POST['feedback'];
    $rating = $_POST['rating'];
    $id=$_POST['id'];
    $query = pg_query($dbconn,"UPDATE pemesanan SET feedback='$feedback', rating='$rating' WHERE no_pemesanan='$id'");
    // $hasil = pg_affected_rows($query);
    if($query){
        echo '<script>'; 
        echo 'alert("Berhasil");'; 
        echo 'window.location.href = "../so-selesai-mitra.php";';
        echo '</script>';
    }else{
        // echo '<script>'; 
        // echo 'alert("Gagal");'; 
        // echo 'window.location.href = "../so-selesai-mitra.php";';
        // echo '</script>';
    }
}

?>