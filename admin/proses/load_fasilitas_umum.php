<?php
 //print_r($_POST);
 include "../../includes/koneksi.php";
 ?>

<div class="container mt-2" id="data_fasilitas_umum">
  <h2 class="text-center" >DATA FASILITAS UMUM</h2>
  <h5 class="text-center">Hotel Anaya</h5>
  
  <!-- Desain Pencarian Tanggal dan Nama -->
   <div class="d-flex justify-content-between d-flex flex-row-reverse"">
     <div class="form-floating mb-2 mt-3 ">
       <input type="text" class="form-control" id="cari_fasilitas_umum"  name="cari_fasilitas_umum">
       <label for="cari_fasilitas_umum">Cari Fasilitas Umum</label>
      </div> 
      <div class="form-floating mb-2 mt-3">
           <button type="button" onclick="add_modal_fasilitas_umum()" class="btn btn-outline-primary">Tambah Data</button>
     </div>
   </div> 
 
   <!-- Desain Box Tabel Kamar-->
   <div class="d-flex justify-content-center">
    <div class="card mt-2 mb-4" style="width:2000px">
      <div class="card-body">
      
       <div id="cari_nama" style="overflow-x:auto;">
         <table id="tb_kamar" class="table table-striped" style="width:100%">
          <thead>
            <tr>
                <th>Nama Fasilitasr</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql="SELECT * FROM tb_fasilitas_umum ORDER BY id DESC LIMIT 5";
              $result= $conn->query($sql);
              if ($result->num_rows > 0 ) {
                while ($row = $result->fetch_assoc())
                {
                  
                ?>
            <tr>
                <td><?php echo $row["nama_fasilitas"]; ?></td>
                <td class="text-center"><?php echo $row["keterangan"]; ?></td>
                <td class="text-center"><a href="#" data-id="" class="btn btn-success" onClick="show_modal_fasilitas_umum(this.id)" id="<?php echo $row["id"]; ?>">Lihat</a> 
                    <a href="#" data-id="" class="btn btn-primary" onClick="check_modal_fasilitas_umum(this.id)" id="<?php echo $row["id"]; ?>">Edit</a>
                </td>
            </tr>
            <?php
                }
              } 
            ?>
          </tbody>
         </table>
        </div>

      </div>
     </div>
   </div>
   
</div>

<!------------------------------ Script Awal Modal Tambah Fasilitas Umum ------------------------------ -->
<div class="modal fade" id="modal_tambah_fasilitas_umum">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Data Fasilitas Umum</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="form_fu">
          <div class="mb-3 mt-3 form-floating">
            <input type="text" class="form-control" id="nama_fasilitas_umum" name="nama_fasilitas_umum">
            <label for="nama_fasilitas_umum">Nama Fasilitas</label>
          </div>
          <div class="mb-3 mt-3 form-floating">
            <textarea class="form-control" rows="9" id="ket" name="ket"></textarea>
            <label for="tipe_fasilitas">Ketrangan Fasilitas</label>
          </div>
          <div class="mb-3 mt-3">
            <label for="upload_fasilitas">Pilih Gambar ( Dimensi: 1220 x 360 ):</label>
            <input type="file" class="form-control" name="upload_fasilitas" id="upload_fasilitas">        
          </div>
        </form>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="add_fasilitas_umum">Simpan</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!------------------------------ Script Akhir Modal Tambah Fasilitas Umum------------------------------ -->

<!----------------------------- Script Awal Modal Lihat Data Fasilitas Umum -------------------------------- -->
<div class="modal fade" id="lihat_data_fasilitas_umum">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Deskripsi Fasilitas Umum</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div id="tampil_fasilitas_umum" class="modal-body">
        
      </div>

    </div>
  </div>
</div>
<!----------------------------- Script Akhir Modal Lihat Data Fasilitas Umum-------------------------------- -->

<script type="text/javascript">

 function add_modal_fasilitas_umum()
  {
    $("#modal_tambah_fasilitas_umum").modal('toggle');
  }

  function show_modal_fasilitas_umum(id)
  {
    $("#lihat_data_fasilitas_umum").modal('toggle');
    $.ajax({
     url: "proses/tampil_fasilitas_umum.php",
     method: "GET",
     data:{
		   idp:id
	      },
     success: function(data)
      {
        $("#tampil_fasilitas_umum").html(data).refresh;
      }
    });
  }

$(function(){	
   $("#add_fasilitas_umum").on('click', function(){
     var namafu       = $("#nama_fasilitas_umum").val();
     var ketfu        = $("#ket").val();
     var gambarfu     = $("#upload_fasilitas").val();
     var form_datafu  = new FormData(); 


	 if ( (namafu=="") || (ketfu==""))
	 {
        alert("Terjadi kesalahan. Ada data yang kosong!");
        return;
	 }
   if (gambarfu=="")
    {
    alert("Terjadi kesalahan. Gambar kosong!");
       return;
    }
	 
   var oFReader = new FileReader();
   oFReader.readAsDataURL(document.getElementById("upload_fasilitas").files[0]);
   var f = document.getElementById("upload_fasilitas").files[0];
   var fsize = f.size||f.fileSize;
   if(fsize > 2000000)
   {
    alert("Terjadi kesalahan. Gambar Besar!");
    return;
   }
   else
   {
      form_datafu.append("namafu",namafu);
      form_datafu.append("fotofu",  document.getElementById('upload_fasilitas').files[0]);
      form_datafu.append("ketfu",ketfu);
      form_datafu.append("gambarfu",gambarfu);
	 
     $.ajax({
     url: "proses/tambah_fasilitas_umum.php",
     method: "POST",
     data: form_datafu,
     contentType: false,
     cache: false,
     processData: false,
     success: function(data)
      {
        //alert(data);return;
        if (data=="OK") 
         {
          alert("Data Tersimpan!");
          document.getElementById("form_fu").reset();
          window.location.href="index.php?id=fasilitas_umum";
		     } 
          if (data=="ERROR") 
           {
            alert("Data TIDAK tersimpan!");
	         }
	     } 

      }); 
    } 
  });
	
});

 </script>
