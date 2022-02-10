<?php
 //print_r($_POST);
 include "../../includes/koneksi.php";

          $id  = isset($_GET['idp']) ? $_GET['idp'] : NULL;
          $sql="SELECT * FROM tb_fasilitas_umum WHERE id= $id";
          $result= $conn->query($sql);
          $row = $result->fetch_assoc();
          $nf = $row["nama_fasilitas"];
          $ket= $row["keterangan"];

?>
 <table class="table table-striped" style="width:100%">

  <tbody>
     <tr>
       <td>Nama Kamar </td>
       <td>: <?php echo $nf; ?> </td>
     </tr>
     <tr>
       <td>Total Kamar </td>
       <td>: <?php echo $ket; ?> </td>
     </tr>
  </tbody>

 </table>

