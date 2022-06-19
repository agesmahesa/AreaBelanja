<?php
error_reporting(0);
// session_start();
// include 'db.php';
// if($_SESSION['status_login'] != true){
//     echo '<script>window.location="login.php"</script>';
// }
include 'koneksi.php';
$kontak = mysqli_query($koneksi, "select telp_admin, email_admin, alamat_admin from tb_admin where id_admin = 1");
$a = mysqli_fetch_object($kontak);

$produk = mysqli_query($koneksi, "select * from tb_produk where id_produk = '".$_GET['id']."' ");
$p = mysqli_fetch_object($produk)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style2.css" >
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
                    <li class="navbar-nav">
                        <b><a class="nav-link active text-light me-5" aria-current="page" href="index.php">Beranda</a></b>
                        <b><a class="nav-link active text-light me-5" href="login.php">ADMIN</a></b>
                    </li>
                </ul>
            </div>
        </div>
       </nav>

    <!-- Search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?> ">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?> ">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>

    <!-- product detail -->
    <div class="section">
        <div class="container">
            <h3>Detail Produk</h3>
            <div class="box">
                <div class="col-2">
                    <img src="produk/<?php echo $p->gambar_produk ?>" width="100%">
                </div>
                <div class="col-2">
                    <h3><?php echo $p->nama_produk ?></h3>
                    <h4>Rp. <?php echo number_format($p->harga_produk) ?></h4>
                    <p>Deskripsi : <br>
                        <?php echo $p->deskripsi_produk ?>
                    </p>
                    <p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->telp_admin ?>&text=Hai, saya tertarik dengan Produk Anda" target="_blank">Hubungin Via Whatsapp
                    <img src="img/wa.png" width="50px"></a>   <!-- ini blm ada gambar -->
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p><?php echo $a->alamat_admin ?></p>

            <h4>Email</h4>
            <p><?php echo $a->email_admin ?></p>

            <h4>No. Hp</h4>
            <p><?php echo $a->telp_admin ?></p>
            <small>Copyright &copy; 2020 - Unila.</small>
        </div>
    </div>
</body>
</html>