<?php

session_start();
if( !isset($_SESSION['login']) ){
  header("Location: login.php");
  exit;
}

require("function.php");

$query = query("SELECT * FROM kategori");
    $kategori = $query;

$query = query("SELECT * FROM kategori ORDER BY tanggal_input DESC");
    $kategori = $query;

    if(isset($_POST['tombol_search'])){
        $kategori = cari_kategori($_POST['keyword']);
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

            <h1>Halo, Selamat Datang <?= $_SESSION['username']; ?> 🤗</h1>

            <div class="d-flex justify-content-between align-items-center">
                <a href="tambah_data_kategori.php">
                    <button class="mb-2 btn-sm btn-primary">Tambah Data</button>
                </a>

                <form class="mb-2" action="" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" placeholder="[jenis kategori]" autocomplete="off">
                        <button class="btn btn-primary" type="submit" name="tombol_search">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
            
            <table class="table table-striped table-hover bg-white">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Input</th>
                    <th>Aksi</th>
                </tr>
                <?php $no=1 ?>
                <?php foreach($kategori as $data): ?>
                <tr>
                    <td> <?= $no ?> </td>
                    <td> <?= $data['nama_kategori'] ?> </td>
                    <td> <?= $data['deskripsi'] ?> </td>
                    <td> <?= $data['tanggal_input'] ?> </td>
                    <td>
                        <a href="ubah_data_kategori.php?id=<?= $data['id'] ?>">
                            <button class="btn-sm btn-success">Edit</button>
                        </a>
                        
                        <a href="hapus_data_kategori.php?id=<?= $data['id'] ?>">
                            <button class="btn-sm btn-danger disabled">Hapus</button>
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