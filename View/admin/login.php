<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo $BASE_URL; ?>/assets/font-awesome-4.7.0/css/font-awesome.css">
    <title>Laporan</title>
</head>

<body>
    <div class="d-flex justify-content-center">
        <div class="card w-75 mt-5">
            <div class="card-body">
                <?php if (isset($_SESSION['statusLogin']) == 'gagal') : ?>
                    <div class="alert alert-danger text-center">
                        !! Login Gagal !!
                    </div>
                <?php session_destroy();
                endif; ?>
                <form action="index.php?view=admin&page=auth&aksi=login" method="post">
                    <div class="form-group">
                        <label for="Username">Masukkan Username</label>
                        <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="Password">Masukkan Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" id="btnMasuk">Masuk</button>
                </form>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <script src="<?php echo $BASE_URL; ?>/assets/js/jquery-3.6.0.min.js"></script>
        <script src="<?php echo $BASE_URL; ?>/assets/js/script.js"></script>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
</body>

</html>