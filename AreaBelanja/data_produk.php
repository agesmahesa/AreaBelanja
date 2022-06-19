<?php
session_start();
    include 'koneksi.php';
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
       <div class="section">
        <div class="container">
                <h4 class="mt-2">Data Produk</h4>
                <div class="box">
                    <p><a href="tambah-produk.php">Tambah Data </a></p>
                    <table border="1" cellspacing="0" class="table">
                        <thead>
                            <tr>
                                <th width="60px">No</th>
                                <th>Kategori</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Status</th>
                                <th width="150px">Aksi</th>
                            </tr>
                        </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $data_produk = mysqli_query($koneksi, "SELECT * FROM tb_produk LEFT JOIN tb_kategori USING (id_kategori)ORDER BY id_produk desc");
                            if(mysqli_num_rows($data_produk)){
                            while($row = mysqli_fetch_array($data_produk)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['nama_kategori']?></td>
                            <td><?php echo $row['nama_produk']?></td>
                            <td>Rp. <?php echo number_format($row['harga_produk'])?></td>
                            <td><?php echo $row['deskripsi_produk']?></td>
                            <td> <a href="produk/<?php echo $row['gambar_produk']?>" target="_blank"><img src="produk/<?php echo $row['gambar_produk']?>" width="50px" ></a></td>
                            <td><?php echo ($row['status_produk']==0)? 'Tidak Tersedia':'Tersedia'; ?></td>
                            <td>
                                <a href="edit-produk.php?id=<?php echo $row['id_produk'] ?>">Edit</a> || <a href="proses-hapus.php?idp=<?php echo $row['id_produk'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php }}else{ ?>
                            <tr>
                                <td colspan="8">Tidak ada data</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>
        </div>
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