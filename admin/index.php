<?php
session_start();
// Set Language variable
$_SESSION['lang']=isset($_GET['lang'])?$_GET['lang']:"en";
// Include Language file
if ($_SESSION['lang'] == "en") {
    include "resources/lang/en.php";
} elseif ($_SESSION['lang'] == "ar") {
    include "resources/lang/ar.php";
} else {
    include "resources/lang/en.php";
}
?>
<?php require "config.php"?>
<?php require "resources/includes/header.inc" ?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $adminUsername = $_POST['adminUsername'];
        $adminPassword =  $_POST['adminPassword'];
        $hashedPass= sha1($adminPassword);
        $query= "SELECT * FROM  users WHERE username= ? AND password= ? AND groupid !=0";
        $stmt= $con->prepare($query);
        $stmt->execute(array($adminUsername , $hashedPass));
        $row= $stmt->fetchAll();
        /*
         ** $rowCount() -> boolen function return 1 if data in DB | 0 if data doesn't in DB
        */
        $count= $stmt->rowCount();
        $inDb= 1 ;
        if ($count == $inDb){
            $_SESSION['USER_ID'] = $row['userid'];
            $_SESSION['USER_NAME'] = $row['username'];
            $_SESSION['EMAIL'] = $row['email'];
            $_SESSION['FULL_NAME'] = $row['fullname'];
            $_SESSION['GROUP_ID'] = $row['groupid'];
            header("location:dashboard.php");
            exit();
        }

    }
?>
    <!--login form-->
    <div class="container">
        <h2 class="text-center"><?= $lang['admin_login'] ?></h2>
        <!-- Language -->
        <section class="lang-choice">
            <a href="?lang=en">English</a>
            <a href="?lang=ar">العربية</a>
        </section>
        <!-- /Language -->
        <section class="login border-top">
            <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">username</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="adminUsername">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="adminPassword">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </section>
    </div>

    <!--/login form-->


<?php require "resources/includes/footer.inc" ?>