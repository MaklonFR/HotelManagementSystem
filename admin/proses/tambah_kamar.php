<?php
 //print_r($_POST);
 include "../../includes/koneksi.php"; 
 $nama      = $_POST['nama'];
 $jkamar    = $_POST['jkamar'];

  $sql = "INSERT INTO tb_kamar (nama_kamar, total_kamar) 
			        VALUES ('$nama','$jkamar')";					
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