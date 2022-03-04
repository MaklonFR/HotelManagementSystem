<?php
// print_r($_POST);

 include "../../includes/koneksi.php"; 
 include "../../includes/timezone.php";
 $id			 = $_POST['idfk'];
 $idkamar        = $_POST['idkamar'];
 $nama_fasilitas = $_POST['nama_fasilitas']; 
 $today			 = date("Y-m-d h:i:sa");
 $jgambar		 = $nama_fasilitas."_".$today;
 $gambar		 = $_POST['gambar'];

if ($gambar!=""){
 	if($_FILES["edit_foto"]["name"] != '')
 	{
 	$name       	 = $_FILES['edit_foto']['name'];  
 	$temp_name  	 = $_FILES['edit_foto']['tmp_name']; 
 	$targetPath1 	 = "image/";
 	$targetPath 	 = "../../image/";
 	$extension		 = explode(".", $name);
 	$file_extension = end($extension);

 	$sql = "select * from tb_fasilitas_kamar where id='$id'";
 	$query = $conn->query($sql);
 	$row = $query->fetch_assoc();

 	$url = preg_replace("![^a-z0-9]+!i", "", $jgambar);
 	//echo $url;

 	//target file hapus
 	$targetFile1 = $targetPath . basename($row['gambar']); 

 	$targetFile = $targetPath . basename($url.".".$file_extension);  
 	$file_load  = $targetPath1 .$url.".".$file_extension;

 	if(file_exists($targetFile1))
 	{
   		unlink('../../'.$row['gambar']);
 	}
 	move_uploaded_file($temp_name, $targetFile);
 	//echo $file_load;

  	$sql = "UPDATE tb_fasilitas_kamar 
  		  SET id_kamar ='$idkamar', fasilitas ='$nama_fasilitas',  gambar='$file_load' 
  		  WHERE (id= '$id')"; 					
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
} else
{
	$sql = "UPDATE tb_fasilitas_kamar 
		SET id_kamar ='$idkamar', fasilitas ='$nama_fasilitas'
		WHERE (id= '$id')"; 					
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