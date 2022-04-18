<?php
//print_r($_POST);

include '../includes/koneksi.php';
if (!isset($_SESSION)) {
    session_start();	
}

if(isset($_POST['username'])!==null)
 {
    $user 		    = $_POST['username'];
	$password 	    = $_POST['password'];
    $tipe           = "admin";
    
    $sql   = "SELECT * FROM tb_user WHERE (( username = '$user') AND (password='$password')AND (tipe='$tipe'))";
    $query = $conn->query($sql);

    if($query->num_rows < 1){	
        //$_SESSION['error'] = 'Cannot find account with the nik';
        echo "ERROR";
    } 
    else 
    {
        $row = $query->fetch_assoc();
		$_SESSION['admin']     = $row['username'];
        $sql = "SELECT * FROM tb_user WHERE username = '".$_SESSION['admin']."'";
        $query = $conn->query($sql);
        $user = $query->fetch_assoc();
        echo "OK";
    }

 }
?>