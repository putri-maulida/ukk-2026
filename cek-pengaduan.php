<?php
include "db.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Cek Pengaduan Sarana </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="cek-body">
    <div class="vh-100 justify-content-center row align-content-center">
        <form action="#" method="POST" class="col-md-4 bg-white border rounded-4  p-4 shadow-sm">
            <h3 class="text-center">Cek Pengaduan Sarana</h3>
            <p class="text-muted text-center mb-4">Pengaduan Sarana SMK Negeri 5 Telkom Banda Aceh</p>
            <hr>
            <div class="mb-3">
                <label class="form-label text-muted">NIS</label>
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
            <button type="submit" name="submit" class="btn btn-secondary w-100"> 🔍 Cek Pengaduan</button>
            <a href="index.php" class="btn btn-warning w-100 mt-3 text-white">
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
<?php
if (isset($_POST['submit'])) {
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];

    $query = "SELECT * FROM siswa WHERE nis='$nis' AND kelas='$kelas'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['nis'] = $nis;
        $_SESSION['kelas'] = $kelas;
        header("Location: data-pengaduan.php");
    } else {
        $_SESSION['error'] = "❌ NIS atau Kelas tidak ditemukan!";
        header("Location: cek-pengaduan.php");
    }
}
?>