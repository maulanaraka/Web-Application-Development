<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $koneksi = new mysqli("localhost", "root", "", "toko_barang");

    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    $id = $_GET['id'];

    $result = $koneksi->query("SELECT * FROM barang WHERE id = $id");
    $row = $result->fetch_assoc();

    $koneksi->close();
?>

<script>
    var konfirmasi = confirm("Apakah Anda yakin ingin menghapus data barang dengan ID <?php echo $id; ?> dan nama <?php echo $row['nama_barang']; ?>?");
    if (konfirmasi) {
        window.location.href = "hapus_barang.php?id=<?php echo $id; ?>";
    } else {
        window.history.back();
    }
</script>

<?php
    } else {
        echo "koneksi gagal:(";
    }
?>
