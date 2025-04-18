<?php
//error_reporting(0);
//set koneksi ke basis data
$host = "localhost"; //Berjalan di local
$username = "root";
$password = "";
$database = "db_pakar"; //Nama database

//koneksi ke basis data
$mysqli = new mysqli($host, $username, $password, $database);

//Cek koneksi basis data
if(mysqli_connect_errno()) {
	echo "Error: Tidak terhubung ke database";
	exit;
	}
?>