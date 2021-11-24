<?php
session_start();
include("../config.php");

    if(isset($_POST['upload'])){
        $id=$_POST['id'];
        $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
        $nama = $_FILES['file']['name'];
        $x = explode('.', $nama);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];	

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if($ukuran < 1044070){			
                move_uploaded_file($file_tmp, '../upload/'.$nama);
                $query = pg_query($dbconn,"UPDATE pemesanan SET bukti_pembayaran='$nama' WHERE no_pemesanan='$id'");
                if(pg_affected_rows($query)){
                    echo '<script>'; 
                    echo 'alert("Data Successfully Added");'; 
                    echo 'window.location.href = "../so-belumbayar-mitra.php";';
                    echo '</script>';
                }else{
                    echo '<script>'; 
                    echo 'alert("Data Unsuccessfully Added");'; 
                    echo 'window.location.href = "../so-belumbayar-mitra.php";';
                    echo '</script>';
                }
            }else{
                echo '<script>'; 
                echo 'alert("Ukuran data lebih dari 1MB");'; 
                echo 'window.location.href = "../so-belumbayar-mitra.php";';
                echo '</script>';
            }
        }else{
            echo '<script>'; 
            echo 'alert("Tambahkan file .jpg, .png, .jpeg");'; 
            echo 'window.location.href = "../so-belumbayar-mitra.php";';
            echo '</script>';
        }
    }
   
?>