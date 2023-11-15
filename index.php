<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
  $userRow = mysqli_fetch_assoc($result);
  
  $userDataResult = mysqli_query($conn, "SELECT * FROM user_specific_table WHERE id = $id");
}
else{
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Index</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
  <style>
        /* Basic styling for the navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #FFFFFF;
            color: black;
            padding: 10px;
            padding-left: 30px;
            padding-right:50px;
            box-shadow: -5px 3px 10px 3px gray;
          font-family: 'Montserrat', sans-serif;
          font-weight: 700;
    

          }
        /* Style for the dropdown content */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        /* Style for the dropdown items */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        /* Show the dropdown contenton hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        .table {
          background-color: #ffffff;
            padding: 10px;
            margin: 0 auto;
            max-width: 1200px;
            border-radius: 5px;
            box-shadow: -5px 5px 10px rgba(0, 0, 0, 0.2);
            font-family: 'Montserrat', sans-serif;
        }


        body {
    background-image: url(image/gambar1.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
        }
        
        .btn-delete{
    border:1px solid #db5d59;
    background: #db5d59 url(image/hapus.png) no-repeat 5px 4px;
    height: 22px;
    padding-left: 15px;
    padding-top: 5px;
    border-radius: 3px;
}

.btn-update{
    border: 1px solid #00b3a8;
    background: #00b3a8 url(image/edit.png) no-repeat 5px 4px;
    height: 22px;
    padding-left: 15px;
    padding-top: 5px;  
    border-radius: 3px;
}
    </style>
</head>
<body>

<div class="navbar">
    <div>
    <p>Welcome <?php echo $userRow["name"]; ?></p>
    </div>
    <div class="dropdown">
        <p>Action</p>
        <div class="dropdown-content">
            <a href="form-kegiatan.php
          ">Isi Form</a>
            <a href="index-excel.php">export to <br> .xls</a>
            <a href="logout.php">Logout</a></a>
        </div>
    </div>
</div>
    <br>
    <br>
    <div class="table">
    <table border="2" style="margin-left:auto; margin-right:auto; border-collapse: collapse;">
    <h2 align="center" style="font-family: 'Montserrat', sans-serif;">Jurnal Kegiatan</h2>
      <tr>
        <td rowspan="2" align="center">No.</td>
        <td rowspan="2" align="center">Hari/Tanggal</td>
        <td rowspan="2" style="width:800px;" align="center">Kegiatan Siswa</td>
        <td rowspan="2" align="center">Keterangan</td>
        <td colspan="2" align="center">TTD Pembina</td>
        <td rowspan="2" colspan="2" align="center">Aksi</td>
      </tr>
      <tr>
        <td>DU/DI</td>
        <td>SEKOLAH</td>
      </tr>
      <?php 
      $no=1;
      while ($dataRow = mysqli_fetch_assoc($userDataResult)) { ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $dataRow["column1"]; ?></td>
          <td><?php echo $dataRow["column2"]; ?></td>
          <td><?php echo $dataRow["column3"]; ?></td>
          <td><?php echo $dataRow["column4"]; ?></td>
          <td><?php echo $dataRow["column5"]; ?></td>
          <?php echo"<td><a href='form-ubah.php?id=$dataRow[id]'><input type='button' class='btn-update'></a></td>
                 <td><a href='?kode=$dataRow[id]'><input type='button' class='btn-delete'> </a></td>" ?>
        
        </tr>
      <?php $no++;} ?>
    </table>
      </div>
      <?php

if(isset($_GET['kode'])){

    mysqli_query($conn, "delete FROM user_specific_table WHERE id='$_GET[kode]'");

    echo "<meta http-equiv=refresh content:2; URL='index.php'>";

}

?>
  </body>
</html>
