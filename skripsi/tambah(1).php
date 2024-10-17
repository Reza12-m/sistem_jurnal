<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require("../koneksi_db.php");

// Deklarasi variabel pesan
$pesan = '';
$pesan_error = '';

if (isset($_POST['simpan'])) {
    $skripsi_id = $_POST['skripsi_id'];
    $judul = $_POST['judul'];
    $metode_penelitian = $_POST['metode_penelitian'];
    $tahun = $_POST['tahun'];
    $nim = $_POST['nim'];
    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $prodi_id = $_POST['prodi_id'];

    // Pastikan prodi_id sudah ada di tabel prodi sebelumnya
    $query_prodi_check = "SELECT prodi_id FROM prodi WHERE prodi_id = '$prodi_id'";
    $result_prodi_check = $koneksi->query($query_prodi_check);

    if ($result_prodi_check->num_rows > 0) {
        // Data prodi_id ditemukan, lanjutkan dengan query INSERT ke tabel skripsi
        $query = "INSERT INTO skripsi (skripsi_id, judul, metode_penelitian, tahun, nim, nama_mahasiswa, prodi_id) VALUES ('$skripsi_id', '$judul', '$metode_penelitian', '$tahun', '$nim', '$nama_mahasiswa', '$prodi_id')";
        $simpan = $koneksi->query($query);

        if ($simpan) {
            $pesan = "Data berhasil ditambahkan!";
        } else {
            $pesan_error = "Gagal menambahkan data. Error: " . $koneksi->error;
        }
    } else {
        // Data prodi_id tidak ditemukan di tabel prodi
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
   
    <title>Tambah data Skripsi</title>
  </head>
  <body>
        <div class="container">
            <div class="card mt-5">
                <div class="card-header bg-primary text-white">
                    Tambah Data Skripsi
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
                            <label class="form-label">Skripsi ID</label>
                            <input type="text" class="form-control" name="skripsi_id" id="skripsi_id">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" id="judul">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Metode Penelitian </label>
                            <input type="text" class="form-control" name="metode_penelitian" id="metode_penelitian">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tahun </label>
                            <input type="text" class="form-control" name="tahun" id="tahun">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIM </label>
                            <input type="text" class="form-control" name="nim" id="nim">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" name="nama_mahasiswa" id="nama_mahasiswa">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prodi ID</label>
                            <input type="text" class="form-control" name="prodi_id" id="prodi_id">
                        </div>
                        <input class="btn btn-success" type="submit" name="simpan" value="Simpan">
                        <a href="/tugas_uas/skripsi/tampil.php" class="btn btn-danger">Kembali</a>
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
