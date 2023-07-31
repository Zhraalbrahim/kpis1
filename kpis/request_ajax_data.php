<?PHP 
require_once 'init.php';
$val = get('val');
$result = getRows("SELECT * FROM `training_materials` WHERE `title` LIKE '%$val%'");
show($result);
echo json_encode($result);

?>