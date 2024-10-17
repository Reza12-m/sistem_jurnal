<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require("../koneksi_db.php");

$query = "SELECT *FROM skripsi";

$hasil = $koneksi->query($query);
$koneksi->close();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Data Dosen</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand"> <img src="../img/logo.png" alt="" width="360"></a>
                
                </div>
            </div>
            </nav>
            <div class="container mt-3">
                <div class="d-flex justify-content-end mb-2">
                    <a class="btn btn-danger text-white" href="/tugas_uas/index.php" role="button">Kembali</a>
                </div>
                <div class="card">
                <div class="card-header bg-primary text-white">
                    Data Dosen
                </div>
                <div class="card-body">
                    <a  class="btn btn-success"href="/tugas_uas/skripsi/tambah.php">Tambahkan Data</a>
                    <table class="table table-bordered table-striped tabel-hover mt-3 text-center">
                       <thead>
                            <tr>
                                <th>Skripsi ID</th>
                                <th>Judul</th>
                                <th>Metede Penelitian</th>
                                <th>Tahun</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th class="action-colum">Aksi</th>
                            </tr>
                        </thead> 
                        <tbody>
            <?php while($row = mysqli_fetch_array($hasil)) { ?>
                <tr>
                    <td><?php echo $row['skripsi_id']; ?></td>
                    <td><?php echo $row['judul']; ?></td>
                    <td><?php echo $row['metode_penelitian']; ?></td>
                    <td><?php echo $row['tahun']; ?></td>
                    <td><?php echo $row['nim']; ?></td>
                    <td><?php echo $row['nama_mahasiswa']; ?></td>
                    <td class="action-column ">
                    <div class="btn-group">
                    <a href="/tugas_uas/skripsi/edit.php?skripsi_id=<?php echo $row['skripsi_id']; ?>">
                            <button class=" btn btn-warning" style="margin-right:20px;">Edit</button>
                        </a>
                        <button class="btn btn-danger "onclick="hapusData('<?php echo $row['skripsi_id']; ?>')">Hapus</button>
                    </div>
                    </td>
                    </td>
                </tr>
            <?php } ?>
                    </tbody>
                    </table>

                    <script>
    // Fungsi JavaScript untuk konfirmasi hapus dan mengirim permintaan DELETE ke "delete.php"
    function hapusData(skripsi_id) {
        if (confirm("Anda yakin ingin menghapus data dengan Dosen ID: " + skripsi_id + "?")) {
            fetch("hapus.php?skripsi_id=" + encodeURIComponent(skripsi_id), {
                method: "DELETE"
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert("Data berhasil dihapus");

                    window.location.reload();
                } else {
                    alert("Gagal menghapus data: " + data.message);
                }
            })
            .catch(error => {
                console.error("Gagal menghapus data:", error);
                alert("Gagal menghapus data");
            });
        }
    }
</script>


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