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
    <title> Halaman Registrasi </title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/regist.css">
   </head>
<body>
  <div class="wrapper">
    <h2>Registrasi Siswa</h2>
    <form action="" method="POST">
      
        <div class="input-box" style="margin-top:35px;margin-bottom:35px">
            <label style="font-size: 17px;font-weight: 400;">Nama Siswa</label>
            <input type="text" name="nama" placeholder="Masukkan Nama" required>
        </div>
        <div class="input-box" style="margin-top:35px;margin-bottom:35px">
            <label style="font-size: 17px;font-weight: 400;">Nis Siswa</label>
            <input type="number" name="nis" placeholder="Masukkan Nis" required>
        </div>
        <label style="font-size: 17px;font-weight: 400">Pilih Kelas</label>
        <div class="custom-select" style="margin-top:10px">
                <select name="kelas">
                    <option value="" selected disabled>Pilih Kelas</option>
                    <?php
                    include '../koneksi.php';
                    $data = mysqli_query($koneksi,"select * from tb_kelas");
                    foreach ($data as $d){
                    ?>
                    <option value="<?= $d['id_kelas']?>"><?=$d['nama_kelas']?></option>
                    <?php
                    }
                    ?>
                </select>
            </div> 
        <div class="input-box" style="margin-top:10px;margin-bottom:35px">
            <label style="font-size: 17px;font-weight: 400;">Tanggal Lahir</label>
            <input type="date" name="tgl"  required>
        </div>
        <div class="input-box" style="margin-top:10px;margin-bottom:35px">
            <label style="font-size: 17px;font-weight: 400;">Asal Sekolah</label>
            <input type="text" name="asal" placeholder="Masukkan Asal Sekolah"  required>
        </div>
        <label style="font-size: 17px;font-weight: 400">Jenis Kelamin</label>
        <div class="custom-select" style="margin-top:10px">
            <select name="jkl" class="custom-select-style" style="border-color: #4070f4;">
                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                <option value="Laki-Laki" style="color:black">Laki-Laki</option>
                <option value="Perempuan" style="color:black">Perempuan</option>
            </select>
        </div>  
        <div class="input-box" style="margin-top:10px">
            <label style="font-size: 17px;font-weight: 400;">Alamat</label>
            <input type="text" name="alamat" placeholder="Masukkan Alamat" required>
        </div>
        <div class="input-box" style="margin-top:35px">
            <label style="font-size: 17px;font-weight: 400;">Username</label>
            <input type="text" name="username" placeholder="Masukkan Username" required>
        </div>
        <div class="input-box" style="margin-top:35px">
            <label style="font-size: 17px;font-weight: 400;">Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>
        <div class="row">
            <div class="input-box button" style="margin-top:35px">
                <input type="Submit" value="Registrasi" name="registrasi">
            </div>
        </div>
      
    </form>
  </div>
</body>
</html>
<?php
  include '../koneksi.php';
  date_default_timezone_set("Asia/Makassar");
  if (isset($_POST['registrasi'])) {
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $tgl = $_POST['tgl'];
    $asal = $_POST['asal'];
    $jk = $_POST['jkl'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $date = date('Y-m-d');

    $cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tb_siswa A WHERE A.nis = '$nis'"));
    $cek1 = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tb_siswa A WHERE A.username_siswa = '$username'"));
    if ($cek > 0) {
        echo "
        <script>
            alert('NIS Sudah Terdaftar');
            history.back();
        </script>";
        }elseif ($cek1 > 0) {
            echo "
            <script>
                alert('Username Sudah Terdaftar');
                history.back();
            </script>";
        }elseif ($tgl > $date) {
            echo "
            <script>
                alert('Tidak Boleh Lebih Besar Dari Tanggal Sekarang');
                history.back();
            </script>";
        }
        else{
            $query = mysqli_query($koneksi,"INSERT INTO `tb_siswa` (`id_siswa`, `id_kelas`, `nama_siswa`, `nis`, `tgl_lahir_siswa`, `asal_sekolah`, `jenis_kelamin_siswa`, `alamat_siswa`, `username_siswa`, `password_siswa`) 
            VALUES (NULL, '$kelas', '$nama', '$nis', '$tgl', '$asal', '$jk', '$alamat', '$username', '$password');");
            if ($query) {
                echo "
                <script>
                    alert('Registrasi Berhasil');
                    location.href='login.php';
                </script>";
            }else{
                echo "
                <script>
                    alert('Registrasi Gagal');
                    history.back();
                </script>";
            }
        }
  
  } 