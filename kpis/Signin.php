<?PHP 
require_once 'init.php';
include 'views/header.php';

if(isLoggedIn()){
  redirect(".");
}
$email = post('email');
$password = post('password');
$error = null;
?>



<?PHP
    if (isset($_POST['signin'])) {

        $admin = getRow("SELECT * FROM `admin` WHERE `email` = '$email' AND password = '$password' ");
        $user = getRow("SELECT * FROM `users` WHERE `email` = '$email' AND password = '$password' ");
        
        if ($admin){
                $_SESSION['logged_in'] = TRUE;
                $_SESSION['user_id'] = $admin['id'];
                $_SESSION['user_email'] = $admin['email'];
                $_SESSION['user_type'] = 'admin';
              }else{ if ($user){
                  $_SESSION['logged_in'] = TRUE;
                  $_SESSION['user_id'] = $user['id'];
                  $_SESSION['user_email'] = $user['email'];
                  $_SESSION['user_type'] = 'user';

                  dbUpdate("UPDATE `users` SET `lastlogin` = current_timestamp() WHERE `users`.`id` = '".$user['id']."';");
          }else{
            $error = "<div class=\"alert alert-warning\"><i class='fa fa-tims'></i> <strong>Login error</strong> incorrect password</div>";

        }

      }

        if (isLoggedIn()) {
            redirect("index.php");
        }
    }
    ?>
<!-- about section starts  -->


<div class="container">
<div class="row ">
    <div class="col-lg-4"></div>
    <div class="col-lg-4 mt-5 border rounded shadow-sm p-5 bg-white     ">

    <h2>Sign in</h2>
    <hr>
    <p class="text-danger"><?=($error)? $error : ''; ?></p>
    <form method = 'post'>
      <div class='mb-3'>
        <label for='email'>Email</label>
        <input type='email' class='form-control' id='email' name='email' value="<?=post('email')?>" placeholder='Enter email'>
      </div>
      <div class='mb-3'>
        <label for='password'>Password</label>
        <input type='password' class='form-control' id='password' name='password' placeholder='Password'>
      </div>
      <button type='submit' class='btn btn-main mb-3' name='signin'>Sign In</button>
      <a href="signup.php" class='btn text-dark mb-3 float-end' name='signin'>Sign Up</a>
    </form>
  </div>
  </div>
    <div class="col-lg-8"></div>

   </div>
   
   </div>



  
<?PHP include 'views/footer.php'?>

