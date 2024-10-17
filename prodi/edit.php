<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require("../koneksi_db.php");

$pesan = '';
$pesan_error = '';

if (isset($_GET['prodi_id'])) {
    $prodi_id = $_GET['prodi_id'];

    // Query untuk mendapatkan data berdasarkan dosen_id
    $query_select = "SELECT * FROM prodi WHERE prodi_id = '$prodi_id'";
    $result_select = $koneksi->query($query_select);

    if ($result_select->num_rows > 0) {
        $data = $result_select->fetch_assoc();
    } else {
       
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
  
    echo "Parameter tidak valid.";
    exit;
}

if (isset($_POST['update'])) {
    $prodi_id = $_GET['prodi_id']; 
    $nama_prodi = $_POST['nama_prodi']; 
    $nama_pendek = $_POST['nama_pendek']; 

    $query_update = "UPDATE prodi SET nama_prodi = '$nama_prodi', nama_pendek = '$nama_pendek' WHERE prodi_id = '$prodi_id'";
    $update = $koneksi->query($query_update);

    if ($update) {
        $pesan = "Data berhasil diupdate";
    } else {
        $pesan_error = "Gagal mengupdate data. Error: " . $koneksi->error;
    }

    $koneksi->close();
}
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <title>edit</title>
    </head>
    <body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header bg-primary text-white">
                Edit Data prodi
            </div>
            <div class="card-body">
                <?php
                if ($pesan !== '') {
                    echo '<div class="alert alert-success" role="alert">' . $pesan . '</div>';
                } elseif ($pesan_error !== '') {
                    echo '<div class="alert alert-danger" role="alert">' . $pesan_error . '</div>';
                }
                ?>
                <form action="edit.php?prodi_id=<?php echo $prodi_id; ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama prodi</label>
                        <input type="text" class="form-control" name="nama_prodi" value="<?php echo $data['nama_prodi']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama pendek</label>
                        <input type="text" class="form-control" name="nama_pendek" value="<?php echo $data['nama_pendek']; ?>" required>
                    </div>
                    <div class="btn-group d-grid gap-2 d-md-block">
                        <input type="submit" name="update" value="Update" class="btn btn-success">
                        <a href="/tugas_uas/prodi/tampil.php" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <!-- ... (script dan tag HTML lainnya) ... -->
    </body>
</html>