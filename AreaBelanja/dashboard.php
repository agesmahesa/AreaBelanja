<?php
    session_start();
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
    include 'koneksi.php';
    $kontak = mysqli_query($koneksi, "select telp_admin, email_admin, alamat_admin from tb_admin where id_admin = 1");
    $a = mysqli_fetch_object($kontak);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style2.css">

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
            <div class="card mt-2" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Selamat Datang <?php echo $_SESSION['a_global']->nama_admin ?></li>
                </ul>
            </div>
        </div>

              <!-- Search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div><br><br>

    <!-- category -->
    <div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box">
                <?php
                    $kategori = mysqli_query($koneksi, "select * from tb_kategori order by id_kategori desc");
                    if(mysqli_num_rows($kategori) > 0){
                        while($k = mysqli_fetch_array($kategori)){
                ?>
                    <a href="produk.php?kat=<?php echo $k['id_kategori'] ?>">
                        <div class="col-5">
                            <img src="list.png" width="50px" style="margin: bottom 5px;">
                            <p><?php echo $k['nama_kategori'] ?> </p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p>Kategori Tidak Ada</p>
                <?php } ?>
            </div>
        </div>
    </div><br><br><br>

    <!-- new product -->
    <div class="section">
        <div class="container">
            <h3>Produk Terbaru</h3>
            <div class="box">
                <?php
                    $produk = mysqli_query($koneksi, "select * from tb_produk where status_produk = 1 order by id_produk desc limit 8");
                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                ?>
                <a href="detail-produk.php?id=<?php echo $p['id_produk'] ?>"></a>
                    <div class="col-4">
                        <img src="produk/<?php echo $p['gambar_produk'] ?> ">
                        <p class="nama"><?php echo substr($p['nama_produk'], 0, 30) ?> </p>
                        <p class="harga">Rp. <?php echo number_format($p['harga_produk']) ?> </p>
                    </div>
                </a>
                <?php }}else{ ?>
                    <p>Produk Tidak Ada</p>
                <?php } ?>
            </div>
        </div>
    </div><br><br><br>

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

       <footer>
        <div class="container">
            <small>Copyright &copy; 2020 - TokoOnline</small>
        </div>
       </footer>
  





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