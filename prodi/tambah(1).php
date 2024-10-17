<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require("../koneksi_db.php");

// Deklarasi variabel pesan
$pesan = '';
$pesan_error = '';

if (isset($_POST['simpan'])) {
    $nama_prodi = $_POST['nama_prodi'];
    $nama_pendek = $_POST['nama_pendek'];
    // Pastikan prodi_id sudah ada di tabel prodi sebelumnya


    
        // Data prodi_id ditemukan, lanjutkan dengan query INSERT ke tabel dosen
        $query = "INSERT INTO prodi (nama_prodi, nama_pendek) VALUES ('$nama_prodi', '$nama_pendek')";
        $simpan = $koneksi->query($query);
        $koneksi->close();

        if ($simpan) {
            $pesan = "Data berhasil ditambahkan!";
        } else {
            $pesan_error = "Gagal menambahkan data. Error: ". $koneksi->error ;
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
                <label class="form-label">nama prodi</label>
                <input type="text" class="form-control" name="nama_prodi" id="nama_prodi">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Pendek</label>
                <input type="text" class="form-control" name="nama_pendek" id="nama_pendek">
            </div>
           <input class=" btn btn-success"type="submit" name="simpan" value="Simpan">
                <a href="/tugas_uas/prodi/tampil.php">
                    <button type="button" class="btn btn-danger" href="/tugas_uas/prodi/tampil.php">Kembali</button>
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