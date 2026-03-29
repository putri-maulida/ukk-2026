<?php
session_start();
if ($_SESSION['login']==false) {
    $_SESSION['error'] = "🙏🏻🗝️ Maaf, Anda belum login!";
    header("Location:../admin-login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand text-muted fw-bold" href="#">Pengaduan Sarana SMK Negeri 5 Telkom Banda Aceh</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarID"
                    aria-controls="navbarID" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <nav class="navbar navbar-expand-sm navbar-light bg-white mt-5 container borderd">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarID"
                    aria-controls="navbarID" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarID">
                    <div class="navbar-nav align-items-center">
                        <a class="nav-link" aria-current="page" href="dashboard.php">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                        <a class="nav-link" aria-current="page" href="?page=datakategori">
                            <i class="fas fa-tags"></i> Kategori Pengaduan
                        </a>
                        <a class="nav-link" aria-current="page" href="?page=pengaduan">
                            <i class="fas fa-message"></i> Data Pengaduan
                        </a>
                        <a class="nav-link" aria-current="page" href="logout.php">
                            <i class="fas fa-power-off"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        
        <div class="container borderd shadow-lg w-100 p-5 mt-5 rounded-3">
            <?php 
            $page = isset($_GET['page']) ? $_GET['page'] : '';
            if(file_exists($page.".php")){
                include $page.".php";
            } else { ?>
                <h4> Selamat datang Admin 🎉</h4>
                <p class="text-muted fst-italic">
                    Pengelolaan sarana dan prasarana sekolah adalah untuk menyediakan, mengatur, dan merawat fasilitas 
                    pendidikan agar proses belajar mengajar berjalan maksimal, efektif, dan efisien. Pengelolaan yang baik 
                    memastikan sarana tersedia dalam jumlah dan kualitas yang memadai untuk mendukung kenyamanan serta 
                    kualitas pendidikan. 
                </p>
            <?php } ?>
        </div>
</body>
</html>