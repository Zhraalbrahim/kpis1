<?PHP
require_once 'init.php';
include 'views/header.php';

$title = post('title');
$description = post('description');
$file = post('file');


if (isset($_POST['doSubmit'])) {

   if (isset($_FILES['file'])) {

      $target_dir = "uploads/";
      $temp = explode(".", $_FILES["file"]["name"]);
      $newfilename = date('YmdHis') . '.' . end($temp);
      $file = $newfilename;
      move_uploaded_file($_FILES["file"]["tmp_name"],  $target_dir  . $newfilename);
   }


   if ($id) {
      if (dbUpdate("UPDATE `training_materials` SET 
     `title` = '$title',
     `description` = '$description',
     `file` = '$file'
      WHERE `training_materials`.`id` = '$id';")) {
         redirect("training-manage.php");
      }
   } else {

      $lastID =  dbInsert("INSERT INTO `training_materials` (`title`, `description`, `file`) 
     VALUES 
     ('$title', '$description', '$file')");

      if ($lastID) {
         redirect("training-manage.php");
      }
   }
}

if (isset($_POST['doDelete'])) {
   $id = post('doDelete');
   if (dbDelete("DELETE FROM training_materials WHERE `training_materials`.`id` = '$id'")) {
      redirect("training-manage.php");
   }
}


if ($id) {
   $row = getTrainingById($id);
   if (!$row) {
      redirect("training-manage.php");
   }

   $title = $row['title'];
   $description = $row['description'];
   $file = $row['file'];
}
?>

<!-- about section starts  -->


<div class="container">
   <h3 class="title text-center">
      <?= ($id) ? 'Training Edit' : 'Add new training' ?>
   </h3>

   <form method="post" enctype="multipart/form-data">
      <div class="row justify-content-md-center   my-5">
         <div class="col-4  bg-white border shadow-sm p-4 ">

            <div class="form-group mb-3">
               <label class="mb-2">Title</label>
               <input type="text" class="form-control" name="title" value="<?= $title ?>" />
            </div>


            <div class="form-group mb-3">
               <label class="mb-2">Description</label>
               <input type="text" class="form-control" name="description" value="<?= $description ?>" />
            </div>

            <div class="form-group mb-3">
               <label class="mb-2">File</label>
               <input type="file" class="form-control" name="file" value="<?= $file ?>" />
            </div>




            <div class="form-group ">
               <label>&nbsp;</label>
               <button type="submit" name="doSubmit" class="btn btn-outline-main">Submit</button>
               <button type="submit" name="doDelete" value="<?= $id ?>" class="btn btn-outline-delete float-end" onclick="return confirm('Are you sure you want delete this Training ?')">Delete</button>
            </div>

         </div>
      </div>

   </form>
</div>

<?PHP include 'views/footer.php' ?>