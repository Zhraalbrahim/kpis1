<?PHP 
require_once 'init.php';
include 'views/header.php';
$kpis = getKpis();
?>

<!-- about section starts  -->

<div class="container" >
   <h3 class="title">KPIs Library </h3>
   <div class="bg-white border shadow-sm p-4 ">
      <table class="table table-hover " id="kpis-table">
         <thead>
            <tr>
               <th>#</th>
               <th>Organizational Unit Name </th>
               <th>Organizational Unit Code</th>
               <th>Employee Job Code</th>
               <th>Employee Job Title</th>
               <th>Kpi Name</th>
               <th>Performance Measure</th>

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
            </tr>
            <?PHP } endif; ?>
          
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