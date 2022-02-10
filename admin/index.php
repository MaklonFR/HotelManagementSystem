<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin - Hotel Booking</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="../hotel.png" />
  <link href="../css/bootstrap5.0.1.min.css" rel="stylesheet">
</head>
<body>

<div class="p-2 bg-secondary text-white text-center">
     <h1>HOTEL ANAYA</h1>
     <p>Selamat datang di Hotel Anaya Labuan Bajo Indonesia!</p> 
</div>

<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
      <div class="container-fluid">
          <h4><a class="nav-link text-white">ADMIN</a></h4> 
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
           <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="mynavbar">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
             <h5><a class="nav-link" href="#" id="tombol_kamar">Kamar</a></h5> 
            </li>
            <li class="nav-item">
              <h5><a class="nav-link" href="#" id="tombol_fasilitas">Fasilitas Kamar</a></h5> 
            </li>
            <li class="nav-item">
              <h5><a class="nav-link" href="#" id="tombol_fasilitas_umum">Fasilitas Umum</a></h5>
            </li>
          </ul>     
  
        </div>
      </div>
</nav>

<!-------- PANGGIL DATA KAMAR, FASILITAS DAN FASILITAS UMUM ------>
<div id="data"> 
   
</div>

<!-- SCRIPT FOOTER -->
<div class="mt-5 p-2 bg-dark text-white text-center">
  <p>@Desain by UKK RPL 2022</p>
</div>

<!-- SCRIPT JAVASCRIPT -->
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap5.0.1.bundle.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

  /*tombol tambah(+) fasilitas*/
    $("#add_fasilitas").click(function() {
    $("#modal_tambah_fasilitas").modal('show');
  });

  /*tombol tambah(+) fasilitas umum*/
    $("#add_fasilitas_umum").click(function() {
    $("#modal_tambah_fasilitas_umum").modal('show');
  });
  
  /*Saat klik tombol Menu Kamar*/
    $("#tombol_kamar").click(function() {
    load_kamar();
  });

  /*Saat klik tombol Menu Fasilitas kamar*/
  $("#tombol_fasilitas").click(function() {
    load_fasilitas_kamar();
  });

  /*Saat klik tombol Menu Fasilitas Umum*/
  $("#tombol_fasilitas_umum").click(function() {
    load_fasilitas_umum();
  });
    
   $("#show_kamar").click(function() {
   $("#lihat_data_kamar").modal("show");
   });

   $("#show_fasilitas").click(function() {
   $("#lihat_data_fasilitas").modal("show");
   });

   $("#show_fasilitas_umum").click(function() {
   $("#lihat_data_fasilitas_umum").modal("show");
   });

load_kamar();
if (window.location.href.indexOf('index.php?id=kamar') > -1) {
load_kamar();
} else 
 if (window.location.href.indexOf('index.php?id=fasilitas_kamar') > -1) {
   load_fasilitas_kamar();
 } else
 if (window.location.href.indexOf('index.php?id=fasilitas_umum') > -1) {
   load_fasilitas_umum();
 }

function load_kamar() 
{
 var id=0;
 $.ajax({
    url: "proses/load_kamar.php",
    method: "POST",
    data:{ids:id},
         success: function(data)
         {
           //alert(data);return;
           $("#data").html(data).refresh;
         }
       });
 }

function load_fasilitas_kamar() 
{
 var id=0;
 $.ajax({
    url: "proses/load_fasilitas.php",
    method: "POST",
    data:{ids:id},
         success: function(data)
         {
           //alert(data);return;
           $("#data").html(data).refresh;
         }
       });
 }

function load_fasilitas_umum() 
{
 var id=0;
 $.ajax({
    url: "proses/load_fasilitas_umum.php",
    method: "POST",
    data:{ids:id},
         success: function(data)
         {
           //alert(data);return;
           $("#data").html(data).refresh;
         }
       });
 }

});
</script>

<!-- END BODY -->
</body>
</html>
