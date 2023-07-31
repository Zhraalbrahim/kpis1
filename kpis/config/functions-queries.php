<?PHP 
/*functions work with database*/
function isEmailAvailable($email = "") {
    $available = true;
    if (isExists("admin", "email", $email) || isExists("users", "email", $email)) {
        $available = FALSE;
    }
    return $available;
}

function isExists($tableName = "", $col = "", $email = "") {

    $sql = "SELECT * FROM " . $tableName . " WHERE $col = '$email'";
    $row = getRow($sql);
    return (isset($row) && count($row) > 0);
}

/* Database Queries */

function getCountOf($table = "", $where = "1") {
    
    if($table):
        $result = getRow("SELECT count(*)as 'count' FROM `$table` WHERE $where ");
        return (isset($result))? $result['count'] : 0;
    endif;
    
}

function getAdmins($where = "1") {
    $result = getRows("SELECT * FROM `admin` Where $where ");
    return $result;
}

function getAdminById($id = 0) {
    if ($id) {
        $row = getAdmins(" `admin_id` = '$id' ");
        return ($row)? $row[0] : null;
    }
}

function getKpis($where = "1") {
    $result = getRows("SELECT * FROM `kpis` Where $where ");
    return $result;
}

function getKpiById($id = 0) {
   
    if ($id) {
      
        $row = getKpis(" `kpis`.`id` = '$id' ");
        
        return ($row)? $row[0] : null;
    }
}


function getTrainings($where = "1") {
    $result = getRows("SELECT * FROM `training_materials` Where $where ");
    return $result;
}

function getTrainingById($id = 0) {
   
    if ($id) {
      
        $row = getTrainings(" `training_materials`.`id` = '$id' ");
        
        return ($row)? $row[0] : null;
    }
}


function getUsers($where = "1") {
    $result = getRows("SELECT *,  concat(first_name, ' ', last_name)as fullName FROM `users` Where $where ");
    return $result;
}

function getUserById($id = 0) {
    if ($id) {
        $row = getUsers(" `id` = '$id' ");
        return ($row)? $row[0] : null;
    }
}


function getConsultations($where = "1") {
    $sql = "SELECT consultation.*, users.email, badge_number,  concat(first_name, ' ', last_name)as fullName  FROM `consultation` 
    LEFT JOIN users ON users.id = consultation.user_id
    Where $where ";

    $result = getRows($sql);
    return ($result)? $result : null;
}

function getConsultationById($id = 0) {
    if ($id) {
        $row = getConsultations(" `consultation`.consultation_id = '$id' ");
        return ($row)? $row[0] : null;
    }
}


function getSupportTypes($where = "1") {
    $sql = "SELECT * FROM `support_types`
    Where $where ";
    $result = getRows($sql);
    return ($result)? $result : null;
}

function getSupportTypeById($id = 0) {
    if ($id) {
        $row = getSupportTypes(" `support_types`.id = '$id' ");
        return ($row)? $row[0] : null;
    }
}

function getForms($where = "1") {
    $sql = "SELECT forms.*, support_types.support_type, users.email, badge_number,  concat(first_name, ' ', last_name)as fullName FROM `forms`
    LEFT JOIN users ON users.id = forms.user_id
    LEFT JOIN support_types ON support_types.id = forms.support_type_id
    Where $where ";

    $result = getRows($sql);
    return ($result)? $result : null;
}

function getFormById($id = 0) {
    if ($id) {
        $row = getForms(" `forms`.id = '$id' ");
        return ($row)? $row[0] : null;
    }
}






