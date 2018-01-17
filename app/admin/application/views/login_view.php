<?php
  $cursor = null;

  if(isset($_POST['buscar'])){  
    $m = new MongoClient("mongodb://heroku_m4b97brj:5rm1ub4c09s4dhn8m266i34669@ds141108.mlab.com:41108/heroku_m4b97brj");
    $db = $m->selectDB('heroku_m4b97brj');
    $collection = new MongoCollection($db, 'personal');

    $cursor = $collection->find(['$text' => ['$search' => '/'.$_POST['buscar'].'/']]);
  }
?>
<!DOCTYPE html>
<html lang="es-MX">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Directorio Telefónico del IPN</title>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">

    <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style type="text/css">
      .form-signin
      {
          max-width: 330px;
          padding: 15px;
          margin: 0 auto;
      }
      .form-signin .form-signin-heading, .form-signin .checkbox
      {
          margin-bottom: 10px;
      }
      .form-signin .checkbox
      {
          font-weight: normal;
      }
      .form-signin .form-control
      {
          position: relative;
          font-size: 16px;
          height: auto;
          padding: 10px;
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
          box-sizing: border-box;
      }
      .form-signin .form-control:focus
      {
          z-index: 2;
      }
      .form-signin input[type="text"]
      {
          margin-bottom: -1px;
          border-bottom-left-radius: 0;
          border-bottom-right-radius: 0;
      }
      .form-signin input[type="password"]
      {
          margin-bottom: 10px;
          border-top-left-radius: 0;
          border-top-right-radius: 0;
      }
      .account-wall
      {
        background-color: #f7f7f7;
        box-shadow: 0 5px 7px rgba(0, 0, 0, 0.3);
        margin-top: 20px;
        padding: 0px 0 24px;
      }
      .login-title
      {
          color: #555;
          font-size: 18px;
          font-weight: 400;
          display: block;
      }
      .profile-img
      {
          width: 96px;
          height: 96px;
          margin: 0 auto 10px;
          display: block;
          -moz-border-radius: 50%;
          -webkit-border-radius: 50%;
          border-radius: 50%;
      }
      .need-help
      {
          margin-top: 10px;
      }
      .new-account
      {
          display: block;
          margin-top: 10px;
      }
    </style>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <div class="account-wall" style="border-top: 7px solid #510635">
                    <img src="<?php echo base_url('assets/logo_buscador.png'); ?>">
                    
                    <img class="profile-img" src="<?php echo base_url('assets/usuario.png'); ?>"
                        alt="">


                    <?php echo validation_errors(); ?>
                    <?php echo form_open('verifylogin', 'class="form-signin"'); ?>
                      <input type="text" class="form-control" placeholder="Usuario" id="username" name="username" required autofocus>
                      <input type="password" class="form-control" id="passowrd" name="password" placeholder="Password" required>
                      <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
                    <!---
                    <label class="checkbox pull-left">
                        <input type="checkbox" value="remember-me">
                        Remember me
                    </label>
                    <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                    -->
                    </form>
                </div>
                <!--- <a href="#" class="text-center new-account">Create an account </a> -->
            </div>
        </div>
    </div>
  </body>
</html>