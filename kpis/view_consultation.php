<?PHP 
require_once 'init.php';
include 'views/header.php';

loginVerification();

$consultation = getConsultationById($id);
if(!$consultation){
   redirect(".");
}
?>

<!-- consultation section starts  -->
<div class="container">
   <h3 class="title"><a class="text-main" href="consultations-manage.php">Consultations</a></h3>
   <div class="text-dark ">

   <h4 class="text-dark">Counseling information</h4>
   <form method="post">
      <div class=" rounded border p-3 shadow-sm">


         <div class="mb-3 col-4">
            <h3>Cutomer Name : <small><?= $consultation['email'] ?></small></h3>
         </div>


         <div class="mb-3 col-4">
            <h3>Date : <small><?= $consultation['consultation_date'] ?></small></h3>
         </div>

         <div class="mb-3 col-4">
            <h3>Time : <small><?= $consultation['consultation_time'] ?></small></h3>
         </div>

         <div class="mb-3 col-4">
            <h3>status : <small><?= $consultation['status'] ?></small></h3>
         </div>


         <div class="mb-3 col-12">
            <h3>Notes :</h3>
            <p><?= $consultation['consultation_notes'] ?></p>
         </div>
         <div>
         </div>


   </form>

   </div>
</div>

 


<?PHP include 'views/footer.php' ?>