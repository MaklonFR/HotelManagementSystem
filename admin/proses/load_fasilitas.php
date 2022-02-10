<?php
 //print_r($_POST);
 include "../../includes/koneksi.php";
 ?>

<div class="container mt-2" id="data_fasilitas">
  <h2 class="text-center" >DATA FASILITAS</h2>
  <h5 class="text-center">Hotel Anaya</h5>
  
  <!-- Desain Pencarian Tanggal dan Nama -->
   <div class="d-flex justify-content-between d-flex flex-row-reverse"">
     <div class="form-floating mb-2 mt-3 ">
       <input type="text" class="form-control" id="cari_fasilitas"  name="cari_fasilitas">
       <label for="cari_fasilitas">Cari Fasilitas</label>
      </div> 
      <div class="form-floating mb-2 mt-3">
           <button type="button" onclick="add_modal_fasilitas()" class="btn btn-outline-primary">Tambah Data</button>
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
                <th>Tipe Kamar</th>
                <th class="text-center">Nama Fasilitas</th>
                <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql="SELECT * FROM tb_fasilitas_kamar JOIN tb_kamar ON tb_fasilitas_kamar.id_kamar = tb_kamar.id_kamar ORDER BY id DESC LIMIT 5";
              $result= $conn->query($sql);
              if ($result->num_rows > 0 ) {
                while ($row = $result->fetch_assoc())
                {
                  
                ?>
            <tr>
                <td><?php echo $row["nama_kamar"]; ?></td>
                <td class="text-center"><?php echo $row["fasilitas"]; ?></td>
                <td class="text-center"><a href="#" data-id="" class="btn btn-success" onClick="show_modal_fasilitas_kamar(this.id)" id="<?php echo $row["id"]; ?>">Lihat</a> 
                    <a href="#" data-id="" class="btn btn-primary" onClick="check_modal_fasilitas_kamar(this.id)" id="<?php echo $row["id"]; ?>">Edit</a>
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

<!------------------------------ Script Awal Modal Tambah Fasilitas ------------------------------ -->
<div class="modal fade" id="modal_tambah_fasilitas">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Data Fasilitas</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="form_fu">
          <div class="mb-3 mt-3 form-floating">
          <select class="form-select mt-3" id="idkamar" name="idkamar">
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
           <label for="idkamar">Tipe Kamar</label>
          </div>

          <div class="mb-3 mt-3 form-floating">
            <input type="text" class="form-control" id="nama_fasilitas" name="nama_fasilitas">
            <label for="nama_fasilitas">Nama Fasilitas</label>
          </div>
          
          <div class="mb-3 mt-3">
            <label for="upload_fasilitas">Pilih Gambar:</label>
            <input type="file" class="form-control" id="upload_fasilitas">        
          </div>

        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="add_fasilitas_kamar">Simpan</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!------------------------------ Script Akhir Modal Tambah Fasilitas ------------------------------ -->

<!----------------------------- Script Awal Modal Lihat Data Fasilitas -------------------------------- -->
<div class="modal fade" id="lihat_data_fasilitas">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Deskripsi Fasilitas</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div id="tampil_fasilitas" class="modal-body">
        
      </div>

    </div>
  </div>
</div>
<!----------------------------- Script Akhir Modal Lihat Data Fasilitas -------------------------------- -->

<script type="text/javascript">
  
  function add_modal_fasilitas()
  {
    $("#modal_tambah_fasilitas").modal('toggle');
  }
  
  function show_modal_fasilitas_kamar(id)
  {
    $("#lihat_data_fasilitas").modal('toggle');
    $.ajax({
     url: "proses/tampil_fasilitas.php",
     method: "GET",
     data:{
		   idp:id
	      },
     success: function(data)
      {
        $("#tampil_fasilitas").html(data).refresh;
      }
    });
  }

$(function(){	
   $("#add_fasilitas_kamar").on('click', function(){
     var idkamar        = $("#idkamar").val();
     var nama_fasilitas = $("#nama_fasilitas").val();
     document.getElementById("form_fu").reset();

	 if ( (idkamar=="") || (nama_fasilitas==""))
	 {
        alert("Terjadi kesalahan. Ada data yang kosong!");
        return;
	 }
	 
     $.ajax({
     url: "proses/tambah_fasilitas_kamar.php",
     method: "POST",
     data:{
           idkamar:idkamar, 
           nama_fasilitas: nama_fasilitas
	      },
     success: function(data)
      {
        //alert(data);return;
        if (data=="OK") 
         {
          alert("Data Tersimpan!")
          window.location.href="index.php?id=fasilitas_kamar";
		     } 
          if (data=="ERROR") 
           {
            alert("Data TIDAK tersimpan!")
	         }
	     } 

      });  
    });
	
});

</script>
