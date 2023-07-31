<?PHP
require_once 'init.php';
include 'views/header.php';


if (!isLoggedIn()) {
   redirect(".");
}

?>

<!-- about section starts  -->

<div class="container">


   <?PHP if (!$action) {
      $where = "`forms`.`user_id` = '$user_id'";
      $where .= ($status) ? "  AND forms.status = '$status' " : '';

      $Forms = getForms($where);

   ?>
      <h3 class="title">Form List

         <div class="btn-group float-end">
            <a href="Form.php?action=add" class="btn btn-main "><i class="fa fa-fw fa-plus "></i> Add New Form</a>
            <a href="Form.php" class="btn btn-light border text-main <?= (!$status) ? 'bg-light' : '' ?>"><i class="fa fa-fw fa-list"></i> All</a>
            <a href="Form.php?status=new" class="btn btn-light border text-main <?= ($status == 'new') ? 'bg-light' : '' ?>"><i class="fa fa-fw fa-folder"></i> New</a>
            <a href="Form.php?status=under consideration" class="btn btn-light border text-main <?= ($status == 'under consideration') ? 'bg-light' : '' ?>"><i class="fa fa-fw fa-history"></i> Under Consideration</a>
            <a href="Form.php?status=done" class="btn btn-light border text-main <?= ($status == 'done') ? 'bg-light' : '' ?>"><i class="fa fa-fw fa-thumbs-up"></i> Done </a>
         </div>

      </h3>

      <div class="rounded border p-3 shadow-sm bg-white">
         <table class="table table-hover">
            <thead>
               <tr>
                  <th width="25">#</th>
                  <th width="200">Support Type </th>
                  <th width="150">Badge Number</th>
                  <th>FullName</th>
                  <th width="200">Created</th>
                  <th width="200">Updated</th>
                  <th width="200">status</th>
               </tr>
            </thead>
            <?PHP
            if ($Forms) {
            ?>
               <tbody>
                  <?PHP foreach ($Forms as $Form) {
                     $support_type_id = $Form['support_type_id'];

                  ?>
                     <tr>
                        <td>
                           <a class="btn btn-main" href="form-info.php?id=<?= $Form['id'] ?>"> <?= $Form['id'] ?></a>
                        </td>
                        <td>
                           <?= $Form['support_type'] ?>
                        </td>
                        <td>
                           <?= $Form['badge_number'] ?>
                        </td>
                        <td>
                           <?= $Form['fullName'] ?>
                        </td>
                        <td>
                           <?= $Form['created'] ?>
                        </td>
                        <td>
                           <?= $Form['updated'] ?>
                        </td>
                        <td>
                           <?PHP if ($Form['status'] == 'accepted') { ?>
                              <a href="Form.php?completed=true&id=<?= $Form['Form_id'] ?>" class="btn btn-success">Completed</a>
                           <?PHP } else { ?>
                              <?= getStatusIcon($Form['status'], true) ?>

                           <?PHP } ?>
                        </td>
                     </tr>
                  <?PHP } ?>
               </tbody>
            <?PHP } else { ?>
               <tfoot>
                  <tr>
                     <td colspan="10" class="text-center">No Forms</td>
                  </tr>
               </tfoot>
            <?PHP } ?>
         </table>


      <?PHP } else if ($action == 'add') {
      $supportTypes = getSupportTypes();
      if (isset($_POST['doSubmit'])) {
         $details = [];
         $support_type_id = post('support_type_id');


         if ($support_type_id == 1 || $support_type_id == 2) {

            $employee_badge = post('employee_badges');
            $rep_number = post('rep_number');

            $arr = [];
            $i = 0;
            if ($employee_badge) {
               foreach ($employee_badge as $e) :
                  array_push($arr, ['employee_badge' => $e, 'rep_number' => $rep_number[$i]]);
                  $i++;
               endforeach;
            }
            $details = $arr;
         } else if ($support_type_id == 3) {

            $bussines_unit = post('bussines_unit_3');
            $type_of_report = post('type_of_report');
            $details = ['bussines_unit' => $bussines_unit, 'type_of_report' => $type_of_report];
         } else if ($support_type_id == 4) {

            $employee_badge = post('employee_badge_4');
            $organizational_code = post('organizational_code');
            $bussines_unit = post('bussines_unit_4');
            $details = ['employee_badge' => $employee_badge, 'organizational_code' => $organizational_code, 'bussines_unit' => $bussines_unit];
         } else if ($support_type_id == 5) {

            $employee_badge = post('employee_badge_5');
            $manager_badge = post('manager_badge_5');
            $form_type = post('form_type');
            $details = ['employee_badge' => $employee_badge, 'manager_badge' => $manager_badge, 'form_type' => $form_type];
         }

         $details = ($details) ? "'" . json_encode($details) . "'" : 'NULL';
         $sql = "INSERT INTO `forms` (`user_id`, `support_type_id`, `form_info`, `status`, `created`, `updated`) VALUES ('$user_id', '$support_type_id', $details , 'new', current_timestamp(), null)";


         $lastID =  dbInsert($sql);

         if ($lastID) {
            redirect("form.php");
         }
      }
      ?>

         <form method="post">

            <div class="row justify-content-md-center   my-5">
               <h3 class="title text-center"> Performance managemnt support</h3>


               <div class="col-6  bg-white border shadow-sm p-4 ">



                  <div class='mb-3'>
                     <label class="my-3" for='support_type_id'>Support Type</label>
                     <select name="support_type_id" id="support_type_id" class="form-select">
                        <?PHP foreach ($supportTypes as $type) { ?>
                           <option value="<?= $type['id'] ?>"><?= $type['support_type'] ?></option>
                        <?PHP } ?>
                     </select>
                  </div>

                  <div class='mb-3' id="div_1">

                     <div id="row_1">
                        <div class="row">
                           <div class="col-6">
                              <label class="my-2">Employee Badge</label>
                              <input type="number" name="employee_badges[]" id="employee_badges" class="form-control" />
                           </div>
                           <div class="col-6">
                              <label class="my-2">Manager Badge</label>
                              <input type="number" name="rep_number[]" id="rep_number" class="form-control" />
                           </div>
                        </div>

                     </div>

                     <button type="button" id="addRow" class="btn btn-main my-2 float-end"><i class="fa fa-fw fa-plus  "></i></button>

                  </div>

                  <div class='mb-3' id="div_3" style="display: none;">
                     <div class="col-12">
                        <label class="my-2">Bussines Unit</label>
                        <select name="bussines_unit_3" id="bussines_unit" class="form-select">
                           <option value="Human resources & Corporate services">Human resources & Corporate services</option>
                           <option value="Distribution & Customer Services">Distribution & Customer Services</option>
                           <option value="INTERNAL ADUTING">INTERNAL ADUTING</option>
                           <option value="National Grid (SA)">National Grid (SA)</option>
                           <option value="Technical Services  BL ">Technical Services BL</option>
                           <option value="Saudi energy production company">Saudi energy production company</option>
                           <option value="Saudi electircity Project Development CO">Saudi electircity Project Development CO</option>
                           <option value="Information Technology &DIgital Transformation ">Information Technology &DIgital Transformation</option>
                           <option value="HSSE Business Line">HSSE Business Line</option>
                           <option value="Stratigic planning & Investment">Stratigic planning & Investment</option>
                           <option value="Finance">Finance</option>
                           <option value="Risk managemnt & Complaince BL">Risk managemnt & Complaince BL</option>
                           <option value="CEO Support Sector">CEO Support Sector</option>
                           <option value="Corporate Communication & Marketing">Corporate Communication & Marketing</option>
                           <option value="CEO Office">CEO Office</option>
                           <option value="Legal Affairs & BoD Trustee">Legal Affairs & BoD Trustee</option>
                           <option value="Dawiyat Integreated Telecom">Dawiyat Integreated Telecom</option>
                           <option value="Solutions Valley Company">Solutions Valley Company</option>
                        </select>
                     </div>

                     <div class="col-12">
                        <label class="my-2">Type Of Report</label>
                        <select name="type_of_report" id="type_of_report" class="form-select">
                           <option value="Goals report">Goals report</option>
                           <option value="Performance indicators report">Performance indicators report</option>
                        </select>
                     </div>

                  </div>


                  <div class='mb-3' id="div_4" style="display: none;">
                     <div id="row_4">
                        <div class="row">
                           <div class="col-6">
                              <label class="my-2">Employee Badge</label>
                              <input type="text" name="employee_badge_4" id="employee_badge" class="form-control" />
                           </div>
                           <div class="col-6">
                              <label class="my-2">Organizational Code</label>
                              <input type="text" name="organizational_code" id="organizational_code" class="form-control" />
                           </div>

                           <div class="col-12">
                              <label class="my-2">Bussines Unit</label>
                              <select name="bussines_unit_4" id="bussines_unit" class="form-select">
                                 <option value="Human resources & Corporate services">Human resources & Corporate services</option>
                                 <option value="Distribution & Customer Services">Distribution & Customer Services</option>
                                 <option value="INTERNAL ADUTING">INTERNAL ADUTING</option>
                                 <option value="National Grid (SA)">National Grid (SA)</option>
                                 <option value="Technical Services  BL ">Technical Services BL</option>
                                 <option value="Saudi energy production company">Saudi energy production company</option>
                                 <option value="Saudi electircity Project Development CO">Saudi electircity Project Development CO</option>
                                 <option value="Information Technology &DIgital Transformation ">Information Technology &DIgital Transformation</option>
                                 <option value="HSSE Business Line">HSSE Business Line</option>
                                 <option value="Stratigic planning & Investment">Stratigic planning & Investment</option>
                                 <option value="Finance">Finance</option>
                                 <option value="Risk managemnt & Complaince BL">Risk managemnt & Complaince BL</option>
                                 <option value="CEO Support Sector">CEO Support Sector</option>
                                 <option value="Corporate Communication & Marketing">Corporate Communication & Marketing</option>
                                 <option value="CEO Office">CEO Office</option>
                                 <option value="Legal Affairs & BoD Trustee">Legal Affairs & BoD Trustee</option>
                                 <option value="Dawiyat Integreated Telecom">Dawiyat Integreated Telecom</option>
                                 <option value="Solutions Valley Company">Solutions Valley Company</option>
                              </select>
                           </div>

                        </div>

                     </div>
                  </div>


                  <div class='mb-3' id="div_5" style="display: none;">

                     <div class="row">
                        <div class="col-6">
                           <label class="my-2">Employee Badge</label>
                           <input type="text" name="employee_badge_5" id="employee_badge" class="form-control" />
                        </div>

                        <div class="col-6">
                           <label class="my-2">Manager Badge</label>
                           <input type="text" name="manager_badge_5" id="manager_badge_5" class="form-control" />
                        </div>


                        <div class="col-12">
                           <label class="my-2">Form Type</label>
                           <select name="form_type" id="form_type" class="form-select">
                              <option value="Planning objective  (non managerial -2033)">Planning objective (non managerial -2033)</option>
                              <option value="Leadership planning objective 2023">Leadership planning objective 2023</option>
                              <option value="performance review form 2023">performance review form 2023</option>
                           </select>
                        </div>

                     </div>


                  </div>







                  <div class="form-group ">
                     <label class="my-2">&nbsp;</label>
                     <button type="submit" name="doSubmit" class="btn btn-outline-main">Submit</button>

                  </div>

               </div>
            </div>

         </form>

      <?PHP } ?>


      </div>
      </section>
      <script>
         $(document).ready(function() {
            const support_type = 0;



            $('#support_type_id').on('change', function() {
               console.log(this.value);

               $('#div_1').hide();
               $('#div_3').hide();
               $('#div_4').hide();
               $('#div_5').hide();

               if (this.value == 1 || this.value == 2) {
                  $('#div_1').show();
               } else if (this.value == 3) {
                  $('#div_3').show();

               } else if (this.value == 4) {
                  $('#div_4').show();

               } else if (this.value == 5) {
                  $('#div_5').show();

               }

            });

            $('#addRow').on('click', function() {

               var outHtml = '';
               outHtml += `<div class="row">
                        <div class="col-6">
                           <label class="my-2">Employee Badge</label>
                           <input type="number" name="employee_badges[]" id="employee_badge" class="form-control"  />
                        </div>
                        <div class="col-6">
                           <label class="my-2">Manager Badge</label>
                           <input type="number" name="rep_number[]" id="rep_number" class="form-control"  />
                        </div>
                     </div>`;

               $('#row_1').append(outHtml);


            });



         });
      </script>

      <?PHP include 'views/footer.php' ?>