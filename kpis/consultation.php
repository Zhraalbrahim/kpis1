<?PHP 
require_once 'init.php';
include 'views/header.php';


if(!isLoggedIn()){
   redirect(".");
}

$user = getUserById($user_id);
$consultation_date = post('consultation_date');
$consultation_time = post('consultation_time');
$consultation_notes = post('consultation_notes');
//show($consultations);
?>

<!-- about section starts  -->

<div class="container" >


   <?PHP if(!$action){
   $where = "`consultation`.`user_id` = '$user_id'";
   $where .= ($status)? "  AND consultation.status = '$status' " : '';
   
   $consultations = getConsultations($where);

   ?>
   <h3 class="title">Consultation List
  
   <div class="btn-group float-end" >
         <a href="consultation.php?action=add" class="btn btn-main"><i class="fa fa-fw fa-plus "></i> Add New Consultation</a>
         <a href="consultation.php" class="btn btn-light border text-main <?=(!$status)? 'bg-light' :''?>"><i class="fa fa-fw fa-list"></i> All</a>
         <a href="consultation.php?status=new" class="btn btn-light border text-main <?=($status == 'new')? 'bg-light' :''?>"><i class="fa fa-fw fa-folder"></i> New</a>
         <a href="consultation.php?status=accepted" class="btn btn-light border text-main <?=($status == 'accepted')? 'bg-light' :''?>"><i class="fa fa-fw fa-check"></i> Accepted</a>
         <a href="consultation.php?status=rejected" class="btn btn-light border text-main <?=($status == 'rejected')? 'bg-light' :''?>"><i class="fa fa-fw fa-times"></i> Rejected</a>
         <a href="consultation.php?status=completed" class="btn btn-light border text-main <?=($status == 'completed')? 'bg-light' :''?>"><i class="fa fa-fw fa-thumbs-up"></i> Completed </a>
      </div>

   </h3>

   <div class="rounded border p-3 shadow-sm bg-white">
<table class="table table-hover">
   <thead>
      <tr>
         <th width="25">#</th>
         <th width="150">Date</th>
         <th width="150">Time</th>
         <th>Notes</th>
         <th width="150">status</th>
      </tr>
   </thead>
   <?PHP 
      if($consultations){
      ?>
   <tbody>
      <?PHP foreach($consultations as $consultation){?>
      <tr>
         <td>
            <?=$consultation['consultation_id']?>
         </td>

         <td>
            <?=$consultation['consultation_date']?>
         </td>
         <td>
            <?=$consultation['consultation_time']?>
         </td>
         <td>
            <?=$consultation['consultation_notes']?>
         </td>
         <td>
         <?=getStatusIcon($consultation['status'], true)?>
       
         </td>
      </tr>
      <?PHP }?>
   </tbody>
   <?PHP }else{?>
      <tfoot>
         <tr>
            <td colspan="10" class="text-center">No Consultations</td>
         </tr>
      </tfoot>
   <?PHP }?>
</table>


<?PHP }else if($action == 'add'){

if(isset($_POST['insert'])){
   dbInsert("INSERT INTO `consultation` (`user_id`, `consultation_date`, `consultation_time`, `consultation_notes`) VALUES ('$user_id', '$consultation_date', '$consultation_time', '$consultation_notes')");
   redirect("consultation.php");
}
?>
<h1>Add Consultation</h1>
<form method="post">
   <div class="row rounded border p-3 shadow-sm">
   

      <div class="mb-3 col-3">
         <span>FullName :</span>
         <input type="email"  class="form-control form-control-lg"  placeholder="FullName" value="<?=$user['fullName']?>" readonly >
      </div>

      <div class="mb-3 col-3">
         <span>Email :</span>
         <input type="email"  class="form-control form-control-lg"  placeholder="Email" value="<?=$user['email']?>" readonly >
      </div>


      <div class="mb-3 col-2">
         <span>Date :</span>
         <input type="date" name="consultation_date" class="form-control form-control-lg" required placeholder="<?=date('Y-m-d')?>" maxlength="20" min="<?=date('Y-m-d')?>" value="<?=$consultation_date?>">
      </div>

      <div class="mb-3 col-2">
         <span>Time :</span>
         <input type="time" name="consultation_time" class="form-control form-control-lg" required placeholder="<?=date('H:i')?>" maxlength="20" value="<?=$consultation_time?>">
      </div>

      <div class="mb-3 col-1">
         <span>&nbsp;</span>
         <input type="reset" value="Reset" class="btn btn-dark w-100">
      </div>


      <div class="mb-3 col-1">
         <span>&nbsp;</span>
         <input type="submit" value="submit" class="btn btn-main w-100" name="insert">
      </div>


   
      <div class="mb-3">
         <span>Notes :</span>
         <textarea rows="10" name="consultation_notes" class="form-control form-control-lg w-100"></textarea>
      </div>

     
      <div>


      </div>

   
</form>
<?PHP }?>


   </div>
</section>
<script> 
$(document).ready( function () {
   /* مطابقة الآيدي مع الجدول آي دي */
    $('#kpis-table').DataTable();
} );
</script>
<?PHP include 'views/footer.php'?>