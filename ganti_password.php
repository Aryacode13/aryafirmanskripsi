<?php
if (empty($_SESSION['status'])) {
  echo"
    <script>
    alert('Mohon Login Terlebih Dahulu');
    location.href='login.php';
    </script>
    ";
}else{
    include "../koneksi.php";
    $id = $_SESSION['id'];
    $data = mysqli_query($koneksi,"select * from tb_guru where id_guru = '$id'");
    $d=mysqli_fetch_array($data);

?>
<div class="wrapper" style="margin-top:50px;margin-left:50px;widht:900px">
    <h2>Edit Password</h2>
    <form action="" method="POST">
      <div class="input-box" style="margin-top:35px;margin-bottom:35px">
        <label style="font-size: 17px;font-weight: 400;">Username</label>
        <input type="text" name="user" placeholder="" value="<?=$d['username_guru']?>" required>
      </div>
      <div class="input-box" style="margin-top:35px;margin-bottom:35px">
        <label style="font-size: 17px;font-weight: 400;">Password</label>
        <input type="text" name="pass" placeholder="" value="<?=$d['password_guru']?>" required>
      </div>
      
      <div class="row">
        <div class="input-box button" style="margin-top:35px">
            <input type="Submit" value="Edit" name="update">
        </div>
      </div>
      
    </form>
  </div>
  <?php
  include '../koneksi.php';
  if (isset($_POST['update'])) {
      $user = $_POST['user'];
      $pass = $_POST['pass'];
      $cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tb_guru WHERE username_guru = '$user'"));
      if ($cek > 0) {
        echo"
          <script>
          alert('Username Ini Sudah Ada');
          history.back();
          </script>
        ";
      }else{
        $query = mysqli_query($koneksi,"UPDATE `tb_guru` SET `username_guru` = '$user', `password_guru` = '$pass' WHERE `tb_guru`.`id_guru` = $id;");
        if ($query) {
          echo"
          <script>
          alert('Data Berhasil di Ubah');
          location.href = '?halaman=password';
          </script>
        ";
        }else{
          echo"
          <script>
          alert('Data Gagal di Tambahkan');
          history.back();
          </script>
        ";
        }
      }
    }
  } 
  ?>