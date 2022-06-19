<?php
session_start();
include 'koneksi.php';
if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
}

    $query = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE id_admin = '".$_SESSION['id']."' ");
    $d = mysqli_fetch_object($query);
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
            <h1><a class="navbar-brand ms-5 " href="dashboard.php">Area Belanja</a></h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mt-2">
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="data-kategori.php">Data Kategori</a>
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
                <h4 class="mt-2">Profile</h4>
                <form method="POST">
                    <div class="mb-3 mt-3">
                        <label class="form-label" required>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $d->nama_admin?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $d->username?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label class="form-label">No. HP</label>
                        <input type="text" class="form-control" name="hp" value="<?php echo $d->telp_admin?>">
                    </div>
                    <div class="mb-3">
                        <label forclass="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $d->email_admin?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="<?php echo $d->alamat_admin?>">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </form>
                <?php
                    if(isset($_POST['submit'])){
                        $nama   = ucwords($_POST['nama']);
                        $username   = $_POST['username'];
                        $hp     = $_POST['hp'];
                        $email  = $_POST['email'];
                        $alamat = ucwords($_POST['alamat']);

                        $update = mysqli_query($koneksi, "UPDATE tb_admin SET 
                            nama_admin = '".$nama."', 
                            username = '".$username."',
                            telp_admin = '".$hp."',
                            email_admin = '".$email."',
                            alamat_admin = '".$alamat."'
                            WHERE id_admin = '".$d->id_admin."'");
                        if($update){
                            echo '<script>alert("Perubahan berhasil disimpan!")</script>';
                            echo '<script>window.location="profile.php"</script>';
                        }else{
                            echo 'gagal '.mysqli_error($koneksi);
                        }
                    }
                ?>
            </div>


            <!-- Ubah password -->
            <div class="col-md-6">
                <h4 class="mt-5">Ubah Password</h4>
                <form method="POST">
                    <div class="mb-3 mt-3">
                        <label class="form-label" required>Password</label>
                        <input type="password" class="form-control" name="pass1" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" name="pass2" required>
                    </div>
                    <button type="submit" name="ubah_pw" class="btn btn-primary">Simpan</button>
                </form>
                <?php
                    if(isset($_POST['ubah_pw'])){

                        $pass1   = $_POST['pass1'];
                        $pass2   = $_POST['pass2'];

                        if($pass2 != $pass1){
                            echo '<script>alert("Konfirmasi Password Baru Tidak Sesuai")</script>';
                        }else{
                            $u_pass = mysqli_query($koneksi, "UPDATE tb_admin SET 
                                password = '".MD5($pass1)."'
                                WHERE id_admin = '".$d->id_admin."'");
                            if($u_pass){
                                echo '<script>alert("Perubahan berhasil disimpan!")</script>';
                                echo '<script>window.location="profile.php"</script>';
                            }else{
                                echo 'gagal '.mysqli_error($koneksi);
                            }
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