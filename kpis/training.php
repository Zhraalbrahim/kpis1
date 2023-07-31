<?PHP
require_once 'init.php';
include 'views/header.php';

$q = get('q');
$where = ($q) ? " AND `title` LIKE '%$q%' " : '';

$result = getRows("SELECT * FROM `training_materials` WHERE 1 $where ");
?>

<!-- about section starts  -->



<div class="container">
   <h3 class="title text-main fw-bold">Training Material</h3>
   <div class="bg-white border shadow-sm p-4 ">
      <form method="get">

         <div class="row">
            <div class="col-lg-4 ">
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <button class="btn btn-outline-main" type="submit"><i class="fa fa-fw fa-search"></i>Search</button>
                  </div>
                  <input type="text" class="form-control" placeholder="search" name="q" value="<?= $q ?>">
               </div>
            </div>
         </div>

      </form>

      <div class="row row-cols-4  p-3">

         <?PHP
         if ($result) :
            foreach ($result as $row) { ?>
               <div class="col my-2">
                  <div class=" border shadow-sm rounded p-3 bg-light border-2">
                     <h3 class="text-gray-dark"><?= $row['title'] ?></h3>
                     <p class="text-dark my-3"><?= $row['description'] ?></p>
                     <a class="text-orange" href="uploads/<?= $row['file'] ?>"><i class="fa fa-fw fa-download"></i> Download</a>
                  </div>
               </div>




            <?PHP } ?>

         <?PHP else : ?>
            no record found
         <?PHP endif; ?>


      </div>
   </div>
</div>
<script>
   /*
function doSearch(val){
   $.ajax({
            type: "GET",
            url: 'request_ajax_data.php',
            data: {val},
            success: function(response)
            {

 console.log(response);
                
           }
       });
}
*/
</script>
<?PHP include 'views/footer.php' ?>