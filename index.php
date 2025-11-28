<?php

session_start();
  if( !isset($_SESSION['login']) ){
      header("Location: login.php");
      exit;
  }

require("function.php");

// $query = query("SELECT * FROM buku");
//     $buku = $query;

$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM buku"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

    $query = query("
          SELECT
          buku.*,
          kategori.nama_kategori
          FROM buku
          INNER JOIN kategori ON buku.id_kategori = kategori.id
          ORDER BY buku.tahun_terbit DESC
          LIMIT $awalData, $jumlahDataPerHalaman
       ");

$buku = $query;

    if(isset($_POST['tombol_search'])){
      $buku = cari_buku($_POST['keyword']);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMBS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        html, body{
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body{
            background-image: url(wall.jpg);
            background-attachment: fixed;
        }
    </style>
</head>
<body>

<!-- NAVBAR SECTION START -->
 <nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#">SIMBS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-white active" aria-current="page" href="index.php">Data Buku</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active" aria-current="page" href="kategori.php">Data Kategori</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="logout.php">logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- NAVBAR SECTION END -->

<!-- CONTENT SECTION START -->
 <section class="p-3">
        <div class="container">

            <h1>Halo, Selamat Datang <?= $_SESSION['username']?> 🤗</h1>

            <div class="d-flex justify-content-between align-items-center">
                <a href="tambah_data_buku.php">
                    <button class="mb-2 btn-sm btn-primary">Tambah Data</button>
                </a>

                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                            <!-- Tombol Previous -->
                        <?php if ($halamanAktif > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
                            </li>
                        <?php endif; ?>


                        <!-- Daftar halaman -->
                        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                            <?php if ($i == $halamanAktif) : ?>
                                <li class="page-item active">
                                    <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php else : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endfor; ?>


                        <!-- Tombol Next -->
                        <?php if ($halamanAktif < $jumlahHalaman) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>

                <form class="mb-2" action="" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" placeholder="[judul][penulis][kategori]" autocomplete="off">
                        <button class="btn btn-primary" type="submit" name="tombol_search">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
            
            <table class="table table-striped table-hover bg-white">
                <tr>
                    <th>No.</th>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
                <?php $no=1 ?>
                <?php foreach($buku as $data): ?>
                <tr>
                    <td> <?= $no ?> </td>
                    <td> <?= $data['kode_buku'] ?> </td>
                    <td> <?= $data['judul'] ?> </td>
                    <td> <?= $data['deskripsi'] ?> </td>
                    <td> <?= $data['penulis'] ?> </td>
                    <td> <?= $data['tahun_terbit'] ?> </td>
                    <td> <?= $data['nama_kategori'] ?> </td>
                    <td> 
                        <img src="img/<?= $data['gambar'] ?> " height="70" width="70" alt="">
                    </td>
                    <td>
                        <a href="ubah_data_buku.php?id=<?= $data['id'] ?>">
                            <button class="btn-sm btn-success">Edit</button>
                        </a>
                        
                        <a href="hapus_data_buku.php?id=<?= $data['id'] ?>">
                            <button class="btn-sm btn-danger">Hapus</button>
                        </a>
                    </td>
                </tr>
                <?php $no++; ?>
                <?php endforeach; ?>
            </table>


        </div>
    </section>
<!-- CONTENT SECTION END -->
</body>
</html>