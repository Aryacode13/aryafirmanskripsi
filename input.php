<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Koneksi ke database
include "../koneksi.php";

$id = $_GET['id']; // Ambil ID dari URL

// Handle penyimpanan jawaban sementara via AJAX
if (isset($_POST['save_temp']) && isset($_POST['answer'])) {
    $question_number = $_POST['question_number'];
    $_SESSION['answers_'.$id][$question_number] = $_POST['answer'];
    exit;
}

// Query untuk mengambil soal ujian
$query = "SELECT * FROM tb_soal_ujian";
$result = mysqli_query($koneksi, $query);

// Tampilkan soal dalam form
?>
<form action="proses_jawaban.php" method="post" id="ujianForm">
    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Soal Ujian</h3>
            </div>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $no = 1;
                while($row = mysqli_fetch_assoc($result)) {
                    // Ambil jawaban dari session jika ada
                    $saved_answer = isset($_SESSION['answers_'.$id][$no]) ? $_SESSION['answers_'.$id][$no] : '';
                    
                    echo "<div class='soal'>";
                    echo "<p>$no. " . htmlspecialchars($row['pertanyaan']) . "</p>";
                    
                    // Tampilkan pilihan ganda dengan checked jika sudah dijawab
                    $options = ['A', 'B', 'C', 'D', 'E'];
                    foreach($options as $opt) {
                        $checked = ($saved_answer == $opt) ? 'checked' : '';
                        echo "<label><input type='radio' name='jawaban$no' value='$opt' $checked onchange='saveAnswer($no, this.value)'> 
                              $opt. " . htmlspecialchars($row[$opt]) . "</label><br>";
                    }
                    echo "</div>";
                    
                    $no++;
                }
                echo "<button type='submit' class='btn-submit'>Kirim Jawaban</button>";
            } else {
                echo "<p>Tidak ada soal yang tersedia.</p>";
            }
            ?>
        </div>
    </div>
</form>

<script>
function saveAnswer(questionNumber, answer) {
    fetch('?halaman=ujian&id=<?php echo $id; ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'save_temp=1&question_number=' + questionNumber + '&answer=' + encodeURIComponent(answer)
    });
}
</script>

<style>
.soal {
    margin: 20px;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.btn-submit {
    margin: 20px;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-submit:hover {
    background-color: #45a049;
}

label {
    display: block;
    margin: 10px 0;
    cursor: pointer;
}

input[type="radio"] {
    margin-right: 10px;
}
</style>

<?php
mysqli_close($koneksi);
?>
