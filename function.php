<?php

$conn = mysqli_connect("localhost", "root", "", "simbs");

function query($query){
    global $conn;

	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah_data_buku($data){
    global $conn;

    $kode_buku = $data['kode_buku'];
    $judul = $data['judul'];
    $deskripsi = $data['deskripsi'];
    $penulis = $data['penulis'];
    $tahun_terbit = $data['tahun_terbit'];
    $gambar = $data['gambar'];
    $id_kategori = $data['id_kategori'];

    $gambar = upload_gambar($kode_buku, $judul);
    if( !$gambar){
        return false;
    }

    $query = "INSERT INTO buku (kode_buku, judul, deskripsi, penulis, tahun_terbit, id_kategori, gambar)
                  VALUES ('$kode_buku', '$judul', '$deskripsi', '$penulis', '$tahun_terbit', '$id_kategori', '$gambar')
                 ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);    
}

function tambah_data_kategori($data){
    global $conn;

    $nama_kategori = $data['nama_kategori'];
    $deskripsi = $data['deskripsi'];

    $query = "INSERT INTO kategori (nama_kategori, deskripsi)
                  VALUES ('$nama_kategori', '$deskripsi')
                 ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);    
}

function hapus_data_buku($id){
    global $conn;

    $query = "DELETE FROM buku WHERE id = $id";

    $result = mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);    
}

function hapus_data_kategori($id){
    global $conn;

    $query = "DELETE FROM kategori WHERE id = $id";

    $result = mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);    
}

function ubah_data_buku($data){
    global $conn;

    $id = $data['id'];
    $kode_buku = $data['kode_buku'];
    $judul = $data['judul'];
    $deskripsi = $data['deskripsi'];
    $penulis = $data['penulis'];
    $tahun_terbit = $data['tahun_terbit'];
    // $gambar = $data['gambar'];
    $id_kategori = $data['id_kategori'];

    $gambarLama = $data['gambarLama'];

    if( $_FILES['gambar']['error'] === 4 ){
        $gambar = $gambarLama;
    }else{
        // upload gambar baru
        $gambar = upload_gambar($kode_buku, $judul);
        if(!$gambar){
            return false;
        }

        // hapus gambar lama
        if(file_exists('img/' . $gambarLama)){
            unlink('img/' . $gambarLama);
        }
    }


    $query = "UPDATE buku SET
                kode_buku = '$kode_buku',
                judul = '$judul',
                deskripsi = '$deskripsi',
                penulis = '$penulis',
                tahun_terbit = '$tahun_terbit',
                gambar = '$gambar',
                id_kategori = '$id_kategori'
              WHERE id = $id
             ";

    //  $result = 
     mysqli_query($conn, $query);
     
     return mysqli_affected_rows($conn); 
}

function ubah_data_kategori($data){
    global $conn;

    $id = $data['id'];
    $nama_kategori = $data['nama_kategori'];
    $deskripsi = $data['deskripsi'];

    $query = "UPDATE mahasiswa SET
                nama_kategori = '$nama_kategori',
                deskripsi = '$deskripsi',
              WHERE id = $id
             ";

     $result = mysqli_query($conn, $query);
     
     return mysqli_affected_rows($conn); 
}

function cari_buku($keyword){
    global $conn;

    $query = "SELECT * FROM buku
			  WHERE
			  judul LIKE '%$keyword%' OR
              penulis LIKE '%$keyword%' OR
              kategori LIKE '%$keyword%' 
			";
	return query($query);
}

function cari_kategori($keyword){
    global $conn;

    $query = "SELECT * FROM kategori
			  WHERE
              nama_kategori LIKE '%$keyword%' 
			";
	return query($query);
}

function upload_gambar($kode_buku, $judul) {

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }

    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    // $ekstensiGambar = explode('.', $namaFile);
    // $ekstensiGambar = strtolower(end($ekstensiGambar));
    $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    if( !in_array($ekstensiGambar, $ekstensiValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
              </script>";
        return false;
    }

    if( $ukuranFile > 2000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
              </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = $kode_buku . "_" .preg_replace('/\s+/', '_', $judul) . "_" . uniqid();
    $namaFileBaru .= '.' . $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);


    return $namaFileBaru;
}

// function register($data_register){
//     global $conn;

//     $username = $data_register['username'];
//     $email = $data_register['email'];
//     $password = mysqli_real_escape_string($conn, $data_register['password']);
//     $confirm_password = mysqli_real_escape_string($conn, $data_register['confirm_password']);

//     $query = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

//     $result = mysqli_fetch_assoc($query);

//     if($result != NULL){
//         return "Username sudah terdaftar di database!";
//     }

//     // strlen

//     if($password !== $confirm_password){
//         return "Konfirmasi password tidak sesuai!";
//     }

//     $password = password_hash($password, PASSWORD_DEFAULT);

//     mysqli_query($conn, "INSERT INTO user (id, username, email, password) VALUES('', '$username', '$email', '$password')");
   
//     return true;
// }

// REGISTER
function register($data_register){
    global $conn;

   // tampung data
    $username = $data_register['username'];
    $email    = $data_register['email'];
    $password = mysqli_real_escape_string($conn, $data_register['password']);

    // cek username sudah ada atau belum
    $query  = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $query);

    // jika ada user dengan username atau email tersebut
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);

        // cek username duplikat
        if($row['username'] == $username){
            return "Username sudah terdaftar!";
        }
        // cek email duplikat
        if($row['email'] == $email){
            return "Email sudah terdaftar. Gunakan email lain!";
        }
    }

    // cek panjang password
    if(strlen($password) < 8){
        return "Password harus lebih atau sama dengan 8!";
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO user (id, username, email, password) VALUES('', '$username', '$email', '$password')");

    return true;
}

function login($data){
    global $conn;


    $username = $data['username'];
    $password = $data['password'];


    // cek username sudah ada atau belum
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);


    // var_dump($result);
    // die;


     // Cek user ada atau tidak
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);


        // var_dump($row);
        // die;


        // Verify password
        if(password_verify($password, $row["password"])) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            // echo "masuk sini";
            return true;
        } else {
            // echo "tidak masuk";
            return "Password salah!";
        }


    } else {
        return "Username tidak ditemukan!"; // username tidak ditemukan
    }
   
}
?>