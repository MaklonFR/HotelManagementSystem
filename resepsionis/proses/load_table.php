 <?php
 //print_r($_POST);
 include "../../includes/koneksi.php";
 ?>
 <!-- Desain Pencarian Tanggal dan Nama -->
 <div class="d-flex justify-content-between">
    <div class="form-floating mb-2 mt-3 ">
     <input type="date" class="form-control" id="tgl"  name="tgl">
     <label for="tgl">Cari Tanggal</label>
    </div> 
    <div class="form-floating mb-2 mt-3 ">
      <input type="text" class="form-control" id="carinama"  name="carinama">
      <label for="carinama">Cari Nama Pemesan</label>
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
                <th>Status</th>
                <th>Nama Tamu</th>
                <th>Tanngal Pesan</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Kamar</th>
                <th>Jumlah Kamar</th>
                <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql="SELECT * FROM tb_pelanggan JOIN tb_kamar ON tb_pelanggan.id_kamar = tb_kamar.id_kamar ORDER BY tb_pelanggan.tgl_pesan DESC LIMIT 20";
              $result= $conn->query($sql);
              if ($result->num_rows > 0 ) {
                while ($row = $result->fetch_assoc())
                {
                  if ($row["status"]=="1"){
                    $status="Selesai Checkin"; $warna="badge bg-success";
                    } if ($row["status"]=="0"){
                      $status="Dalam Proses"; $warna="badge bg-warning";
                        } else if ($row["status"]==""){$status="Batal"; $warna="badge bg-danger";}
            ?>
            <tr>
                <td><span class="<?php echo $warna; ?>"><?php echo $status;  ?></span></td>
                <td><?php echo $row["nama_tamu"]; ?></td>
                <td><?php echo $row["tgl_pesan"]; ?></td>
                <td><?php echo $row["checkin"]; ?></td>
                <td><?php echo $row["checkout"]; ?></td>
                <td><?php echo $row["nama_kamar"]; ?></td>
                <td class="text-center"><?php echo $row["jml_kamar"]; ?></td>
                <td><a href="#" data-id="" class="btn btn-success" onClick="show_modal_reservasi(this.id)" id="<?php echo $row["id"]; ?>">Lihat</a> 
                    <a href="#" data-id="" class="btn btn-primary" onClick="check_modal_reservasi(this.id)" id="<?php echo $row["id"]; ?>">Proses</a>
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


<script type="text/javascript">
  function check_modal_reservasi(id)
  {
    document.getElementById("id_proses").value=id;
    $("#modal_check_reservasi").modal("show");
  }

  function show_modal_reservasi(id)
  {
    $("#modal_lihat_reservasi").modal('toggle');
    $.ajax({
     url: "proses/tampil_pelanngan.php",
     method: "GET",
     data:{
		   idp:id
	      },
     success: function(data)
      {
        //alert(data);return;
        $("#pelanngan").html(data).refresh;
        //$("#modal_show_reservasi").modal("show");
      }
    });
  }

  $('#carinama').keyup(function(){
	var kata = $("#carinama").val();
	$.ajax({
     url: "proses/cari_nama.php",
     method: "POST",
     data:{kata:kata},
          success: function(data)
          {
            //alert(data);return;
            $("#cari_nama").html(data).refresh;
          }
        });
});

$(document).ready(function(){
    var tgl = document.getElementById('tgl');     
        tgl.valueAsDate = new Date();
        
        $("#tgl").on("change",function(){
            tanggal = tgl.value;
            //console.log(this.value);
            $.ajax({
            url: "proses/cari_tanggal.php",
            method: "POST",
            data:{tanggal:tanggal},
              success: function(data)
              {
                //alert(data);return;
                $("#cari_nama").html(data).refresh;
              }
            });
        });
});

</script>
