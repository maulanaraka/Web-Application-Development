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
    <h1>Ubah Data Barang</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $koneksi = new mysqli("localhost", "root", "", "toko_barang");

        if ($koneksi->connect_error) {
            die("Koneksi gagal: " . $koneksi->connect_error);
        }

        $id = $_GET['id'];

        $result = $koneksi->query("SELECT * FROM barang WHERE id = $id");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Data tidak ditemukan.";
            $koneksi->close();
            exit;
        }

        $koneksi->close();
    }
    ?>
    
    <form action="" method="POST" onsubmit="return confirmSubmission()">
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" name="nama_barang" required><br><br>
        
        <label for="harga">Harga:</label>
        <input type="number" name="harga" required><br><br>
        
        <label for="stok">Stok:</label>
        <input type="number" name="stok" required><br><br>
        
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" value="Simpan Perubahan">
    </form>
    
    <br><br>
    <a href='index.php'><button type="button">Ga jadi deh</button></a>

    <script>
        function confirmSubmission() {
            var confirmation = confirm('Apakah Anda yakin ingin mengubah data barang dengan ID <?php echo $id; ?> dan nama <?php echo $row['nama_barang']; ?>?');
            
            if (confirmation) {
                return true;
            } else {
                return false;
            }
        }
    </script>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $koneksi = new mysqli("localhost", "root", "", "toko_barang");

    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    $id = $_POST['id'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "UPDATE barang SET nama_barang='$nama_barang', harga=$harga, stok=$stok WHERE id=$id";

    if ($koneksi->query($sql) === TRUE) {
        $message = "Data barang berhasil diperbarui.";
    } else {
        $message = "Error: " . $sql . "<br>" . $koneksi->error;
    }

    $koneksi->close();

    echo "<br>".$message;
}
?>
