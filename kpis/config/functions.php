<?php

function show($arr = null)
{
    if ($arr) {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }
}

/*redirect from page to other*/
function redirect($location)
{
    echo "<script>window.location='$location'</script>";
}

/*get value by form submit*/
function post($parm = "")
{
    if (isset($_POST[$parm]) && $_POST[$parm]) {
        return $_POST[$parm];
    }
}

/*get value by url */
function get($parm = "")
{
    if (isset($_GET[$parm]) && $_GET[$parm]) {
        return $_GET[$parm];
    }
}

function getPageName()
{
    return basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
}



function _ucwords($text, $sp = '_')
{
    $str = str_replace($sp, " ", $text);
    return ucwords($str);
}


function printMSG($fixed = false)
{

    $color = "";
    $icon = "";
    $msg = "";
    global $msg_ok, $msg_info, $msg_warning, $msg_error;

    if ($msg_ok) {
        $color = "success";
        $icon = "check";
        $msg = $msg_ok;
    } else if ($msg_info) {
        $color = "info";
        $icon = "info";
        $msg = $msg_info;
    } else if ($msg_warning) {
        $color = "warning";
        $icon = "exclamation-triangle";
        $msg = $msg_warning;
    } else if ($msg_error) {
        $color = "danger";
        $icon = "times";
        $msg = $msg_error;
    }

    if ($msg) :
        $out = "<div id='div_msg' class=\"alert alert-$color\"><strong class='fa fa-$icon'></strong> $msg</div>";

        if ($fixed) :
            $out .= "<script>setTimeout(function() { $('#div_msg').slideToggle();  }, $fixed);</script>";
        endif;
        return  $out;
    endif;
}

function printErrors($errors = null, $hide = false)
{

    if ($errors != NULL) :
        echo '<div id="div_errors" class="alert alert-danger">';
        foreach ($errors as $error) :
            echo "<h5><i class='fa fa-caret-right'></i> $error</h6>";
        endforeach;
        echo "</div>";
        if ($hide) :
            echo "<script>setTimeout(function() { $('#div_errors').slideToggle(); }, 5000);</script>";
        endif;

    endif;
}



/*_SESSION functions*/
function isLoggedIn()
{
    return (isset($_SESSION['logged_in'])) ? TRUE : FALSE;
}


function getUserId()
{
    return (isLoggedIn()) ? $_SESSION['user_id'] : 0;
}
function getUserType()
{
    return (isLoggedIn()) ? $_SESSION['user_type'] : NULL;
}
function getEmail()
{
    return (isLoggedIn()) ? $_SESSION['user_email'] : NULL;
}

function isAdmin()
{
    return (getUserType() == 'admin') ? TRUE : FALSE;
}
function isUser()
{
    return (getUserType() == 'user') ? TRUE : FALSE;
}

function loginVerification()
{
    if (!isLoggedIn()) {
        redirect("index.php");
    }
}


/*General functions*/







function getStatusIcon($status = "false", $withName = "")
{
    $color = "";
    $icon = "";
    switch ($status):
        case 'all':
            $color = 'dark';
            $icon = 'list';
            break;
        case 'done':
        case 'active':
        case 'paid':
            $color = 'success';
            $icon = 'check';
            break;

        case 'inactive':
        case 'unpaid':
            $color = 'dark';
            $icon = 'times';
            break;

        case 'new':
            $color = 'dark';
            $icon = 'folder';
            break;

        case 'accepted':
            $color = 'info';
            $icon = 'check';
            break;
        case 'rejected':
            $color = 'danger';
            $icon = 'times';
            break;
        case 'delete':
            $color = 'danger';
            $icon = 'trash';
            break;
        case 'under consideration':
            $color = 'warning';
            $icon = 'history';
            break;
        case 'completed':
            $color = 'success';
            $icon = 'thumbs-up';
            break;

    endswitch;

    if ($withName) {
        return "<i class='text-" . $color . " fa fa-fw fa-" . $icon . "'></i> " . _ucwords($status);
    } else {
        return "<i class='text-" . $color . " fa fa-fw fa-" . $icon . "'></i>";
    }
}


function printValidationError($error = "")
{
    global $errors;
    if (isset($errors[$error]) && $errors[$error]) {
        return '<small class="text-danger">' . $errors[$error] . '</small>';;
    }
}
