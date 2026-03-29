<?php 
include "../db.php";
include "akses.php";
$id = $_GET['id'];
$pilih = mysqli_query($db, "SELECT * FROM kategori WHERE id_kategori='$id'");
$kategori = mysqli_fetch_array($pilih);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
</head>
<body>
    <h4 class="text-center mt-2 mb-4">
        <i class="fa fa-tags"></i> Edit Kategori Pengaduan
    </h4>
    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label fw-bold text-muted">Kategori Pengaduan</label>
            <input type="text" name="ket_kategori" class="form-control" value="<?= $kategori['ket_kategori'] ?>" required>
        </div>
        <button name="submit" type="submit" class="btn btn-success w-100 ">
            <i class="fa fa-save"></i> Simpan 
        </button>
    </form>
    <?php 
    if(isset($_POST['submit'])){
        $ket = $_POST['ket_kategori'];
        $data = mysqli_query($db, "UPDATE kategori SET ket_kategori='$ket' WHERE id_kategori='$id'");
        if($data){
            echo"<script>alert('🤗 Data berhasil diubah'); window.location.assign('?page=datakategori');</script>";
        }else{
            echo"<script>alert('😔 Data gagal diubah'); window.location.assign('?page=datakategori');</script>";
        }
    }
    ?>
</body>
</html>