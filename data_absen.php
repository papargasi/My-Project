<?php
include_once "koneksi.php";

// Initialize a success flag and error message
$success = false;
$error_message = "";

// Fetch names from the 'host' table
$names = [];
$query = "SELECT nama FROM host";
if ($result = $connect->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $names[] = $row['nama'];
    }
    $result->free();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $sekarang = gmdate('Y-m-d H:i:s', time() + 7*3600);
    $tanggal_hari_ini = gmdate('Y-m-d', time() + 7*3600); // Get current date

    // Check if the user has already marked as absent today
    $check_query = "SELECT COUNT(*) as count FROM absen WHERE nama = ? AND DATE(tanggal) = ?";
    if ($stmt = $connect->prepare($check_query)) {
        $stmt->bind_param("ss", $nama, $tanggal_hari_ini);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $error_message = "Sudah absen hari ini"; // Set error message if already absent today
        } else {
            // Determine if this is a regular absen or quick absence
            if (isset($_POST['absent'])) {
                // Quick absence button
                $durasi = 0;
                $status = 0;
                $pay = 0;
            } else {
                // Regular form submission
                $durasi = $_POST['durasi'];
                $status = 1;
                $pay = 0; // Pay calculation logic can go here if needed
            }

            // Proceed with inserting the record
            $query = "INSERT INTO absen (nama, durasi, status, tanggal, pay) VALUES (?, ?, ?, ?, ?)";
            if ($stmt = $connect->prepare($query)) {
                $stmt->bind_param("siisi", $nama, $durasi, $status, $sekarang, $pay);
                if ($stmt->execute()) {
                    $success = true; // Set success flag if insertion is successful
                }
                $stmt->close();
            } else {
                echo "Error: " . $connect->error;
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Msub0702 | Absen</title>
    <link rel="stylesheet" href="path/to/bootstrap.css">
    <script>
        function showAlertAndRedirect() {
            alert("Sukses melakukan absen");
            window.location.href = "index.php"; // Redirect to the homepage
        }

        function confirmAbsence(name) {
            return confirm("Apakah benar " + name + " tidak hadir?");
        }
    </script>
</head>
<body>

<div class="container-fluid">
    <h1 class="mt-4">Input absen</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="index.php" style="color:grey;text-decoration:none;">Beranda</a></li>
        <li class="breadcrumb-item active">Input absen</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="">
                <h4>Formulir daftar hadir</h4>
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <select id="nama" name="nama" class="form-control" required>
                        <option hidden>Pilih Nama</option>
                        <?php foreach ($names as $name): ?>
                            <option value="<?php echo htmlspecialchars($name); ?>"><?php echo htmlspecialchars($name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="durasi">Durasi:</label>
                    <input type="number" id="durasi" name="durasi" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h4>Tombol cepat untuk tidak hadir</h4>
            <?php foreach (array_slice($names, 0, 5) as $name): ?>
                <form method="POST" action="" style="display:inline;" onsubmit="return confirmAbsence('<?php echo htmlspecialchars($name); ?>');">
                    <input type="hidden" name="nama" value="<?php echo htmlspecialchars($name); ?>">
                    <input type="hidden" name="absent" value="1">
                    <button type="submit" class="btn btn-danger" style="margin: 5px;">
                        <?php echo htmlspecialchars($name); ?>
                    </button>
                </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php if ($success): ?>
    <script>
        // Call the function to show the alert and redirect
        showAlertAndRedirect();
    </script>
<?php elseif (!empty($error_message)): ?>
    <script>
        alert("<?php echo $error_message; ?>");
    </script>
<?php endif; ?>

</body>
</html>
