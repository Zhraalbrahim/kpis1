<?PHP 
require_once 'init.php';
include 'views/header.php';
?>

<!-- about section starts  -->

<div class="container" >
   <h3 class="title">Training Manage </h3>
   <div class="bg-white border shadow-sm p-4 ">
      <table class="table table-hover " id="training-table">

         <thead>
            <tr class="text-main">
               <th width="25">#</th>
               <th>Title </th>
               <th>Description</th>
               <th>File</th>
               <th width="50"><a href="training-edit.php" class="btn btn-outline-main"><i class="fa fa-fw fa-plus "></i></a></th>
            </tr>
         </thead>
         <tbody>
            <?PHP 
            $Trainings = getTrainings();
            if($Trainings){
            $i = 0;
            foreach($Trainings as $row){$i++;?>
            <tr>
               <td><?=$i?></td>
               <td><?=$row['title']?></td>
               <td><?=$row['description']?></td>
               <td>
               <a href="uploads/<?=$row['file']?>" class="text-orange"><i class="fa fa-fw fa-download "></i> Download</a>
            </td>
               <td><a href="training-edit.php?id=<?=$row['id']?>" class="btn btn-outline-main"><i class="fa fa-fw fa-edit "></i></a></td>
            </tr>
            <?PHP }}?>
          
         </tbody>
      </table>
   </div>

</div>
<script> 
$(document).ready( function () {
   /* مطابقة الآيدي مع الجدول آي دي */
    $('#training-table').DataTable();
} );
</script>
<?PHP include 'views/footer.php'?>