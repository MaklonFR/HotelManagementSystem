<?php
 //print_r($_POST);
 include "../../includes/koneksi.php"; 
 $nama      = $_POST['nama'];
 $ket    = $_POST['ket'];

  $sql = "INSERT INTO tb_fasilitas_umum (nama_fasilitas, keterangan) 
			        VALUES ('$nama','$ket')";					
            if($conn->query($sql) == 1)
            {
             $data = "OK";
             echo $data;               
			}
			else
			{
			 $data = "ERROR";
			 echo $data;
			}
?>