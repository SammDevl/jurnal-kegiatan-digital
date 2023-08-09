<link rel='stylesheet' href='style.css'>

<h3> Form Kegiatan <h3>

<form action="" method="post">
    <table>
        
    <tr>
        <td widht="130">Tanggal-bulan-tahun</td>
        <td><input type="text" name="tbt" require></td>
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
include "config.php";

if(isset($_POST['proses'])){
    mysqli_query($conn,"insert into data_pegawai set 
    nama = '$_POST[nama]',
    alamat = '$_POST[alamat]',
    no_hp = '$_POST[no_hp]'");

    echo "Data Pegawai Baru Telah Tersimpan";
    echo "<meta http-equiv=refresh content=1;URL='barang-data.php'>";
}
?>