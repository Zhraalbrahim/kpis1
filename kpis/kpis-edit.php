<?PHP
require_once 'init.php';
include 'views/header.php';

$organizational_unit_name = post('organizational_unit_name');
$organizational_unit_code = post('organizational_unit_code');
$employee_job_code = post('employee_job_code');
$employee_job_title = post('employee_job_title');
$kpi_name = post('kpi_name');
$performance_measure = post('performance_measure');

if (isset($_POST['doSubmit'])) {

   if (!$organizational_unit_name) {
      $errors['organizational_unit_name'] = "Organizational Unit Name empty !!!";
   }

   if (!$organizational_unit_code) {
      $errors['organizational_unit_code'] = "Organizational Unit Code empty !!!";
   }

   if (!$employee_job_code) {
      $errors['employee_job_code'] = "Employee Job Code empty !!!";
   }

   if (!$employee_job_title) {
      $errors['employee_job_title'] = "Employee Job Title empty !!!";
   }

   if (!$kpi_name) {
      $errors['kpi_name'] = "Kpi Name empty !!!";
   }

   if (!$performance_measure) {
      $errors['performance_measure'] = "Performance Measure empty !!!";
   }


   if ($errors == null) :

      if ($id) {
         if (dbUpdate("UPDATE `kpis` SET 
     `organizational_unit_name` = '$organizational_unit_name',
     `organizational_unit_code` = '$organizational_unit_code',
     `employee_job_code` = '$employee_job_code',
     `employee_job_title` = '$employee_job_title',
     `kpi_name` = '$kpi_name',
     `performance_measure` = '$performance_measure'
      WHERE `kpis`.`id` = '$id';")) {
            redirect("kpis-manage.php");
         }
      } else {

         $lastID =  dbInsert("INSERT INTO `kpis` (`organizational_unit_name`, `organizational_unit_code`, `employee_job_code`, `employee_job_title`, `kpi_name`, `performance_measure`) 
     VALUES 
     ('$organizational_unit_name', '$organizational_unit_code', '$employee_job_code', '$employee_job_title', '$kpi_name', '$performance_measure')");

         if ($lastID) {
            redirect("kpis-manage.php");
         }
      }

   endif;
}

if (isset($_POST['doDelete'])) {
   $id = post('doDelete');
   if (dbDelete("DELETE FROM kpis WHERE `kpis`.`id` = '$id'")) {
      redirect("kpis-manage.php");
   }
}


if ($id) {
   $row = getKpiById($id);
   if (!$row) {
      redirect("kpis-manage.php");
   }
   $organizational_unit_name = $row['organizational_unit_name'];
   $organizational_unit_code = $row['organizational_unit_code'];
   $employee_job_code = $row['employee_job_code'];
   $employee_job_title = $row['employee_job_title'];
   $kpi_name = $row['kpi_name'];
   $performance_measure = $row['performance_measure'];
}
?>

<!-- about section starts  -->


<div class="container">
   <h3 class="title text-center">
      <?= ($id) ? 'KPIs Edit' : 'Add new kpi' ?>
   </h3>

   <form method="post">
      <div class="row justify-content-md-center   my-5">
         <div class="col-4  bg-white border shadow-sm p-4 ">

            <div class="form-group mb-3">
               <label class="mb-2">Organizational Unit Name</label>
               <input type="text" class="form-control" name="organizational_unit_name" value="<?= $organizational_unit_name ?>" />
               <?= printValidationError('organizational_unit_name'); ?>
            </div>


            <div class="form-group mb-3">
               <label class="mb-2">Organizational Unit Code</label>
               <input type="text" class="form-control" name="organizational_unit_code" value="<?= $organizational_unit_code ?>" />
               <?= printValidationError('organizational_unit_code'); ?>
            </div>

            <div class="form-group mb-3">
               <label class="mb-2">Employee Job Code</label>
               <input type="text" class="form-control" name="employee_job_code" value="<?= $employee_job_code ?>" />
               <?= printValidationError('employee_job_code'); ?>
            </div>

            <div class="form-group mb-3">
               <label class="mb-2">Employee Job title</label>
               <input type="text" class="form-control" name="employee_job_title" value="<?= $employee_job_title ?>" />
               <?= printValidationError('employee_job_title'); ?>
            </div>

            <div class="form-group mb-3">
               <label class="mb-2">Kpi Name</label>
               <input type="text" class="form-control" name="kpi_name" value="<?= $kpi_name ?>" />
               <?= printValidationError('kpi_name'); ?>
            </div>

            <div class="form-group mb-3">
               <label class="mb-2">Performance Measure</label>
               <input type="text" class="form-control" name="performance_measure" value="<?= $performance_measure ?>" />
               <?= printValidationError('performance_measure'); ?>
            </div>

            <div class="form-group ">
               <label>&nbsp;</label>
               <button type="submit" name="doSubmit" class="btn btn-outline-main">Submit</button>
               <button type="submit" name="doDelete" value="<?= $id ?>" class="btn btn-outline-delete float-end" onclick="return confirm('Are you sure you want delete this KPI ?')">Delete</button>
            </div>

         </div>
      </div>

   </form>

</div>

<?PHP include 'views/footer.php' ?>