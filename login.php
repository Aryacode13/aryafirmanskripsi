<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Halaman Login </title>
    <link rel="stylesheet" href="css/style.css">
   </head>
<body>
  <div class="wrapper">
    <h2>Login Siswa</h2>
    <form action="" method="POST">
      <div class="input-box">
        <input type="text" placeholder="Masukkan Username" name="username" required>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Masukkan Password" name="password" required>
      </div>
      <div class="input-box button">
        <input type="Submit" value="Login" name="login">
      </div>
      <div class="">
        <span>Belum Punya Akun ? <a href="registrasi.php">Registrasi</a></span>
      </div>
    </form>
  </div>
</body>
</html>
<?php
include '../koneksi.php';
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = mysqli_query($koneksi,"SELECT * FROM `tb_siswa` WHERE `username_siswa` = '$username' AND `password_siswa` = '$password'");
  $jum = mysqli_num_rows($query);
  if ($jum > 0) {
    $d = mysqli_fetch_assoc($query);
    $_SESSION['id'] = $d['id_siswa'];
    $_SESSION['status'] = 'login';
    $_SESSION['nama_siswa'] = $d['nama_siswa'];
    echo"
    <script>
    alert('Login berhasil');
    location.href='index.php';
    </script>
    ";
  }else{
    echo"
    <script>
    alert('Username atau password salah');
    history.back();
    </script>
    ";
  }
}
