<?php
session_start();

// Menghubungkan dengan koneksi (pastikan file koneksi.php ada di folder databases)
include '../databases/koneksi.php';

// Sertakan file pendukung lainnya
require_once __DIR__ . '/../setting/crud.php';
// require_once __DIR__ . '/../setting/koneksi.php';  // Tidak perlu, karena sudah di-include di atas
require_once __DIR__ . '/../setting/tanggal.php';

// Tangkap data yang dikirim dari form melalui POST
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Pastikan variabel tidak kosong, Anda bisa menambahkan validasi tambahan di sini

// Sanitasi input dengan fungsi real_escape_string
$username = $koneksi->real_escape_string($username);
$password = $koneksi->real_escape_string($password);

// Definisikan query untuk memeriksa keberadaan admin
$sqladmin = "SELECT * FROM tb_admin WHERE username='$username' AND password='$password'";

// Menggunakan fungsi CekExist dari file crud.php
if (CekExist($koneksi, $sqladmin) == true) {
    // Jika data ditemukan, ambil data admin menggunakan fungsi caridata (pastikan fungsi ini ada di crud.php)
    $_SESSION['admin'] = caridata($koneksi, $sqladmin);
    echo "<script>alert('Anda login sebagai Admin');</script>";
    echo "<script>window.location='index.php';</script>";
} else {
    // Jika tidak ditemukan, tampilkan pesan gagal login
    echo "<script>alert('Username atau Password tidak terdaftar');</script>";
    echo "<script>window.location='../index.php';</script>";
}
?>
