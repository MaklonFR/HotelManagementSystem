<?php
 //print_r($_POST);
 include "../../includes/koneksi.php"; 
 include "../../includes/timezone.php";

 $id			= $_POST['idfu'];
 $namafu        = $_POST['enamafu'];
 $ketfu 		= $_POST['eketfu']; 
 $today			= date("Y-m-d h:i:sa");
 $jgambar		= $namafu."_".$today;
 $gambar		 = $_POST['egambarfu'];

if ($gambar!=""){
 	if($_FILES["eupload_fasilitas"]["name"] != '')
 	{
 	$name       	 = $_FILES['eupload_fasilitas']['name'];  
 	$temp_name  	 = $_FILES['eupload_fasilitas']['tmp_name']; 
 	$targetPath1 	 = "image/";
 	$targetPath 	 = "../../image/";
 	$extension		 = explode(".", $name);
 	$file_extension = end($extension);

 	$sql = "select * from tb_fasilitas_umum where id='$id'";
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

  	$sql = "UPDATE tb_fasilitas_umum 
  		  SET nama_fasilitas ='$namafu', keterangan ='$ketfu',  gambar='$file_load' 
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
	$sql = "UPDATE tb_fasilitas_umum
		SET nama_fasilitas ='$namafu', keterangan ='$ketfu'
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