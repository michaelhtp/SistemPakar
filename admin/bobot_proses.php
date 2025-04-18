<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

if(isset($_POST['tambah']))
{	
    $id_gejala_arr = $_POST['id_gejala']; // ini array!
    $id_penyakit = mysqli_real_escape_string($mysqli, $_POST['id_penyakit']);

    $berhasil = 0;
    $gagal = 0;

    foreach ($id_gejala_arr as $id_gejala) {
        $id_gejala = mysqli_real_escape_string($mysqli, $id_gejala);

        $stmt = $mysqli->prepare("INSERT INTO tb_rekap (id_gejala, id_penyakit) VALUES (?, ?)");
        $stmt->bind_param("ss", $id_gejala, $id_penyakit);

        if ($stmt->execute()) {
            $berhasil++;
        } else {
            $gagal++;
        }
    }

    echo "<script>alert('Data berhasil disimpan: $berhasil, Gagal: $gagal')</script>";
    echo "<script>window.location='index.php?hal=bobot_olah&id=".$id_penyakit."';</script>";	

} else if(isset($_GET['hapus'])) {

    $id_rekap = mysqli_real_escape_string($mysqli, $_GET['hapus']); // ini oke untuk keamanan

    $stmt = $mysqli->prepare("DELETE FROM tb_rekap WHERE id_rekap = ?");
    $stmt->bind_param("i", $id_rekap); 

    if ($stmt->execute()) {
        echo "<script>alert('Data Bobot Berhasil Dihapus')</script>";
        echo "<script>window.location='index.php?hal=bobot_olah&id=".$_GET['id']."';</script>";
    } else {
        echo "<script>alert('Data Bobot Gagal Dihapus: " . $stmt->error . "')</script>";
        echo "<script>window.location='index.php?hal=bobot_olah&id=".$_GET['id']."';</script>";
    }
}



?>
