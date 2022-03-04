<?php
 //print_r($_POST);
 
 include "../../includes/koneksi.php"; 
 include "../../includes/timezone.php"; 
 $idkamar        = $_POST['idkamar'];
 $nama_fasilitas = $_POST['nama_fasilitas']; 
 $today			 = date("Y-m-d h:i:sa");
 $jgambar		 = $nama_fasilitas."_".$today;

 if($_FILES["foto"]["name"] != '')
 {
 $name       	 = $_FILES['foto']['name'];  
 $temp_name  	 = $_FILES['foto']['tmp_name']; 
 $targetPath1 	 = "image/";
 $targetPath 	 = "../../image/";
 $extension		 = explode(".", $name);
 $file_extension = end($extension);

 $url = preg_replace("![^a-z0-9]+!i", "", $jgambar);
 //echo $url;

 $targetFile = $targetPath . basename($url.".".$file_extension);  
 $file_load  = $targetPath1 .$url.".".$file_extension;

 move_uploaded_file($temp_name, $targetFile);
 //echo $file_load;

  $sql = "INSERT INTO tb_fasilitas_kamar (id_kamar, fasilitas, gambar) 
			        VALUES ('$idkamar','$nama_fasilitas','$file_load')";					
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
}
?>