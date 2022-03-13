<?php
 //print_r($_POST);
 include "../../includes/koneksi.php";
 ?>

<div class="container mt-2" id="data_kamar">
 <h2 class="text-center" >DATA KAMAR</h2>
 <h5 class="text-center">Hotel Anaya</h5>

<!-- Desain Pencarian Tanggal dan Nama -->
<div class="d-flex justify-content-between d-flex flex-row-reverse">
    <div class="form-floating mb-2 mt-3">
      <input type="text" class="form-control" id="nama"  name="nama">
      <label for="nama">Cari Nama Kamar</label>
     </div> 
     <div class="form-floating mb-2 mt-3">
           <button type="button" onclick="add_modal_kamar()" class="btn btn-outline-primary">Tambah Data</button>
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
                <th>Nama Kamar</th>
                <th class="text-center">Total Kamar</th>
                <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql="SELECT * FROM tb_kamar ORDER BY id_kamar ASC LIMIT 10";
              $result= $conn->query($sql);
              if ($result->num_rows > 0 ) {
                while ($row = $result->fetch_assoc())
                {
                  
                ?>
            <tr>
                <td><?php echo $row["nama_kamar"]; ?></td>
                <td class="text-center"><?php echo $row["total_kamar"]; ?></td>
                <td class="text-center">
                  <a href="#" data-id="" class="btn btn-success" onClick="show_modal_kamar(this.id)" id="<?php echo $row["id_kamar"]; ?>">Lihat</a> 
                  <a href="#" data-id="" class="btn btn-primary" onClick="edit_modal_kamar(this.id)" id="<?php echo $row["id_kamar"]; ?>">Edit</a>
                  <a href="#" data-id="" class="btn btn-danger"  onClick="delete_modal_kamar(this.id)" id="<?php echo $row["id_kamar"]; ?>">Delete</a>
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

<!------------------------------ Script Awal Modal Tambah Kamar ------------------------------->
<div class="modal fade" id="modal_tambah_kamar">
  <div class="modal-dialog ">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Data Kamar</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="form_k">
          <div class="mb-3 mt-3 form-floating">
            <input type="text" class="form-control" id="nama_kamar" name="nama_kamar">
            <label for="nama_kamar">Nama Kamar</label>
          </div>
          <div class="mb-3 mt-3 form-floating">
            <input type="number" class="form-control" id="jml_kamar" name="jml_kamar">
            <label for="jml_kamar">Jumlah Kamar</label>
          </div>
        </form>

      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="add_kamar">Simpan</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!------------------------------ Script Akhir Modal Tambah Kamar ------------------------------ -->

<!----------------------------- Script Awal Modal Lihat Data Kamar -------------------------------- -->
<div class="modal fade" id="lihat_data_kamar">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Deskripsi Kamar</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div id="tampil_kamar" class="modal-body">
        
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <p class="text-center">@Desain by UKK RPL 2022</p>
      </div>
      
    </div>
  </div>
</div>
<!----------------------------- Script Akhir Modal Lihat Data Kamar -------------------------------- -->

<!------------------------------ Script Awal Modal EDIT Kamar ------------------------------->
<div class="modal fade" id="modal_edit_kamar">
  <div class="modal-dialog ">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Data Kamar</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
      <!-- Modal body -->
      <div id="tedit_kamar" class="modal-body">

      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="update_kamar">Simpan</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!------------------------------ Script Akhir Modal EDIT Kamar ------------------------------ -->

<script>
 function add_modal_kamar()
  {
    $("#modal_tambah_kamar").modal('toggle');
  }

  function show_modal_kamar(id)
  {
    $("#lihat_data_kamar").modal('toggle');
    $.ajax({
     url: "proses/tampil_kamar.php",
     method: "GET",
     data:{
		   idp:id
	      },
     success: function(data)
      {
        $("#tampil_kamar").html(data).refresh;
      }
    });
  }

  function edit_modal_kamar(id)
  {
    $("#modal_edit_kamar").modal('toggle');
    $.ajax({
     url: "proses/edit_kamar.php",
     method: "GET",
     data:{
		   idp:id
	      },
     success: function(data)
      {
        $("#tedit_kamar").html(data).refresh;
      }
    });
  }

  function delete_modal_kamar(id)
  {
    $.ajax({
     url: "proses/delete_kamar.php",
     method: "POST",
     data:{
		        idp:id
	        },
        success: function(data)
        {
        if (data=="OK") 
         {
          alert("Data Berhasil dihapus!");
          window.location.href="index.php?id=kamar";
		     } 
          if (data=="ERROR") 
           {
            alert("Data Gagal dihapus!");
	         }
        }
    });
  }

$(function(){	
    $("#add_kamar").on('click', function(){
     var nama    = $("#nama_kamar").val();
     var jkamar  = $("#jml_kamar").val();

	 if ( (nama=="") || (jkamar==""))
	 {
        alert("Terjadi kesalahan. Ada data yang kosong!");
        return;
	 }
	 
     $.ajax({
     url: "proses/tambah_kamar.php",
     method: "POST",
     data:{
		       nama:nama, 
           jkamar: jkamar
	      },
     success: function(data)
      {
        if (data=="OK") 
         {
          alert("Data Tersimpan!");
          window.location.href="index.php?id=kamar";
		     } 
          if (data=="ERROR") 
           {
            alert("Data TIDAK tersimpan!");
	         }
           document.getElementById("form_k").reset();
	     } 

      });  
    });
	
});

$(function(){	
    $("#update_kamar").on('click', function(){
     var idk      = $("#idk").val();
     var enama    = $("#enama_kamar").val();
     var ejkamar  = $("#ejml_kamar").val();

	 if ( (enama=="") || (ejkamar==""))
	 {
        alert("Terjadi kesalahan. Ada data yang kosong!");
        return;
	 }
	 
     $.ajax({
     url: "proses/update_kamar.php",
     method: "POST",
     data:{
           idk    : idk,
		       nama   : enama, 
           jkamar : ejkamar
	      },
     success: function(data)
      {
        if (data=="OK") 
         {
          alert("Data Terupdate!");
          window.location.href="index.php?id=kamar";
		     } 
          if (data=="ERROR") 
           {
            alert("Data TIDAK terupdate!");
	         }
           document.getElementById("form_ke").reset();
	     } 

      });  
    });
	
});
  
</script>



