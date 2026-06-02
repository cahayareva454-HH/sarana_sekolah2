<?php
session_start();
include "../koneksi.php";

$username = mysqli_real_escape_string(
    $conn,
    $_POST['username']
);

$password = md5(
    mysqli_real_escape_string($conn, $_POST['password'])
);

$query = mysqli_query(
    $conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'"
);

if (mysqli_num_rows($query) == 1) {
    $_SESSION['admin'] = $username;
    header("location: ../admin/index-admin.php");
    exit;

}else{
    echo "<script> alert('username atau password salah');
            window.location='../admin/login.php'; </script>";
        exit;
}
?>