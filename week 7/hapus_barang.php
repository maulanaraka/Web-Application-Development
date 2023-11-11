<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $koneksi = new mysqli("localhost", "root", "", "toko_barang");

    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    $id = $_GET['id'];

    $sql = "DELETE FROM barang WHERE id = $id";

    if ($koneksi->query($sql) === TRUE) {
        $message = "Data barang dengan ID " . $id . " berhasil dihapus.";
    } else {
        $message = "Error: " . $sql . "<br>" . $koneksi->error;
    }

    $koneksi->close();
    echo "<h2 style = text-align:centre> $message </h2>";
    echo "<br><a 
        style = display: block;
        margin-left: auto;
        margin-right: auto; 
        href='index.php'>
        Kembali
        </a>";
}
?>