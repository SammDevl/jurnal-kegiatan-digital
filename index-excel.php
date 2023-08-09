<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan.xls"); 
require 'config.php';
if(!empty($_SESSION["id"])){
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
  $userRow = mysqli_fetch_assoc($result);
  
  $userDataResult = mysqli_query($conn, "SELECT * FROM user_specific_table WHERE user_id = $id");
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
  
</head>
<body>


    <br>
    <br>
    <div class="table">
    <table border='2' style="margin-left:auto; margin-right:auto; align: middle;">
    <h2 align="center" style="font-family: 'Montserrat', sans-serif;">User-Specific Data Table</h2>
      <tr>
        <td rowspan="2" align="center">No.</td>
        <td rowspan="2" align="center">Hari/Tanggal</td>
        <td rowspan="2" style="width:200px;" align="center">Kegiatan Siswa</td>
        <td rowspan="2" align="center">Keterangan</td>
        <td colspan="2" align="center">TTD Pembina</td>
      </tr>
      <tr>
        <td>DU/DI</td>
        <td>SEKOLAH</td>
      </tr>
      <?php while ($dataRow = mysqli_fetch_assoc($userDataResult)) { ?>
        <tr>
          <td><?php echo $dataRow["column1"]; ?></td>
          <td><?php echo $dataRow["column2"]; ?></td>
          <td><?php echo $dataRow["column3"]; ?></td>
          <td><?php echo $dataRow["column4"]; ?></td>
          <td><?php echo $dataRow["column5"]; ?></td>
          <td><?php echo $dataRow["column6"]; ?></td>
        </tr>
      <?php } ?>
    </table>
      </div>
  </body>
</html>
