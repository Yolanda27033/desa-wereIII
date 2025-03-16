
<?php
include 'config/config.php'; // Pastikan path benar sesuai lokasi config.php
?>
<?php
session_start(); // Memulai sesi untuk menyimpan status login

// Cek apakah pengguna sudah login
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header('Location: dashboard.php'); // Redirect ke halaman dashboard setelah login
    exit();
}

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

$menu = [
    "Home" => "?page=home",
    "Tentang Kami" => "?page=tentang",
    "Kontak Kami" => "?page=kontak",
    "Login" => "login.php" // Menu Login mengarah ke login.php
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Were III</title>
    <style>
        /* Gaya CSS */
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        nav {
            background: #40E0D0; /* Warna tosca muda */
            color: #fff;
            display: flex;
            justify-content: flex-end; /* Menempatkan menu di kanan */
            padding: 5px 15px; /* Padding lebih kecil untuk navbar yang lebih sempit */
            position: absolute;
            top: 0;
            right: 0;
            width: 100%; /* Menggunakan lebar 100% untuk memastikan navbar tidak terpotong */
            z-index: 10;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 8px 20px; /* Padding lebih kecil untuk elemen link */
            margin: 0 8px; /* Mengurangi jarak antar elemen */
            font-size: 0.9rem; /* Mengurangi ukuran font untuk navbar yang lebih ramping */
        }

        header {
            background: url('dist/img/desa.png') no-repeat center center/cover;
            color: #fff;
            height: 500px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            text-align: center;
        }

        header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Overlay gelap */
        }

        header h1 {
            position: relative;
            font-size: 8rem; /* Ukuran paling besar */
            font-weight: 900; /* Lebih tebal */
            color: #ffeb3b; /* Warna terang */
            z-index: 2;
        }

        header .marquee {
            position: relative;
            overflow: hidden;
            box-sizing: border-box;
            text-align: center;
            z-index: 2;
        }

        header .marquee span {
            display: inline-block;
            animation: marquee 15s linear infinite;
            font-size: 1.2rem;
        }

        header .visi-misi {
            position: relative;
            z-index: 2;
            margin-top: 20px;
            text-align: center;
        }

        header .visi-misi h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        header .visi-misi p {
            font-size: 1rem;
            margin: 5px 0;
        }

        @keyframes marquee {
            from { transform: translateX(100%); }
            to { transform: translateX(-100%); }
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        .content img {
            width: 45%;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        footer {
            background: #40E0D0; /* Warna tosca muda */
            color: #fff;
            text-align: center;
            padding: 5px 10px; /* Padding lebih kecil untuk footer */
            font-size: 0.8rem; /* Mengurangi ukuran font di footer */
            margin-top: 20px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-- Header -->
    <header>
        <div class="marquee">
            <span>Selamat Datang di Desa Were III</span>
        </div>
        <div class="visi-misi">
            <h2>Visi</h2>
            <p>"Membangun Desa yang Mandiri, Berdaya Saing, dan Berkelanjutan."</p>
            <h2>Misi</h2>
            <p>Meningkatkan kesejahteraan masyarakat melalui pengembangan pertanian dan ekonomi kreatif.</p>
            <p>Mewujudkan pendidikan dan kesehatan yang berkualitas.</p>
            <p>Melestarikan budaya lokal dan mempromosikan pariwisata desa.</p>
            <p>Meningkatkan pembangunan infrastruktur yang berkelanjutan.</p>
        </div>
    </header>

    <!-- Navigasi -->
    <nav>
        <?php foreach ($menu as $nama => $link): ?>
            <a href="<?php echo $link; ?>"><?php echo $nama; ?></a>
        <?php endforeach; ?>
    </nav>

    <!-- Konten Dinamis -->
    <div class="content">
        <?php
        switch ($page) {
            case 'tentang':
                echo "<h2>Informasi Kelompok Tani</h2>";
            
                $queryKelompok = "SELECT k.id_kelompok, k.nama_kelompok, k.lokasi, k.nama_ketua,
                                  GROUP_CONCAT(a.nama_anggota SEPARATOR ', ') AS anggota
                                  FROM tb_kelompok_tani k
                                  LEFT JOIN tb_anggota_kelompok a ON k.id_kelompok = a.id_kelompok
                                  GROUP BY k.id_kelompok";
                $resultKelompok = mysqli_query($conn, $queryKelompok);
            
                echo "<table border='1' cellpadding='8' cellspacing='0' width='100%'>";
                echo "<tr><th>No</th><th>Nama Kelompok</th><th>Lokasi</th><th>Ketua</th><th>Anggota</th></tr>";
            
                $no = 1;
                while ($row = mysqli_fetch_assoc($resultKelompok)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['nama_kelompok'] . "</td>";
                    echo "<td>" . $row['lokasi'] . "</td>";
                    echo "<td>" . $row['nama_ketua'] . "</td>";
                    echo "<td>" . ($row['anggota'] ? $row['anggota'] : 'Belum ada anggota') . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            
                echo "<h2>Informasi Masa Tanam</h2>";
            
                $queryMasaTanam = "SELECT * FROM tb_masa_tanam";
                $resultMasaTanam = mysqli_query($conn, $queryMasaTanam);
            
                echo "<table border='1' cellpadding='8' cellspacing='0' width='100%'>";
                echo "<tr><th>No</th><th>Jenis Tanaman</th><th>Periode Tanam</th></tr>";
            
                $no = 1;
                while ($row = mysqli_fetch_assoc($resultMasaTanam)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['jenis_tanaman'] . "</td>";
                    echo "<td>" . $row['periode_tanam'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            
                echo "<h2>Informasi Bantuan</h2>";
            
                $queryBantuan = "SELECT b.id_bantuan, b.nama_bantuan, p.jumlah_bantuan 
                                 FROM tb_bantuan b 
                                 LEFT JOIN tb_pembagian_anggaran p ON b.id_bantuan = p.id_bantuan";
                $resultBantuan = mysqli_query($conn, $queryBantuan);
            
                echo "<table border='1' cellpadding='8' cellspacing='0' width='100%'>";
                echo "<tr><th>No</th><th>Nama Bantuan</th><th>Jumlah</th></tr>";
            
                $no = 1;
                while ($row = mysqli_fetch_assoc($resultBantuan)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['nama_bantuan'] . "</td>";
                    echo "<td>" . ($row['jumlah_bantuan'] ? $row['jumlah_bantuan'] : 'Belum ada data') . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                break;
            
            case 'home':
            default:
               
                echo "<h3>Foto Kegiatan</h3>";
                echo "<img src='dist/img/rapat.png' alt='Rapat Desa'>";
                echo "<img src='dist/img/aula.png' alt='Aula Desa'>";
                echo "<img src='dist/img/ica.png' alt='Foto Ica'>";
                echo "<img src='dist/img/ceco.png' alt='Foto Ceco'>";
                break;
        }
        ?>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Desa Were III. Semua Hak Dilindungi.</p>
    </footer>

</body>
</html>
