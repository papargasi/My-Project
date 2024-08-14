<?php
// Koneksi ke database
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_host = $_POST['nama_host'];
    $durasi_to_lunasi = $_POST['durasi'];  // Durasi yang dipilih oleh user untuk dilunasi

    // Ambil data absen dengan pay = 0 berdasarkan nama host dan urutkan berdasarkan tanggal terlama
    $query = "SELECT id, durasi FROM absen WHERE nama = ? AND pay = 0 ORDER BY tanggal ASC";
    if ($stmt = $connect->prepare($query)) {
        $stmt->bind_param("s", $nama_host);
        $stmt->execute();
        $stmt->bind_result($id, $durasi);

        $total_durasi = 0;
        $ids_to_update = [];

        while ($stmt->fetch()) {
            $total_durasi += $durasi;
            $ids_to_update[] = $id;

            // Jika total durasi sudah mencapai atau melebihi durasi yang ingin dilunasi, hentikan loop
            if ($total_durasi >= $durasi_to_lunasi) {
                break;
            }
        }

        $stmt->close();

        // Jika durasi yang dikumpulkan memenuhi syarat, update kolom pay menjadi 1
        if (!empty($ids_to_update)) {
            $ids_to_update = implode(',', $ids_to_update);
            $update_query = "UPDATE absen SET pay = 1 WHERE id IN ($ids_to_update)";
            if ($conn->query($update_query) === TRUE) {
                echo "<script>alert('Pembayaran berhasil dilunasi!'); window.location.href = 'index.php?page=data_bayaran';</script>";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }
}

$connect->close();
?>
