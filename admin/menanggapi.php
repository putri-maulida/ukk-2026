<?php
include "../db.php";
include "akses.php";

function status($status){
    if($status=="Menunggu"){
        echo"<div class='badge bg-warning'> ⏰ $status </div>";
    }else if($status=="Proses"){
        echo"<div class='badge bg-info'> 🔄️ $status </div>";
    } else if($status=="Selesai"){
        echo "<div class='badge bg-success'> ☑️ $status </div>";
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM input_aspirasi, aspirasi, kategori, siswa WHERE kategori.id_kategori=input_aspirasi.id_kategori AND aspirasi.id_kategori=kategori.id_kategori AND siswa.nis=input_aspirasi.nis AND input_aspirasi.id_pelaporan='$id'";
$query = mysqli_query($db, $sql);
if(!$query) {
    die("Query Error: " . mysqli_error($db));
}
$data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanggapi Pengaduan Siswa</title>
</head>
<body class="body">
    <h4 class="text-center mt-4"><i class="fa fa-comments"></i> Menanggapi Pengaduan</h4>
    <form action="" method="POST">
        <div class="row">
            <div class="col-md-3 fw-bold mb-1">NIS :</div>
            <div class="col-md-9"><?= $data['nis'] ?></div>
            <div class="col-md-3 fw-bold mb-1">Kelas :</div>
            <div class="col-md-9"><?= $data['kelas'] ?></div>
            <div class="col-md-3 fw-bold mb-1">Kategori Pengaduan :</div>
            <div class="col-md-9"><?= $data['ket_kategori'] ?></div>
            <div class="col-md-3 fw-bold mb-1">Status :</div>
            <div class="col-md-9"><?= status($data['status']) ?></div>
            <div class="col-md-3 fw-bold mb-1">Lokasi :</div>
            <div class="col-md-9"><?= $data['lokasi'] ?></div>
            <div class="col-md-3 fw-bold mb-1">Pengaduan :</div>
            <div class="col-md-12 p-3 border"><?= $data['ket'] ?></div>
            <div class="col-md-3 fw-bold mb-1">Feedback :</div>
            <div class="col-md-12 p-3 border">
                <select name="status" class="form-control mb-2" required>
                <option value="Menunggu" <?= ($data['status']=="Menunggu")?'selected':'' ?>>Menunggu</option>
                <option value="Proses" <?= ($data['status']=="Proses")?'selected':'' ?>>Proses</option>
                <option value="Selesai" <?= ($data['status']=="Selesai")?'selected':'' ?>>Selesai</option>
                </select>

                <textarea name="feedback" class="form-control mb-1" placeholder="Tulis Feedback" required></textarea>
            </div>
            <button type="submit" name="button" class="btn btn-success w-100 mt-4">💾 Kirim </button>
        </div>
    </form>
    <?php
    if(isset($_POST['button'])){
        $status = $_POST['status'];
        $feedback = $_POST['feedback'];
        $data = mysqli_query($db, "UPDATE aspirasi SET status='$status', feedback='$feedback' WHERE id_aspirasi='$data[id_aspirasi]'");
        if($data){
            echo"<script>alert('☑️ Feedback berhasil Terkirim'); window.location.assign('?page=pengaduan')</script>";
        }else{
            echo"<script>alert('✖️ Feedback gagal Terkirim'); window.location.assign('?page=menanggapi')</script>";
   
        }
    }
    ?>
</body>
</html>