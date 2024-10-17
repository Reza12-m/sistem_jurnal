<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require("../koneksi_db.php");

// Pastikan dosen_id telah diset dan merupakan angka
if (isset($_GET['prodi_id']) && is_numeric($_GET['prodi_id'])) {
    $prodi_id = $_GET['prodi_id'];

    // Hapus data dari database berdasarkan dosen_id
    $query = "DELETE FROM prodi WHERE prodi_id = $prodi_id";

    if ($koneksi->query($query)) {
        echo json_encode(['status' => 'success']);
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => $koneksi->error]);
        exit;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Parameter tidak valid']);
    exit;
}

$koneksi->close();
?>
