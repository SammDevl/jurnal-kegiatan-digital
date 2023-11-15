<?php
require 'config.php';

if(!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
    $userRow = mysqli_fetch_assoc($result);
  
    $userDataResult = mysqli_query($conn, "SELECT * FROM user_specific_table WHERE id = $id");
}
else {
    header("Location: login.php");
}
?>
<style>
    form {
          background-color: #ffffff;
            padding: 10px;
            margin: 0 auto;
            max-width: 450px;
            border-radius: 5px;
            box-shadow: -5px 5px 10px rgba(0, 0, 0, 0.2);
            font-family: 'Montserrat', sans-serif;
        }
</style>


<link rel='stylesheet' href='style.css'>



<form action="" method="post">
<h3 align="center"> Form Kegiatan </h3>
    <table>
        
    <tr>
        <td widht="130">Tanggal/Hari</td>
        <td><input type="date" name="tbt" require></td>
    </tr>
    <tr>
        <td>Kegiatan Siswa</td>
        <td> <input type="text" name="kegiatan" require></td>
    </tr>
    <tr>
        <td>Keterangan</td>
        <td> <input type="text" name="keterangan" require></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" value="Simpan" name="proses"></td>
    </tr>
    </table>
</form>

<?php

if(isset($_POST['proses'])) {
    $tbt = mysqli_real_escape_string($conn, $_POST['tbt']);
    $kegiatan = mysqli_real_escape_string($conn, $_POST['kegiatan']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
    
    // Simpan data ke database .
    $insertQuery = "INSERT INTO user_specific_table (column1, column2, column3, id) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, "sssi", $tbt, $kegiatan, $keterangan, $id);
    
    if(mysqli_stmt_execute($stmt)) {
        echo "Data Kegiatan Telah Tersimpan";
        header("Refresh: 1; URL=index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}
?>