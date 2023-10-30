<?php
$text = "";
$clean_text = "";
$lowercase_text = "";
$words = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    // Mendapatkan isi file yang diunggah
    $uploaded_file = $_FILES['file']['tmp_name'];

    if (file_exists($uploaded_file)) {
        $text = file_get_contents($uploaded_file);

        // Membersihkan teks (menghapus karakter non-alfanumerik)
        $clean_text = preg_replace('/[^a-zA-Z0-9\s]/', '', $text);

        // Mengubah teks ke huruf kecil
        $lowercase_text = strtolower($clean_text);

        // Memisahkan kata-kata
        $words = explode(' ', $lowercase_text);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Training Data</title>
    <!-- Menambahkan tautan ke Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Menambahkan gaya khusus untuk halaman -->
    <style>
        body {
            font-family: 'Poppins', sans-serif; /* Menggunakan font Poppins untuk body */
            background-image: url('background.jpg'); /* Ganti 'background.jpg' dengan URL gambar latar belakang Anda */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            color: #fff; /* Warna teks */

            background-color: #333; /* Warna latar belakang gelap */
            font-family: 'Poppins', sans-serif; /* Menggunakan font Poppins untuk body */
            color: #fff; /* Warna teks putih */

        }
        .container {
            background-color: rgba(0, 0, 0, 0.7); /* Latar belakang semi-transparan untuk container */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        h1 {
            color: #f8f9fa; /* Warna teks judul */
        }
        .form-control {
            background-color: rgba(255, 255, 255, 0.2); /* Latar belakang semi-transparan untuk input */
            color: #fff;
        }
        .btn {
            background-color: #007bff;
            color: #fff;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
<body>
</body>
    <header class="text-center py-2">
        <h1 class="text-white">"Document Classification"</h1>
    </header>
    
    <div class="container">     
    <h1>Preprocessing Text</h1>
    <form action="input_clean.php" method="post" enctype="multipart/form-data">
    <label for="file">Masukkan Dokumen:</label><br>
    <input type="file" id="file" name="file"><br><br>
    <input type="submit" value="Preprocessing" class="btn btn-primary btn-block">
</form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Menampilkan hasil
        echo "<div class='result'>";
        echo "<br> <br>";
        echo "<h2>Hasil Preprocessing</h2>";
        echo "<strong>Teks Awal:</strong> $text<br><br><br>";


echo "<table class='table table-bordered'>";
    // Teks Setelah Dibersihkan
    echo "<tr><td><strong>Cleansing</strong></td><td>$clean_text</td></tr>";
    // Teks dalam Huruf Kecil
    echo "<tr><td><strong>Lowercase</strong></td><td>$lowercase_text</td></tr>";
    // Kata-kata
    echo "<tr><td><strong>Tokenizing</strong></td><td>" . implode(', ', $words) . "</td></tr>";
    echo "</table>";
        echo "<br> <br>";
         // Tombol untuk mengarahkan ke halaman testing.php
    //echo '<a href="testing.php" class="btn btn-primary">Ke Halaman Klasifikasi</a>';

        echo "</div>";

        echo "<form action='parsing.php' method='post'>";
        echo "<input type='hidden' name='clean_text' value='$clean_text'>";
        echo "<label for='category'>Masukkan Kategori:</label><br>";
        echo "<input type='text' id='category' name='category'><br><br>";
        echo "<input type='submit' value='Simpan ke Kamus' class='btn btn-primary btn-block'>";
        echo "</form>";
    }
    ?>       
    </div>

    <!-- Menambahkan tautan ke Bootstrap JavaScript dan jQuery (diperlukan oleh Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
