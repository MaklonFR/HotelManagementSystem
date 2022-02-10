 <?php
 //print_r($_POST);
 include "../../includes/koneksi.php";
 ?>
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
              $s_tanggal = $_POST['tanggal'];
              echo $s_tanggal;
              //$cari_tanggal = '%'. $s_tanggal .'%';
              $sql="SELECT * FROM tb_pelanggan JOIN tb_kamar ON tb_pelanggan.id_kamar = tb_kamar.id_kamar 
                    WHERE tb_pelanggan.checkin='$s_tanggal' ORDER BY tb_pelanggan.tgl_pesan DESC LIMIT 20";

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
              } else 
              {
                echo "<tr>
                        <td colspan='7' class='text-center'><span class='badge bg-danger'> Tidak ada data ditemukan </span></td>
                      </tr>";
              }
            ?>
          </tbody>
       </table>

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

</script>
