<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require("../koneksi_db.php");

if (isset($_GET['dosen_id']) && is_numeric($_GET['dosen_id'])) {
    $dosen_id = $_GET['dosen_id'];

    // Hapus data dari database berdasarkan dosen_id
    $query = "DELETE FROM dosen WHERE dosen_id = $dosen_id";

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
