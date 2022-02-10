<?php
 //print_r($_POST);
 include "../../includes/koneksi.php";

    $id        = $_POST['ids'];
    $proses    = $_POST['proses'];

     $sql = "UPDATE tb_pelanggan SET status ='$proses' WHERE (id= '$id')"; 
     if (($conn->query($sql)==1)) {
          $data = "OK";
          echo $data;
        }
         else 
         {
         $data = "ERROR";
         echo $data;
         }

 ?>