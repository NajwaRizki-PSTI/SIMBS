<?php 

session_start();
if( !isset($_SESSION['login']) ){
  header("Location: login.php");
  exit;
}

    require("function.php");

$id = $_GET['id'];

$query = query("SELECT * FROM buku WHERE id = $id")[0];
$buku = $query;

$query = query("SELECT * FROM kategori");
$kategori = $query;

    if(isset($_POST['tombol_submit'])){
        if(ubah_data_buku($_POST) > 0){
            echo "
                <script>
                    alert('Data berhasil ditambahkan ke database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal ditambahkan ke database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
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

    <!-- NAVBAR SECTION START  -->
    <nav class="navbar navbar-expand-lg navbar-light white bg-primary">
        <div class="container">
            <a class="navbar-brand text-white" href="#">SIMBS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="index.php">Data Buku</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="data_kategori.php">Data Kategori</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white" href="logout.php">logout</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <!-- NAVBAR SECTION END  -->
   
    <div class="p-4 container">
        <div class="row">
            <h1 class="mb-2">Ubah Data Buku</h1>
            <a href="index.php" class="mb-2">Kembali</a>
            <div class="col-md-6">
                <form action="" method="POST" enctype="multipart/form-data">
                <!-- <form action="" method="POST"> -->
                    <input type="hidden" class="form-control" name="id" id="id" value="<?= $buku['id'] ?>" autocomplete="off">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kode Buku</label>
                        <input type="text" class="form-control" name="kode_buku" id="kode_buku"  value="<?= $buku['kode_buku']; ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul" value="<?= $buku['judul']; ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3" id="deskripsi" value="<?= $buku['deskripsi']; ?>"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Penulis</label>
                        <input type="text" class="form-control" name="penulis" id="penulis" value="<?= $buku['penulis']; ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tahun Terbit</label>
                        <input type="text" class="form-control" name="tahun_terbit" id="tahun_terbit" value="<?= $buku['tahun_terbit']; ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <select name="id_kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori as $k): ?>
                                <option value="<?= $k['id']; ?>"><?= $k['nama_kategori']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Gambar</label>
                        <input type="hidden" name="gambarLama" value="<?= $buku['gambar']; ?>">
                        <input type="file" class="form-control" name="gambar" id="gambar" value="<?= $buku['gambar']; ?>">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="tombol_submit" class="btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>