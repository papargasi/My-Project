<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Msub0702</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        .sb-sidenav-menu-nested .nav-link {
    margin-bottom: 5px; /* Atur jarak antar item */
    padding-left: 15px; /* Mengatur padding kiri agar lebih dekat */
}

    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">Msub0702 OFFICIAL</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button><!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
            </div>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Ubah Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Navigasi</div>

                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseCoba" aria-expanded="false" aria-controls="collapseCoba">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>Absen LIVE
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="show" id="collapseCoba" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                             <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="index.php">Beranda</a>
                                <a class="nav-link" href="index.php?page=data_absen">Absen</a>
                                <a class="nav-link" href="index.php?page=data_bayaran">Bayaran host</a>
                            </nav>
                        </div>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Admin Msub0702
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>

                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];

                    switch ($page) {
                        case 'data_absen':
                            include "data_absen.php";
                            break;
                        case 'data_bayaran':
                            include "data_bayaran.php";
                            break;
                        case 'payment':
                            include "payment.php";
                            break;
                        }
                } else {
                    include "Beranda.php";
                }
                ?>

            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Msub0702-Official</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var toggleLink = document.querySelector('.nav-link[href="#"]');
        var collapseElement = document.getElementById('collapseCoba');

        toggleLink.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah tautan untuk melakukan navigasi

            if (collapseElement.classList.contains('show')) {
                collapseElement.classList.remove('show');
            } else {
                collapseElement.classList.add('show');
            }
        });
});

    </script>
</body>

</html>