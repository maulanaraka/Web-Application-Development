<?php
    $koneksi = new mysqli("localhost", "root", "", "toko_barang");

    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO barang (nama_barang, harga, stok) VALUES ('$nama_barang', $harga, $stok)";

    if ($koneksi->query($sql) === TRUE) {
        $message = "Data barang berhasil diperbarui.";
    } else {
        $message = "Error: " . $sql . "<br>" . $koneksi->error;
    }

    $koneksi->close();

    echo $message;
    header("Location: index.php");
    ?>