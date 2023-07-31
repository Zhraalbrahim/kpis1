<?php

if(!isset($_SESSION)){
    session_start();
}

define("SERVER_HOST", "localhost");
define("SERVER_USER", "root");
define("SERVER_PASS", "");
define("SERVER_DB", "kpis_db");

date_default_timezone_set('asia/Riyadh');
$conn = new mysqli(SERVER_HOST, SERVER_USER, SERVER_PASS, SERVER_DB);

require 'config/functions.php';
require 'config/functions-db.php';
require 'config/functions-queries.php';
/* name of site */
define("SITE_NAME", "KPIs Library");

$errors = NULL;
$applicant = null;
$company = null;

$page = get('page');
$action = get('action');
$user_id = getUserId();
$usertype = get('usertype');
$status = get('status');

$id = get('id');
$item_id = get('item_id');


$msg_ok = get('msg_ok');
$msg_info = get('msg_info');
$msg_warning = get('msg_warning');
$msg_error = get('msg_error');

$page = getPageName();
