<?php
include "../koneksi.php";

    $matpel = $_REQUEST['matpel'];
  

    $no = 1;
    $query = "select * from tb_soal_ujian,tb_matapelajaran where tb_soal_ujian.id_matapelajaran=tb_matapelajaran.id_matapelajaran and tb_soal_ujian.id_matapelajaran='$matpel'";

    $data = mysqli_query($koneksi, $query);
    $jum = mysqli_num_rows($data);
    if ($jum > 0) {
        $tableData = ''; // Variabel untuk data tabel
        foreach ($data as $d) {
        
        $tableData .= '
        <tr>
                    <td>'.$no++.'</td>
                    <td>'.$d['kode_matapelajaran'].'</td>
                    <td>'.$d['nama_matapelajaran'].'</td>
                    <td>'.$d['pertanyaan'].'</td>
                    <td>'.$d['kunci_jawaban'].'</td>
                    <td>
                    <a href="?halaman=editsoalujian&id='.$d['id_soal_ujian'].'" class="btn-download">
                        <span class="text">Edit</span>
                    </a>
                    <a href="?halaman=hapussoalujian&id='.$d['id_soal_ujian'].'" class="btn-download">
                        <span class="text">Hapus</span>
                    </a>
                    </td>
                </tr>';
        
      
    }
    echo"$tableData";
        # code...
    }else{
        echo "gagal";
    }

    


?>
