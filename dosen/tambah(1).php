<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require("../koneksi_db.php");

// Deklarasi variabel pesan
$pesan = '';
$pesan_error = '';

if (isset($_POST['simpan'])) {
    $dosen_id = $_POST['dosen_id'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $status = $_POST['aktif'];
    $prodi_id = $_POST['prodi_id']; 

    $query_prodi_check = "SELECT prodi_id FROM prodi WHERE prodi_id = '$prodi_id'";
    $result_prodi_check = $koneksi->query($query_prodi_check);

    if ($result_prodi_check->num_rows > 0) {
        $query = "INSERT INTO dosen (dosen_id, nama_lengkap, email, aktif, prodi_id) VALUES ('$dosen_id', '$nama_lengkap', '$email', '$status', '$prodi_id')";
        $simpan = $koneksi->query($query);

        if ($simpan) {
            $pesan = "Data berhasil ditambahkan!";
        } else {
            $pesan_error = "Gagal menambahkan data. Error: " . $koneksi->error;
        }
    } else {     
        $pesan_error = "Gagal menambahkan data. Prodi ID tidak valid.";
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
   
    <title>Tambah data Dosen</title>
  </head>
  <body>
        <div class="container">
            <div class="card mt-5">
            <div class="card-header bg-primary text-white">
                Tambah Data Dosen
            </div>
            <div class="card-body">
            <?php
                if ($pesan !== '') {
                    echo '<div class="alert alert-success" role="alert">' . $pesan . '</div>';
                } elseif ($pesan_error !== '') {
                    echo '<div class="alert alert-danger" role="alert">' . $pesan_error . '</div>';
                }
            ?>
            <form action="tambah.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Dosen ID</label>
                <input type="text" class="form-control" name="dosen_id" id="dosen_id">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap">
            </div>
            <div class="mb-3">
                <label  class="form-label">E-mail </label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="mb-3">
                <label  class="form-label">Prodi ID</label>
                <input type="text" class="form-control" name="prodi_id" id="prodi_id">
            </div>
            <div class="mb-3">
            <label class="form-label">Status</label>
                <select class="form-select"name="aktif" required>
                    <option value="">-- Pilih --</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>   
                </select>
            </div>
           <input class=" btn btn-success"type="submit" name="simpan" value="Simpan">
                <a href="/tugas_uas/dosen/tampil.php">
                    <button type="button" class="btn btn-danger" href="/tugas_uas/dosen/tampil.php">Kembali</button>
            </form>
            </div>
            </div>
        </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>