<?php
session_start();
    include 'koneksi.php';
    $produk = mysqli_query($koneksi, "SELECT * FROM tb_produk WHERE id_produk = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($produk);

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
    <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
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
            <div class="col-md-6">
                <h4 class="mt-2">Edit Data Produk</h4>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3 mt-3">
                        <select class="form-control" name="kategori" required>
                            <option value="">--Pilih--</option>
                            <?php
                                $kategori = mysqli_query ($koneksi, "SELECT * FROM tb_kategori ORDER BY id_kategori DESC");
                                while($r = mysqli_fetch_array($kategori)){
                            ?>
                            <option value="<?php echo $r['id_kategori']?>" <?php echo($r['id_kategori'] == $p->id_kategori)? 'selected' : '';?>><?php echo $r['nama_kategori'] ?></option>
                        <?php } ?>
                        </select>
                        <br>

                        <input type="text" name="nama" class="form-control" placeholder="Nama Produk" value="<?php echo $p->nama_produk?>" required><br>
                        <input type="text" name="harga" class="form-control" placeholder="Harga" value="<?php echo $p->harga_produk?>" required><br>

                        <img src="produk/<?php echo $p->gambar_produk ?>" width=100px>
                        <input type="hidden" name="foto" value="<?php echo $p->gambar_produk ?>">
                        <input type="file" name="gambar" class="form-control" ><br>
                        <textarea class="form-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->deskripsi_produk?></textarea><br>
                        <select class="form-control" name="status">
                            <option value="">--Pilih--</option>
                            <option value="1" <?php echo ($p->status_produk == 1)? 'selected' :'';?>>Aktif</option>
                            <option value="0"<?php echo ($p->status_produk == 0 )? 'selected' :'';?>>Tidak Aktif</option>
                        </select>

                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </form>
                <?php
                    if(isset($_POST['submit'])){
                        // menampung data inputan dari form
                        $kategori = $_POST['kategori'];
                        $nama = $_POST['nama'];
                        $harga= $_POST['harga'];
                        $deskripsi = $_POST['deskripsi'];
                        $status = $_POST['status'];
                        $foto = $_POST['foto'];

                        // data gambar yang baru
                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

                        // jika admin ganti gambar
                        if($filename != ''){
                            $type1 = explode('.', $filename);

                            $type2 = $type1[1];

                            $newname = 'produk' .time(). '.'.$type2;

                            //menampung data format file yang diizinkan
                            $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');
                            
                            //validasi format file
                            if(!in_array($type2, $tipe_diizinkan)){
                                // jika format file tidak ada di dalam tipe diizinkan
                                echo '<script>alert("Format file tidak diizinkan")</script>';
                            }else{
                                unlink('./produk/'.$foto);
                                move_uploaded_file($tmp_name, './produk/'.$newname);
                                $namagambar = $newname;
                            }

                        }else{
                            // jika admin tidak ganti gambar
                            $namagambar = $foto;

                        }
                        // query update data produk
                        $update = mysqli_query($koneksi, "UPDATE tb_produk SET
                            id_kategori = '".$kategori."',
                            nama_produk = '".$nama."',
                            harga_produk = '".$harga."',
                            deskripsi_produk = '".$deskripsi."',
                            gambar_produk = '".$namagambar."',
                            status_produk = '".$status."'
                            WHERE id_produk = '".$p->id_produk."' ");

                        if($update){
                            echo '<script>alert("Data berhasil diubah")</script>';
                            echo '<script>window.location="data_produk.php"</script>';
                        }else{
                            echo 'Gagal ' .mysqli_error($koneksi);
                        }
                        
                    }
                ?>
            </div>
        </div>
        </div>

       <script>
             CKEDITOR.replace('deskripsi');
        </script>

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