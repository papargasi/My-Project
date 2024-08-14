<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";  // Ganti dengan username database Anda
$password = "";      // Ganti dengan password database Anda
$dbname = "live";    // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan data dari tabel host
$sql = "SELECT nama FROM host";
$result = $conn->query($sql);
?>

<div class="container-fluid">
    <h1 class="mt-4">Data bayaran host</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="index.php" style="color:grey;text-decoration:none;">Beranda</a></li>
        <li class="breadcrumb-item active">Data bayaran host</li>
    </ol>
    <a href="index.php?page=payment" class="btn btn-success py-2 mb-4" >Lunasi pending</a>
    <div class="card mb-4">
        <div class="card-body">
            <div style="overflow-x: auto;">
            <table class="table table-bordered table-striped">
                <tr align="center">
                    <th rowspan="2">Nama</th>
                    <th colspan="4">Bayaran</th>                    
                    <th rowspan="2">Total</th>
                    <th rowspan="2" style="width:25px">Durasi total</th>
                    <th rowspan="2" style="width:25px">Durasi lebih</th>
                </tr>
                <tr align="center" width=100%>
                    <th style="background-color:limegreen" width=150px>Done</th>
                    <th width=20px style="background-color:limegreen">Durasi</th>
                    <th style="background-color:" class="bg-danger" width=150px>Pending</th>
                    <th width=20px class="bg-danger">Durasi</th>
                </tr>
                
                <?php
                if ($result->num_rows > 0) {
                    // Output data setiap baris
                    while($row = $result->fetch_assoc()) {
                        $nama_host = $row["nama"];

                        // Query untuk menghitung total durasi dari tabel absen berdasarkan nama host
                        $durasi_sql = "SELECT SUM(durasi) AS total_durasi FROM absen WHERE nama = '$nama_host'";
                        $durasi_result = $conn->query($durasi_sql);
                        $durasi_row = $durasi_result->fetch_assoc();
                        $total_durasi = $durasi_row['total_durasi'] ? $durasi_row['total_durasi'] : 0;

                        // Hitung durasi lebih (sisa bagi dengan 3)
                        $durasi_lebih = $total_durasi % 3;

                        // Query untuk menghitung total pay dari tabel absen berdasarkan nama host
                        $pay_sql = "SELECT SUM(pay) AS total_pay FROM absen WHERE nama = '$nama_host'";
                        $pay_result = $conn->query($pay_sql);
                        $pay_row = $pay_result->fetch_assoc();
                        $total_pay = $pay_row['total_pay'] ? $pay_row['total_pay'] : 0;

                        // Hitung total bayaran berdasarkan kelipatan 3 (setiap 3 unit senilai 50000)
                        $done = (int)($total_pay / 3) * 50000;
                        $total=(($total_durasi - $durasi_lebih)/3)*50000 ;
                        $pen = $total - $done;
                        echo "<tr align='center'>";
                        echo "<td>" . $nama_host . "</td>";
                        echo "<td>Rp " . number_format($done,0,",",",") . "</td>";  // Kolom Total
                        echo "<td>".(int)(($total_pay/3)*3)." jam</td>";
                        if ($pen > 0){
                            echo "<td style='color:red' >Rp " . number_format($pen,0,",",",") . "</td>";  // Kolom Bayaran Done (kosongkan atau isi sesuai kebutuhan)
                            echo "<td style='color:red'>".(int)(($total_durasi-$durasi_lebih)-(($total_pay/3)*3))." Jam</td>";
                        }else{
                            echo "<td style='color:red' colspan='2' >Belum ada data bayaran pending</td>";  // Kolom Bayaran Done (kosongkan atau isi sesuai kebutuhan)
                        }
                        echo "<td>Rp " . number_format($total,0,",",",") . "</td>";  // Kolom Bayaran Pending (kosongkan atau isi sesuai kebutuhan)
                        echo "<td>" . $total_durasi . "</td>";  // Kolom Durasi tot
                        echo "<td>" . $durasi_lebih . "</td>";  // Kolom Durasi lebih
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' align='center'>Tidak ada data</td></tr>";
                }
                $conn->close();
                ?>
                
            </table>
            </div>
        </div>
    </div>
</div>
