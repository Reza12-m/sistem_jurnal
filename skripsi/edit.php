<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require("../koneksi_db.php");

$pesan = '';
$pesan_error = '';

if (isset($_GET['skripsi_id'])) {
    $skripsi_id = $_GET['skripsi_id'];

    // Query untuk mendapatkan data berdasarkan skripsi_id
    $query_select = "SELECT * FROM skripsi WHERE skripsi_id = '$skripsi_id'";
    $result_select = $koneksi->query($query_select);

    if ($result_select->num_rows > 0) {
        $data = $result_select->fetch_assoc();
        // Data ditemukan, tampilkan formulir untuk pengeditan
    } else {
        // Data tidak ditemukan, berikan pesan atau redirect ke halaman lain
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "Parameter tidak valid.";
    exit;
}

if (isset($_POST['update'])) {
    $skripsi_id = $_POST['skripsi_id'];
    $judul = $_POST['judul'];
    $metode_penelitian = $_POST['metode_penelitian'];
    $tahun = $_POST['tahun'];
    $nim = $_POST['nim'];
    $nama_mahasiswa = $_POST['nama_mahasiswa'];

    $query_update = "UPDATE skripsi SET judul = '$judul', metode_penelitian = '$metode_penelitian', tahun = '$tahun', nim = '$nim', nama_mahasiswa = '$nama_mahasiswa' WHERE skripsi_id = '$skripsi_id'";
    $update = $koneksi->query($query_update);

    if ($update) {
        $pesan = "Data berhasil diupdate";
    } else {
        $pesan_error = "Gagal mengupdate data. Error: " . $koneksi->error;
    }
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
    <!-- ... (head dan tag HTML lainnya) ... -->
    <body>
    <div class="container">
            <div class="card mt-5">
                <div class="card-header bg-primary text-white">
                    Edit Data Dosen
                </div>
                <div class="card-body">
                <?php
                    if ($pesan !== '') {
                        echo '<div class="alert alert-success" role="alert">' . $pesan . '</div>';
                    } elseif ($pesan_error !== '') {
                        echo '<div class="alert alert-danger" role="alert">' . $pesan_error . '</div>';
                    }
                    ?>
                    <form action="edit.php?skripsi_id=<?php echo $skripsi_id; ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Skripsi ID</label>
                            <input type="text" class="form-control" name="skripsi_id" value="<?php echo $data['skripsi_id']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" value="<?php echo $data['judul']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Metode Penelitian</label>
                            <input type="text" class="form-control" name="metode_penelitian" value="<?php echo $data['metode_penelitian']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" name="tahun" value="<?php echo $data['tahun']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" class="form-control" name="nim" value="<?php echo $data['nim']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" name="nama_mahasiswa" value="<?php echo $data['nama_mahasiswa']; ?>" required>
                        </div>
                        <input type="submit" name="update" value="Update" class="btn btn-success">
                        <a href="/tugas_uas/skripsi/tampil.php" class="btn btn-danger">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
        <!-- ... (script dan tag HTML lainnya) ... -->
    </body>
</html>