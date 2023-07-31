<?PHP
require_once 'init.php';
include 'views/header.php';

if (!isCustomer()) {
    redirect(".");
}
$user = getCustomerById($user_id);

if ($user) {
    $email = $user['email'];
    $fname = $user['fname'];
    $lname = $user['lname'];
    $phone = $user['phone'];
    $address = $user['address'];
}

if (isset($_POST['doSave'])) {


    $current_password = post('current_password');
    $password = post('password');
    $email = post('email');
    $fname = post('fname');
    $lname = post('lname');
    $phone = post('phone');
    $address = post('address');

    $more = "";
    if ($password) {
        
            if(!getRow("SELECT * FROM `customer` WHERE `customer_id` = '$user_id' AND password = md5('$current_password') ")){
                $errors['current_password']  = 'Please enter the correct current password';
            }

        $more .= ", `password` = md5('$password') ";
    }

    if ($errors == NULL) {


        $sql = "UPDATE `customer` SET `customer_id` = '$user_id', `fname` = '$fname', `lname` = '$lname', `phone` = '$phone', `address` = '$address' $more WHERE `customer`.`customer_id` = '$user_id';";

        $isUpdate = dbUpdate($sql);

        if ($isUpdate) {
            redirect("index.php");
        }
    }
}

if (isset($_GET['unsubscribe'])) {
    $id = get('unsubscribe');
    dbDelete("DELETE FROM `customer` WHERE `customer_id` = '$id' ");
    redirect("logout.php");
}


?>

<!-- consultation section starts  -->

<section class="container">
    <form method="post" enctype="multipart/form-data" id="xForm">
        <div class="heading text-start">
            <span><a class="text-main" href="profile.php">Profile</a></span>
            <h1>Customer Profile

                <button class="btn btn-success btn-lg float-end" name="doSave" type="submit">Save</button>
            </h1>

            <div class="rounded border p-3 shadow-sm">



                <div class="row">


                    <div class="col-lg-6 ">




                        <!-- fname input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="fname">First Name</label>
                            <input type="text" id="fname" name="fname" class="form-control form-control-lg" value="<?= $fname ?>" />
                            <?= printValidationError('fname'); ?>
                        </div>

                        <!-- lname input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="lname">First Name</label>
                            <input type="text" id="lname" name="lname" class="form-control form-control-lg" value="<?= $lname ?>" />
                            <?= printValidationError('lname'); ?>
                        </div>


                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" class="form-control form-control-lg" placeholder="Enter a valid phone" value="<?= $phone ?>" />
                            <?= printValidationError('phone'); ?>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Permanently cancel the account</label>
                            <a href="profile.php?unsubscribe=<?= $user['customer_id'] ?>" class="btn btn-danger btn-sm w-100" onclick="return confirm('Do you want to permanently cancel the account?');">Yes, I want to permanently cancel the account</a>
                        </div>

                    </div>


                    <div class="col-lg-6 ">

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">E-Mail</label>
                            <input type="email" disabled="" class="form-control form-control-lg" value="<?= $email ?>" />
                            <?= printValidationError('email'); ?>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Current Password</label>
                            <input type="password" id="current_password" name="current_password" class="form-control form-control-lg" placeholder="Enter Current Password" />
                            <?= printValidationError('current_password'); ?>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Enter password" />
                            <?= printValidationError('password'); ?>
                        </div>






                    </div>
                </div>

            </div>
        </div>
    </form>
</section>