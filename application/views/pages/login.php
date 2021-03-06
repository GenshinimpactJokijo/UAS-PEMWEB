<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  echo $js;
  echo $css;
  ?>

  <style>
    body {
      background-image: url(https://www.teahub.io/photos/full/35-352663_wallpaper-leaves-green-plant-aesthetic-nature-background-green.jpg);
      background-size: cover;
    }
  </style>
  <title>Login to an Account</title>
</head>

<body>
  <div class="container d-flex justify-content-sm-center position-absolute top-50 start-50 translate-middle">
    <div class="card box bg-light bg-opacity-75" style="width: 28rem; padding: 0 2%;" data-aos="zoom-in">
      <div class="card-body">
        <?php echo form_open('Home/Login'); ?>
          <h2 class="card-title text-center mb-3"><b>Welcome Back!</b></h2>
          <div class="mb-3">
            <input type="Email" class="form-control" id="Email" name="Email" placeholder="E-mail">
          </div>
          <div class="mb-3">
            <input type="Password" name="Password" class="form-control" id="Password" placeholder="Password">
          </div>
          <?php
          if (isset($_SESSION['gagalLogin'])) {
            echo "<p style='color:red; margin-left:10%'>{$_SESSION['gagalLogin']}</p>";
            session_unset();
            session_destroy();
          }
          ?>
          <div class="d-grid gap-2">
            <button type="submit" name="submit" class="btn btn-dark btn-outline-light">Login</button>
            <a class="btn btn-secondary btn-outline-light" href="<?php echo base_url("index.php/Home"); ?>">Back</a>
            <div class="mt-1 d-flex justify-content-center">
              <span>Belum memiliki akun? Silahkan <a href="<?php echo base_url("index.php/Home/Register"); ?>">Register</a></span>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>