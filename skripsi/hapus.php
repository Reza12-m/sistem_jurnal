<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require("../koneksi_db.php");

// Pastikan skripsi_id telah diset dan merupakan angka
if (isset($_GET['skripsi_id']) && is_numeric($_GET['skripsi_id'])) {
    $skripsi_id = $_GET['skripsi_id'];

    // Hapus data dari database berdasarkan skripsi_id
    $query = "DELETE FROM skripsi WHERE skripsi_id = ?";

    // Prepare and bind the statement
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $skripsi_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        exit;
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Parameter tidak valid']);
    exit;
}

$koneksi->close();
?>
