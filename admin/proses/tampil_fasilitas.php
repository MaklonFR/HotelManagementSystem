<?php
 //print_r($_POST);
 include "../../includes/koneksi.php";

          $id  = isset($_GET['idp']) ? $_GET['idp'] : NULL;
          $sql="SELECT * FROM tb_fasilitas_kamar JOIN tb_kamar ON tb_fasilitas_kamar.id_kamar = tb_kamar.id_kamar WHERE id= $id";
          $result= $conn->query($sql);
          $row = $result->fetch_assoc();
          $namakamar= $row["nama_kamar"];
          $fasilitas= $row["fasilitas"];
?>
 <table class="table table-striped" style="width:100%">

  <tbody>
     <tr>
       <td>Nama Kamar </td>
       <td>: <?php echo $namakamar; ?> </td>
     </tr>
     <tr>
       <td>Fasilitas </td>
       <td>: <?php echo $fasilitas; ?> </td>
     </tr>
  </tbody>

 </table>

