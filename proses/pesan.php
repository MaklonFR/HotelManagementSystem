<?php
 //print_r($_POST);
 include "../includes/koneksi.php";
 include '../includes/timezone.php'; 
 $nama      = $_POST['nama'];
 $email     = $_POST['email'];
 $hp        = $_POST['hp'];
 $tamu      = $_POST['tamu'];
 $checkin   = $_POST['checkin'];
 $checkout  = $_POST['checkout'];
 $jkamar    = $_POST['jkamar'];
 $idkamar   = $_POST['idkamar'];
 $today = date('Y-m-d h:i:sa');

  $sql = "INSERT INTO tb_pelanggan (nama_pemesan, email, hp, nama_tamu, tgl_pesan, checkin, checkout, jml_kamar, id_kamar) 
			        VALUES ('$nama','$email', '$hp', '$tamu', '$today', '$checkin', '$checkout', '$jkamar', '$idkamar')";					
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