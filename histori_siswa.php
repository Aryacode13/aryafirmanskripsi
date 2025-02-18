<?php
// Cek session guru
if (!isset($_SESSION['guru'])) {
    header("Location: ../login.php");
    exit();
}

$guru_id = $_SESSION['guru']['id'];

// Query untuk mendapatkan histori siswa yang pernah diajar
$query = "SELECT DISTINCT 
            s.nama AS nama_siswa,
            k.nama_kelas,
            ta.tahun_ajaran,
            m.nama_mapel
          FROM siswa s
          JOIN kelas k ON s.id_kelas = k.id
          JOIN mengajar mg ON k.id = mg.id_kelas
          JOIN mapel m ON mg.id_mapel = m.id
          JOIN tahun_ajaran ta ON mg.id_tahun_ajaran = ta.id
          WHERE mg.id_guru = '$guru_id'
          ORDER BY ta.tahun_ajaran DESC, k.nama_kelas ASC";

$result = mysqli_query($koneksi, $query);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Histori Siswa</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Siswa yang Pernah Diajar</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Tahun Ajaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama_siswa'] ?></td>
                                        <td><?= $row['nama_kelas'] ?></td>
                                        <td><?= $row['nama_mapel'] ?></td>
                                        <td><?= $row['tahun_ajaran'] ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script> 