<?php
// Tentukan path ke folder ikon dan lokasi file JSON
$iconDirectory = './public/images/icon';
$jsonFilePath = './public/images/manifest-icon.json';

// Pastikan folder ikon ada
if (!is_dir($iconDirectory)) {
    die("Folder $iconDirectory tidak ditemukan.");
}

// Dapatkan daftar semua file di dalam folder ikon
$files = scandir($iconDirectory);

// Filter file untuk mengabaikan '.' dan '..'
$iconFiles = array_filter($files, function ($file) use ($iconDirectory) {
    return is_file($iconDirectory . '/' . $file);
});

// Hitung jumlah file ikon
$length = count($iconFiles);

// Buat array dengan struktur yang diinginkan
$manifest = ['list' => []];
foreach ($iconFiles as $file) {
    // Hapus ekstensi file
    $name = pathinfo($file, PATHINFO_FILENAME);
    // Ganti tanda hubung dengan spasi
    $name = str_replace('-', ' ', $name);

    // Buat slug dari name
    $slug = preg_replace('/[^a-zA-Z0-9\s]/', '', $name); // Hapus semua simbol
    $slug = strtolower(str_replace(' ', '-', $slug)); // Ganti spasi dengan tanda hubung dan ubah ke huruf kecil

    $manifest['list'][] = [
        'name' => $name,
        'slug' => $slug,
        'file' => $file
    ];
}

// Encode array ke JSON
$jsonData = json_encode($manifest, JSON_PRETTY_PRINT);

// Pastikan folder untuk menyimpan file JSON ada
$jsonDirectory = dirname($jsonFilePath);
if (!is_dir($jsonDirectory)) {
    mkdir($jsonDirectory, 0777, true);
}

// Simpan data JSON ke file
if (file_put_contents($jsonFilePath, $jsonData) === false) {
    die("Gagal menyimpan file JSON ke $jsonFilePath.");
}

echo "File JSON berhasil dibuat di $jsonFilePath dengan $length ikon.";
