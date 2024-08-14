<?php
include 'koneksi.php';
$sql = "SELECT nama, id_host FROM host";
$result = $connect->query($sql);

// Cek apakah query berhasil
if (!$result) {
    die("Query gagal: " . $connect->error);
}
?>

<div class="container-fluid">
    <h1 class="mt-4">Data bayaran host</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="index.php" style="color:grey;text-decoration:none;">Beranda</a></li>
        <li class="breadcrumb-item active"><a href="index.php?page=data_bayaran" style="color:grey;text-decoration:none;">Data bayaran host</a></li>
        <li class="breadcrumb-item active">Pelunasan pending</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-body">
            <div style="overflow-x: auto;">
            <table class="table table-bordered table-striped">
                <tr align="center">
                    <th>Nama</th>
                    <th>Bayaran pending</th>                    
                    <th>Durasi pending</th>
                    <th style="width:25px">Lunasi</th>
                </tr>
                
                <?php
                if ($result->num_rows > 0) {
                    // Output data setiap baris
                    while ($row = $result->fetch_assoc()) {
                        $nama_host = $row["nama"];
                        $id = $row["id_host"];
                        $durasi_sql = "SELECT SUM(durasi) AS total_durasi FROM absen WHERE nama = '$nama_host' AND pay = 0";
                        $durasi_result = $connect->query($durasi_sql);
                        if (!$durasi_result) {
                            die("Query gagal: " . $connect->error);
                        }
                        $durasi_row = $durasi_result->fetch_assoc();
                        $total_durasi = $durasi_row['total_durasi'] ? $durasi_row['total_durasi'] : 0;
                        $durasi_lebih = $total_durasi % 3;
                        $pay_sql = "SELECT SUM(pay) AS total_pay FROM absen WHERE nama = '$nama_host' AND pay = 0";
                        $pay_result = $connect->query($pay_sql);
                        if (!$pay_result) {
                            die("Query gagal: " . $connect->error);
                        }
                        $pay_row = $pay_result->fetch_assoc();
                        $total_pay = $pay_row['total_pay'] ? $pay_row['total_pay'] : 0;
                        $done = (int)($total_pay / 3) * 50000;
                        $total = ((($total_durasi - $durasi_lebih) / 3) * 50000);
                        $durpem = $total_durasi - $durasi_lebih;
                        $pen = $total - $done;
                        if ($pen > 0) {
                            echo "<tr align='center'>";
                            echo "<td>" . $nama_host . "</td>";
                            echo "<td>Rp " . number_format($pen,0,",",",") . "</td>";
                            echo "<td>" . $durpem . "</td>";
                            echo "<td><button class='btn btn-primary btn-block' data-toggle='modal' data-target='#modal-$id'>Lunasi</button></td>";
                            echo "</tr>";
                        }

                        // Modal for each host
                        echo "
                        <div class='modal fade' id='modal-$id' tabindex='-1' role='dialog' aria-labelledby='modalLabel-$id' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='modalLabel-$id'>Lunasi pembayaran untuk $nama_host</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                        <form method='POST'>
                                            <div class='form-group'>
                                                <label for='durasi-$id'>Durasi:</label>
                                                <select id='durasi-$id' name='batas' class='form-control'>";
                                                
                                                // Populate the select options
                                                for ($i = 3; $i <= $durpem; $i += 3) {
                                                    echo "<option hidden>Pilih durasi yang akan dilunasi</option>";
                                                    echo "<option value='$i'>$i jam</option>";
                                                }
                                                
                                                echo "
                                                </select>
                                            </div>
                                            <input type='submit' name='submit' class='btn btn-primary btn-block' value='Lunasi' >
                                            <input type='hidden' name='host_id' value='$id'>
                                            <input type='hidden' name='nama' value='$nama_host'>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>";

                    }
                }
                ?>
                
            </table>
            </div>
        </div>
    </div>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $host_id = $_POST['host_id'];
    $batas = (int) $_POST['batas'];
    $nama_host = $_POST['nama'];

    // Query untuk memilih ID dari entri yang akan diupdate
    $select_sql = "
        SELECT id_absen 
        FROM absen 
        WHERE nama = '$nama_host' 
        AND status = 1 
        AND durasi > 0 
        AND pay = 0 
        ORDER BY tanggal ASC 
        LIMIT $batas
    ";

    $result = $connect->query($select_sql);

    if ($result && $result->num_rows > 0) {
        $id_list = [];
        while ($row = $result->fetch_assoc()) {
            $id_list[] = $row['id_absen'];
        }
        
        // Buat daftar ID menjadi string yang bisa digunakan dalam query SQL
        $id_list_str = implode(',', $id_list);
        
        // Query untuk mengupdate entri yang dipilih
        $update_sql = "
            UPDATE absen 
            SET pay = 1 
            WHERE id_absen IN ($id_list_str)
        ";

        if ($connect->query($update_sql) === TRUE) {
            echo "<div class='alert alert-success' role='alert'>Pembayaran berhasil dilunasi.</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Terjadi kesalahan: " . $connect->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning' role='alert'>Tidak ada data yang sesuai untuk dilunasi.</div>";
    }
}
                $connect->close();

?>


<!-- Include Bootstrap JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
