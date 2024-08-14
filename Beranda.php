<?php
$bulan = date('m');
$nama_bulan = date('M');
$sebulan = cal_days_in_month(CAL_GREGORIAN, $bulan, 2024);
$hari_ini = date('Y-m-d');

// Menghubungkan ke database
include 'koneksi.php';

// Query untuk mengambil data absensi bulan ini
$sql = "SELECT nama, DAY(tanggal) as hari, status, pay, durasi 
        FROM absen 
        WHERE MONTH(tanggal) = $bulan AND YEAR(tanggal) = 2024";
$result = $connect->query($sql);

// Mengumpulkan data absensi dalam array
$absensi = [];
while ($row = $result->fetch_assoc()) {
    $absensi[$row['nama']][$row['hari']] = [
        'status' => $row['status'],
        'pay' => $row['pay'],
        'durasi' => $row['durasi']
    ];
}

// Query untuk mengambil data absensi hari ini
$sql_today = "SELECT nama, TIME(tanggal) as jam, durasi, status 
              FROM absen 
              WHERE DATE(tanggal) = '$hari_ini'";
$result_today = $connect->query($sql_today);

$rekap_live = [];
while ($row_today = $result_today->fetch_assoc()) {
    $rekap_live[] = $row_today;
}
$hari = array(
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
);

// Array untuk bulan dalam bahasa Indonesia
$bulan = array(
    'Jan' => 'Januari',
    'Feb' => 'Februari',
    'Mar' => 'Maret',
    'Apr' => 'April',
    'May' => 'Mei',
    'Jun' => 'Juni',
    'Jul' => 'Juli',
    'Aug' => 'Agustus',
    'Sep' => 'September',
    'Oct' => 'Oktober',
    'Nov' => 'November',
    'Dec' => 'Desember'
);

// Mendapatkan tanggal saat ini
$tanggal = date('D, d M Y');

// Mengganti nama hari dan bulan dengan bahasa Indonesia
$tanggal = str_replace(array_keys($hari), array_values($hari), $tanggal);
$tanggal = str_replace(array_keys($bulan), array_values($bulan), $tanggal);

?>
<title>Msub0702</title>
<div class="container-fluid">
    <h1 class="mt-4">Dashboard absensi live</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="index.php" style="color:grey;text-decoration:none;">Beranda</a></li>
    </ol>
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4" id="content">
                <div class="card-header">Rekap live <?php echo $tanggal; ?></div>
                <div class="card-body">
                    <div style="overflow-x: auto;">
                   <table class="table table-bordered table-striped" >
                        <tr align="center">
                            <th>Nama</th>
                            <th>Pukul Live</th>
                            <th>Durasi Live</th>
                        </tr>
                        <?php
                        if (!empty($rekap_live)) {
                            foreach ($rekap_live as $data) {
                                $nama = $data['nama'];
                                $jam = $data['jam'];
                                $durasi = $data['durasi'];
                                $status = $data['status'];

                                $pukul_live = '';
                                $durasi_live = '0';
                                $bg_color = ''; // Default background color

                                if ($status == 1) {
                                    // Calculate the end time
                                    $start_time = new DateTime($jam);
                                    $end_time = clone $start_time;
                                    $end_time->modify("+$durasi hours");
                                    $pukul_live = $start_time->format('H:i') . ' - ' . $end_time->format('H:i');
                                    $durasi_live = $durasi;
                                    echo "<tr>
                                        <td>$nama</td>
                                        <td>$pukul_live</td>
                                        <td>$durasi_live Jam</td>
                                      </tr>";
                                } else {
                                    $bg_color = 'red'; // Set background to red if status is 0
                                    echo "<tr style='background-color:$bg_color'>
                                        <td>$nama</td>
                                        <td>$pukul_live</td>
                                        <td></td>
                                      </tr>";
                                    
                                }

                                
                            }
                        } else {
                            echo "<tr><td colspan='3'>Tidak ada data absensi untuk hari ini</td></tr>";
                        }
                        ?>
                   </table>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">Data absensi bulan ini, <?php echo date('M Y'); ?></div>
                <div class="card-body">
                    <div style="overflow-x: auto;">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th rowspan="2" style="text-align:center">Nama</th>
                                    <th style="text-align:center" colspan="<?php echo $sebulan ?>"><?php echo $nama_bulan ?></th>
                                    <th rowspan="2" style="text-align:center">Total Jam</th>
                                </tr>
                                <tr>
                                    <?php
                                    for ($i = 1; $i <= $sebulan; $i++) {
                                        echo "<th style='width:30px;'>$i</th>";
                                    }
                                    ?>
                                </tr>
                                <?php
                                // Query untuk mengambil semua nama dari tabel host
                                $sql_host = "SELECT nama FROM host";
                                $result_host = $connect->query($sql_host);

                                if ($result_host->num_rows > 0) {
                                    while ($row_host = $result_host->fetch_assoc()) {
                                        $nama = $row_host['nama'];
                                        echo "<tr><td>$nama</td>";

                                        $total_jam = 0;
                                        for ($i = 1; $i <= $sebulan; $i++) {
                                            $bg_color = ''; // Default background color
                                            $display_text = '';

                                            if (isset($absensi[$nama][$i])) {
                                                $status = $absensi[$nama][$i]['status'];
                                                $pay = $absensi[$nama][$i]['pay'];
                                                $durasi = $absensi[$nama][$i]['durasi'];

                                                // Apply background color based on pay value
                                                if ($pay >= 1) {
                                                    $bg_color = 'limegreen'; // Neon green color
                                                }

                                                // Display duration if status is 1
                                                if ($status == 1) {
                                                    $display_text = $durasi;
                                                    $total_jam += $durasi;
                                                } else {
                                                    $bg_color = 'red';
                                                }
                                            }

                                            echo "<td style='background-color: $bg_color; width:30px;'>$display_text</td>";
                                        }

                                        // Menampilkan total durasi
                                        echo "<td>$total_jam</td></tr>";
                                    }
                                } else {
                                    echo "<tr style='color:black'><td colspan='".($sebulan + 2)."'>Belum ada data absensi untuk bulan ini</td></tr>";
                                }
                                ?>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>