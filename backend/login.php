<?php
session_start();
include 'koneksi.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $id = $data['id_profile'];
        $nama = $data['nama'];

        $_SESSION['nama'] = $nama;
        $_SESSION['email'] = $email;
        $_SESSION['id_profile'] = $id;
        $_SESSION['logged_in'] = true;

        header("Location: admin/dashboard.php");
        exit();
    } else {
        echo "<div class='col-md-3 col-md-offset-3 mx-auto'>";
        echo "<div class='alert alert-danger text-center'> Login Gagal </div>";
        echo "</div>";
    }
}
?>
