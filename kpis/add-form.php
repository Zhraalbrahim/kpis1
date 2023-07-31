<?PHP
require_once 'init.php';
include 'views/header.php';

$organizational_unit_name = post('organizational_unit_name');
$organizational_unit_code = post('organizational_unit_code');
$employee_job_code = post('employee_job_code');
$employee_job_title = post('employee_job_title');
$kpi_name = post('kpi_name');
$performance_measure = post('performance_measure');

if(isset($_POST['doSubmit'])){


   $details = ['emp_number'=> 1, 'rep_number'=> 11];
   $details = ($details) ? "'" . json_encode($details) . "'" : 'NULL';
   $sql = "INSERT INTO `forms` (`user_id`, `form_info`, `status`, `created`, `updated`) VALUES ('$user_id', $details , 'new', current_timestamp(), null)";
   echo $sql;
    $lastID =  dbInsert($sql);

      if($lastID){
        // redirect("form.php");
      }
  
}


?>

<!-- about section starts  -->


   <div class="container">
   
 
      <form method="post">
         <div class="row my-5">
         <h3 class="title"> Performance managemnt support</h3>
            <div class="col-6  bg-white border shadow-sm p-4 ">
            



               <div class="form-group ">
                  <label>&nbsp;</label>
                 <button type="submit" name="doSubmit" class="btn btn-outline-main">Submit</button>
                 
               </div>

            </div>
         </div>

      </form>
     
   </div>

<?PHP include 'views/footer.php' ?>