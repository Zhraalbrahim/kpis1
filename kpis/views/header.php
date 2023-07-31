<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= SITE_NAME ?></title>

   <!-- font awesome cdn link  -->


   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">


   <link href="assets/css/bootstrap.min.css" rel="stylesheet">
   <link href="assets/fontawesome/css/all.min.css" rel="stylesheet">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="assets/css/style.css">

   <!-- custom js file link  -->
   <script src="assets/js/jquery.min.js"></script>

   <!-- datatables CSS & JS -->
   <link rel="stylesheet" href="assets/css/datatables.css" />
   <script src="assets/js/datatables.js"></script>

</head>

<body>

   <div class="row bg-white top-back">
      <div class="col-3 ">
        <a href="."> <img src="assets/img/logo.png" class="w-25 my-3 mx-3 rounded" /></a>
      </div>

      <div class="col-9">

         <div class="header float-end mx-2">

            <nav class="navbar">
               <a href="." class="<?=($page == 'kpis')? 'active': ''?>"><i class="fa fa-fw fa-home text-orange"></i> home</a>
               <?PHP if (isUser()) { ?>
                  <a href="kpis.php" class="<?=($page == 'kpis.php')? 'active': ''?>"><i class="fa fa-fw fa-list text-orange"></i> KPIs</a>
                  <a href="training.php" class="<?=($page == 'training.php')? 'active': ''?>"><i class="fa fa-fw fa-list text-orange"></i> Training</a>
                  <a href="consultation.php" class="<?=($page == 'consultation.php')? 'active': ''?>"><i class="fa fa-fw fa-list text-orange"></i> Consultation</a>
                  <a href="form.php" class="<?=($page == 'form.php')? 'active': ''?>"><i class="fa fa-fw fa-list text-orange"></i> Form</a>
               <?PHP } ?>
               <a href="about.php" class="<?=($page == 'about.php')? 'active': ''?>"><i class="fa fa-fw fa-info text-orange"></i> about</a>


               <?PHP if (isAdmin()) { ?>
                  <a href="kpis-manage.php" class="<?=($page == 'kpis-manage.php')? 'active': ''?>"><i class="fa fa-fw fa-list text-orange"></i> KPIs Manage</a>
                  <a href="Training-manage.php" class="<?=($page == 'Training-manage.php')? 'active': ''?>"><i class="fa fa-fw fa-list text-orange"></i> Training Manage</a>
                  <a href="consultations-manage.php?status=new" class="<?=($page == 'consultations-manage.php')? 'active': ''?>"><i class="fa fa-fw fa-list text-orange"></i> Consultations Manage</a>
                  <a href="forms-manage.php?status=new" class="<?=($page == 'forms-manage.php')? 'active': ''?>"><i class="fa fa-fw fa-list text-orange"></i> Forms</a>
                  <a href="users-manage.php" class="<?=($page == 'users-manage.php')? 'active': ''?>"><i class="fa fa-fw fa-users text-orange"></i> Users</a>
         
               <?PHP } ?>
               <?PHP if (isLoggedIn()) { ?>
               <a href="logout.php" class="<?=($page == 'logout.php')? 'active': ''?>"><i class="fa fa-fw fa-sign-out-alt text-orange"></i> Logout</a>
               <?PHP } else { ?>
                  <a href="Signin.php" class="<?=($page == 'Signin.php')? 'active': ''?>"><i class="fa fa-fw fa-sign-in-alt text-orange"></i> Login</a>
                  <?PHP } ?>
            </nav>




            <div id="menu-btn" class="fas fa-bars d-lg-none d-md-none "></div>

         </div>

      </div>
      <div class="row header-bar">

      </div>




   </div>




   <link rel="stylesheet" href="assets/js/script.js">

   <!-- header section starts     -->


   <div class="container my-3">
      <?= printMSG(2000); ?>
   </div>