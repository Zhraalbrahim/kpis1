<?PHP 
require_once 'init.php';
include 'views/header.php';

if(isLoggedIn()){
  redirect(".");
}

$email = post('email');
$password = post('password');
$badge_number = post('badge_number');
$first_name = post('first_name');
$last_name = post('last_name');

$error = null;
?>



<?PHP

if (isset($_POST['doSubmit'])):


  if (!isEmailAvailable($email)) {
      $errors[] = "Email Exists !!!";
  }

     // Validate password strength
     $uppercase = preg_match('@[A-Z]@', $password);
     $lowercase = preg_match('@[a-z]@', $password);
     $number    = preg_match('@[0-9]@', $password);
     $specialChars = preg_match('@[^\w]@', $password);

     if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
         $errors[] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
     }



  if ($errors == NULL){
         /* Register User*/
         $sql = "INSERT INTO `users` (`email`, `password`, `badge_number`, `first_name`, `last_name`) VALUES ('$email', '$password', '$badge_number', '$first_name', '$last_name')";
        $lastId = dbInsert($sql);
  if ($lastId) :
    $_SESSION['logged_in'] = TRUE;
    $_SESSION['user_id'] = $lastId;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_type'] = 'user';
    dbUpdate("UPDATE `users` SET `lastlogin` = current_timestamp() WHERE `users`.`id` = '$lastId';");
    redirect("index.php");
  endif;
  }
endif;
    ?>
<!-- about section starts  -->


<div class="container">
<div class="row ">
    <div class="col-lg-4"></div>
    <div class="col-lg-4 mt-5 border rounded shadow-sm p-5 bg-white     ">

    <h2>Sign Up</h2>
    <hr>
    <p class="text-danger"><?=($errors)? $errors[0] : ''; ?></p>


    <form method = 'post'>
      <div class='mb-3'>
        <label for='email'>Email</label>
        <input type='email' class='form-control' id='email' name='email' value="<?=post('email')?>" placeholder='Enter email'>
      </div>
      <div class='mb-3'>
        <label for='password'>Password</label>
        <input type='password' class='form-control' id='password' name='password' placeholder='Password' required>
      </div>

      <div class='mb-3'>
        <label for='badge_number'>Badge Number</label>
        <input type='number' class='form-control' id='badge_number' name='badge_number' placeholder='Badge Number' required>
      </div>

      <div class='mb-3'>
        <label for='first_name'>First Name</label>
        <input type='text' class='form-control' id='first_name' name='first_name' placeholder='First Name'>
      </div>

      <div class='mb-3'>
        <label for='last_name'>Last Name</label>
        <input type='text' class='form-control' id='last_name' name='last_name' placeholder='Last Name'>
      </div>
      
      <button type='submit' class='btn btn-main mb-3' name='doSubmit'>Submit</button>
      <a href="signin.php" class='btn text-dark mb-3 float-end' >I`have account </a>
    </form>
  </div>
  </div>
    <div class="col-lg-8"></div>

   </div>
   
   </div>



  
<?PHP include 'views/footer.php'?>

