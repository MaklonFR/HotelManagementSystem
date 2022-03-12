<?php
 //print_r($_POST);
 include "../../includes/koneksi.php";

          $id  = isset($_GET['idp']) ? $_GET['idp'] : NULL;
          $sql="SELECT * FROM tb_kamar WHERE id_kamar= $id";
          $result= $conn->query($sql);
          $row = $result->fetch_assoc();
          $total_kamar= $row["total_kamar"];
          $namakamar= $row["nama_kamar"];

?>
<form id="form_ke">
  <input type="text" id="idk" value="<?php echo $id; ?>" hidden>
          <div class="mb-3 mt-3 form-floating">
            <input value="<?php echo $namakamar; ?>" type="text" class="form-control" id="enama_kamar" name="enama_kamar">
            <label for="nama_kamar">Nama Kamar</label>
          </div>
          <div class="mb-3 mt-3 form-floating">
            <input value="<?php echo $total_kamar; ?>" type="number" class="form-control" id="ejml_kamar" name="ejml_kamar">
            <label for="jml_kamar">Jumlah Kamar</label>
          </div>

 </form>

