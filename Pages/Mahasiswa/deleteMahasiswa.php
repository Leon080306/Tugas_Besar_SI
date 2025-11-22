<?php
include "../../SQL/connection.php";
$stmt_user = $con->prepare("UPDATE users SET deleted_at = NOW() WHERE user_id = ?");
$stmt_user->bind_param("s", $_GET['user_id']);

$stmt_mhs = $con->prepare("UPDATE mahasiswa SET deleted_at = NOW() WHERE user_id = ?");
$stmt_mhs->bind_param("s", $_GET['user_id']);

if ($stmt_user->execute() && $stmt_mhs->execute()) {
    echo "<script>alert('Berhasil menghapus Mahasiswa: " . $_GET['nim'] . "');</script>";
} else {
    echo "<script>alert('Gagal menghapus Mahasiswa: " . $_GET['nim'] . "');</script>";
}
header("Location: mahasiswaMenuAdmin.php");
?>