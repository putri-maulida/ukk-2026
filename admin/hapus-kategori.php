<?php 
include "../db.php";
include "akses.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('⚠️ ID tidak valid'); window.location.assign('?page=datakategori');</script>";
    exit;
}

$id = (int) $_GET['id'];
$query = "DELETE FROM kategori WHERE id_kategori=$id";
$result = mysqli_query($db, $query);

if ($result) {
    echo "<script>alert('🤗 Data berhasil dihapus'); window.location.assign('?page=datakategori');</script>";
} else {
    $error = mysqli_error($db);
    echo "<script>alert('😔 Gagal hapus: $error'); window.location.assign('?page=datakategori');</script>";
}
?>