<?PHP
require_once 'init.php';
include 'views/header.php';
loginVerification();

$where = "1";

$consultations = getUsers($where . " ORDER BY `users`.`lastlogin` DESC");

?>

<!-- about section starts  -->


<div class="container">
   <h3 class="title">Users 


   </h3>

   
   <div class="bg-white border shadow-sm p-4 ">
      <table class="table table-hover" id="kpis-table">
         <thead>
            <tr class="text-main">
               <th width="50">#</th>
               <th>Email</th>
               <th>First Name</th>
               <th>Last Name</th>
               <th>Badge Number</th>

               <th width="200">LastLogin</th>
            </tr>
         </thead>
         <tbody>
            <?PHP
            $i = 0;
            foreach ($consultations as $consultation) {
               $i++; ?>
               <tr>
                  <td>
                     <?= $consultation['id'] ?>
                  </td>
                  <td>
                  <?= $consultation['email'] ?>
                  </td>
         
                  <td>
                     <?= $consultation['first_name'] ?>
                  </td>
                  <td>
                     <?= $consultation['last_name'] ?>
                  </td>
                  <td>
                     <?= $consultation['badge_number'] ?>
                  </td>

                  <td><?= $consultation['lastlogin'] ?></td>
            

               </tr>
            <?PHP } ?>

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