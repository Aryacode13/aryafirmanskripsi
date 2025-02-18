<?php
ob_start();
session_start();
if (empty($_SESSION['status'])) {
  echo"
    <script>
    alert('Mohon Login Terlebih Dahulu');
    location.href='login.php';
    </script>
    ";
}else{
  include '../koneksi.php';
  $jum_guru=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM `tb_guru`"));
  $jum_siswa =mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM `tb_siswa`"));
  $jum_peserta =mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM `tb_peserta`"));
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <!-- My CSS -->
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="css/form.css">

    <title>Halaman Siswa</title>
  </head>
  <body>
    <!-- SIDEBAR -->
    <section id="sidebar">
      <a href="#" class="brand">
        <i class="bx bxs-smile"></i>
        <span class="text">UJIAN ONLINE</span>
      </a>
      <ul class="side-menu top">
      <li>
          
            
          <span class="text">&nbsp;&nbsp;&nbsp;<?=$_SESSION['nama_siswa']?></span>
        
      </li>
        <li class="active">
          <a href="./">
            <i class="bx bxs-dashboard"></i>
            <span class="text">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="?halaman=ujian">
            <i class="bx bxs-doughnut-chart"></i>
            <span class="text">Jadwal Ujian</span>
          </a>
        </li>
        <li>
          <a href="?halaman=hasil">
            <i class="bx bxs-doughnut-chart"></i>
            <span class="text">Hasil Ujian</span>
          </a>
        </li>
      </ul>
      <ul class="side-menu">
        <li>
          <a href="?halaman=password">
            <i class="bx bxs-cog"></i>
            <span class="text">Settings</span>
          </a>
        </li>
        <li>
          <a href="logout.php" class="logout">
            <i class="bx bxs-log-out-circle"></i>
            <span class="text">Logout</span>
          </a>
        </li>
      </ul>
    </section>
    <section id="content">
      <nav>
        <i class="bx bx-menu"></i>
        
      </nav>
      <!-- NAVBAR -->

      <!-- MAIN -->
      <?php
      if(isset($_REQUEST['halaman'])){
        $halaman = $_REQUEST['halaman'];
          switch ($halaman) {
            case 'ujian':
              include 'ujian/view.php';
              break;
            case 'inputujian':
              include 'ujian/input.php';
              break;
            case 'simpanujian':
              include 'ujian/simpan.php';
              break;
            case 'updateujian':
              include 'ujian/update_selesai.php';
              break;
            // ===============================
            case 'password':
              include 'ubah/password.php';
              break;
            // ===============================
            case 'hasil':
              include 'hasil/view.php';
              break;
            case 'detailhasil':
              include 'hasil/detail.php';
              break;
            }
          }else{
      ?>
      <main>
        <div class="head-title">
          <div class="left">
            <h1>Dashboard</h1>
            
          </div>
          
        </div>

        <ul class="box-info">
          <li>
            <i class="bx bx bxs-group"></i>
            <span class="text">
              <h3><?=$jum_guru?></h3>
              <p>Data Guru</p>
            </span>
          </li>
          <li>
            <i class="bx bxs-group"></i>
            <span class="text">
              <h3><?=$jum_siswa?></h3>
              <p>Data Siswa</p>
            </span>
          </li>
          <li>
            <i class="bx bxs-doughnut-chart"></i>
            <span class="text">
              <h3><?=$jum_peserta?></h3>
              <p>Data Peserta Ujian</p>
            </span>
          </li>
        </ul>
      </main>
      <?php
      }
      ?>
    </section>
    <!-- CONTENT -->

    <script src="script.js"></script>
    <script>
      var navLinks = document.querySelectorAll(".side-menu li a");
      for (var i = 0; i < navLinks.length; i++) {
      if (navLinks[i].href.endsWith(window.location.pathname + window.location.search)) {
          navLinks[i].parentElement.classList.add("active");
      } else {
          navLinks[i].parentElement.classList.remove("active");
      }
      }
    </script>
  </body>
</html>
<?php
}
?>

