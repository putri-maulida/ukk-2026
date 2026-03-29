<?php
include "db.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login Admin </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="vh-100 justify-content-center row align-content-center">
        <form action="#" method="POST" class="col-md-4 bg-white border rounded-4  p-4 shadow-sm">
            <h3 class="text-center">Login Admin</h3>
            <p class="text-muted text-center mb-4">Pengaduan Sarana SMK Negeri 5 Telkom Banda Aceh</p>
            <hr>
            <div class="mb-3">
                <label class="form-label text-muted">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username anda" required>
            </div>
            <div class="mb-3">
                <label class="form-label text-muted">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password anda" required>
            </div>
            <button type="submit" name="submit" class="btn btn-secondary w-100">Login</button>
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
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['login'] = true;
        header("Location: admin/dashboard.php");
    } else {
        $_SESSION['error'] = "❌ Username atau password salah!";
        header("Location: admin-login.php");
    }
}
?>