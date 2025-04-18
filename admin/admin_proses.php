<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

if (isset($_POST['tambah'])) {	

	// Simpan input ke variabel
	$nm_admin = $_POST['nm_admin'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$no_telp = $_POST['no_telp'];
	$jk = $_POST['jk'];

	// Persiapkan query insert
	$stmt = $mysqli->prepare("INSERT INTO tb_admin (nm_admin, username, password, no_telp, jk) VALUES (?, ?, ?, ?, ?)");
	$stmt->bind_param("sssss", $nm_admin, $username, $password, $no_telp, $jk);

	// Eksekusi query
	if ($stmt->execute()) { 
		setcookie("info", "Data admin berhasil disimpan", time() + 2, "/");
		echo "<script>window.location='index.php?hal=admin';</script>";	
	} else {
		setcookie("gagal", "Data admin gagal disimpan", time() + 2, "/");
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

} else if (isset($_POST['ubah'])) {

	$nm_admin = $_POST['nm_admin'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$no_telp = $_POST['no_telp'];
	$jk = $_POST['jk'];
	$id_admin = $_POST['id_admin'];

	$stmt = $mysqli->prepare("UPDATE tb_admin SET nm_admin=?, username=?, password=?, no_telp=?, jk=? WHERE id_admin=?");
	$stmt->bind_param("ssssss", $nm_admin, $username, $password, $no_telp, $jk, $id_admin);

	if ($stmt->execute()) { 
		setcookie("info", "Data admin berhasil diubah", time() + 2, "/");
		echo "<script>window.location='index.php?hal=admin';</script>";	
	} else {
		echo "<script>alert('Data admin gagal diubah');</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

} else if (isset($_POST['id_admin'])) {

	$id_admin = $_POST['id_admin'];

	$stmt = $mysqli->prepare("DELETE FROM tb_admin WHERE id_admin=?");
	$stmt->bind_param("s", $_POST['id_admin']);


	if ($stmt->execute()) { 
		setcookie("info", "Data admin berhasil dihapus", time() + 2, "/");
		echo "<script>window.location='index.php?hal=admin';</script>";	
	} else {
		echo "<script>alert('Data admin gagal dihapus');</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>
