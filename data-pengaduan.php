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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Data Pengaduan Sarana </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="data-body">
    <div class="div-data">
        <form action="#" method="POST" class="col-md-9 bg-white border rounded-4  p-4 shadow-sm">
            <h3 class="text-center">Data Pengaduan Sarana</h3>
            <p class="text-muted text-center mb-4">Pengaduan Sarana SMK Negeri 5 Telkom Banda Aceh</p>
            <a href="index.php" class="btn btn-secondary">
                ➕  Tambah Pengaduan
            </a>
            <hr>

            <table class="table table-bordered table-striped">
                <tr class="fw-bold">
                    <td>No</td>
                    <td>Kategori</td>
                    <td>Keterangan</td>
                    <td>Status</td>
                    <td>Detail</td>
                </tr>
                <?php
                $no = 1;
                $nis = mysqli_real_escape_string($db, $_SESSION['nis']);
                $sql = "SELECT * FROM input_aspirasi, kategori, aspirasi WHERE input_aspirasi.id_kategori=kategori.id_kategori AND aspirasi.id_pelaporan=input_aspirasi.id_pelaporan AND input_aspirasi.nis='$nis'";
                $data = mysqli_query($db, $sql);
                foreach($data as $pengaduan){ ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $pengaduan['ket_kategori'] ?></td>
                    <td><?= $pengaduan['ket'] ?></td>
                    <td><?= status($pengaduan['status']) ?></td>
                    <td>
                        <a href="detail-pengaduan.php?id=<?= $pengaduan['id_pelaporan'] ?>" class="btn btn-secondary">
                            🔍 Detail Pengaduan
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </table>
            
            <a href="cek-pengaduan.php" class="btn btn-warning w-100 mt-3 text-white">
                ⬅️ Kembali
            </a>
             <?php
            if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger mt-1 mb-4">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
        </form>
    </div>
</body>
</html>