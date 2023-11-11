<!DOCTYPE html>
<html>
<head>
    <title>Ubah Data Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
    </style>
</head>
<body>
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
        echo "<br><a href='index.php'><button type='button'>Okee</button></a>";
    }
    ?>
</body>