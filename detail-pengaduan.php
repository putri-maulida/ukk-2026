<?php
include "db.php";
session_start();

if (!isset($_SESSION['nis'])) {
    $_SESSION['error'] = "Silakan cek pengaduan terlebih dahulu.";
    header("Location: cek-pengaduan.php");
    exit;
}

function status($status){
    if($status=="Menunggu"){
        echo"<div class='badge bg-warning'> ⏰ $status </div>";
    }else if($status=="Proses"){
        echo"<div class='badge bg-info'> 🔄️ $status </div>";
    } else if($status=="Selesai"){
        echo "<div class='badge bg-success'> ☑️ $status </div>";
    }
}

$id=$_GET['id'];
$sql = mysqli_query($db, "SELECT * FROM input_aspirasi, aspirasi, kategori WHERE kategori.id_kategori=input_aspirasi.id_kategori AND aspirasi.id_kategori=kategori.id_kategori AND input_aspirasi.id_pelaporan='$id'");
$data = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Detail Pengaduan Sarana </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="detail-body">
    <div class="div-data">
        <form action="#" method="POST" class="col-md-9 bg-white border rounded-4  p-4 shadow-sm">
            <h3 class="text-center">Detail Pengaduan Sarana Sekolah</h3>
            <p class="text-muted text-center mb-4">Pengaduan Sarana SMK Negeri 5 Telkom Banda Aceh</p>
            <a href="index.php" class="btn btn-secondary">
                ➕  Tambah Pengaduan
            </a>
            <hr>

            <div class="row">
                <div class="col-md-3 fw-bold mb-1">NIS :</div>
                <div class="col-md-9"><?= $data['nis'] ?></div>
                <div class="col-md-3 fw-bold mb-1">Kelas :</div>
                <div class="col-md-9"><?= $_SESSION['kelas'] ?></div>
                <div class="col-md-3 fw-bold mb-1">Kategori Pengaduan :</div>
                <div class="col-md-9"><?= $data['ket_kategori'] ?></div>
                <div class="col-md-3 fw-bold mb-1">Status :</div>
                <div class="col-md-9"><?= status($data['status']) ?></div>
                <div class="col-md-3 fw-bold mb-1">Lokasi :</div>
                <div class="col-md-9"><?= $data['lokasi'] ?></div>
                <div class="col-md-3 fw-bold mb-1">Pengaduan :</div>
                <div class="col-md-12 p-3 border"><?= $data['ket'] ?></div>
                <div class="col-md-3 fw-bold mb-1">Feedback :</div>
                <div class="col-md-12 p-3 border"><?= $data['feedback'] ?></div>
            </div>
            
            <a href="data-pengaduan.php" class="btn btn-warning w-100 mt-3 text-white">
                ⬅️ Kembali
            </a>
        </form>
    </div>
</body>
</html>