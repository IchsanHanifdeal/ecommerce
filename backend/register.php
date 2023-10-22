<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $targetDir = "../assets/img/";
  $profile = $_FILES['profile']['name'];
  $profilePath = $targetDir . basename($profile);
  $profileTmp = $_FILES["profile"]["tmp_name"];

  if (move_uploaded_file($profileTmp, $profilePath)) {
    $sql = "INSERT INTO users (`profile`, `nama`, `email`, `password`) VALUES('$profilePath', '$nama', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
      header('Location: ../login.php');
      exit;
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  } else {
    echo "Gagal mengunggah gambar. Pastikan file yang diunggah adalah gambar valid.";
  }
}
?>
