<?php
include("koneksi.php");

// Fungsi untuk mengambil soal berdasarkan tingkat kesulitan
function getSoalByDifficulty($koneksi, $difficulty) {
    $sql = "SELECT * FROM tb_soal_ujian WHERE id_matapelajaran = 4 AND tingkat_kesulitan = '$difficulty'";
    $result = $koneksi->query($sql);
    
    $soals = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $soals[] = $row;
        }
    }
    return $soals;
}

// Fungsi untuk memilih soal secara acak
function getRandomSoals($koneksi) {
    // Ambil soal berdasarkan tingkat kesulitan
    $soalMudah = getSoalByDifficulty($koneksi, "mudah"); // Tingkat kesulitan 'mudah'
    $soalSedang = getSoalByDifficulty($koneksi, "sedang"); // Tingkat kesulitan 'sedang'
    $soalSulit = getSoalByDifficulty($koneksi, "sulit"); // Tingkat kesulitan 'sulit'

    // Mengacak soal di setiap kategori
    shuffle($soalMudah);
    shuffle($soalSedang);
    shuffle($soalSulit);

    // Ambil 5 soal dari setiap kategori
    $selectedSoal = array_merge(array_slice($soalMudah, 0, 5), array_slice($soalSedang, 0, 5), array_slice($soalSulit, 0, 5));

    return $selectedSoal;
}

// Ambil soal secara acak
$soals = getRandomSoals($koneksi);

// Tampilkan soal yang terpilih
echo "<h3>Soal Ujian:</h3>";
echo "<ol>";
foreach ($soals as $soal) {
    echo "<li>" . $soal['pertanyaan'] . "<br>";
    echo "A. " . $soal['a'] . "<br>";
    echo "B. " . $soal['b'] . "<br>";
    echo "C. " . $soal['c'] . "<br>";
    echo "D. " . $soal['d'] . "<br>";
    echo "E. " . $soal['e'] . "<br>";
    echo "Kunci Jawaban: " . $soal['kunci_jawaban'] . "</li><br>";
}
echo "</ol>";

// Menutup koneksi
$koneksi->close();
?>
