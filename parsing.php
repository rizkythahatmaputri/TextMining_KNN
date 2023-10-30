<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clean_text = $_POST['clean_text'];
    $category = $_POST['category'];

    // Validasi input (Anda dapat menambahkan validasi sesuai kebutuhan).
    if (empty($clean_text) || empty($category)) {
        echo "Document and category are required fields.";
        // Tambahkan logika lain jika diperlukan, seperti menampilkan pesan kesalahan.
    } else {
        // Simpan data pelatihan ke dalam file teks (misalnya, training_data.txt).
        $trainingData = "$clean_text|$category\n"; // Format: Dokumen|Category

        // Buka file untuk ditulis (gunakan mode "a" untuk menambahkan data ke file yang sudah ada).
        $file = fopen("training_data.txt", "a");

        // Tulis data pelatihan ke dalam file.
        if ($file) {
            fwrite($file, $trainingData);
            fclose($file);

            // Redirect kembali ke halaman input training data dengan pesan sukses.
            header("Location: parsing.php?success=1");
        } else {
            echo "Failed to save training data.";
            // Tambahkan logika lain jika ada masalah dengan penyimpanan data.
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Parsing Data</title>
    <!-- Menambahkan tautan ke Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header class="text-center py-2">
        <h1 class="text-white">Parsing Data</h1>
    </header>
    
    <div class="container">     
        <h2>Data Berhasil Disimpan ke Kamus</h2>
        
        <a href="testing.php" class="btn btn-primary">Ke Halaman Klasifikasi</a>
    </div>

    <!-- Menambahkan tautan ke Bootstrap JavaScript dan jQuery (diperlukan oleh Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
