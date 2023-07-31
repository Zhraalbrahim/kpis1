<?PHP
require_once 'init.php';
include 'views/header.php';


if (!isLoggedIn()) {
   // redirect(".");
}
$format = '';
$form = getFormById($id);
//show($form);

if(!$form){
   redirect("form.php");
}
$support_type_id = $form['support_type_id'];
$formInfo = $form['form_info'];

if ($formInfo) {
   $formInfo = json_decode($formInfo);
   $format = getFormInfoFormatByType($support_type_id, $formInfo);
}


?>

<!-- about section starts  -->

<div class="container">

   <h1 class="title"><?= $form['support_type'] ?> <small class="float-end fs-5"><?= getStatusIcon($form['status'], true) ?></small></h1>

   <div class="row">
      <div class="col-2">
         <label class="my-3">Badge Number</label>
      <h4><?= $form['badge_number'] ?></h4>
      </div>
      <div class="col-3">
      <label class="my-3">FullName</label>
      <h5><?= $form['fullName'] ?></h5>
      </div>
      <div class="col-3">
      <label class="my-3">E-Mail</label>
      <h5><?= $form['email'] ?></h5>
      </div>

      <div class="col-2">
      <label class="my-3">Created</label>
      <h5><?= $form['created'] ?></h5>
      </div>

      <?PHP if($form['updated']){?>
      <div class="col-2">
      <label class="my-3">Updated</label>
      <h5><?= $form['updated'] ?></h5>
      </div>
      <?PHP } ?>
   </div>
<hr>
 


   <h3 class="my-3">Form Informations</h3>
   <?= $format ?>


</div>
</section>
<script>
   $(document).ready(function() {

   });
</script>
<?PHP
function getFormInfoFormatByType($id, $array)
{

   switch ($id) {
      case '1':
      case '2':
         $out = '<table class="table table-hover">
               <tr>
               <th width="50">#</th>
                  <th>Employee Number</th>
                  <th>Manager Badge</th>
               </tr>';
               $i = 0 ;
         foreach ($array as $arr) :$i++;

            $out .= '<tr>';
            $out .= '<td> ' . $i . '</td>';
            $out .= '<td> ' . $arr->employee_badge . '</td>';
            $out .= '<td> ' . $arr->rep_number . '</td>';
            $out .= '</tr>';
         endforeach;
         $out .= ' </table>';
         return $out;
         break;
      case '3':

         $out = "<table class='table table-hover'>
      
                  <tr>
                     <th width='250'>Bussines Unit</th>
                     <td>$array->bussines_unit</td>
                  </tr>
                  <tr>
                     <th>Type Of Report</th>
                     <td>$array->type_of_report</td>
                     </tr>
                     ";
         $out .= ' </table>';


         return $out;

         break;

      case '4':

         $out = "<table class='table table-hover'>
                     <tr>
                        <th width='250'>Employee Number</th>
                        <td>$array->employee_badge</td>
                     </tr>
                     <tr>
                        <th>Organizational Code</th>
                        <td>$array->organizational_code</td>
                        </tr>
                     <tr>
                        <th>Bussines Unit</th>
                        <td>$array->bussines_unit</td>
                     </tr>";
         $out .= ' </table>';


         return $out;

         break;

      case '5':

         $out = "<table class='table table-hover'>
                        <tr>
                           <th width='250'>Employee Number</th>
                           <td>$array->employee_badge</td>
                        </tr>
                        <tr>
                        <th width='250'>Manager Badge</th>
                        <td>$array->manager_badge</td>
                     </tr>
                        <tr>
                           <th>Form Type</th>
                           <td>$array->form_type</td>
                           </tr>
                       ";
         $out .= ' </table>';


         return $out;

         break;

      default:
         return $array;
   }
}
?>
<?PHP include 'views/footer.php' ?>