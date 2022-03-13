<?php
 //print_r($_POST);
 include "../../includes/koneksi.php";
          $id  = isset($_GET['idp']) ? $_GET['idp'] : NULL;
          $cek = $_GET['cek'];
          $sql="SELECT * FROM tb_fasilitas_kamar JOIN tb_kamar ON tb_fasilitas_kamar.id_kamar = tb_kamar.id_kamar WHERE id= $id";
          $result= $conn->query($sql);
          $row = $result->fetch_assoc();
          $namakamar= $row["nama_kamar"];
          $fasilitas= $row["fasilitas"];
          $gambar= $row["gambar"];

if ($cek == 1) {
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
     <tr> 
      <td>Gambar: </td>
       <td>
        <div class="mt-4">
          <img class="img-fluid" max-width: 100%;  height: auto; 
          src="../<?php echo $gambar; ?>" alt="Gambar">
        </div>
       </td>
     </tr>
  </tbody>
 </table>
 
<?php } else if ($cek==0) { ?> 
 
<form id="edit_form_fu">
    <input type="text" id="idfk" name="idfk" value="<?php echo $id; ?>" hidden>
    <div class="mb-3 mt-3 form-floating">
      <select class="form-select mt-3" id="edit_idkamar" name="edit_idkamar">
      <option value="<?php echo $row["id_kamar"]; ?>"> <?php echo $namakamar ?> </option>
                  <?php
                    $sql = "SELECT * FROM tb_kamar";
                    $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                      //membaca data pada baris tabel
                      while($row = $result->fetch_assoc()) {
                  ?>
                        <option value="<?php echo $row["id_kamar"]; ?>"> <?php echo $row["nama_kamar"]; ?> </option>                 
                  <?php 
                    }
                   }
                  ?>
            </select>
           <label for="edit_idkamar">Tipe Kamar</label>
          </div>

      <div class="mb-3 mt-3 form-floating">
        <input type="text" class="form-control" value="<?php echo $fasilitas?>" id="edit_nama_fasilitas" name="edit_nama_fasilitas">
         <label for="nama_fasilitas">Nama Fasilitas</label>
      </div>
          
      <div class="mb-3 mt-3">
         <label for="upload_fasilitas">Pilih Gambar ( Dimensi: 1220 x 360 )</label>
         <input type="file" class="form-control" id="edit_foto" name="edit_foto">        
      </div>

    </form>
    <!-- Modal footer -->
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="edit_fasilitas_kamar">Update</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
    </div>

<?php } ?>

<script>
$(function(){	
/*BAGIAN UPDATE*/
   $("#edit_fasilitas_kamar").on('click', function(){
     var idfk           = $("#idfk").val();
     var idkamar        = $("#edit_idkamar").val();
     var nama_fasilitas = $("#edit_nama_fasilitas").val();
     var gambar         = $("#edit_foto").val();
     var form_data      = new FormData(); 
     
	 if ( (idkamar=="") || (nama_fasilitas==""))
	 {
        alert("Terjadi kesalahan. Ada data yang kosong!");
        return;
	 }
   
      form_data.append("idfk",idfk);
      form_data.append("idkamar",idkamar);
      form_data.append("edit_foto",  document.getElementById('edit_foto').files[0]);
      form_data.append("nama_fasilitas",nama_fasilitas);
      form_data.append("gambar",gambar);

     $.ajax({
     url: "proses/edit_fasilitas_kamar.php",
     method: "POST",
     data: form_data,
     contentType: false,
     cache: false,
     processData: false,
     success: function(data)
      {
        //alert(data);return;
        if (data=="OK") 
         {           
          document.getElementById("edit_form_fu").reset();
          alert("Data Terupdate!")
          window.location.href="index.php?id=fasilitas_kamar";
		     } 
          if (data=="ERROR") 
           {
            alert("Data TIDAK terupdate!")
	         }
	     } 

      });  
     

   });
});

</script>