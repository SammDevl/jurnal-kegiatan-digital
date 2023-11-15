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
<?php
require 'config.php';

if(!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
    $userRow = mysqli_fetch_assoc($result);

    // Ambil data dari user_specific_table berdasarkan column1 dan parameter URL 'column1'
    if (isset($_GET['id'])) {
        $column1Value = mysqli_real_escape_string($conn, $_GET['id']);
        $userDataResult = mysqli_query($conn, "SELECT * FROM user_specific_table WHERE id = $id ");
        $dataRow = mysqli_fetch_assoc($userDataResult);
        if (!$dataRow) {
           // Redirect jika data tidak ditemukan
        }
    } else {
        // Jika parameter'column1' tidak ada, arahkan kembali ke halaman index
        
    }
} else {
    header("Location: login.php");
}
?>

<!-- ... -->
<form action="" method="post">
    <h3 align="center">Form Update Kegiatan</h3>
    <table>
        <tr>
            <td width="130">Tanggal/Hari</td>
            <td><input type="text" name="tbt" value="<?php echo $dataRow['column1']; ?>" required></td>
        </tr>
        <tr>
            <td>Kegiatan Siswa</td>
            <td><input type="text" name="kegiatan" value="<?php echo $dataRow['column2']; ?>" required></td>
        </tr>
        <tr>
    <td>Keterangan</td>
    <td><input type="text" name="keterangan" value="<?php echo $dataRow['column3']; ?>"></td>
</tr>

        <tr>
            <td></td>
            <td><input type="submit" value="Update" name="update"></td>
        </tr>
    </table>
</form>

<?php
if(isset($_POST['update'])) {
    $tbt = mysqli_real_escape_string($conn, $_POST['tbt']);
    $kegiatan = mysqli_real_escape_string($conn, $_POST['kegiatan']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    // Update data di user_specific_table berdasarkan ID
    $updateQuery = "UPDATE user_specific_table SET column1=?, column2=?, column3=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "sssi", $tbt, $kegiatan, $keterangan, $dataId);
    
    if(mysqli_stmt_execute($stmt)) {
        echo "Data Kegiatan Telah Diperbarui";
        header("Refresh: 1; URL=index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}
?>