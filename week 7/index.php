<!DOCTYPE html>
<html>
<head>
    <title>Daftar Barang</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Daftar Barang</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Action</th>
        </tr>
        <?php
        $koneksi = new mysqli("localhost", "root", "", "toko_barang");

        if ($koneksi->connect_error) {
            die("Koneksi gagal: " . $koneksi->connect_error);
        }

        $sql = "SELECT * FROM barang";
        $result = $koneksi->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nama_barang"] . "</td>";
                echo "<td>" . $row["harga"] . "</td>";
                echo "<td>" . $row["stok"] . "</td>";
                echo "<td><a href='hapus_confirm.php?id=" . $row['id'] . "'>Hapus</a>
                <br><a href='ubah_barang.php?id=" . $row['id'] . "'>Ubah</a></td>";
                echo "</tr>";
            }
        } else {
            echo "Tidak ada data barang.";
        }

        $koneksi->close();
        ?>
    </table>
    <h1>Input Data Barang</h1>
    <form action="tambah_barang.php" method="POST" onsubmit="return confirmSubmission()">
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" name="nama_barang" required><br><br>
        
        <label for="harga">Harga:</label>
        <input type="number" name="harga" required><br><br>
        
        <label for="stok">Stok:</label>
        <input type="number" name="stok" required><br><br>
        
        <input type="submit" value="Simpan">
    </form>
    <script>
        function confirmSubmission() {
            var namaBarang = document.getElementsByName("nama_barang")[0].value;
            var confirmation = confirm('Apakah ingin menambah data barang ' + namaBarang + '?');
            
            if (confirmation) {
                // Submit the form
                return true;
            } else {
                // Do not submit the form
                return false;
            }
        }
    </script>
</body>
</html>
