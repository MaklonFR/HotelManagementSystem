<?php
 //print_r($_POST);
 include "../../includes/koneksi.php"; 
 include "../../includes/timezone.php";

 $namafu        = $_POST['namafu'];
 $ketfu 		= $_POST['ketfu']; 
 $today			= date("Y-m-d h:i:sa");
 $jgambar		= $namafu."_".$today;

 if($_FILES["fotofu"]["name"] != '')
 {
 $name       	 = $_FILES['fotofu']['name'];  
 $temp_name  	 = $_FILES['fotofu']['tmp_name']; 
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

  $sql = "INSERT INTO tb_fasilitas_umum (nama_fasilitas, keterangan, gambar) 
			        VALUES ('$namafu','$ketfu','$file_load')";					
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