<?php
// Konfigurasi koneksi ke database
include("koneksi.php");

// Fungsi untuk mengambil soal berdasarkan tingkat kesulitan
function getSoalByDifficulty($koneksi, $difficulty) {
    $query = "SELECT * FROM tb_soal_ujian WHERE id_soal_ujian BETWEEN ? AND ?";
    switch ($difficulty) {
        case 'mudah':
            $start = 8; // id soal untuk soal mudah
            $end = 12; // id soal untuk soal mudah
            break;
        case 'sedang':
            $start = 13; // id soal untuk soal sedang
            $end = 17; // id soal untuk soal sedang
            break;
        case 'sulit':
            $start = 18; // id soal untuk soal sulit
            $end = 22; // id soal untuk soal sulit
            break;
        default:
            return [];
    }

    // Prepare statement untuk mencegah SQL Injection
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ii", $start, $end);
    $stmt->execute();
    $result = $stmt->get_result();

    $soals = [];
    while ($row = $result->fetch_assoc()) {
        $soals[] = $row;
    }

    $stmt->close();
    return $soals;
}

// Fungsi untuk memilih soal secara acak
function getRandomSoals($koneksi) {
    $soalMudah = getSoalByDifficulty($koneksi, 'mudah');
    $soalSedang = getSoalByDifficulty($koneksi, 'sedang');
    $soalSulit = getSoalByDifficulty($koneksi, 'sulit');

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
