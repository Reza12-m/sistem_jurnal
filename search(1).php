<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require("koneksi_db.php");

// Search feature
$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
$where_clause_search = $search_query ? "WHERE judul LIKE '%$search_query%'" : '';

// Year filter
$selected_year = isset($_GET['tahun']) ? $_GET['tahun'] : '';
$year_filter = $selected_year ? "WHERE tahun = '$selected_year'" : '';

// Check if "Filter Tahun" button is clicked
if (isset($_GET['filter_tahun'])) {
    $query = "SELECT * FROM skripsi $year_filter";
} else {
    $query = "SELECT * FROM skripsi $where_clause_search $year_filter";
}

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

    <title>Data Skripsi</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand"> <img src="img/logo.png" alt="" width="360"></a>
        <form class="col-md-5 ms-2 d-flex search" method="GET" action="">
          <input class="form-control me-2 input" type="search" name="search_query" placeholder="Masukan Judul Skripsi" aria-label="Search" value="<?php echo $search_query; ?>">
          <button class="btn btn-outline-success ms-2 btn-success text-white" type="submit">Cari</button>
        </form>
      </div>
    </nav>
    
    <div class="container mt-3">
      <!-- Year filter form -->
      <div class="d-flex justify-content-between mb-2">
        <form class="col-md-3 d-flex" method="GET" action="">
          <select class="form-select" name="tahun" aria-label="Year" style="width:170px;">
            <option value="" selected>Pilih Tahun</option>
            <?php
            $current_year = date('Y');
            for ($year = 2019; $year <= $current_year; $year++) {
              $selected = ($year == $selected_year) ? 'selected' : '';
              echo "<option value=\"$year\" $selected>$year</option>";
            }
            ?>
          </select>
          <button class="btn btn-outline-primary btn-primary text-white ms-2" type="submit" name="filter_tahun">Tahun</button>
        </form>
        
        <div class="d-flex">
          <a class="btn btn-danger text-white ms-2" href="/tugas_uas/index.php" role="button">Kembali</a>
        </div>
      </div>

      <div class="card">
        <div class="card-header bg-primary text-white">
          Data Skripsi
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mt-3 text-center">
              <thead>
                <tr>
                  <th>Skripsi ID</th>
                  <th>Judul</th>
                  <th>Metode Penelitian</th>
                  <th>Tahun</th>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
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
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
