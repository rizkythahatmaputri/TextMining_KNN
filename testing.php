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
    <title>Testing Data</title>
    <!-- Menambahkan tautan ke Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Menambahkan gaya khusus untuk halaman -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            color: #fff;
            background-color: #333;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        h1 {
            color: #f8f9fa;
        }
        .form-control {
            background-color: rgba(255, 255, 255, 0.2);
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
    <header class="text-center py-4">
        <h1 class="text-white">Document Classification</h1>
    </header>
    
    <div class="container">     
        
        <form action="testing.php" method="post" enctype="multipart/form-data"> <!-- Form action updated -->
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

            echo "<table class='table-bordered'>";
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

            //echo '<form action="proses_testing.php" method="post">
            //<input type="hidden" name="clean_text" value="<?php echo htmlspecialchars($clean_text);">
            //<input type="submit" value="Classify" class="btn btn-primary btn-block">
        //</form>' ;

            echo "</div>";

        }
        ?> 
        <br>
         <form action="proses_testing.php" method="post">
    <input type="hidden" name="clean_text" value="<?php echo htmlspecialchars($clean_text); ?>">
    <input type="submit" value="Classify" class="btn btn-primary btn-block">      
    </div>

  
    
<?php
// Tampilkan hasil klasifikasi jika tersedia
if (isset($_GET["category"])) {
    $category = $_GET["category"];
    echo "<br> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Kategori: $category</p>";
}
?>
  <div class="text-center mt-3">
            <a href="index.html" class="btn btn-secondary">Kembali ke Halaman Awal</a>
        </div>

    <!-- Menambahkan tautan ke Bootstrap JavaScript dan jQuery (diperlukan oleh Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
