<?PHP

/* Database Functions */

function getRows($query = "") {
    global $conn;
    $result = ($query) ? $conn->query($query) : NULL;
    $result->fetch_array(MYSQLI_ASSOC);
    $arr = NULL;
    foreach ($result as $row):
        $arr[] = $row;
    endforeach;
    return (isset($arr) && $arr) ? $arr : NULL;
}

function getRow($query = "") {
    $result = getRows($query);
    return ($result) ? $result[0] : NULL;
}

function dbInsert($query = "") {
    global $conn;
    $conn->query($query);
    $insert_id = mysqli_insert_id($conn);
    return ($insert_id) ? $insert_id : 0;
}

function dbUpdate($query = "") {
    global $conn;
    $conn->query($query);
    return ($conn->affected_rows > 0) ? true : false;
}

function dbDelete($query = "") {
    global $conn;
    $conn->query($query);
    return ($conn->affected_rows > 0) ? true : false;
}

function getGroupConcat($col = "", $table = "", $where = ""){
    $sql = "SELECT GROUP_CONCAT($col)as 'group_ids' FROM `$table` WHERE $where ";
    $row = getRow($sql);
    return ($row['group_ids'])? $row['group_ids'] : 0;
}
