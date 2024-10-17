<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require("../koneksi_db.php");

$pesan = '';
$pesan_error = '';

if (isset($_GET['dosen_id'])) {
    $dosen_id = $_GET['dosen_id'];

    // Query untuk mendapatkan data berdasarkan dosen_id
    $query_select = "SELECT * FROM dosen WHERE dosen_id = '$dosen_id'";
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
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $status = $_POST['aktif'];

    $query_update = "UPDATE dosen SET nama_lengkap = '$nama_lengkap', email = '$email', aktif = '$status' WHERE dosen_id = '$dosen_id'";
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
                    <form action="edit.php?dosen_id=<?php echo $dosen_id; ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $data['nama_lengkap']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $data['email']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="aktif" required>
                                <option value="1" <?php echo ($data['aktif'] == 1) ? 'selected' : ''; ?>>Aktif</option>
                                <option value="0" <?php echo ($data['aktif'] == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                            </select>
                        </div>
                        <input type="submit" name="update" value="Update" class="btn btn-success">
                        <a href="/tugas_uas/dosen/tampil.php" class=" btn btn-danger">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
        <!-- ... (script dan tag HTML lainnya) ... -->
    </body>
</html>