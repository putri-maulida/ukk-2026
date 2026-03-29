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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan</title>
</head>
<body>
    <h4 class="text-center">Daftar Pengaduan Siswa</h4>
    <table class="table table-bordered table-striped">
        <tr class="fw-bold">
            <td>No</td>
            <td>NIS</td>
            <td>Kelas</td>
            <td>Kategori</td>
            <td>Keterangan</td>
            <td>Status</td>
            <td>Menanggapi</td>
        </tr>
        <?php
        $no = 1;
        $sql = "SELECT * FROM input_aspirasi, aspirasi, kategori WHERE input_aspirasi.id_kategori=kategori.id_kategori AND input_aspirasi.id_pelaporan=aspirasi.id_pelaporan";
        $data = mysqli_query($db, $sql);
        foreach($data as $pengaduan){ ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $pengaduan['nis'] ?></td>
                <?php
                $kelas_siswa = mysqli_query($db, "SELECT * FROM siswa WHERE nis='$pengaduan[nis]'");
                $data_kelas = mysqli_fetch_array($kelas_siswa);
                ?>
                <td><?= $data_kelas['kelas'] ?></td>
                <td><?= $pengaduan['ket_kategori'] ?></td>
                <td><?= $pengaduan['ket'] ?></td>
                <td><?= status($pengaduan['status']) ?></td>
                <td>
                    <?php $cek = ($pengaduan['status']=="Selesai")?'disabled':''; ?>
                    <a href="?page=menanggapi&id=<?= $pengaduan['id_pelaporan'] ?>" class="btn btn-primary <?= $cek ?>">
                        Menanggapi
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
