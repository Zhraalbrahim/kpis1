<?PHP
require_once 'init.php';
include 'views/header.php';
loginVerification();

if($status && $id){
$sql = "UPDATE `consultation` SET `status` = '$status' WHERE `consultation`.`consultation_id` = '$id';";

if(dbUpdate($sql)){
   redirect("consultations-manage.php");
}

}
$where = "1";
$where .= ($status) ? "  AND consultation.status = '$status' " : '';

$consultations = getConsultations($where);

?>

<!-- about section starts  -->


<div class="container">
   <h3 class="title">Consultation Manage

      <div class="btn-group float-end">

         <a href="consultations-manage.php" class="btn btn-light border text-main <?= (!$status) ? 'bg-light' : '' ?>"><i class="fa fa-fw fa-list"></i> All</a>
         <a href="consultations-manage.php?status=new" class="btn btn-light border text-main <?= ($status == 'new') ? 'bg-light' : '' ?>"><i class="fa fa-fw fa-folder"></i> New</a>
         <a href="consultations-manage.php?status=accepted" class="btn btn-light border text-main <?= ($status == 'accepted') ? 'bg-light' : '' ?>"><i class="fa fa-fw fa-check"></i> Accepted</a>
         <a href="consultations-manage.php?status=rejected" class="btn btn-light border text-main <?= ($status == 'rejected') ? 'bg-light' : '' ?>"><i class="fa fa-fw fa-times"></i> Rejected</a>
         <a href="consultations-manage.php?status=completed" class="btn btn-light border text-main <?= ($status == 'completed') ? 'bg-light' : '' ?>"><i class="fa fa-fw fa-thumbs-up"></i> Completed </a>
      </div>

   </h3>


   <div class="bg-white border shadow-sm p-4 ">
      <table class="table table-hover" id="kpis-table">
         <thead>
            <tr class="text-main">
               <th width="50">#</th>
               <th>User</th>
               <th>Consultation Date</th>
               <th>Consultation Time</th>
               <th>Consultation Notes</th>
               <th>Status</th>
            </tr>
         </thead>
         <tbody>
            <?PHP
            if ($consultations) :
               $i = 0;
               foreach ($consultations as $consultation) {
                  $i++; ?>
                  <tr>
                     <td>
                        <?= $consultation['consultation_id'] ?>
                     </td>
                     <td>
                        <a href="view_consultation.php?id=<?= $consultation['consultation_id'] ?>" class="text-main fw-bolder"><?= $consultation['email'] ?></a>
                     </td>
                     <td><?= $consultation['consultation_date'] ?></td>
                     <td><?= $consultation['consultation_time'] ?></td>
                     <td><?= $consultation['consultation_notes'] ?></td>

                     <td>
                     <div class="row">
                        <?PHP if ($consultation['status'] == 'new') { ?>
                        
                           <div class="col-6">
                           <a href="consultations-manage.php?status=rejected&id=<?= $consultation['consultation_id'] ?>" class="btn btn-light border w-100"><?= getStatusIcon('rejected', true) ?></a>
                           </div>

                              <div class="col-6">
                           <a href="consultations-manage.php?status=accepted&id=<?= $consultation['consultation_id'] ?>" class="btn btn-light border w-100"><?= getStatusIcon('accepted', true) ?></a>
                           </div>
                        
                        
                           <?PHP }else if ($consultation['status'] == 'accepted') { ?>
                              <div class="col-12">
                           <a href="consultations-manage.php?status=completed&id=<?= $consultation['consultation_id'] ?>" class="btn btn-light border w-100"><?= getStatusIcon('completed', true) ?></a>
                              </div>
                        <?PHP } else { ?>
                           <div class="col-12">
                           <?= getStatusIcon($consultation['status'], true) ?>
                           </div>
                        <?PHP } ?>
                        </div>
                     </td>

                  </tr>
            <?PHP }
            endif; ?>

         </tbody>
      </table>
   </div>
</div>

<script>
   $(document).ready(function() {
      /* مطابقة الآيدي مع الجدول آي دي */
      $('#kpis-table').DataTable();
   });
</script>
<?PHP include 'views/footer.php' ?>