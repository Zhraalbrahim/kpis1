<?PHP 
require_once 'init.php';
include 'views/header.php';

$kpis = getKpis();
?>

<!-- about section starts  -->


   <div class="container">
   <h3 class="title">KPIs Manage </h3>
   <div class="bg-white border shadow-sm p-4 ">
   <table class="table table-hover" id="kpis-table">
         <thead>
            <tr class="text-main">
               <th>#</th>
               <th><small>Organizational Unit Name</small> </th>
               <th><small>Organizational Unit Code</small></th>
               <th><small>Employee Job Code</small></th>
               <th><small>Employee Job Title</small></th>
               <th><small>Kpi Name</small></th>
               <th><small>Performance Measure</small></th>
               <th><a href="kpis-edit.php" class="btn btn-outline-main"><i class="fa fa-fw fa-plus "></i></a></th>
            </tr>
         </thead>
         <tbody>
            <?PHP 
            if($kpis):
            $i = 0;
            foreach($kpis as $kip){$i++;?>
            <tr>
               <td><?=$i?></td>
               <td><?=$kip['organizational_unit_name']?></td>
               <td><?=$kip['organizational_unit_code']?></td>
               <td><?=$kip['employee_job_code']?></td>
               <td><?=$kip['employee_job_title']?></td>
               <td><?=$kip['kpi_name']?></td>
               <td><?=$kip['performance_measure']?></td>
               <td><a href="kpis-edit.php?id=<?=$kip['id']?>" class="btn btn-outline-main"><i class="fa fa-fw fa-edit "></i></a></td>
            </tr>
            <?PHP } endif;?>
          
         </tbody>
      </table>
   </div>
   </div>

<script> 
$(document).ready( function () {
   /* مطابقة الآيدي مع الجدول آي دي */
    $('#kpis-table').DataTable();
} );
</script>
<?PHP include 'views/footer.php'?>