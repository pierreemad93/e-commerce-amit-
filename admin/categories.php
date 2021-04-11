<?php  
    session_start();
    $do=isset($_GET['do'])?$_GET['do']:"manage"; 
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
<?php require "resources/includes/navbar.inc"?>

<?php require "resources/includes/footer.inc" ?>
<?php if($do == "manage"):?>
<?php elseif($do == "add"):?>
<?php elseif($do == "insert"):?>
<?php elseif($do == "edit"):?>
<?php elseif($do == "update"):?>
<?php elseif($do == "delete"):?>
<?php elseif($do == "show"):?>
<?php else:?>
<?php 
     header("location:index.php");
?>
<?php endif?>