<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style_.css">

    <title>Login</title>
  </head>
  <body id="bg-login">
    <div class="container">
        <div class="box">
            <div class="row contentForm">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <img src="online-shopping.png" alt="" class="img-fluid">
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6">
                  <h4 class="text-center">LOGIN</h4>
                  <form action="" method="POST">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Username</label>
                      <input placeholder="Masukkan username Anda" type="text" class="form-control" name="user">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input placeholder="Masukkan password Anda" type="password" class="form-control" name="pass"> 
                    </div>
                    <button type="submit" class="btn btn-warning w-100" name="submit">Login</button>
                  </form>
                </div>
                <?php
                  if(isset($_POST['submit'])){
                    session_start();
                    include 'koneksi.php';

                    $user = $_POST['user'];
                    $pass = $_POST['pass'];

                    $cek = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE username = '".$user."' AND password = '".MD5($pass)."'");
                    if(mysqli_num_rows($cek) > 0){
                      $d = mysqli_fetch_object($cek);
                      $_SESSION['status_login'] = true;
                      $_SESSION['a_global'] = $d;
                      $_SESSION['id'] = $d->id_admin;
                      echo '<script>window.location="dashboard.php"</script>';
                    }else{
                      echo '<script>alert("Username atau password Anda salah!")</script>';
                    }
                  }
                ?>
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