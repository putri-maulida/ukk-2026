<?php
include "db.php";
session_start();
$kategori = mysqli_query($db, "SELECT * FROM kategori");

// Proses submit
if(isset($_POST['submit'])){
    //masukkan data ke tabel siswa
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $data1 = mysqli_query($db, "INSERT INTO siswa(nis, kelas) VALUES ('$nis','$kelas')");

    //data masuk ke tabel input_aspirasi
    $id_kategori = $_POST['id_kategori'];
    $lokasi = $_POST['lokasi'];
    $ket = $_POST['ket'];
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date("Y-m-d H:i:s");
    $sql = "INSERT INTO input_aspirasi(nis, id_kategori, lokasi, ket, tgl_input) VALUES ('$nis','$id_kategori','$lokasi','$ket','$tanggal')";
    $data2 = mysqli_query($db, $sql);

    //data masuk ke tabel aspirasi
    $id_pelaporan = mysqli_insert_id($db);
    $status = "Menunggu";
    $sql = "INSERT INTO aspirasi(id_pelaporan, id_kategori, status) VALUES ('$id_pelaporan','$id_kategori','$status')";
    $data = mysqli_query($db, $sql);
    $_SESSION ['status'] = "😍 Pengaduan berhasil diajukan";
    header("Location:cek-pengaduan.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Pengaduan Sarana Sekolah </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="index-body">
    <div class ="form">
        <form action="#" method="POST" class="col-md-4 bg-white border rounded-4  p-3 shadow-sm">
            <h3 class="text-center">Hallo 👋🏻</h3>
            <p class="text-muted text-center mb-4">Silahkan isi data dibawah ini untuk melakukan pengaduan sarana sekolah</p>
            <hr>
            <div class="mb-3">
                <label class="from-label text-muted">NIS</label>
                <input type="number" name="nis" class="form-control" placeholder="Masukkan NIS anda" required>
            </div>

            <div class="mb-3">
                <label class="from-label text-muted">Kelas</label>
                <select name="kelas" class="form-control" required>
                    <option value="">== Pilih kelas ==</option>
                    <option value="X PPLG 1">X PPLG 1</option>
                    <option value="X PPLG 2">X PPLG 2</option>
                    <option value="X PPLG 3">X PPLG 3</option>
                    <option value="X TJAT 1">X TJAT 1</option>
                    <option value="X TJAT 2">X TJAT 2</option>
                    <option value="X TJAT 3">X TJAT 3</option>
                    <option value="X BP 1">X BP 1</option>
                    <option value="X BP 2">X BP 2</option>
                    <option value="XI RPL 1">XI RPL 1</option>
                    <option value="XI RPL 2">XI RPL 2</option>
                    <option value="XI RPL 3">XI RPL 3</option>
                    <option value="XI BP 1">XI BP 1</option>
                    <option value="XI BP 2">XI BP 2</option>
                    <option value="XI TKJ 1">XI TKJ 1</option>
                    <option value="XI TKJ 2">XI TKJ 2</option>
                    <option value="XI TKJ 3">XI TKJ 3</option>
                    <option value="XI TJA">XI TJA</option>
                    <option value="XII RPL 1">XII RPL 1</option>
                    <option value="XII RPL 2">XII RPL 2</option>
                    <option value="XII RPL 3">XII RPL 3</option>
                    <option value="XII TKJ 1">XII TKJ 1</option>
                    <option value="XII TKJ 2">XII TKJ 2</option>
                    <option value="XII TKJ 3">XII TKJ 3</option>
                    <option value="XII BP 1">XII BP 1</option>
                    <option value="XII BP 2">XII BP 2</option>
                    <option value="XII TJA">XII TJA</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="from-label text-muted">Kategori</label>
                <select name="id_kategori" class="form-control" required>
                    <option value="">== Pilih kategori ==</option>
                    <?php foreach($kategori as $data) { ?>
                        <option value="<?= $data['id_kategori'] ?>"><?= $data['ket_kategori'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="from-label text-muted">Lokasi</label>
                <textarea name="lokasi" class="form-control" placeholder="Masukkan lokasi sarana yang ingin diajukan" required></textarea>
            </div>
            <div class="mb-3">
                <label class="from-label text-muted">Deskripsi Pengaduan</label>
                <textarea name="ket" class="form-control" placeholder="Masukkan deskripsi pengajuan sarana" required></textarea>
            </div>


            <button type="submit" name="submit" class="btn btn-secondary w-100">Kirim ➡️</button>
            <a href="cek-pengaduan.php" class="btn btn-success mt-3 w-100">
                Cek Pengaduan 🔍
            </a>
            
        </form>
    </div>
</body>
</html>