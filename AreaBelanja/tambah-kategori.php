<?php
session_start();
    include 'koneksi.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Area Belanja</title>
  </head>
  <body>
  
      <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <h1><a class="navbar-brand ms-5 " href="#">Area Belanja</a></h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mt-2">
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="kategori.php">Data Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="data_produk.php">Data Produk</a>
                    </li>
                    <li class="nav-item me-5">
                        <a class="nav-link active text-light" aria-current="page" href="keluar.php">Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
       </nav>

       <!-- Content -->
        <div class="container">
            <div class="col-md-6">
                <h4 class="mt-2">Tambah Data Kategori</h4>
                <form method="POST">
                    <div class="mb-3 mt-3">
                        <label class="form-label" required>Nama Kategori</label>
                        <input type="text" class="form-control" name="nama" >
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </form>
                <?php
                    if(isset($_POST['submit'])){
                        $nama = ucwords($_POST['nama']);
                        $insert = mysqli_query($koneksi, "INSERT INTO tb_kategori VALUES (null, '".$nama."' )");
                            if($insert){
                                echo '<script>alert("Data berhasil ditambahkan")</script>';
                                echo '<script>window.location="kategori.php"</script>';
                            }else{
                                echo 'Data gagal ditambahkan' .mysqli_error($koneksi);
                            }
                    }
                ?>
            </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>