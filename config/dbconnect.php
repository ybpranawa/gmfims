<?php
//nama atau alamat server
$servername="localhost";
//username untuk login database
$username="root";
//password untuk login database
$passwd="";
//nama database yang digunakan
$dbname="manpowerdb";

//membuat sesi koneksi baru
$conn=mysqli_connect($servername,$username,$passwd,$dbname);

//jika koneksi gagal
if (!$conn) {
	$statuskoneksi=0;
	die("Koneksi ke database gagal : ".mysqli_connect_error());
}
else{
	$statuskoneksi = 1;
}
?>