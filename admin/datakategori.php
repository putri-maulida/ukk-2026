<?php 
include "../db.php";
include "akses.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="body">
    <h4 class="text-center">
        <i class="fa fa-tags"></i> Data Kategori Pengaduan
    </h4>
    <a href="?page=tambah-kategori" class="btn btn-secondary mt-2 mb-2">
        <i class="fa fa-plus"></i> Tambah kategori
    </a>
    <table class="table table-bordered table-light mt-2">
        <tr class="fw-bold">
            <td>No</td>
            <td>Kategori</td>
            <td>Kelola</td>
        </tr>
        <?php 
        $no = 1;
        $data = mysqli_query($db, "SELECT * FROM kategori ORDER BY id_kategori DESC");
        foreach($data as $kategori){ ?>
        <tr>
        <td><?= $no++ ?></td>
        <td><?= $kategori['ket_kategori'] ?></td>
        <td>
            <a href="?page=edit-kategori&id=<?= $kategori['id_kategori'] ?>" class="btn btn-outline-warning text-warning">
                <i class="fa fa-pencil"></i>
            </a>
            <a href="?page=hapus-kategori&id=<?= $kategori['id_kategori'] ?>" class="btn btn-outline-danger text-danger" onclick="return confirm('Hapus data kategori <?= $kategori['ket_kategori'] ?> ?');">
                <i class="fa fa-trash"></i>
            </a>
        </td>
        </tr>
        <?php } ?>
    </table>
    <script>
        function hapus($pesan, $id_kategori) {
            if(confirm($pesan)){
                window.location.href = '?page=hapus-kategori&id='+$id_kategori;
            }
        }
    </script>
</body>
</html>