<?php
//Mulai Sesion
session_start();
if (!isset($_SESSION["ses_username"])) {
	header("Location: beranda.php");
	exit(); // Penting agar skrip tidak dieksekusi lebih lanjut
}
else {
	$data_id = $_SESSION["ses_id"];
	$data_nama = $_SESSION["ses_nama"];
	$data_user = $_SESSION["ses_username"];
	$data_level = $_SESSION["ses_level"];
}


//KONEKSI DB
include "inc/koneksi.php";

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DESA WERE III</title>
	<link rel="icon" href="dist/img/logo.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- Alert -->
	<script src="plugins/alert.js"></script>
</head>

<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-dark" style="background-color: dark;">

			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#">
						<i class="fas fa-bars text-white"></i>
					</a>
				</li>
			</ul>

			<!-- SEARCH FORM (Removed text) -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item d-none d-sm-inline-block">
					<a href="index.php" class="nav-link">
						<font color="white">
							<b></b> <!-- Removed the name text -->
						</font>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		 <!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-gray elevation-4">
			<!-- Brand Logo -->
			<a href="index.php" class="brand-link">
			<img src="dist/img/logo.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
				<span class="brand-text"> DESA WERE III</span>
			</a>
			
				<!-- Sidebar -->
				<div class="sidebar">
					<!-- Sidebar user (optional) -->
					<div class="user-panel mt-2 pb-2 mb-2 d-flex">
						<div class="image">
							<?php
							// Cek apakah user adalah kades atau administrator
							if (isset($data_level) && strtolower($data_level) == "kades") {
								$foto = "dist/img/kades.png"; // Jika Kades
							} else {
								$foto = "dist/img/user.png"; // Jika Administrator
							}
							?>
							<img src="<?php echo $foto; ?>" class="img-circle elevation-1" alt="User Image">
						</div>
					<div class="info">
						<a href="index.php" class="d-block">
							<?php echo $data_nama; ?>
						</a>
						<span class="badge badge-success">
							<?php echo $data_level; ?>
						</span>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-3">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Level  -->
						<?php
						if ($data_level == "Administrator") {
						?>
							<li class="nav-item">
								<a href="index.php" class="nav-link">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>Dashboard</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="?page=data-penduduk" class="nav-link">
									<i class="nav-icon far fa fa-users"></i>
									<p>
										Data Penduduk
									</p>
								</a>
							</li>
                             <li class="nav-item">
                                    <a href="?page=data-kelompok_tani" class="nav-link">
                                        <i class="nav-icon fas fa-tractor"></i>
                                        <p>
                                            Data Kelompok Tani
                                        </p>
                                    </a>
                                </li> 
                                <li class="nav-item">
                                    <a href="?page=data-masa_tanam" class="nav-link">
                                        <i class="nav-icon fas fa-seedling"></i>
                                        <p>
                                            Data Masa Tanam
                                        </p>
                                    </a>
                                </li> 
                                <li class="nav-item">
                                    <a href="?page=data-pertanian" class="nav-link">
                                        <i class="nav-icon fas fa-leaf"></i>
                                        <p>
                                            Data Pertanian
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=data-pembagian_anggaran" class="nav-link">
                                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                                        <p>
                                            Pembagian Bantuan
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=data-bantuan" class="nav-link">
                                        <i class="nav-icon fas fa-gift"></i>
                                        <p>
                                            Data Bantuan
                                        </p>
                                    </a>
                                </li>

								<?php
									} elseif ($data_level == "Kades") {
									?>
										<li class="nav-item">
											<a href="index.php" class="nav-link">
												<i class="nav-icon fas fa-tachometer-alt"></i>
												<p>Dashboard</p>
											</a>
										</li>
									<li class="nav-item">
										<a href="?page=laporan-penduduk" class="nav-link">
											<i class="nav-icon fas fa-users"></i>
											<p>Laporan Data Penduduk</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="?page=laporan-kelompok-tani" class="nav-link">
											<i class="nav-icon fas fa-seedling"></i>
											<p>Laporan Data Kelompok Tani</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="?page=laporan-masa-tanam" class="nav-link">
											<i class="nav-icon fas fa-calendar-alt"></i>
											<p>Laporan Data Masa Tanam</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="?page=laporan-bantuan" class="nav-link">
											<i class="nav-icon fas fa-hand-holding-usd"></i>
											<p>Laporan Data Bantuan</p>
										</a>
									</li>

								<?php } ?>
								<li class="nav-item">
									<a onclick="return confirm('apa anda yakin ingin keluar?')" href="logout.php" class="nav-link">
										<i class="nav-icon far fa-circle text-danger"></i>
										<p>Logout</p>
									</a>
								</li>

				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
			</section>

			<!-- Main content -->
			<section class="content">
				<!-- /. WEB DINAMIS DISINI ############################################################################### -->
				<div class="container-fluid">

					<?php
					if (isset($_GET['page'])) {
						$hal = $_GET['page'];

						switch ($hal) {
								//Klik Halaman Home pegawai
							case 'Admin':
								include "home/admin.php";
								break;
							case 'Kades':
								include "home/kades.php";
								break;
						
								//Penduduk
							case 'data-penduduk':
								include "admin/penduduk/data_penduduk.php";
								break;
							case 'add-penduduk':
								include "admin/penduduk/add_penduduk.php";
								break;
							case 'edit-penduduk':
								include "admin/penduduk/edit_penduduk.php";
								break;
							case 'del-penduduk':
								include "admin/penduduk/del_penduduk.php";
								break;
							case 'view-penduduk':
								include "admin/penduduk/view_penduduk.php";
								break;
								//keanggotaan_kt
							case 'data-keanggotaan_kt':
								include "admin/keanggotaan_kt/data_keanggotaan_kt.php";
								break;
							case 'add-keanggotaan_kt':
								include "admin/keanggotaan_kt/add_keanggotaan_kt.php";
								break;
							case 'edit-keanggotaan_kt':
								include "admin/keanggotaan_kt/edit_keanggotaan_kt.php";
								break;
							case 'del-keanggotaan_kt':
								include "admin/keanggotaan_kt/del_keanggotaan_kt.php";
								break;
							case 'view-keanggotaan_kt':
								include "admin/keanggotaan_kt/view_keanggotaan_kt.php";
								break;

								//kelompok tani
							case 'data-kelompok_tani':
								include "admin/kelompok_tani/data_kelompok_tani.php";
								break;
							case 'add-kelompok_tani':
								include "admin/kelompok_tani/add_kelompok_tani.php";
								break;
							case 'edit-kelompok_tani':
								include "admin/kelompok_tani/edit_kelompok_tani.php";
								break;
							case 'del-kelompok_tani':
									include "admin/kelompok_tani/del_kelompok_tani.php";
									break;
							case 'view-kelompok_tani':
								include "admin/kelompok_tani/view_kelompok_tani.php";
								break;

								//masa tanam
							case 'data-masa_tanam':
								include "admin/masa_tanam/data_masa_tanam.php";
								break;
							case 'add-masa_tanam':
								include "admin/masa_tanam/add_masa_tanam.php";
								break;
							case 'edit-masa_tanam':
								include "admin/masa_tanam/edit_masa_tanam.php";
								break;
							case 'del-masa_tanam':
								include "admin/masa_tanam/del_masa_tanam.php";
								break;
							case 'view-masa_tanam':
								include "admin/masa_tanam/view_masa_tanam.php";
								break;

								//pertanian
							case 'data-pertanian':
								include "admin/pertanian/data_pertanian.php";
								break;
							case 'add-pertanian':
								include "admin/pertanian/add_pertanian.php";
								break;
							case 'edit-pertanian':
								include "admin/pertanian/edit_pertanian.php";
								break;
							case 'del-pertanian':
								include "admin/pertanian/del_pertanian.php";
								break;
							case 'view-pertanian':
								include "admin/pertanian/view_pertanian.php";
								break;

								//anggaran
							case 'data-pembagian_anggaran':
								include "admin/pembagian_anggaran/data_pembagian_anggaran.php";
								break;
							case 'add-pembagian_anggaran':
								include "admin/pembagian_anggaran/add_pembagian_anggaran.php";
								break;
							case 'edit-pembagian_anggaran':
								include "admin/pembagian_anggaran/edit_pembagian_anggaran.php";
								break;
							case 'view-pembagian_anggaran':
								include('admin/pembagian_anggaran/view_pembagian_anggaran.php');
								break;

								//bantuan
							case 'data-bantuan':
								include "admin/bantuan/data_bantuan.php";
								break;
							case 'add-bantuan':
								include "admin/bantuan/add_bantuan.php";
								break;
							case 'edit-bantuan':
								include "admin/bantuan/edit_bantuan.php";
								break;
							case 'del-bantuan':
								include "admin/bantuan/del_bantuan.php";
								break;
							case 'view-bantuan':
								include "admin/bantuan/view_bantuan.php";
								break;
							//laporan kades
							case 'laporan-penduduk':
								include "kades/laporan/laporan-penduduk.php";
								break;
							case 'laporan-kelompok-tani':
								include "kades/laporan/laporan-kelompok-tani.php";
								break;
							case 'laporan-masa-tanam':
								include "kades/laporan/laporan-masa-tanam.php";
								break;
							case 'laporan-bantuan':
								include "kades/laporan/laporan-bantuan.php";
								break;
					 //default
					 default:
					 echo "<center><h1> ERROR !</h1></center>";
							break;    
						}
					}else{
					// Auto Halaman Home Pengguna
						if($data_level=="Administrator"){
							include "home/admin.php";
							}
						elseif($data_level=="Kades"){
							include "home/kades.php";
							}
						}
				?>
				</div>
			</section>
		</div>

		<footer class="main-footer">
			<div class="float-right d-none d-sm-block">
				<!-- Copyright &copy; -->
					<a target="_blank" href="https://www.instagram.com/yolanbeka?igsh=d3oyaG54ZzN6ZXBr" tyle="text-decoration: none;">
						<strong> Yolanda Kristina Beka</strong>
					</a>
					<a target="_blank" href="https://www.instagram.com/elektro_tkja21?igsh=MWhyNmhtcXg0a3VjaQ==" style="text-decoration: none; margin-left: 2px;">
						<font color="gray">TKJ.A 2021</font>
					</a>
			</div>
			<b>Modified in 2025</b>
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Select2 -->
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<!-- DataTables -->
	<script src="plugins/datatables/jquery.dataTables.js"></script>
	<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="dist/js/demo.js"></script>
	<!-- page script -->
	<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

	<script>
		$(function() {
			$("#example1").DataTable();
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
			});
		});
	</script>

	<script>
		$(function() {
			//Initialize Select2 Elements
			$('.select2').select2()

			//Initialize Select2 Elements
			$('.select2bs4').select2({
				theme: 'bootstrap4'
			})
		})
	</script>

</body>

</html>




