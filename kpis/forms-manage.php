<?PHP
require_once 'init.php';
include 'views/header.php';
loginVerification();

if($id && $status){
   if(dbUpdate("UPDATE `forms` SET `status` = '$status' WHERE `forms`.`id` = '$id';")){
      redirect("forms-manage.php?status=new");
   }
}

$where = "1";
$where .= ($status)? "  AND forms.status = '$status' " : '';

$forms = getForms($where);

?>

<!-- about section starts  -->


<div class="container">
   <h3 class="title">Forms 
   <div class="btn-group float-end" >
 
         <a href="forms-manage.php" class="btn btn-light border text-main <?=(!$status)? 'bg-light' :''?>"><i class="fa fa-fw fa-list"></i> All</a>
         <a href="forms-manage.php?status=new" class="btn btn-light border text-main <?=($status == 'new')? 'bg-light' :''?>"><i class="fa fa-fw fa-folder"></i> New</a>
         <a href="forms-manage.php?status=under consideration" class="btn btn-light border text-main <?=($status == 'under consideration')? 'bg-light' :''?>"><i class="fa fa-fw fa-history"></i> Under Consideration</a>
         <a href="forms-manage.php?status=done" class="btn btn-light border text-main <?=($status == 'done')? 'bg-light' :''?>"><i class="fa fa-fw fa-thumbs-up"></i> Done </a>
      </div>

   </h3>

   
   <div class="bg-white border shadow-sm p-4 ">
      <table class="table table-hover" id="kpis-table">
         <thead>
            <tr class="text-main">
               <th width="50">#</th>
               <th>Email</th>
               <th>FullName</th>
               <th>Support Type</th>
   
       
               <th width="150">Created</th>
               <th width="150">Updated</th>
               <th width="150">Action</th>
            </tr>
         </thead>
         <tbody>
            <?PHP
            if($forms):
            $i = 0;
            foreach ($forms as $form) {
               $i++; ?>
               <tr>
                  <td>
                    <a class="btn btn-main" href="form-info.php?id=<?= $form['id'] ?>"> <?= $form['id'] ?></a>
                  </td>
                  <td>
                  <?= $form['email'] ?>
                  </td>
         
                  <td>
                     <?= $form['fullName'] ?>
                  </td>
                  <td>
                     <?= $form['support_type'] ?>
                  </td>
               
                  
                  <td><?= $form['created'] ?></td>
                  <td><?= $form['updated'] ?></td>
                  <td>
                     
                  <?PHP if($form['status'] != 'done'){?>
                     <select class="form-select" onchange="window.location='forms-manage.php?id=<?= $form['id'] ?>&status='+this.value">
                     <?PHP if($form['status'] == 'new'){?>
                        <option value="new">New</option>
                        <?PHP }?>

                        <option value="under consideration">Under Consideration</option>
                      
                        <option value="done">Done</option>
                  
                     </select>
                     <?PHP }else{
                        echo getStatusIcon('done', true);
                        }?>
                  </td>
               </tr>
            <?PHP } endif; ?>

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