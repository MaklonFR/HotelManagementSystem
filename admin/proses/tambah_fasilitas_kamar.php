<?php
 //print_r($_POST);
 include "../../includes/koneksi.php"; 
 $idkamar        = $_POST['idkamar'];
 $nama_fasilitas = $_POST['nama_fasilitas'];

  $sql = "INSERT INTO tb_fasilitas_kamar (id_kamar, fasilitas) 
			        VALUES ('$idkamar','$nama_fasilitas')";					
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