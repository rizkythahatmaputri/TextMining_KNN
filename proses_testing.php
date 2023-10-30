<?php
// Implementasikan algoritma KNN di sini, dengan menggunakan data pelatihan yang telah Anda simpan.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //$document = $_POST["document"];
    $clean_text = $_POST["clean_text"];


    // Baca data pelatihan dari file teks (training_data.txt) dan simpan dalam sebuah array.
    $trainingData = file("training_data.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Inisialisasi variabel untuk menyimpan kategori hasil klasifikasi.
    $classifiedCategory = "Kategori Tidak Diketahui"; // Default jika klasifikasi gagal.

    // Implementasikan algoritma KNN untuk klasifikasi dokumen berdasarkan data pelatihan.
    if (!empty($trainingData)) {
        $documentWords = explode(" ", $clean_text);
        $maxSimilarity = 0;

        foreach ($trainingData as $data) {
            list($trainingDocument, $category) = explode("|", $data);
            $trainingWords = explode(" ", $trainingDocument);

            // Implementasikan metrik perbandingan kosinus atau metrik jarak lainnya di sini.
            // Misalnya, Anda dapat menghitung kemiripan dokumen menggunakan perbandingan kosinus.
            $similarity = calculateCosineSimilarity($documentWords, $trainingWords);

            if ($similarity > $maxSimilarity) {
                $maxSimilarity = $similarity;
                $classifiedCategory = $category;
            }
        }
    }

    // Redirect kembali ke halaman testing.php dengan hasil klasifikasi.
    header("Location: testing.php?category=$classifiedCategory");
}

// Fungsi untuk menghitung perbandingan kosinus antara dua dokumen.
function calculateCosineSimilarity($document1, $document2) {
    // Implementasikan perhitungan perbandingan kosinus di sini.
    // Anda perlu menghitung dot product dan panjang vektor untuk kedua dokumen.

    // Contoh sederhana: Hitung dot product antara dua vektor kata dan panjang vektor masing-masing dokumen.
    $dotProduct = 0;
    $magnitude1 = 0;
    $magnitude2 = 0;

    foreach ($document1 as $word1) {
        if (in_array($word1, $document2)) {
            $dotProduct += 1;
        }
        $magnitude1 += 1;
    }

    foreach ($document2 as $word2) {
        $magnitude2 += 1;
    }

    // Hitung perbandingan kosinus.
    if ($magnitude1 > 0 && $magnitude2 > 0) {
        $cosineSimilarity = $dotProduct / (sqrt($magnitude1) * sqrt($magnitude2));
        return $cosineSimilarity;
    } else {
        return 0; // Jika salah satu vektor nol, kembalikan 0.
    }
}

?>
