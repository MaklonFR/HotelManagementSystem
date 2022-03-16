 <?php
 //print_r($_POST);
  include "../../includes/koneksi.php";
 ?>
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
              $s_kata = $_POST['kata'];
              $cari_kata = '%'. $s_kata .'%';
              $sql="SELECT * FROM tb_kamar WHERE (nama_kamar LIKE ?) ORDER BY id_kamar DESC LIMIT 20";
              $result_satu= $conn->prepare($sql);
              $result_satu->bind_param('s',$cari_kata);
              $result_satu->execute();
              $result= $result_satu->get_result();

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

</script>
