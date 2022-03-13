<?php
 //print_r($_POST);
 include "../../includes/koneksi.php";
          $id  = isset($_GET['idp']) ? $_GET['idp'] : NULL;
          $cek = $_GET['cek'];
          $sql="SELECT * FROM tb_fasilitas_umum WHERE id= $id";
          $result= $conn->query($sql);
          $row    = $result->fetch_assoc();
          $nf     = $row["nama_fasilitas"];
          $ket    = $row["keterangan"];
          $gambar = $row["gambar"];

if ($cek == 1) {
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

 <!------------------------------ Script Awal Modal Edit Fasilitas Umum ------------------------------ -->
        <form id="form_efu">
        <input type="text" id="idfu" name="idfu" value="<?php echo $id; ?>" hidden>
          <div class="mb-3 mt-3 form-floating">
            <input type="text" value="<?php echo $nf ?>" class="form-control" id="enama_fasilitas_umum" name="enama_fasilitas_umum">
            <label for="nama_fasilitas_umum">Nama Fasilitas</label>
          </div>
          <div class="mb-3 mt-3 form-floating">
            <textarea class="form-control" rows="9" id="eket" name="eket"><?php echo $ket ?></textarea>
            <label for="tipe_fasilitas">Ketrangan Fasilitas</label>
          </div>
          <div class="mb-3 mt-3">
            <label for="upload_fasilitas">Pilih Gambar ( Dimensi: 1220 x 360 ):</label>
            <input type="file" class="form-control" name="eupload_fasilitas" id="eupload_fasilitas">        
          </div>
          <button type="button" class="btn btn-primary" id="edit_fasilitas_umum">Simpan</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </form>
<!------------------------------ Script Akhir Modal Edit Fasilitas Umum------------------------------ -->

<?php } ?>


<script>
$(function(){	
   $("#edit_fasilitas_umum").on('click', function(){
     var idfu          = $("#idfu").val();
     var enamafu       = $("#enama_fasilitas_umum").val();
     var eketfu        = $("#eket").val();
     var egambarfu     = $("#eupload_fasilitas").val();
     var eform_datafu  = new FormData(); 

	 if ( (enamafu=="") || (eketfu==""))
	 {
        alert("Terjadi kesalahan. Ada data yang kosong!");
        return;
	 }
	 
      eform_datafu.append("idfu",idfu);
      eform_datafu.append("enamafu",enamafu);
      eform_datafu.append("eupload_fasilitas",  document.getElementById('eupload_fasilitas').files[0]);
      eform_datafu.append("eketfu",eketfu);
      eform_datafu.append("egambarfu",egambarfu);
	 
     $.ajax({
     url: "proses/edit_fasilitas_umum.php",
     method: "POST",
     data: eform_datafu,
     contentType: false,
     cache: false,
     processData: false,
     success: function(data)
      {
        //alert(data);return;
        if (data=="OK") 
         {
          alert("Data Tersimpan!");
          document.getElementById("form_efu").reset();
          window.location.href="index.php?id=fasilitas_umum";
		     } 
          if (data=="ERROR") 
           {
            alert("Data TIDAK tersimpan!");
	         }
	     } 

      }); 
  
  });
	
});
</script>