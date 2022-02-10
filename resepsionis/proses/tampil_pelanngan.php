<?php
 //print_r($_POST);
 include "../../includes/koneksi.php";

          $id  = isset($_GET['idp']) ? $_GET['idp'] : NULL;
          $sql="SELECT * FROM tb_pelanggan JOIN tb_kamar ON tb_pelanggan.id_kamar = tb_kamar.id_kamar WHERE id= $id";
          $result= $conn->query($sql);
          $row = $result->fetch_assoc();
          $namapesan= $row["nama_pemesan"];
          $email= $row["email"];
          $hp= $row["hp"];
          $namatamu= $row["nama_tamu"];
          $tglpesan= $row["tgl_pesan"];
          $checkin= $row["checkin"];
          $checkout= $row["checkout"];
          $namakamar= $row["nama_kamar"];
          $jmlkamar = $row["jml_kamar"]; 
?>
 <table class="table table-striped" style="width:100%">

  <tbody>
     <tr>
       <td>Nama Pemesan </td>
       <td><?php echo $namapesan; ?> </td>
     </tr>
     <tr>
       <td>Nama Tamu </td>
       <td><?php echo $namatamu; ?> </td>
     </tr>
     <tr>
       <td>Email </td>
       <td><?php echo $email; ?> </td>
     </tr>
     <tr>
       <td>No. HP </td>
       <td><?php echo $hp; ?> </td>
     </tr>
     <tr>
       <td>Tanggal Pesan </td>
       <td><?php echo $tglpesan; ?> </td>
     </tr>
     <tr>
       <td>Tanggal Checkin </td>
       <td><?php echo $checkin; ?> </td>
     </tr>
     <tr>
       <td>Tanggal Checkout </td>
       <td><?php echo $checkout; ?> </td>
     </tr>
     <tr>
       <td>Nama Kamar </td>
       <td><?php echo $namakamar; ?> </td>
     </tr>
     <tr>
       <td>Jumlah Kamar </td>
       <td><?php echo $jmlkamar; ?> </td>
     </tr>
  </tbody>

 </table>

